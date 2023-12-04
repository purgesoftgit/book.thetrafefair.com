<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;
class SendStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $change,$subjectChange,$subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($change,$subjectChange,$subject)
    {
        $this->change = $change;
        $this->subjectChange = $subjectChange;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         if($this->change->type_of_booking == 0) 
            $which_reservation = 'Bar'; 
        elseif($this->change->type_of_booking == 1) 
            $which_reservation = 'Rastaurant'; 
        else
            $which_reservation = 'Meeting';


        return $this->from(env('MAIL_USERNAME'),'The Trade International')->subject($which_reservation.' Table Confirmation - Hotel the Trade International')->view('mails.change-status');
    }
}
