<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function index()
    {
        Session::put('register_load_time', now());
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // 1. Honeypot
        if ($request->filled('b_field')) {
            abort(403);
        }

        // 2. Time-Based Validation
        $loadTime = Session::get('register_load_time');
        if (!$loadTime || now()->diffInSeconds($loadTime) < 5) { // Reduced to 5s for better UX
            Alert::error(__('Error'), __('Pengisian terlalu cepat. Sistem mendeteksi aktivitas robot.'));
            return back()->withErrors(['msg' => 'Pengisian terlalu cepat. Sistem mendeteksi aktivitas robot.'])->withInput();
        }

        // 3. Slide-to-Verify
        if ($request->input('is_human_verified') !== 'true') {
             Alert::error(__('Error'), __('Silakan geser slider verifikasi.'));
             return back()->withErrors(['msg' => 'Silakan geser slider verifikasi.'])->withInput();
        }

        // 4. Cloudflare Turnstile
        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => env('TURNSTILE_SECRET_KEY'),
            'response' => $request->input('cf-turnstile-response'),
        ]);

        if (!$response->json()['success']) {
            Alert::error(__('Error'), __('Validasi Turnstile gagal. Silakan coba lagi.'));
            return back()->withErrors(['msg' => 'Validasi Turnstile gagal.'])->withInput();
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'level' => 'required|in:TK,SD,SMP,SMA,SMK',
            'major' => 'required_if:level,SMK|in:PPLG,AKL,MPLB,',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        Candidate::create([
            'user_id' => $user->id,
            'registration_number' => 'REG-' . time() . '-' . $user->id,
            'level' => $request->level,
            'major' => $request->level === 'SMK' ? $request->major : null,
            'status' => 'draft',
        ]);

        // Login user
        auth()->login($user);

        Alert::success(__('Berhasil'), __('Selamat Bergabung, silakan lengkapi formulir.'));

        return redirect()->route('student.dashboard');
    }
}
