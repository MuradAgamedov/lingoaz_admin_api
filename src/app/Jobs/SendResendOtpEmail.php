<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use Throwable;

class SendResendOtpEmail implements ShouldQueue
{
    use Queueable;

    public function __construct(protected $email, protected $otp) {}

    public function handle(): void
    {
        Mail::to($this->email)->send(new RegisterMail($this->otp));
    }

    public function failed(Throwable $exception): void
    {
        Log::error('SendResendOtpEmail job failed', [
            'email'     => $this->email,
            'attempts'  => $this->attempts(),
            'exception' => $exception->getMessage(),
            'trace'     => $exception->getTraceAsString(),
        ]);
    }
}
