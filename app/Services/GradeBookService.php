<?php

namespace App\Services;

use App\Models\Subject;
use App\Models\User;

class GradeBookService
{
    public function subjects()
    {
        return Subject::all();
    }

    public function average()
    {
         return Subject::with('users')->get()->map(function ($subject) {
            return $subject->users->map(function ($user) {
                return [
                    'score' => $user->pivot->score,
                ];
            })->avg('score');
         });
    }

    public function goodUsers()
    {
        return User::with('subjects')->get()->filter(function ($user) {
            return $user->subjects->min('pivot.score') == 4;
        });
    }

    public function bestUsers()
    {
        return User::with('subjects')->get()->filter(function ($user) {
            return $user->subjects->min('pivot.score') == 5;
        });
    }
}
