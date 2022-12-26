<?php

namespace App\View\Components;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class GroupSelect extends Component
{
    public $groups;

    public function __construct()
    {
       $this->groups = Group::all();
    }

    public function isSelected($group_id, $user = null)
    {
        if (
            $user?->group->id == $group_id
            || Auth::user()?->group->id == $group_id
        ) {
            return true;
        }

        return false;
    }

    public function render()
    {
        return view('components.group-select');
    }
}
