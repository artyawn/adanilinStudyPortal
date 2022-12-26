<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ScorePolicy
{
    use HandlesAuthorization;

   public static function editScore(User $user, User $model) {
       return ($user->role == Role::Admin->name
       || $user->role == Role::Teacher->name)
       && $user->group_id == $model->group_id
       && $model->role == Role::Student->name
           ? Response::allow()
           : Response::deny('You are not authorized for this action');
   }
}
