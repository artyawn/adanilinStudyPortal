<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupUserController extends Controller
{
    public function index(Group $group)
    {
        $users = $group->users()->paginate(10);

        return view('users.index', compact('users', 'group'));
    }

    public function create(Group $group)
    {
        return view('users.create', compact('group'));
    }

    public function store(StoreUserRequest $request, Group $group)
    {
        $data = $request->validated();
        $data['group_id'] = $group->id;
        User::create($data);

        return redirect()->route('groups.users.index', compact('group'));
    }

    public function show(Group $group, User $user)
    {
        return view('users.show', compact('group', 'user'));
    }

    public function edit(Group $group, User $user)
    {
        return view('users.edit', compact('group', 'user'));
    }

    public function update(UpdateUserRequest $request, Group $group, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('groups.users.index', $group->id);
    }

    public function destroy(Group $group, User $user)
    {
        $user->delete();

        return redirect()->route('groups.users.index', $group->id);
    }
}
