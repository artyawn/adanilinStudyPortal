<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PasswordController extends Controller
{
    public function update(UpdatePasswordRequest $request)
    {
        Auth::user()->update([
            'password' => Hash::make($request->validated('new_password'))
        ]);

        return redirect()->route('profile.edit');
    }
}
