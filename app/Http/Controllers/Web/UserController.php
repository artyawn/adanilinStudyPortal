<?php

namespace App\Http\Controllers\Web;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Group;
use App\Models\User;
use App\Services\FileService;

class UserController extends Controller
{
    public function index(CreateUserRequest $request)
    {
        $users = User::filter($request)->withTrashedFilter()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);
        $groups = Group::all();

        return view('users.create', compact('groups'));
    }

    public function store(StoreUserRequest $request, FileService $service)
    {
        $this->authorize('store', [User::class, $request]);
        $user = User::create($request->validated());
        $service->saveAvatar($user, $request);
        event(new UserCreated($user, $request->validated('password')));

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        $subjects = $user->subjects;

        return view('users.show', compact('user', 'subjects'));
    }

    public function edit(User $user)
    {
        $this->authorize('edit', $user);
        $groups = Group::all();

        return view('users.edit', compact('user', 'groups'));
    }

    public function update(UpdateUserRequest $request, User $user, FileService $service)
    {
        $this->authorize('update', [User::class, $request]);
        $user->update($request->validated());
        $service->updateAvatar($user, $request);

        return redirect()->route('users.index');
    }

    public function export(User $user, FileService $service)
    {
        $this->authorize('export', User::class);

        return $service->exportPdf($user);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->route('users.index');
    }

    public function restore(User $user)
    {
        $this->authorize('restore', $user);
        $user->restore();

        return redirect()->route('users.index');
    }

    public function forceDelete(User $user)
    {
        $this->authorize('forceDelete', $user);
        $user->forceDelete();

        return redirect()->route('users.index');
    }
}
