<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Nette\Utils\Random;

class ScoresForCreatedUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        foreach (Subject::all() as $subject) {
            $event->user->subjects()->attach($subject->id, ['score' => mt_rand(2,5)]);
        }
    }
}
