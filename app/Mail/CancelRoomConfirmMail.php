<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;
class CancelRoomConfirmMail extends Mailable
{
    use Queueable, SerializesModels;
    public $trans_data;
    public function __construct($trans_data)
    {
    	$this->trans_data = $trans_data;
    }
 
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'),'The Trade International')->subject('The Trade International')->view('mails.cancel-room-mail');
    }
}
