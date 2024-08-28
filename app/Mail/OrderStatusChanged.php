<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged extends Mailable
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
            subject: $this->mailData['subject'] ?? 'Default Subject',
        );
    }

    public function build()
    {
        $email = $this->mailData['email'] ?? config('mail.from.address');
        $name = $this->mailData['name'] ?? config('app.name');
        $subject = $this->mailData['subject'] ?? 'Default Subject';

        $this->from($email, $name)->subject($subject);

        switch ($this->mailData['status']) {
            case 'PROCESS':
                return $this->view('emails.processMail');
            case 'TRACKING':
                return $this->view('emails.incomingMail');
            case 'DONE':
                return $this->view('emails.deliveredMail');
            default:
                // O manejar un caso por defecto
                return $this->view('emails.graciasMail');
        }
    }

    public function attachments(): array
    {
        return [];
    }
}
