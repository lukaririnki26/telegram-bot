<?php

namespace App\Http\Controllers\Admin;

use Symfony\Component\HttpFoundation\Request;

class AuthAdminController extends AdminController
{
    public function login()
    {
        return view('auth.login');
    }

    public function submitLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('error', 'Login Failed!');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function submitRegister(Request $request)
    {
        dd($request);
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function submitForgotPassword(Request $request)
    {
        dd($request);
    }

    public function logout() {}
}
