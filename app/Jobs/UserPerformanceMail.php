<?php

namespace App\Jobs;

use App\Mail\PerformanceMail;
use App\Models\User;
use Error;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserPerformanceMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::with('subjects')->get();

        foreach ($users as $user) {
            try {
                Mail::to($user->esdl)->send(new PerformanceMail($user));
            } catch (\Throwable $exception) {
                Log::channel('email')->critical('Message not sent to user id-' . $user->id, ['exception' => $exception->getMessage()]);
            }
        }
    }
}
