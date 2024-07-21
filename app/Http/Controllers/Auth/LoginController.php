<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        try {
            // Check Auth
            if (!Auth::attempt($request->only('username', 'password'))) {
                RateLimiter::hit(Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip()));
                return back()->with("gagal", 'Login Gagal! Kombinasi username dan password salah!');
            }

            $request->session()->regenerate();

            switch (Auth::user()->role) {
                case 'Penpos':
                    return redirect()->intended('/penpos');
                default:
                    abort(404);
            }
        } catch (\Exception $x) {
            return back()->with('gagal', $x->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
