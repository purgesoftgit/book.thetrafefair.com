<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;

class UserRegisterDetailMail extends Mailable
{
    use Queueable, SerializesModels;
    public $userDetail,$randomString;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userDetail,$randomString)
    {
        $this->userDetail = $userDetail;
        $this->randomString = $randomString;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'),'The Trade International')->subject("User Register Details - The Trade International")->view('mails.user-register-detail-mail');
    }
}
