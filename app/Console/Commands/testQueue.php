<?php

namespace App\Console\Commands;

use App\Jobs\SendVerificationCode;
use App\Models\User;
use Illuminate\Console\Command;

class testQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::first();
        $user->email = 'mohamad99elawi@gmail.com';
        dispatch(new SendVerificationCode($user->toArray()))->onConnection('database');
    }
}
