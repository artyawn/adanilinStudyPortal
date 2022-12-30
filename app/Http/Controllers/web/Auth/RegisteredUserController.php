<?php

namespace App\Http\Controllers\web\Auth;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'fio' => ['required', 'string', 'max:255'],
            'group_id' => ['required', 'string', 'max:255'],
            'role' => ['required', 'int'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'fio' => $request->fio,
            'group_id' => $request->group_id,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ]);

        event(new UserCreated($user, $request->password));

        Auth::login($user);

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
