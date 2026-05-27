<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendMessage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $message)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        info($this->message);
    }
}
