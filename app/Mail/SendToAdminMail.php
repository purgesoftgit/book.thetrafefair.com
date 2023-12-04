<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;
class SendToAdminMail extends Mailable
{
    use Queueable, SerializesModels;
     public $contact,$subjectAdmin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact,$subjectAdmin)
    { 
        $this->contact = $contact;
        $this->subjectAdmin = $subjectAdmin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        return $this->from(env('MAIL_USERNAME'),'The Trade International')->subject($this->subjectAdmin)->view('mails.contact-us-mail');
    }
}
