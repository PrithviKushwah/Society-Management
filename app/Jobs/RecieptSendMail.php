<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\RecieptMail;
use Illuminate\Support\Facades\Mail;

class RecieptSendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $recieptMailData;

    /**
     * Create a new job instance.
     */
    public function __construct($recieptMailData)
    {
        $this->recieptMailData = $recieptMailData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->recieptMailData['email'])->send(new RecieptMail($this->recieptMailData));
    }
}
