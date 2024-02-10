<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    public function login(Request $request) {
        $registered = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['name' => $registered['loginname'], 'password' => $registered['loginpassword']])) {
            $request ->session()->regenerate();
        }

        return redirect('/');

    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
    public function register(Request $request) {
        $registered = $request->validate([
            'name' => ['required', 'min:2', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:10', 'max:100']
        ]);

        $registered['password'] = bcrypt($registered['password']);
        $user = User::create($registered);
        auth()->login($user);
        return redirect('/');
    }
}
