<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;
class SendToUserMail extends Mailable
{
    use Queueable, SerializesModels;
    public $type,$name,$subjectUser;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type,$name,$subjectUser)
    {
        $this->type = $type;
        $this->name = $name;
        $this->subjectUser = $subjectUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        Log::info($this->type);
        return $this->from(env('MAIL_USERNAME'),'The Trade International')->subject($this->subjectUser)->view('mails.send-to-user-mail');
    }
}
