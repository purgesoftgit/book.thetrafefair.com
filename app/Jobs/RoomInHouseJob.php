<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\RoomInHouseMail;
use Mail;

class RoomInHouseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $email,$full_name,$txnid;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$full_name,$txnid)
    {
        $this->email = $email;
        $this->full_name = $full_name;
        $this->txnid = $txnid;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new RoomInHouseMail($this->full_name,$this->txnid));
    }
}
