<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MaintainanceMail;
use Illuminate\Support\Facades\Mail;

class MaintenanceSendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $maintenanceMailData;
    /**
     * Create a new job instance.
     */
    public function __construct($maintenanceMailData)
    {
        $this->maintenanceMailData = $maintenanceMailData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->maintenanceMailData['email'])->send(new MaintainanceMail($this->maintenanceMailData));

    }
}
