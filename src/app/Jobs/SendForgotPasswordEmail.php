<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;

class SendForgotPasswordEmail implements ShouldQueue
{
    use Queueable;

    public function __construct(protected $email, protected $otp) {}

    public function handle(): void
    {
        Mail::to($this->email)->send(new ForgotPasswordMail($this->otp));
    }
}
