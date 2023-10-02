<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendToUserMail;
use Mail;
use Log;
class SendToUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $type,$name,$subjectUser,$email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type,$name,$subjectUser,$email)
    {
        $this->type = $type;
        $this->name = $name;
        $this->email = $email;
        $this->subjectUser = $subjectUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("email user");
         Log::info($this->email);
        Mail::to(trim($this->email))->send( new SendToUserMail($this->type,$this->name,$this->subjectUser));
    }
}
