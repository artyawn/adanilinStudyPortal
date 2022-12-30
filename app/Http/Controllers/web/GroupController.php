<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;

class GroupController extends Controller
{
    public function index(CreateGroupRequest $request)
    {
        $groups = Group::filter($request)->paginate(10);

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $this->authorize('create', Group::class);
        return view('groups.create');
    }

    public function store(StoreGroupRequest $request)
    {
        $this->authorize('create', Group::class);
        Group::create($request->validated());

        return redirect()->route('groups.index');
    }

    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        $this->authorize('update', $group);
        return view('groups.edit', compact('group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $this->authorize('update', $group);
        $group->update($request->validated());

        return redirect()->route('groups.index');
    }

    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);
        $group->delete();

        return redirect()->route('groups.index');
    }
}
