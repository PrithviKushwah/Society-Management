<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PDF;

class RecieptMail extends Mailable
{
    use Queueable, SerializesModels;
    public $recieptMailData;

    /**
     * Create a new message instance.
     */
    public function __construct($recieptMailData)
    {
        $this->recieptMailData = $recieptMailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reciept Mail',
        );
    }

    // /**
    //  * Get the message content definition.
    //  */
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

        $pdf = PDF::loadView('email.reciept.emailPdf', $this->recieptMailData);

        return $this->view('email.reciept.recieptMail', $this->recieptMailData)
            ->to($this->recieptMailData['email'])
            ->subject($this->recieptMailData['title'])
            ->attachData($pdf->output(), 'text.pdf');
    }
}
