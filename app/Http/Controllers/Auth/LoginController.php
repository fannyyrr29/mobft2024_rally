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
        $maxAttempts = 5;
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        try {
            $throttleKey = Str::transliterate(Str::lower($request->input('username')).'|'.$request->ip());

            // Check Limiter
            if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
                $seconds = RateLimiter::availableIn($throttleKey);
                return back()->with("gagal", 'Too many login attempts. Please try again in ' . $seconds .  ' seconds!');
            }

            // Check Auth
            if (!Auth::attempt($request->only('username', 'password'))) {
                RateLimiter::hit($throttleKey);
                return back()->with("gagal", 'Login Gagal! Kombinasi username dan password salah!');
            }

            // Clear Limiter
            RateLimiter::clear($throttleKey);

            $request->session()->regenerate();

            switch (Auth::user()->role) {
                case 'Penpos':
                    return redirect()->intended('/penpos');
                case "Rally1":
                    abort(403);// Sementara, nanti hapus aja
                case "Rally2":
                    abort(403);// Sementara, nanti hapus aja
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
