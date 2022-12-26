<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Password implements Rule
{
    public function passes($attribute, $value)
    {
        if(! Hash::check($value, Auth::user()->password)){
            return false;
        }

        return true;
    }

    public function message()
    {
        return "Old password doesn't match";
    }
}
