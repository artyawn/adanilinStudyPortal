<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Mail\PasswordMail;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(CreateUserRequest $request)
    {
        $users = User::filter($request)->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $groups = Group::all();

        return view('users.create', compact('groups'));
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());
        Mail::to($request->validated('email'))->send(new PasswordMail($request->validated('password')));

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $subjects = $user->subjects;

        return view('users.show', compact( 'user','subjects'));
    }

    public function edit(User $user)
    {
        $groups = Group::all();

        return view('users.edit', compact( 'user', 'groups'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
