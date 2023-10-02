<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendStatusMail;
use Mail;

class SendStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public  $email,$change,$subjectChange,$subject;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $email,$change,$subjectChange,$subject)
    {
        $this->email = $email;
        $this->change = $change;
        $this->subjectChange = $subjectChange;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new SendStatusMail($this->change,$this->subjectChange,$this->subject));
    }
}
