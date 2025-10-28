<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('administrator.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required'], // bisa berupa email atau username
            'password' => ['required'],
        ]);

        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $crendentials = [
            $loginType => $request->input('login'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($crendentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard.index', [], false));
        }

        return back()->withErrors([
            'login' => 'Email/Username atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
