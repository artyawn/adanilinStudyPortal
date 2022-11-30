<?php


namespace App\Service;


use App\Models\Subject;
use App\Models\User;

class GradeBookService
{
    public function subjects()
    {
        $subjects = Subject::all();

        return $subjects;
    }

    public function average()
    {
        $average = Subject::with('users')->get()->map(function ($subject){
            return  $subject->users->map(function ($user) {
                return [
                    'score' => $user->pivot->score
                ];
            })->avg('score');
        });

        return $average;
    }

    public function goodUsers(){
        $good_users = User::with('subjects')->get()->filter(function($user){
            return $user->subjects->min('pivot.score') == 4;
        });
        return $good_users;
    }

    public function bestUsers(){
        $best_users = User::with('subjects')->get()->filter(function($user){
            return $user->subjects->min('pivot.score') == 5;
        });
        return $best_users;
    }
}
