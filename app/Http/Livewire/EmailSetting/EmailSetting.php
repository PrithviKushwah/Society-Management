<?php

namespace App\Http\Livewire\EmailSetting;

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
use Illuminate\Http\Request;

class EmailSetting extends Component
{
   
    public $logo = '';
    public $insta = '';
    public $whatsapp = '';
    public $company_name = '';
    public $uuid = '';
    public $footer = '';
    use WithFileUploads;

   
    public function render()
    {
       return view(
            'livewire.email-setting.email-setting',
            
        );

    }

   
    public function store(Request $request)
    {
        dd($request);
         $this->validate([            
               'company_name' => 'required',
        ]);
       
        
        $data = [
            'company_name' => $this->company_name,
            'whatsapp' => $this->whatsapp,
            'insta' => $this->insta, 
            'footer'=>$this->footer          
        ];
        if (empty($this->uuid)) {
            $uuid = (string) Str::uuid();
            $this->uuid = $uuid;
            $data['uuid'] = $uuid;
        }
        
        if (is_object($this->logo)) {
            $logo = $this->logo->store('public/logo');
            $filename = basename($logo);
            $data['logo'] = $filename;
        }
       
      
        EmailSettingModel::updateOrCreate(['uuid' => $this->uuid], $data);
        session()->flash(
            'message',
            $this->uuid ? 'Property Updated Successfully.' : 'Property Created Successfully.'
        );

       

         
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
    


    
}
