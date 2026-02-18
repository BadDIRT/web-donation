@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="bg-white rounded-3xl shadow-xl p-8">

        {{-- LOGO / BRAND --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-green-600">
                DonasiKita
            </h1>
            <p class="text-gray-500 mt-2">
                Masuk untuk melanjutkan kebaikan
            </p>
        </div>

        {{-- SUCCESS ALERT --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="mb-6 rounded-xl bg-green-50 border border-green-200 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- ERROR ALERT --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif




        {{-- FORM --}}
        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="text-sm font-medium text-gray-600">
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com"
                    class="w-full mt-1 px-4 py-3 rounded-xl border
              @error('email') border-red-500 @enderror
              focus:ring-2 focus:ring-green-500 focus:outline-none">

            </div>

            {{-- PASSWORD --}}
            <div x-data="{ show: false }" class="relative">
                <label class="text-sm font-medium text-gray-600">
                    Password
                </label>

                <input :type="show ? 'text' : 'password'" name="password" required placeholder="••••••••"
                    class="w-full mt-1 px-4 py-3 rounded-xl border
               @error('password') border-red-500 @enderror
               focus:ring-2 focus:ring-green-500 focus:outline-none pr-12">

                {{-- TOGGLE ICON --}}
                <button type="button" @click="show = !show"
                    class="absolute right-4 top-[42px] text-gray-400 hover:text-green-500">

                    {{-- EYE OPEN --}}
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                         c4.478 0 8.268 2.943 9.542 7
                         -1.274 4.057-5.064 7-9.542 7
                         -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    {{-- EYE CLOSED --}}
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                         c-4.478 0-8.268-2.943-9.543-7
                         a9.97 9.97 0 012.188-3.592m3.673-2.87
                         A9.956 9.956 0 0112 5
                         c4.478 0 8.268 2.943 9.543 7
                         a10.025 10.025 0 01-4.132 5.411M15 12
                         a3 3 0 00-3-3m0 0a3 3 0 013 3m-3-3L3 3" />
                    </svg>

                </button>
            </div>


            {{-- SUBMIT --}}
            <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600
                       text-white py-3 rounded-xl font-semibold transition">
                Login
            </button>
        </form>

        {{-- REGISTER LINK --}}
        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-green-600 font-medium hover:underline">
                Daftar sekarang
            </a>
        </p>

    </div>
@endsection
