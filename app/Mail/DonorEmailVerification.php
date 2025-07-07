<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonorEmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Your Donor Registration Verification Code')
            ->view('emails.donor-verification');
    }
} 