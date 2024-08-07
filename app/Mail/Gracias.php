<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Gracias extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Gracias por comprar en Lodomens',
        );
    }

    public function build()
    {
        return $this->from(
            $this->mailData['email'],
            $this->mailData['name'],
            )
            ->subject($this->mailData['subject'])
            ->view('emails.graciasMail');
    }


    public function attachments(): array
    {
        return [];
    }
}
