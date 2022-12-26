<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
       return $user->role == Role::Teacher->name;
    }

    public function update(User $user)
    {
        return $user->role == Role::Teacher->name;
    }

    public function delete()
    {
        return false;
    }

    public function before(User $user)
    {
      if($user->role == Role::Admin->name) {
          return true;
      }
    }
}
