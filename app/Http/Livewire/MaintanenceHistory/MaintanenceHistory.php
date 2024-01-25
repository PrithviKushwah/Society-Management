<?php

namespace App\Http\Livewire\MaintanenceHistory;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\MaintenanceUser;
use Illuminate\Support\Facades\Session;

class MaintanenceHistory extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10 , $search_month = '' , $search_year = ''  , $user_id;
public function mount(){
    $this->user_id = auth()->user();
}

    public function render()
    {
        $property_data =  Session::get('property_data');

        $maintenance_history = MaintenanceUser::where('property_id' , $property_data)
        ->where('month', 'like', '%' . $this->search_month . '%')
        ->where('year', 'like', '%' . $this->search_year . '%')
        ->paginate($this->perPage);
              return view('livewire.maintanence-history.maintanence-history',
        [
            'maintenance_history' => $maintenance_history,
        ]);
    }

}
