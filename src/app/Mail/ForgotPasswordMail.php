<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $otp)
    {
        $this->otp = $otp->token;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Şifrə Sıfırlama — lingoaz');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.forgot_password',
            with: ['otp' => $this->otp]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
