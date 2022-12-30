<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectsResource;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        return SubjectsResource::collection(Subject::all());
    }

    public function store(StoreSubjectRequest $request)
    {
        $this->authorize('create', Subject::class);
        $subject = Subject::create($request->validated());

        return new SubjectsResource($subject);
    }

    public function show(Subject $subject)
    {
        return new SubjectsResource($subject);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $this->authorize('update', $subject);
        $subject->update($request->validated());

        return new SubjectsResource($subject);
    }

    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);
        $subject->delete();

        return response()->json([
            'message' => 'Subject deleted',
        ]);
    }
}
