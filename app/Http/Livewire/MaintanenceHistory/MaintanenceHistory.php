<?php

namespace App\Http\Livewire\MaintanenceHistory;

use Livewire\Component;
use App\Models\MaintenanceUser;
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
use App\Jobs\SendEmailJob;

class MaintanenceHistory extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;


    public function render()
    {
        $maintenance_history = DB::table('maintenance')
        ->join('properties', 'maintenance.property_id', '=', 'properties.id')
        ->join('users', 'properties.user_id', '=', 'users.id')
        ->select('maintenance.*', 'properties.user_id' , 'properties.area' , 'users.user_name',)
        //  ->where('users.user_name', 'like', '%' . $this->search_name . '%')
        // ->where('month', 'like', '%' . $this->search_month . '%')
        // ->where('year', 'like', '%' . $this->search_year . '%')
        ->paginate($this->perPage);

        return view('livewire.maintanence-history.maintanence-history',
        [
            'maintenance_history' => $maintenance_history,
        ]);
    }

}
