<?php

namespace App\Jobs;

use App\Mail\SendVerificationCodeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVerificationCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user ;
    public function __construct($user)
    {
        $this->user =$user ;
    }

    public function handle()
    {
            Mail::to($this->user->email)->send(new SendVerificationCodeMail($this->user));
    }
}
