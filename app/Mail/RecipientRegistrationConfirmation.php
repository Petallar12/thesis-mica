<?php

namespace App\Mail;

use App\Models\Recipients;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;

class RecipientRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;

    public function __construct(Recipients $recipient)
    {
        $this->recipient = $recipient;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank You for Registering as a Recipient'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration',
            with: [
                'recipient' => $this->recipient
            ]
        );
    }

    public function attachments(): array
    {
        // You can add PDF or other attachments here if needed
        return [];
    }
} 