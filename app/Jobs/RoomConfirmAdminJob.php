<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\RoomConfirmAdmin;

class RoomConfirmAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email,$txn_rec;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$txn_rec)
    {
        $this->email = $email;
        $this->txn_rec = $txn_rec;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new RoomConfirmAdmin($this->txn_rec));
    }
}
