<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->role == Role::Admin->name;
    }

    public function update(User $user, Group $group)
    {
        return $user->role == Role::Admin->name
            && $group->id == $user->group_id;
    }

    public function delete(User $user, Group $group)
    {
        return false;
    }
}
