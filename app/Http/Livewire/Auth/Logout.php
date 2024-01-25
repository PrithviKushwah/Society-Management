<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Logout extends Component
{

    public function destroy()
    {
        Session::forget('property_data') ;
        auth()->logout();

        return redirect('/sign-in');
    }

    
    public function render()
    {
        return view('livewire.auth.logout');
    }
}
