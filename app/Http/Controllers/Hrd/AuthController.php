<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('hrd.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'hrd') {
                return redirect()->route('hrd.dashboard');
            }
            Auth::logout();
            return redirect()->route('hrd.login')->with('error', 'Hanya HRD yang bisa login di sini.');
        }
        return redirect()->route('hrd.login')->with('error', 'Email atau password salah.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('hrd.login');
    }
}
