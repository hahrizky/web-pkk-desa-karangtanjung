<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Halaman Login Admin
     */
    public function showLoginForm()
    {
        // Jika sudah login via Auth Guard, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses Login melalui Laravel Auth Guard dengan Proteksi Rate Limiting
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Key unik berdasarkan username (lowercase) dan IP pengunjung
        $throttleKey = Str::transliterate(Str::lower($request->input('username')).'|'.$request->ip());

        // Cek jika sudah melebihi 5 kali percobaan gagal
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()
                ->with('error', "Terlalu banyak percobaan login gagal. Silakan coba lagi dalam {$seconds} detik.")
                ->withInput($request->only('username'));
        }

        $loginInput = $request->input('username');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        // Dukung login via username maupun email
        $loginField = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $attemptSuccess = Auth::attempt([$loginField => $loginInput, 'password' => $password], $remember);

        // Jika tidak cocok dan awalnya dianggap username, coba cek sebagai email atau sebaliknya
        if (! $attemptSuccess) {
            $altField = ($loginField === 'email') ? 'username' : 'email';
            $attemptSuccess = Auth::attempt([$altField => $loginInput, 'password' => $password], $remember);
        }

        if ($attemptSuccess) {
            // Bersihkan riwayat percobaan login saat berhasil
            RateLimiter::clear($throttleKey);

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang, '.Auth::user()->name.'!');
        }

        // Catat 1 kali percobaan gagal (terkunci selama 60 detik jika mencapai 5x)
        RateLimiter::hit($throttleKey, 60);

        $remaining = RateLimiter::remaining($throttleKey, 5);
        $errorMessage = 'Username atau password salah. Silakan coba lagi.';
        if ($remaining > 0 && $remaining <= 3) {
            $errorMessage .= " (Sisa percobaan: {$remaining}x)";
        }

        return back()
            ->with('error', $errorMessage)
            ->withInput($request->only('username'));
    }

    /**
     * Logout melalui Laravel Auth Guard
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah keluar dari sistem.');
    }
}
