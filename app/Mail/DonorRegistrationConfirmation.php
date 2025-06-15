<?php

namespace App\Mail;

use App\Models\Donor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Barryvdh\DomPDF\Facade\Pdf;

class DonorRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $donor;

    public function __construct(Donor $donor)
    {
        $this->donor = $donor;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank You for Registering as a Donor'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration',
            with: [
                'donor' => $this->donor
            ]
        );
    }

    public function attachments(): array
    {
        $pdf = PDF::loadView('emails.donor-card', ['donor' => $this->donor]);
        
        return [
            Attachment::fromData(
                fn () => $pdf->output(),
                'donor-card.pdf'
            )->withMime('application/pdf')
        ];
    }
} 