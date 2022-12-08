<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $groups = Group::all();

        return view('users.profile', compact('groups'));
    }

    public function update(UpdateProfileRequest $request)
    {
        Auth::user()->update($request->validated());

        return redirect()->route('profile.edit');
    }
}
