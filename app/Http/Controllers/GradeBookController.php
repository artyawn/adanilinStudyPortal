<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class GradeBookController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        $users = User::paginate(10);
        $average = $subjects->map(function ($subject){
           return  $subject->users->map(function ($user) {
               return [
                   'score' => $user->pivot->score
               ];
           })->avg('score');
        });

        $good_users = User::with('subjects')->get()->filter(function($user){
        return $user->subjects->min('pivot.score') == 4;
        });

        $best_users = User::with('subjects')->get()->filter(function($user){
            return $user->subjects->min('pivot.score') == 5;
        });

        return view('book.index', compact('subjects', 'users', 'average', 'good_users', 'best_users'));
   }
}
