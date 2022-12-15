<?php

namespace App\Policies;

use App\Enums\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role == Role::Admin->name || $user->role == Role::Teacher->name;
    }

    public function store(User $user, StoreUserRequest $request)
    {
        return match (true) {
            $user->role == Role::Admin->name => $request->group_id == $user->group_id && $request->role != Role::Admin->value,
            $user->role == Role::Teacher->name => $request->group_id == $user->group_id && $request->role == Role::Student->value,
            default => false,
        };
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function edit(User $user, User $model)
    {
        return match (true) {
            $user->role == Role::Admin->name => $model->group_id == $user->group_id && $model->role != Role::Admin->name,
            $user->role == Role::Teacher->name => $model->group_id == $user->group_id && $model->role == Role::Student->name,
            default => false,
        };
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        return match (true) {
            $user->role == Role::Admin->name => $request->group_id == $user->group_id && $request->role != Role::Admin->value,
            $user->role == Role::Teacher->name => $request->group_id == $user->group_id && $request->role == Role::Student->value,
            default => false,
        };
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        return $user->role == Role::Admin->name
            && $model->group_id == $user->group_id
            && $model->role != Role::Admin->name;
    }
}
