<?php

namespace App\Http\Livewire\Reciept;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\MaintenanceUser;
use App\Models\InvoiceModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyModel;
use App\Jobs\RecieptSendMail;
use Carbon;

class Reciept extends Component

{
    public $perPage='10', $search_name = '', $isOpen = 0 , $isUserOpen = 0,
    $uuid,
    $payable_amount ,
    $paid_amount,
    $comment,
    $admin,
    $created_by,
    $remaining_amount,
    $payment_date,
    $year,
    $month,
    $created_for,
    $error_msg,
    $payment_method,
    $search_year = ''
    ,$search_month='',
    $properties,
    $property_id;


    public function mount(){
        $this->properties = PropertyModel::all(); 
       
    }
    public function render()

    {
        $invoices = DB::table('maintenance')
        ->join('properties', 'maintenance.property_id', '=', 'properties.id')
        ->join('users', 'properties.user_id', '=', 'users.id')
        ->join('admins', 'maintenance.create_by', '=', 'admins.id')
        ->select('maintenance.*', 'users.user_name', 'properties.area','admins.name')
        ->where('maintenance.transaction_type' , 'cr')
        ->where('users.user_name', 'like', '%' . $this->search_name . '%')
        ->where('month', 'like', '%' . $this->search_month . '%')
        ->where('year', 'like', '%' . $this->search_year . '%')
        ->paginate($this->perPage);
        
        return view('livewire.reciept.reciept',
    [
        'invoices' => $invoices 
    ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
    public function openModal()
    {
       
        $this->isOpen = true;
    }
    public function closeModal(){
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->resetErrorBag();
        
        $this->created_by = '' ;
        $this->created_for = '' ;
        $this->error_msg = ''; 
        $this->comment = '';
        $this->month = '' ;
        $this->year = '';
        $this->payable_amount = '' ;
        $this->payment_method = '';
        $this->uuid = '';
        $this->paid_amount = '';
        $this->search_year = '';
        $this->search_month='';
        $this->search_name= '';
        $this->property_id = '';
    }

    public function store(){
        $this->validate([
            'property_id' => 'required',
            'year' => 'required',
            'month' => 'required',
            'payable_amount' => 'required',
            'paid_amount' => 'required',
            'payment_method' => 'required',
        ]);
        $created_by = Auth::id();       

        
        $data = [
            'property_id' => $this->property_id,
            'year' => $this->year,
            'month' => $this->month,
            'transaction_type'=>'CR',
            'payment_method' => $this->payment_method,
            'comment' => $this->comment,
            'create_by'=>$created_by,
            'total_amount' => $this->paid_amount
        ];
        if ($this->uuid == null)   {
            $uuid = (string) Str::uuid();
            $data['uuid'] = $uuid;
            $data['created_by'] = $created_by;
        }
          $test = MaintenanceUser::updateOrCreate(['uuid' => $this->uuid], $data);

        $properties = PropertyModel::where('id', $this->property_id)->first();
        $maintenance_dr = MaintenanceUser::where('property_id', $this->property_id)
            ->where('month' , $this->month)
            ->where('year' , $this->year)
            ->where('transaction_type' , 'DR')
            ->first();

        $maintenance_cr = MaintenanceUser::where('property_id', $this->property_id)
            ->where('month' , $this->month)
            ->where('year' , $this->year)
            ->where('transaction_type' , 'CR')
            ->first();

        $remaining_amount = $maintenance_dr->total_amount - $maintenance_cr->total_amount ;

        $mydate = Carbon\Carbon::now()->format('d-m-Y');

        $recieptMailData = [
            'email' => $properties->user->email,
            'user_name' => $properties->user->user_name,
            'maintenance_type' => $maintenance_dr->type,
            'remaining_amount' => $remaining_amount,
            'total' => $maintenance_dr->total_amount,
            'month' => $this->month,
            'year' => $this->year,
            'admin' => $created_by,
            'current_date' => $mydate,
            'area' => $properties->area,
            'flat_no' => $properties->flat_no,
            'block_no' => $properties->block_no,
            'floor_no' => $properties->floor_no ,
            'paid_amount' => $this->paid_amount,
            'payment_method' => $maintenance_cr->payment_method  
        ];

        dispatch(new RecieptSendMail($recieptMailData));
        session()->flash(
            'message',
            $this->uuid ? 'Reciept Updated Successfully.' : 'Reciept Created Successfully.'
        );
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($uuid, $view)
    {
        $this->resetInputFields();
        $maintenance = MaintenanceUser::where('uuid', $uuid)->first();
        if ($maintenance) {
            $this->uuid = $maintenance->uuid;
            $this->property_id = $maintenance->property_id;
            $this->payment_method = $maintenance->payment_method;
            $this->comment = $maintenance->comment;
            $this->year = $maintenance->year;
            $this->month = $maintenance->month;
            $this->paid_amount = $maintenance->total_amount;
            $this->edit = 'edit';
            if ($view == 'edit')
            $this->openModal();
            else
                $this->openView();
        }
    }
    public function delete($id)
    {
        $Reciept = MaintenanceUser::where('id', $id)->first();
        if ($Reciept) {
            $Reciept->delete();
            session()->flash('delete', 'Reciept Deleted Successfully.');
        }
    }
}
