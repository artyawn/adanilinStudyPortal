<?php

namespace App\View\Components;

use App\Models\Group;
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
