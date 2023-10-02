<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendToAdminMail;
use Mail;
use Log;

class SendToAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $contact,$subjectAdmin,$admin_mail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact,$subjectAdmin,$admin_mail)
    {
        $this->contact = $contact;
        $this->subjectAdmin = $subjectAdmin;
        $this->admin_mail = $admin_mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        Log::info("email admin");
        Log::info($this->admin_mail);
        $mailresult = Mail::to(trim($this->admin_mail))->send( new SendToAdminMail($this->contact,$this->subjectAdmin));
        Log::info(json_encode($mailresult));
    }
}
