<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserSubjectRequest;
use App\Http\Requests\UpdateUserSubjectRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class UserSubjectController extends Controller
{
    public function create(User $user)
    {
        $subjects = Subject::all();

        return view('scores.create', compact('subjects', 'user'));
    }

    public function store(StoreUserSubjectRequest $request, User $user)
    {
        if($user->subjects()->where('id', $request->validated('subject_id')))
        {
            return redirect()
                ->route('users.subjects.create', $user)
                ->withErrors(['subject' => 'This subject already scored']);
        }
        $user->subjects()->attach($request->validated('subject_id'), ['score' => $request->validated('score')]);

        return redirect()->route('users.show', $user);
    }

    public function edit(User $user, Subject $subject)
    {
        return view('scores.edit', compact( 'user', 'subject'));
    }

    public function update(UpdateUserSubjectRequest $request, User $user, Subject $subject)
    {
       $user->subjects()->updateExistingPivot($subject->id, ['score' => $request->validated('score')]);

       return redirect()->route('users.show', $user);
    }

    public function destroy(User $user, Subject $subject)
    {
       $user->subjects()->detach($subject->id);

       return redirect()->route('users.show', $user);
    }
}
