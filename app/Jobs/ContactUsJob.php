<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ContactUsMail;
use Mail;
use Log;


class ContactUsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $contact,$subjectAdmin,$type,$subjectUser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact,$subjectAdmin,$type,$subjectUser)
    {
        $this->contact = $contact;
        $this->subjectAdmin = $subjectAdmin;
        $this->type = $type;
        $this->subjectUser = $subjectUser;
 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       Mail::to($this->contact->email)->send(new ContactUsMail($this->contact));
    }
}
