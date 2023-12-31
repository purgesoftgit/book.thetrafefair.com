<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;

class RoomConfirmMail extends Mailable
{
    use Queueable, SerializesModels;
    public $txn_rec;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($txn_rec)
    {
        $this->txn_rec = $txn_rec;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'),'Hotel The Trade International')->subject("Room Confirmation Mail.")->view('mails.roomconfirm-mail');
    }
}
