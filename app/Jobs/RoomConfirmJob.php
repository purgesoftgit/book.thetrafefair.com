<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\RoomConfirmMail;
use Mail;
use Illuminate\Support\Facades\Log;

  
class RoomConfirmJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email,$txn_rec,$setting;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$txn_rec,$setting)
    {
        $this->email = $email;
        $this->txn_rec = $txn_rec;
        $this->setting = $setting;
 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new RoomConfirmMail($this->txn_rec,$this->setting));
    }
}
