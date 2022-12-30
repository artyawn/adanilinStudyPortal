<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserSubjectRequest;
use App\Http\Requests\UpdateUserSubjectRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserSubjectController extends Controller
{
    public function create(User $user)
    {
        Gate::authorize('edit-score', $user);
        $subjects = Subject::all();

        return view('scores.create', compact('subjects', 'user'));
    }

    public function store(StoreUserSubjectRequest $request, User $user)
    {
        Gate::authorize('edit-score', $user);
        $user->subjects()->attach($request->validated('subject_id'), ['score' => $request->validated('score')]);

        return redirect()->route('users.show', $user);
    }

    public function edit(User $user, Subject $subject)
    {
        Gate::authorize('edit-score', $user);
        $subject = $user->subjects->firstWhere('id', $subject->id);

        return view('scores.edit', compact('user', 'subject'));
    }

    public function update(UpdateUserSubjectRequest $request, User $user, Subject $subject)
    {
       Gate::authorize('edit-score', $user);
       $user->subjects()->updateExistingPivot($subject->id, ['score' => $request->validated('score')]);

       return redirect()->route('users.show', $user);
    }

    public function destroy(User $user, Subject $subject)
    {
       Gate::authorize('edit-score', $user);
       $user->subjects()->detach($subject->id);

       return redirect()->route('users.show', $user);
    }
}
