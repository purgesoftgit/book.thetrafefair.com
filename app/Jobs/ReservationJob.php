<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ReservationMail;
use Mail;
use Log;

class ReservationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $subjectChange,$data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subjectChange,$data)
    {
        $this->subjectChange = $subjectChange;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info($this->data);
        Log::info($this->data['email']);
        Mail::to($this->data['email'])->send(new ReservationMail($this->subjectChange,$this->data));
    }
}
