<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApply extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\JobApply
     */
    public $jobApply;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\JobApply $jobApply
     */
    public function __construct(\App\Models\JobApply $jobApply)
    {
        $this->jobApply = $jobApply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.jobapply')
            ->attach($this->jobApply->curriculum);
    }
}
