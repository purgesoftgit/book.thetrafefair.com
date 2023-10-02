<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\ReplyOnTourEnquiry;

class ReplyOnTourEnquiryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $email,$name,$reply;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$name,$reply)
    {
        $this->email = $email;
        $this->name = $name;
        $this->reply = $reply;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new ReplyOnTourEnquiry($this->name,$this->reply));
    }
}
