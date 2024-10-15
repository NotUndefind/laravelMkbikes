<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    public function login() {

        return view('auth.login');
    }



    public function doLogin(LoginRequest $request) {

        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended((route('dashboard.index')));
        }

        return to_route('login')->withErrors([
            'email' => 'Email invalide ou mot de passe invalide'
        ]);
    }
}
