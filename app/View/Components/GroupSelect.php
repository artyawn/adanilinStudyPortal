<?php

namespace App\View\Components;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class GroupSelect extends Component
{
    public $groups;
    /**
     * Create a new component instance.
     *
     * @return void
     */
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

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.group-select');
    }
}
