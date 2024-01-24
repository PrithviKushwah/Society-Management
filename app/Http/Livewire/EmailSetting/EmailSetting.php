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
        $email = EmailSettingModel::first();
       return view(
            'livewire.email-setting.email-setting',
            [
                'email'=> $email,
            ]
            
        );

    }

   
    public function store(Request $request)
    {
     
         $request->validate([            
               'company_name' => 'required',
        ]);
        $email = EmailSettingModel::where('uuid', $request->uuid)->first();

        if (!$email) {
            // Handle case when the record with the given uuid is not found
            return redirect()->back()->with('error', 'Email settings not found.');
        }
            $email->company_name =  $request->company_name;
            $email->whatsapp =  $request->whatsapp;
            $email->insta =  $request->insta; 
            $email->footer = $request->footer;
            if (is_object($request->logo)) {
                $logo = $request->logo->store('public/logo');
                $filename = basename($logo);
                $email->logo = $filename;
            }
            $email->save();
        return redirect()->route('Email Setting')->with('message', 'Email settings updated successfully');
    }

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // public function edit($uuid, $view)
    // {
    //     $this->resetInputFields();
    //     $maintenance = MaintenanceUser::where('uuid', $uuid)->first();
    //     if ($maintenance) {
    //         $this->uuid = $maintenance->uuid;
    //         $this->type = $maintenance->type;
    //         $this->price = $maintenance->price;
    //         $this->comment = $maintenance->comment;
    //         $this->year = $maintenance->year;
    //         $this->month = $maintenance->month;
    //         $this->property_id = $maintenance->property_id;
    //         $this->edit = 'edit';
    //         if ($view == 'edit')
    //         $this->openModal();
    //         else
    //             $this->openView();
    //     }
    // }
    
}
