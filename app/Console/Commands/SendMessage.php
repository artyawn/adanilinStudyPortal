<?php

namespace App\Console\Commands;

use App\Jobs\UserPerformanceMail;
use App\Models\User;
use Illuminate\Console\Command;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:performance';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send performance mail to users';
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::with('subjects')->get();

        foreach ($users as $user) {
            dispatch(new UserPerformanceMail($user));
        }
    }
}
