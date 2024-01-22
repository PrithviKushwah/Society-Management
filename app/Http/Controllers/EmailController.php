<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MaintainanceMail;

class EmailController extends Controller
{
    public function index()
    {
        $maintenanceMailData = [
            'title' => ' push test Test Email From AllPHPTricks.com',
            'body' => 'This is the body of test email.'
        ];

                Mail::to('kushwahprithvi78@gmail.com')->send(new MaintainanceMail($maintenanceMailData));

        dd('Success! Email has been sent successfully.');
    }
}
