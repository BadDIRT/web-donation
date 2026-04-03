@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="w-full max-w-md">

        {{-- BRAND --}}
        <div class="text-center mb-8">
            <a href="{{ route('campaign.index') }}" class="inline-flex items-center gap-3 group">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-md shadow-green-200/50 group-hover:shadow-green-300/50 transition-all">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 21s-6.5-4.35-9-8.5C1.5 9.5 3.5 6 7 6c2 0 3.5 1.5 5 3.5C13.5 7.5 15 6 17 6c3.5 0 5.5 3.5 4 6.5-2.5 4.15-9 8.5-9 8.5z" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gray-800 tracking-tight">
                    Donasi<span class="text-green-500">Kita</span>
                </span>
            </a>
            <p class="text-slate-500 text-sm mt-3">Masuk untuk melanjutkan kebaikan</p>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">

            {{-- SUCCESS ALERT --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="mx-6 mt-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 flex items-center gap-3">
                    <div class="w-6 h-6 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            {{-- ERROR ALERT --}}
            @if ($errors->any())
                <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    class="mx-6 mt-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 flex items-center gap-3">
                    <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <p class="text-sm text-red-700 font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            <div class="p-6 sm:p-8">
                {{-- FORM --}}
                <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                    @csrf

                    {{-- EMAIL --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                placeholder="email@example.com"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border text-sm text-slate-800 placeholder-slate-400
                                    @error('email') border-red-300 bg-red-50/50 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 bg-slate-50/50 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white @enderror
                                    focus:outline-none focus:ring-2 transition-all">
                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input :type="show ? 'text' : 'password'" id="password" name="password" required
                                placeholder="Masukkan password"
                                class="w-full pl-11 pr-12 py-3 rounded-xl border text-sm text-slate-800 placeholder-slate-400
                                    @error('password') border-red-300 bg-red-50/50 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 bg-slate-50/50 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white @enderror
                                    focus:outline-none focus:ring-2 transition-all">

                            {{-- TOGGLE --}}
                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                <svg x-show="!show" class="w-4.5 h-4.5" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" class="w-4.5 h-4.5" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 012.188-3.592m3.673-2.87A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411M15 12a3 3 0 00-3-3m0 0a3 3 0 013 3m-3-3L3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit"
                        class="w-full py-3 rounded-xl text-sm font-semibold bg-gradient-to-r from-green-500 to-green-600 text-white hover:from-green-600 hover:to-green-700 shadow-lg shadow-green-500/20 hover:shadow-green-500/30 transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk
                    </button>
                </form>

                {{-- DIVIDER --}}
                <div class="flex items-center gap-4 my-6">
                    <div class="flex-1 h-px bg-slate-200"></div>
                    <span class="text-xs text-slate-400 font-medium">atau</span>
                    <div class="flex-1 h-px bg-slate-200"></div>
                </div>

                {{-- REGISTER LINK --}}
                <p class="text-center text-sm text-slate-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="text-green-600 font-semibold hover:text-green-700 transition-colors hover:underline">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </div>

        {{-- FOOTER TEXT --}}
        <p class="text-center text-xs text-slate-400 mt-6">
            &copy; {{ date('Y') }} DonasiKita. Platform donasi terpercaya.
        </p>

    </div>
@endsection
