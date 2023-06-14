<?php

namespace App\Console\Commands;

use App\Jobs\BlockedUser;
use App\Jobs\blockUser;
use App\Jobs\test;
use App\Models\User;
use Illuminate\Console\Command;

class TestJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:job';

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
        $user =User::where('email','fefe@gmail.com')->first();
        dispatch(new BlockedUser($user->toArray(),'blocked'));
        // dispatch(new test());
        // $data = ['name'=>'baker','id'=>3];
        // blockUser::dispatch($data);

    }
}
