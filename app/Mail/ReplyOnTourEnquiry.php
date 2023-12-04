<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;

class ReplyOnTourEnquiry extends Mailable
{
    use Queueable, SerializesModels;
    public $name,$reply;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$reply)
    {
        $this->name = $name;
        $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        return $this->from(env('MAIL_USERNAME'),'The Trade International')->subject('Reply Tour Enquiry - The Trade International')->view('mails.reply-on-tour-enquiry');
    }
}
