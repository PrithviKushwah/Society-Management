<?php

namespace App\Http\Livewire\Reciept;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\MaintenanceUser;
use App\Models\InvoiceModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyModel;

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
        $invoices = DB::table('invoices')
        ->join('users', 'invoices.created_for', '=', 'users.id')
        ->join('admins', 'invoices.created_by', '=', 'admins.id')
        ->select('invoices.*', 'users.user_name','users.area', 'admins.name')
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
            'payable_amount' => $this->payable_amount,
            'paid_amount' => $this->paid_amount,
            'payment_method' => $this->payment_method,
            'remaining_amount' => floatval($this->payable_amount) - floatval($this->paid_amount),
            'comment' => $this->comment,
        ];
        if ($this->uuid == null)   {
            $uuid = (string) Str::uuid();
            $data['uuid'] = $uuid;
            $data['created_by'] = $created_by;
        }
        $test = MaintenanceUser::updateOrCreate(['uuid' => $this->uuid], $data);
     

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
            $this->type = $maintenance->type;
            $this->price = $maintenance->price;
            $this->comment = $maintenance->comment;
            $this->year = $maintenance->year;
            $this->month = $maintenance->month;
            $this->create_for = $maintenance->create_for;
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
