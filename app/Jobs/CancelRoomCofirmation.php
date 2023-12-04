<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\CancelRoomConfirmMail;
use Mail;
  
class CancelRoomCofirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email,$trans_data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$trans_data)
    {
        $this->email = $email;
        $this->trans_data = $trans_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new CancelRoomConfirmMail($this->trans_data));
    }
}
