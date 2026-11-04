<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Halaman Login Admin
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses Login melalui Database Users
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $user->id,
                'admin_name' => $user->name,
                'admin_username' => $user->username ?? $user->email,
            ]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return back()->with('error', 'Username atau password salah. Silakan coba lagi.')->withInput($request->only('username'));
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_id', 'admin_name', 'admin_username']);
        return redirect()->route('admin.login')
            ->with('success', 'Anda telah keluar dari sistem.');
    }
}

