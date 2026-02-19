<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ===== LOGIN =====
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ],
        [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.'
        ]);

        if (!auth()->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.'
            ]);
        }

        $request->session()->regenerate();

        $user = auth()->user();

        /**
         * 🔥 AUTO UPGRADE DONATUR → PENGELOLA
         */
        if ($user->role === 'donatur') {
            $user->update([
                'role'        => 'pengelola',
                'is_approved' => false
            ]);
        }

        /**
         * 🔀 REDIRECT BERDASARKAN ROLE
         */
        return match ($user->role) {
            'admin'     => redirect()->route('home')->with('success', 'Login berhasil, selamat datang admin!'),
            'pengelola' => redirect()->route('home')->with('success', 'Login berhasil, selamat datang pengelola!'),
            default     => redirect()->route('home')->with('success', 'Login berhasil, selamat datang donatur!'),
        };
    }


    // ===== REGISTER =====
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 6 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok'
            ]
        );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'donatur'
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil, silakan login');
    }

    // ===== LOGOUT =====
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
