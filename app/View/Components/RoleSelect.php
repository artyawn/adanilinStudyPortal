<?php

namespace App\View\Components;

use App\Enums\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class RoleSelect extends Component
{
    public $roles;

    public function __construct()
    {
        $this->roles = Role::cases();
    }

    public function isSelected($role, $user = null)
    {
        if (
            $user?->role == $role->value
            || Auth::user()?->role == $role->value
        ) {
            return true;
        }

        return false;
    }

    public function render()
    {
        return view('components.role-select');
    }
}
