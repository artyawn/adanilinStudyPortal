<?php

namespace App\Console\Commands;

use App\Mail\PasswordMail;
use App\Mail\PerformanceMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMessage extends Command
{
    public $users;
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
            Mail::to($user->email)->send(new PerformanceMail($user));
        }
    }
}
