<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class IsScored implements Rule
{
    private $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function passes($attribute, $value)
    {
        if (User::find($this->user_id)->subjects->firstWhere('id', $value)) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'Subject is already scored';
    }

}
