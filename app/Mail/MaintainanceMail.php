<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PDF;


class MaintainanceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $maintenanceMailData;

    /**
     * Create a new message instance.
     */
    public function __construct($maintenanceMailData)
    {
        $this->maintenanceMailData = $maintenanceMailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Maintainance Mail' . $this->maintenanceMailData['user_name'],
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $pdf = PDF::loadView('email.maintenance.emailPdf', $this->maintenanceMailData);

        return $this->view('email.maintenance.maintenanceMail' ,$this->maintenanceMailData )
        ->to($this->maintenanceMailData['email'])
        ->attachData($pdf->output(), 'text.pdf');
    }
}
