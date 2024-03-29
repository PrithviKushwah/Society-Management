<?php

namespace App\Http\Livewire\Maintenance;

use Livewire\Component;
use App\Models\MaintenanceUser;
use App\Models\EmailSettingModel;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\PropertyModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\MaintainanceMail;
use App\Jobs\MaintenanceSendEmailJob;
use Carbon;



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
    $area,
    $year,
    $price,
    $create_by,
    $create_for,
    $property_id,
    $error_msg,
    $comment,
    $bulk,
    $single,
    $edit,
    $type = 'PRICE BY AREA',
    $properties,
    $created_by,
    $emailSettingData;
       
    public $isOpen = 0, $isView = 0 , $isBulkOpen = 0 , $isUserOpen = 0;
 
    public function mount(){
        
        $this->properties = PropertyModel::select('id', 'user_id')->get();
        $this->created_by = Auth::id();
        $this->emailSettingData = EmailSettingModel::first();
        

    }
    public function render()
    {
        $maintenance_user = DB::table('maintenance')
        ->join('properties', 'maintenance.property_id', '=', 'properties.id')
        ->join('admins', 'maintenance.create_by', '=', 'admins.id')
        ->join('users', 'properties.user_id', '=', 'users.id')
        ->select('maintenance.*', 'properties.user_id' , 'properties.area' , 'users.user_name',  'admins.name')
        ->where('users.user_name', 'like', '%' . $this->search_name . '%')
        ->where('month', 'like', '%' . $this->search_month . '%')
        ->where('year', 'like', '%' . $this->search_year . '%')
        ->where('maintenance.transaction_type','DR')
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
        $this->property_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()

    {
        
     
            $this->validate([
                'month' => 'required',
                'year' => 'required',
                'price' => 'required',
                'type' => 'required',
                'property_id' => 'required',
            ]);

        $property = PropertyModel::where('id' , '=' , $this->property_id)->first();
            $maintenance = MaintenanceUser::where('month', '=', $this->month)
            ->where('year', '=', $this->year)
            ->where('property_id' , '=' , $this->property_id)
            ->get();
 
        if ($this->uuid == null) {        
     
        if($maintenance->isEmpty()){
           
         
            $uuid = (string) Str::uuid();
            if($this->type == 'FIX PRICE'){
               
            $tot_cost =  $this->price;
            }else if($this->type == 'PRICE BY AREA'){
                
            $tot_cost = $this->price * $property->area; 
            }
            $data = [
                'uuid' =>$uuid ,
                'month' => $this->month,
                'year' => $this->year,
                'create_by' => $this->created_by,
                'property_id' => $property->id,
                'price'=>$this->price,
                'type'=>$this->type,
                'transaction_type'=>'DR',
                'total_amount'=>$tot_cost,
                'comment'=>$this->comment,
            ];
             
                    MaintenanceUser::Create($data);
                    $mydate = Carbon\Carbon::now()->format('d-m-Y');
                    $maintenanceMailData = [
                        'email' => $property->user->email,
                        'user_name' => $property->user->user_name,
                        'maintenance_type' => $this->type,
                        'total' => $tot_cost,
                        'month' => $this->month,
                        'year' => $this->year,
                        'admin' => $this->created_by,
                        'current_date' => $mydate, 
                        'area' => $property->area,
                        'flat_no'=>$property->flat_no,
                        'block_no'=>$property->block_no,
                        'floor_no'=>$property->floor_no  ,
                        'company_name'=>$this->emailSettingData->company_name,
                        'insta'=>$this->emailSettingData->insta,
                        'whatsapp'=>$this->emailSettingData->whatsapp,
                        'logo'=>$this->emailSettingData->logo,
                        'footer'=>$this->emailSettingData->footer,
                       
                    ];
                  
                    dispatch(new MaintenanceSendEmailJob($maintenanceMailData));

         
        
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
            $property = PropertyModel::where('id' , $this->property_id)->select('id','area')->first();
            if($this->type == 'FIX PRICE'){
                $tot_cost =  $this->price;
                }else{
                $tot_cost = $this->price * $property->area; 
                }
               
            $data = [
                'price'=>$this->price,
                'type'=>$this->type,
                'total_amount'=>$tot_cost,
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

    public function bulkStore()
    {
        
        
        // Retrieve all properties
        $properties = PropertyModel::all();

        // Validate input data
        $this->validate([
            'month' => 'required',
            'year' => 'required',
            'price' => 'required',
            'type' => 'required',
        ]);

        $maintenanceCreated = false; // Flag to check if any maintenance records were created

        foreach ($properties as $property) {
            // Check if maintenance record already exists for the given month, year, and property
            $maintenance = MaintenanceUser::where('month', '=', $this->month)
                ->where('year', '=', $this->year)
                ->where('property_id', '=', $property->id)
                ->first();

            if (!$maintenance) {
                // Generate a UUID for the maintenance record
                $uuid = (string) Str::uuid();

                // Calculate total cost based on maintenance type
                $tot_cost = ($this->type == 'FIX PRICE') ? $this->price : ($this->price * $property->area);

                // Prepare data for maintenance record
                $data = [
                    'uuid' => $uuid,
                    'month' => $this->month,
                    'year' => $this->year,
                    'create_by' => $this->created_by,
                    'property_id' => $property->id,
                    'price' => $this->price,
                    'type' => $this->type,
                    'transaction_type' => 'DR',
                    'total_amount' => $tot_cost,
                    'comment' => $this->comment,
                ];

                // Create maintenance record
                MaintenanceUser::create($data);

                // Get current date in the 'd-m-Y' format
                $mydate = Carbon\Carbon::now()->format('d-m-Y');

                // Prepare data for maintenance email
                $maintenanceMailData = [
                    'email' => $property->user->email,
                    'user_name' => $property->user->user_name,
                    'maintenance_type' => $this->type,
                    'total' => $tot_cost,
                    'month' => $this->month,
                    'year' => $this->year,
                    'admin' => $this->created_by,
                    'current_date' => $mydate,
                    'area' => $property->area,
                    'flat_no' => $property->flat_no,
                    'block_no' => $property->block_no,
                    'floor_no' => $property->floor_no,
                    'company_name'=>$this->emailSettingData->company_name,
                    'insta'=>$this->emailSettingData->insta,
                    'whatsapp'=>$this->emailSettingData->whatsapp,
                    'logo'=>$this->emailSettingData->logo,
                    'footer'=>$this->emailSettingData->footer,

                ];
                
// dd($maintenanceMailData);
                // Dispatch a job to send maintenance email asynchronously
                dispatch(new MaintenanceSendEmailJob($maintenanceMailData));

                // Set the flag to true if maintenance record is created
                $maintenanceCreated = true;
            }
        }

        // Display a message based on whether any maintenance records were created
        if ($maintenanceCreated) {
            session()->flash(
                'message',
                $this->uuid ? 'Maintenance Updated Successfully.' : 'Maintenance Created Successfully.'
            );
        } else {
            session()->flash('delete', 'Maintanence Aready Exist for this Month , Year All User');
        }

        // Close the modal and reset input fields
        $this->closeModal();
        $this->resetInputFields();
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
            $this->property_id = $maintenance->property_id;
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
