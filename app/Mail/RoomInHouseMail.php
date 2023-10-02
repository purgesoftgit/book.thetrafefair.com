<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RoomInHouseMail extends Mailable
{
    use Queueable, SerializesModels;
    public $full_name,$txnid;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($full_name,$txnid)
    {
        $this->full_name = $full_name;
        $this->txnid = $txnid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'),'The Trade International')->subject('Room Status Changed - The Trade International')->view('mails.room-inhouse-status');
    }
}
