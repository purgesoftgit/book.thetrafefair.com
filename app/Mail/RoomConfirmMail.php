<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class RoomConfirmMail extends Mailable
{
    use Queueable, SerializesModels;
    public $txn_rec,$setting;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($txn_rec,$setting)
    {
        $this->txn_rec = $txn_rec;
        $this->setting = $setting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->from(env('MAIL_USERNAME'),'Booking Engine - Hotel The Trade Fair')->subject("Room Confirmation Mail.")->view('mails.roomconfirm-mail');
    }
}
