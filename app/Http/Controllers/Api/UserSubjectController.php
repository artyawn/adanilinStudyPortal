<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserSubjectRequest;
use App\Http\Requests\UpdateUserSubjectRequest;
use App\Http\Resources\UserSubjectsResource;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserSubjectController extends Controller
{
    public function index(User $user)
    {
        return UserSubjectsResource::collection($user->subjects);
    }

    public function store(StoreUserSubjectRequest $request, User $user)
    {
        Gate::authorize('edit-score', $user);
        $user->subjects()->attach($request->validated('subject_id'), ['score' => $request->validated('score')]);

        return response()->json([
            'message' => 'Score created',
        ]);
    }

    public function update(UpdateUserSubjectRequest $request, User $user, Subject $subject)
    {
        Gate::authorize('edit-score', $user);
        $user->subjects()->updateExistingPivot($subject->id, ['score' => $request->validated('score')]);

        return response()->json([
            'message' => 'Score updated',
        ]);
    }

    public function destroy(User $user, Subject $subject)
    {
        Gate::authorize('edit-score', $user);
        $user->subjects()->detach($subject->id);

        return response()->json([
            'message' => 'Score deleted',
        ]);
    }
}
