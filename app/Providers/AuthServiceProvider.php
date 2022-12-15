<?php

namespace App\Providers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('redact-score', function (User $user, User $model) {
           return (
               $user->role == Role::Admin->name
               || $user->role == Role::Teacher->name
           )
               && $user->group_id == $model->group_id
               && $model->role == Role::Student->name
               ? Response::allow()
               : Response::deny('You are not authorized for this action');
        });
    }
}
