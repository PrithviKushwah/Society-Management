<?php

namespace App\Http\Livewire\Invoice;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\MaintenanceUser;

class Invoice extends Component

{
    public $perPage='10', $search_name = '', $isOpen = 0 , $isUserOpen = 0,
    $payable_amount ,
    $paid_amount,
    $comment,
    $admin,
    $username,
    $remaining_amount,
    $payment_date,
    $year,
    $month,
    $created_for;

    public function render()

    {
        $invoices = DB::table('invoices')
        ->join('users', 'invoices.created_for', '=', 'users.id')
        ->join('admins', 'invoices.created_by', '=', 'admins.id')
        ->select('invoices.*', 'users.user_name','users.area', 'admins.name')
        ->where('users.user_name', 'like', '%' . $this->search_name . '%')
        // ->where('month', 'like', '%' . $this->search_month . '%')
        // ->where('year', 'like', '%' . $this->search_year . '%')
        ->paginate($this->perPage);
        return view('livewire.invoice.invoice',
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

    private function resetInputFields()
    {
        $this->resetErrorBag();
        
        $this->created_by = '' ;
        $this->created_for = '' ;
        $this->error_msg = '';
        $this->comment = '';
        
    }
}
