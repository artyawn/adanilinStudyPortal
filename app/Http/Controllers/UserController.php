<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\Group;
use App\Models\User;


class UserController extends Controller
{
    public function index(CreateUserRequest $request)
    {
        $users = User::filter($request)->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);
        $groups = Group::all();

        return view('users.create', compact('groups'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('store', [User::class, $request]);
        $user = User::create($request->validated());
        event(new UserCreated($user, $request->validated('password')));

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $subjects = $user->subjects;

        return view('users.show', compact( 'user','subjects'));
    }

    public function edit(User $user)
    {
        $this->authorize('edit', $user);
        $groups = Group::all();

        return view('users.edit', compact( 'user', 'groups'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', [User::class, $request]);
        $user->update($request->validated());

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->route('users.index');
    }
}
