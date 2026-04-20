@extends('layouts.app')

@section('title', 'Edit User - ' . $user->name)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/30">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('admin.users.show', $user) }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 transition-colors mb-8 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Detail User
            </a>

            {{-- HEADER --}}
            <div class="flex items-center gap-4 mb-8">
                @if ($user->profile_photo_path)
                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                        class="w-14 h-14 rounded-2xl object-cover shadow-lg
        {{ $user->role === 'admin' ? 'shadow-red-500/20' : ($user->role === 'pengelola' ? 'shadow-violet-500/20' : 'shadow-blue-500/20') }}">
                @else
                    <div
                        class="w-14 h-14 rounded-2xl flex items-center justify-center text-xl font-extrabold shadow-lg
        {{ $user->role === 'admin' ? 'bg-gradient-to-br from-red-400 to-rose-500 text-white shadow-red-500/20' : ($user->role === 'pengelola' ? 'bg-gradient-to-br from-violet-400 to-purple-500 text-white shadow-violet-500/20' : 'bg-gradient-to-br from-blue-400 to-cyan-500 text-white shadow-blue-500/20') }}">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="text-2xl font-extrabold text-slate-800">Edit User</h1>
                        <span
                            class="text-[10px] font-bold uppercase tracking-widest px-2.5 py-0.5 rounded-md
                        {{ $user->role === 'admin' ? 'bg-red-50 text-red-600 border border-red-100' : ($user->role === 'pengelola' ? 'bg-violet-50 text-violet-600 border border-violet-100' : 'bg-blue-50 text-blue-600 border border-blue-100') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <p class="text-slate-500 text-sm mt-0.5">{{ $user->name }} • {{ $user->email }}</p>
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
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <h2 class="font-bold text-sm text-slate-700">Informasi Akun</h2>
                    </div>
                </div>

                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 sm:p-8">

                    @csrf @method('PUT')

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
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
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
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" placeholder="contoh@email.com"
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

                        {{-- DIVIDER --}}
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-100"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span
                                    class="bg-white px-4 text-xs text-slate-400 uppercase tracking-widest font-semibold flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Ubah Password
                                </span>
                            </div>
                        </div>

                        {{-- PASSWORD INFO --}}
                        <div class="flex items-start gap-2.5 p-3 bg-slate-50 border border-slate-100 rounded-xl">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-[11px] text-slate-500 leading-relaxed">
                                <span class="font-semibold text-slate-600">Opsional.</span> Biarkan kosong jika tidak ingin
                                mengubah password saat ini.
                            </p>
                        </div>

                        {{-- PASSWORD ROW --}}
                        <div class="grid sm:grid-cols-2 gap-5">
                            {{-- PASSWORD --}}
                            <div>
                                <label for="password"
                                    class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                    Password Baru
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
                                    @error('password') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
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
                                        placeholder="Ulangi password baru"
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all">
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
                                    class="bg-white px-4 text-xs text-slate-400 uppercase tracking-widest font-semibold flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    Pengaturan Akses
                                </span>
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
                                    <option value="donatur"
                                        {{ old('role', $user->role) === 'donatur' ? 'selected' : '' }}>Donatur</option>
                                    <option value="pengelola"
                                        {{ old('role', $user->role) === 'pengelola' ? 'selected' : '' }}>Pengelola</option>
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                        Admin</option>
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

                            {{-- ROLE INFO DYNAMIC --}}
                            <div x-data="{
                                role: '{{ old('role', $user->role) }}',
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

                        {{-- ROLE CHANGE WARNING --}}
                        <div x-data="{
                            currentRole: '{{ $user->role }}',
                            get selectedRole() { return document.getElementById('role').value },
                            get changed() { return this.currentRole !== this.selectedRole }
                        }" x-show="changed" x-cloak
                            class="flex items-start gap-2.5 p-3 bg-amber-50 border border-amber-100 rounded-xl">
                            <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="text-[11px] text-amber-600 leading-relaxed">
                                <span class="font-semibold">Perhatian:</span> Mengubah role dari
                                <span class="font-bold" x-text="currentRole"></span> ke
                                <span class="font-bold" x-text="selectedRole"></span>
                                dapat mempengaruhi akses pengguna.
                            </p>
                        </div>

                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                        <a href="{{ route('admin.users.show', $user) }}"
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
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

            {{-- DANGER ZONE --}}
            <div class="mt-6 bg-white rounded-2xl shadow-sm shadow-black/5 border border-red-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-red-50 flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-sm text-red-600">Zona Berbahaya</h3>
                </div>
                <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-700">Hapus Akun User</p>
                        <p class="text-xs text-slate-400 mt-0.5">Tindakan ini tidak dapat dibatalkan. Semua data terkait
                            akan dihapus.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('deleteConfirm').classList.remove('hidden')"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium border border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 transition-all flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus User
                    </button>
                </div>

                {{-- DELETE CONFIRMATION --}}
                <div id="deleteConfirm" class="hidden px-6 pb-6">
                    <div class="bg-red-50 border border-red-200 rounded-xl p-5">
                        <div class="flex items-start gap-3 mb-4">
                            <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div>
                                <p class="text-sm font-bold text-red-700">Yakin ingin menghapus <span
                                        class="underline">{{ $user->name }}</span>?</p>
                                <p class="text-xs text-red-500 mt-1">Semua data termasuk donasi, campaign, dan rekening
                                    bank akan dihapus permanen.</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                            class="flex justify-end gap-2">
                            @csrf @method('DELETE')
                            <button type="button"
                                onclick="event.preventDefault(); document.getElementById('deleteConfirm').classList.add('hidden')"
                                class="px-4 py-2 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-white transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 rounded-xl text-sm font-semibold bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/20 transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Ya, Hapus Permanen
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
