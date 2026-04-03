@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/30">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 transition-colors mb-8 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar User
            </a>

            {{-- HEADER --}}
            <div class="flex items-center gap-4 mb-8">
                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 9v3m0 0v-3m0 3h-3m-3 0h6m-9 1a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-800">Tambah User Baru</h1>
                    <p class="text-slate-500 text-sm mt-0.5">Buat akun pengguna baru di platform</p>
                </div>
            </div>

            {{-- ALERT --}}
            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 rounded-xl px-5 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            @endif

            {{-- FORM CARD --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">

                {{-- FORM HEADER --}}
                <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h2 class="font-bold text-sm text-slate-700">Informasi Akun</h2>
                    </div>
                </div>

                <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 sm:p-8">

                    @csrf

                    <div class="space-y-6">

                        {{-- NAMA --}}
                        <div>
                            <label for="name"
                                class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Nama Lengkap
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all
                                @error('name') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                    required>
                            </div>
                            @error('name')
                                <div class="flex items-center gap-1.5 mt-2">
                                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label for="email"
                                class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Email
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="contoh@email.com"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all
                                @error('email') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                    required>
                            </div>
                            @error('email')
                                <div class="flex items-center gap-1.5 mt-2">
                                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- PASSWORD ROW --}}
                        <div class="grid sm:grid-cols-2 gap-5">
                            {{-- PASSWORD --}}
                            <div>
                                <label for="password"
                                    class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                    Password
                                    <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input x-data="{ show: false }" :type="show ? 'text' : 'password'" id="password"
                                        name="password" placeholder="Minimal 8 karakter"
                                        class="w-full pl-12 pr-12 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all
                                    @error('password') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                        required>
                                    <button type="button" @click="show = !show"
                                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="flex items-center gap-1.5 mt-2">
                                        <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            {{-- KONFIRMASI PASSWORD --}}
                            <div>
                                <label for="password_confirmation"
                                    class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                    Konfirmasi Password
                                    <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        placeholder="Ulangi password"
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all"
                                        required>
                                </div>
                            </div>
                        </div>

                        {{-- DIVIDER --}}
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-100"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span
                                    class="bg-white px-4 text-xs text-slate-400 uppercase tracking-widest font-semibold">Pengaturan
                                    Akses</span>
                            </div>
                        </div>

                        {{-- ROLE --}}
                        <div>
                            <label for="role"
                                class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Role
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <select id="role" name="role"
                                    class="w-full pl-12 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all cursor-pointer appearance-none
                                @error('role') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                    required>
                                    <option value="" disabled {{ !old('role') ? 'selected' : '' }}>Pilih role
                                        pengguna</option>
                                    <option value="donatur" {{ old('role') === 'donatur' ? 'selected' : '' }}>Donatur
                                    </option>
                                    <option value="pengelola" {{ old('role') === 'pengelola' ? 'selected' : '' }}>
                                        Pengelola</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            @error('role')
                                <div class="flex items-center gap-1.5 mt-2">
                                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                </div>
                            @enderror

                            {{-- ROLE INFO --}}
                            <div x-data="{
                                role: '{{ old('role', '') }}',
                                info: {
                                    donatur: 'Dapat berdonasi dan mengelola profil pribadi.',
                                    pengelola: 'Dapat membuat campaign, mengelola donasi, dan tarik dana. Perlu verifikasi KTP.',
                                    admin: 'Akses penuh ke semua fitur platform termasuk manajemen user.'
                                }
                            }" x-show="info[role]" x-cloak
                                class="flex items-start gap-2.5 mt-3 p-3 bg-blue-50 border border-blue-100 rounded-xl transition-all">
                                <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-[11px] text-blue-600 leading-relaxed" x-text="info[role]"></p>
                            </div>
                        </div>

                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                        <a href="{{ route('admin.users.index') }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold border border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold bg-gradient-to-r from-blue-500 to-indigo-500 text-white hover:from-blue-600 hover:to-indigo-600 shadow-lg shadow-blue-500/20 hover:shadow-blue-500/30 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Buat User
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
