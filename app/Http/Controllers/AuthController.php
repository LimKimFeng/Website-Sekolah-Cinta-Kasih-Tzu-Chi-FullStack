<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Rate Limiting
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts('login:' . $request->ip(), 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn('login:' . $request->ip());
            \RealRashid\SweetAlert\Facades\Alert::error('Terlalu Banyak Percobaan', 'Silakan coba lagi dalam ' . $seconds . ' detik.');
            return back()->withErrors(['email' => 'Terlalu banyak percobaan login.'])->onlyInput('email');
        }

        // Cloudflare Turnstile
        $response = \Illuminate\Support\Facades\Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => env('TURNSTILE_SECRET_KEY'),
            'response' => $request->input('cf-turnstile-response'),
        ]);

        if (!$response->json()['success']) {
            \RealRashid\SweetAlert\Facades\Alert::error('Error', 'Validasi Turnstile gagal. Silakan coba lagi.');
            return back()->withErrors(['msg' => 'Validasi Turnstile gagal.'])->withInput();
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            \Illuminate\Support\Facades\RateLimiter::clear('login:' . $request->ip());
            $request->session()->regenerate();

            \RealRashid\SweetAlert\Facades\Alert::toast('Selamat datang kembali, ' . Auth::user()->name, 'success');

            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('student.dashboard'));
        }

        \Illuminate\Support\Facades\RateLimiter::hit('login:' . $request->ip());

        \RealRashid\SweetAlert\Facades\Alert::error('Gagal Masuk', 'Email atau password yang Anda masukkan salah.');

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
}
