@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
    <div class="bg-white rounded-3xl shadow-xl p-8">

        {{-- LOGO / BRAND --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-green-600">
                DonasiKita
            </h1>
            <p class="text-gray-500 mt-2">
                Buat akun untuk mulai berbagi kebaikan
            </p>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- NAMA --}}
            <div>
                <label class="text-sm font-medium text-gray-600">
                    Nama Lengkap
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Nama lengkap"
                    class="w-full mt-1 px-4 py-3 rounded-xl border
                          focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="text-sm font-medium text-gray-600">
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com"
                    class="w-full mt-1 px-4 py-3 rounded-xl border
                          focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

            {{-- PASSWORD --}}
            <div>
                <label class="text-sm font-medium text-gray-600">
                    Password
                </label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter"
                    class="w-full mt-1 px-4 py-3 rounded-xl border
                          focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

            {{-- KONFIRMASI PASSWORD --}}
            <div>
                <label class="text-sm font-medium text-gray-600">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation" required placeholder="Ulangi password"
                    class="w-full mt-1 px-4 py-3 rounded-xl border
                          focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            @error('password_confirmation')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

            {{-- SUBMIT --}}
            <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600
                       text-white py-3 rounded-xl font-semibold transition">
                Daftar
            </button>
        </form>

        {{-- LOGIN LINK --}}
        <p class="text-center text-sm text-gray-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-green-600 font-medium hover:underline">
                Login di sini
            </a>
        </p>

    </div>
@endsection
