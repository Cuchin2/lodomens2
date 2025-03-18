<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReclamationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }
    public function build()
    {
        return $this->from(
            $this->mailData['email'],
            $this->mailData['fromName'],
            )
            ->subject($this->mailData['subject'])
            ->view('emails.contactMail');
    }

    public function attachments(): array
    {
        return [];
    }
}
