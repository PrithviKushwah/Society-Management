<?php

namespace App\Http\Livewire\Maintenance;

use Livewire\Component;
use App\Models\MaintenanceUser;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\MaintainanceMail;
use PDF;



class Maintenance extends Component
{
   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $search_name = '';
    public $search_year = '';
    public $search_month = '';
    use WithFileUploads;

    public

    $tot_cost,
    $user_detail,
    $uuid,
    $month,
    $year,
    $price,
    $create_by,
    $create_for,
    $error_msg,
    $comment,
    $bulk,
    $single,
    $edit,
    $type = 'PRICE BY AREA';
       
    public $isOpen = 0, $isView = 0 , $isBulkOpen = 0 , $isUserOpen = 0;
 
    public function render()
    {
        $maintenance_user = DB::table('maintenance')
        ->join('users', 'maintenance.create_for', '=', 'users.id')
        ->join('admins', 'maintenance.create_by', '=', 'admins.id')
        ->select('maintenance.*', 'users.user_name','users.area', 'admins.name')
        ->where('users.user_name', 'like', '%' . $this->search_name . '%')
        ->where('month', 'like', '%' . $this->search_month . '%')
        ->where('year', 'like', '%' . $this->search_year . '%')
        ->paginate($this->perPage);
        
      
        // $maintenance_user = MaintenanceUser::where('create_for', 'like', '%' . $this->search_name . '%')
        // ->where('month', 'like', '%' . $this->search_month . '%')
        // ->where('year', 'like', '%' . $this->search_year . '%')
        // ->paginate($this->perPage);

            
        return view(
            'livewire.maintenance.maintenance',
            [
                'maintenance_user' => $maintenance_user,
            ]
        );

    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function createBulk()
    {
        $this->resetInputFields();
        $this->openBulkModal();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->single = 'single' ;
        $this->isView = false;
        $this->isBulkOpen = false;
        $this->isOpen = true;
    }

    public function openBulkModal()
    {
        $this->isOpen = false;
        $this->isView = false;
        $this->isBulkOpen = true;
    }

    

    public function openView()
    {
        $this->isView = true;
    }

    public function openUserView()
    {
        $this->isUserOpen = true;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isBulkOpen = false;
        $this->isOpen = false;
        $this->isView = false;
        $this->isUserOpen = false;

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->resetErrorBag();
        $this->uuid = '';        
        $this->month = '' ;
        $this->year = '' ;
        $this->price = '' ;
        $this->create_by = '' ;
        $this->create_for = '' ;
        $this->error_msg = '';
        $this->type = '';
        $this->comment = '';
        $this->single = '';
        $this->edit = '';
        $this->tot_cost ='';
        $this->user_detail = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()

    {
        
      if($this->create_for != null || $this->single != null){
            $this->validate([
                'month' => 'required',
                'year' => 'required',
                'price' => 'required',
                'type' => 'required',
                'create_for' => 'required',
            ]);  
            $users = User::where('id' , $this->create_for)->select('id', 'area','email')->get();
            $maintenance = MaintenanceUser::where('month', '=', $this->month)
            ->where('year', '=', $this->year)
            ->where('create_for' , '=' , $this->create_for)
            ->get();
                         
      }else{
        $users = User::select('id','area','email')->get();

            $this->validate([
                'month' => 'required',
                'year' => 'required',
                'price' => 'required',
                'type' => 'required',
            ]);
            $maintenance = MaintenanceUser::where('month', '=', $this->month)
            ->where('year', '=', $this->year)
            ->get();
        }
        $created_by = Auth::id();       
 
        if ($this->uuid == null) {        
     
        if($maintenance->isEmpty()){
           
        foreach($users as $user){
         
            $uuid = (string) Str::uuid();
            if($this->type == 'FIX PRICE'){
               
            $tot_cost =  $this->price;
            }else if($this->type == 'PRICE BY AREA'){
                
            $tot_cost = $this->price * $user->area; 
            }
           
            $data = [
                'uuid' =>$uuid ,
                'month' => $this->month,
                'year' => $this->year,
                'create_by' => $created_by,
                'create_for' => $user->id,
                'price'=>$this->price,
                'type'=>$this->type,
                'total_cost'=>$tot_cost,
                'comment'=>$this->comment,
            ];
            // MaintenanceUser::Create($data);


        $testMailData["email"] = 'kushwahprithvi78@gmail.com';
        $testMailData["title"] = "From Cloud1.com";
        $testMailData["body"] = "This is Demo";
  
        $pdf = PDF::loadView('email.emailPdf', $testMailData);
  
        Mail::send('email.testMail', $testMailData, function($message)use($testMailData, $pdf ,$user) {
            $message->to($user->email)
                    ->subject($testMailData["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });
    
         }
        
               session()->flash(
                'message',
                $this->uuid ? 'Maintenance Updated Successfully.' : 'Maintenance Created Successfully.'
            );
            $this->closeModal();
            $this->resetInputFields();
        }else{
                $msg = "Maintanence Aready Exist for this Month , Year and User ";
                $this->error_msg = $msg;

        }
        }else{
            $user = User::where('id' , $this->create_for)->select('id','area')->first();
            if($this->type == 'fix_price'){
                $tot_cost =  $this->price;
                }else{
                $tot_cost = $this->price * $user->area; 
                }
            $data = [
                'price'=>$this->price,
                'type'=>$this->type,
                'total_cost'=>$tot_cost,
                'comment'=>$this->comment,
            ];

            MaintenanceUser::updateOrCreate(['uuid' => $this->uuid], $data);

            session()->flash(
                'message',
                $this->uuid ? 'Maintenance Updated Successfully.' : 'Maintenance Created Successfully.'
            );
            $this->closeModal();
            $this->resetInputFields();
        }

        
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    public function userView($create_for)
    {        
        $user_details = User::where('id', $create_for)->first();
        $this->user_detail = $user_details;
        $this->openUserView();
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        $maintenance = MaintenanceUser::where('id', $id)->first();
        if ($maintenance) {
            $maintenance->delete();
            session()->flash('delete', 'Maintenance Deleted Successfully.');
        }
    }


    public function export()
    {
        $rows = [];
        MaintenanceUser::query()->lazyById(2000, 'id')
            ->each(function ($student) use (&$rows) {
                $rows[] = $student->toArray();
            });

        SimpleExcelWriter::streamDownload('Maintanance.csv')
        ->addRows($rows);
    }

    public function download($path)
    {

        $filePath = Storage::path('/' . $path);

        return response()->download($filePath);
    }
}
