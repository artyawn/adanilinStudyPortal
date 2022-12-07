<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function edit()
    {
        $groups = Group::all();

        return view('users.profile', compact('groups'));
    }

    public function update(UpdateUserRequest $request)
    {
        Auth::user()->update($request->validated());

        return redirect()->route('profile.edit');
    }
}
