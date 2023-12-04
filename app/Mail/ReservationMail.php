<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subjectChange,$data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subjectChange,$data)
    {
        $this->subjectChange = $subjectChange;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {  
       

        return $this->from(env('MAIL_USERNAME'),'The Trade International')->subject($this->subjectChange)->view('mails.reservation-mail');
    }
}
