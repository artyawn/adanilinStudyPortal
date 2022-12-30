<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Services\FileService;

class UserController extends Controller
{
    public function index()
    {
        return UsersResource::collection(User::all());
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('store', [User::class, $request]);
        $user = User::create($request->validated());

        return new UsersResource($user);
    }

    public function show(User $user)
    {
        return new UsersResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', [User::class, $request]);
        $user->update($request->validated());

        return new UsersResource($user);
    }

    public function export(FileService $service, User $user)
    {
        $this->authorize('export', $user);

        return response()->json([
            'link' => $service->getLink($user),
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();

        return response()->json([
            'message' => 'User deleted',
        ]);
    }

    public function restore(User $user)
    {
        $this->authorize('restore', $user);
        $user->restore();

        return response()->json([
            'message' => 'User restored',
        ]);
    }

    public function forceDelete(User $user)
    {
        $this->authorize('forceDelete', $user);
        $user->forceDelete();

        return response()->json([
            'message' => 'User deleted',
        ]);
    }
}
