<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function update(UpdatePasswordRequest $request)
    {
        Auth::user()->update([
            'password' => $request->validated('new_password')
        ]);

        return redirect()->route('profile.edit');
    }
}
