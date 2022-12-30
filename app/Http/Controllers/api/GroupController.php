<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupsResource;
use App\Models\Group;

class GroupController extends Controller
{
    public function index()
    {
       return GroupsResource::collection(Group::all());
    }

    public function store(StoreGroupRequest $request)
    {
        $this->authorize('create', Group::class);
        $group = Group::create($request->validated());

        return new GroupsResource($group);
    }

    public function show(Group $group)
    {
        return new GroupsResource($group);
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $this->authorize('update', $group);
        $group->update($request->validated());

        return new GroupsResource($group);
    }

    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);
        $group->delete();

        return response()->json([
            'message' => 'Group deleted',
        ]);
    }
}
