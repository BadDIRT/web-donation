@extends('layouts.app')
<div class="min-h-screen bg-slate-50 py-8">
    <div class="container mx-auto px-4 max-w-4xl">

        {{-- BREADCRUMB --}}
        <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
            <a href="{{ route('dashboard') }}" class="hover:text-green-600 transition-colors">Dashboard</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-slate-800 font-medium">Edit Profile</span>
        </nav>

        {{-- PAGE TITLE --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Edit Profile</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola informasi akun dan tampilan profile Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ============================================= --}}
            {{-- KOLOM KIRI: FOTO PROFILE --}}
            {{-- ============================================= --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h2 class="text-sm font-bold text-slate-700">Foto Profile</h2>
                    </div>

                    <div class="p-6">
                        {{-- AVATAR --}}
                        <div class="flex flex-col items-center">
                            @if ($user->profile_photo_path)
                                <div class="relative group">
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                        class="w-28 h-28 rounded-2xl object-cover shadow-lg">

                                    {{-- HOVER OVERLAY --}}
                                    <div
                                        class="absolute inset-0 bg-black/40 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="w-28 h-28 rounded-2xl bg-gradient-to-br {{ $user->role_color }} flex items-center justify-center shadow-lg">
                                    <span class="text-3xl font-bold text-white">{{ $user->initial }}</span>
                                </div>
                            @endif

                            <h3 class="mt-4 text-sm font-bold text-slate-800">{{ $user->name }}</h3>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $user->email }}</p>

                            {{-- ROLE BADGE --}}
                            <span
                                class="inline-flex items-center gap-1 mt-2 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $user->role_badge_color }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>

                        {{-- AKSI FOTO --}}
                        <div class="mt-6 space-y-2.5">
                            {{-- UPLOAD FOTO --}}
                            <form action="{{ route('profile.photo.update') }}" method="POST"
                                enctype="multipart/form-data" x-data="{ uploading: false }" @submit="uploading = true">
                                @csrf
                                @method('POST')

                                <label
                                    class="flex items-center justify-center gap-2 w-full px-4 py-2.5 border-2 border-dashed border-slate-200 rounded-xl cursor-pointer hover:border-green-400 hover:bg-green-50/50 transition-all duration-200 group">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-green-500 transition-colors"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span
                                        class="text-xs font-medium text-slate-500 group-hover:text-green-600 transition-colors"
                                        x-text="uploading ? 'Mengupload...' : 'Ganti Foto'">
                                        Ganti Foto
                                    </span>
                                    <input type="file" name="photo" accept="image/jpeg,image/png,image/webp"
                                        class="hidden" onchange="this.closest('form').submit()">
                                </label>
                            </form>

                            {{-- HAPUS FOTO --}}
                            @if ($user->profile_photo_path)
                                <form action="{{ route('profile.photo.remove') }}" method="POST"
                                    x-data="{ confirm: false }">
                                    @csrf
                                    @method('DELETE')

                                    <template x-if="!confirm">
                                        <button type="button" @click="confirm = true"
                                            class="flex items-center justify-center gap-2 w-full px-4 py-2.5 text-xs font-medium text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus Foto
                                        </button>
                                    </template>

                                    <template x-if="confirm">
                                        <div class="flex items-center gap-2">
                                            <button type="submit"
                                                class="flex-1 px-3 py-2 text-xs font-medium text-white bg-red-500 hover:bg-red-600 rounded-xl transition-colors">
                                                Ya, Hapus
                                            </button>
                                            <button type="button" @click="confirm = false"
                                                class="flex-1 px-3 py-2 text-xs font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                                                Batal
                                            </button>
                                        </div>
                                    </template>
                                </form>
                            @endif

                            {{-- INFO --}}
                            <p class="text-[10px] text-slate-400 text-center leading-relaxed">
                                Format: JPG, PNG, WebP<br>Maks: 2MB
                            </p>
                        </div>
                    </div>
                </div>

                {{-- INFO AKUN --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden mt-6">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h2 class="text-sm font-bold text-slate-700">Info Akun</h2>
                    </div>
                    <div class="p-6 space-y-3.5">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">Role</span>
                            <span class="font-semibold text-slate-700 capitalize">{{ $user->role }}</span>
                        </div>
                        <div class="border-t border-slate-100"></div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">Terdaftar</span>
                            <span class="font-medium text-slate-700">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="border-t border-slate-100"></div>

                        @if ($user->role === 'pengelola')
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Status</span>
                                @if ($user->is_approved)
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Terverifikasi
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Menunggu
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ============================================= --}}
            {{-- KOLOM KANAN: FORM EDIT --}}
            {{-- ============================================= --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- FORM DATA PROFILE --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h2 class="text-sm font-bold text-slate-700">Informasi Pribadi</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Perbarui nama, email, dan nomor telepon Anda</p>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('profile.update') }}" method="POST" x-data="{ success: '{{ session('success') }}' }"
                            x-init="setTimeout(() => success = '', 3000)">
                            @csrf
                            @method('PUT')

                            {{-- NAMA --}}
                            <div class="mb-5">
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                                    placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="mb-5">
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                                    placeholder="Masukkan email">
                                @error('email')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- PHONE --}}
                            <div class="mb-6">
                                <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">
                                    Nomor Telepon
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <span class="text-sm text-slate-400 font-medium">No.</span>
                                    </div>
                                    <input type="text" id="phone" name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        class="w-full pl-12 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                                        placeholder="8xxxxxxxxxx" maxlength="13">
                                </div>
                                @error('phone')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-[10px] text-slate-400 mt-1.5">Kosongkan jika tidak ingin diubah</p>
                            </div>

                            {{-- SUBMIT --}}
                            <div class="flex items-center gap-3">
                                <button type="submit"
                                    class="px-6 py-2.5 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-xl shadow-sm shadow-green-200/50 hover:shadow-green-300/50 transition-all duration-200">
                                    Simpan Perubahan
                                </button>
                                <a href="{{ route('dashboard') }}"
                                    class="px-6 py-2.5 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition-all duration-200">
                                    Batal
                                </a>
                            </div>
                        </form>

                        {{-- FLASH SUCCESS --}}
                        @if (session('success'))
                            <div
                                class="mt-4 flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200/60 rounded-xl">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm text-emerald-700 font-medium">{{ session('success') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- FORM UBAH PASSWORD --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h2 class="text-sm font-bold text-slate-700">Ubah Password</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Pastikan akun Anda menggunakan password yang kuat
                        </p>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('profile.password.update') }}" method="POST" x-data="{ show: false, success: '{{ session('success') }}' }"
                            x-init="setTimeout(() => success = '', 3000)">
                            @csrf
                            @method('PUT')

                            {{-- TOGGLE PASSWORD --}}
                            <button type="button" @click="show = !show"
                                class="flex items-center gap-2 text-sm text-slate-600 hover:text-green-600 transition-colors mb-5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                                <span x-text="show ? 'Tutup Form' : 'Ubah Password'"></span>
                                <svg class="w-3.5 h-3.5 transition-transform" :class="show && 'rotate-180'"
                                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="show" x-transition>
                                {{-- PASSWORD LAMA --}}
                                <div class="mb-4">
                                    <label for="current_password"
                                        class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Password Saat Ini <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                                        placeholder="Masukkan password saat ini">
                                    @error('current_password')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- PASSWORD BARU --}}
                                <div class="mb-4">
                                    <label for="new_password" class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Password Baru <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" id="new_password" name="new_password"
                                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                                        placeholder="Minimal 8 karakter">
                                    @error('new_password')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- KONFIRMASI PASSWORD --}}
                                <div class="mb-6">
                                    <label for="new_password_confirmation"
                                        class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" id="new_password_confirmation"
                                        name="new_password_confirmation"
                                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                                        placeholder="Ulangi password baru">
                                    @error('new_password_confirmation')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="px-6 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium rounded-xl shadow-sm transition-all duration-200">
                                    Ubah Password
                                </button>
                            </div>
                        </form>

                        @if (session('success'))
                            <div
                                class="mt-4 flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200/60 rounded-xl">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm text-emerald-700 font-medium">{{ session('success') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- ============================================= --}}
                {{-- DANGER ZONE - HAPUS AKUN --}}
                {{-- ============================================= --}}
                <div class="bg-white rounded-2xl shadow-sm border border-red-200/60 overflow-hidden"
                    x-data="{
                        step: 'idle', // idle | confirm | password | deleting
                        password: '',
                        error: '{{ $errors->first('password') }}',
                        loading: false
                    }" x-init="setTimeout(() => error = '', 5000)">

                    <div class="px-6 py-4 border-b border-red-100 bg-red-50/30">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <h2 class="text-sm font-bold text-red-700">Zona Berbahaya</h2>
                        </div>
                        <p class="text-xs text-red-400 mt-0.5">Tindakan ini tidak dapat dikembalikan</p>
                    </div>

                    <div class="p-6">

                        {{-- STEP 1: IDLE (TOMBOL HAPUS) --}}
                        <template x-if="step === 'idle'">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-slate-700">Hapus Akun</p>
                                    <p class="text-xs text-slate-400 mt-0.5">
                                        Semua data Anda akan dihapus secara permanen
                                    </p>
                                </div>
                                <button @click="step = 'confirm'"
                                    class="px-4 py-2 border border-red-200 text-red-500 text-xs font-medium rounded-xl hover:bg-red-50 transition-colors whitespace-nowrap">
                                    Hapus Akun
                                </button>
                            </div>
                        </template>

                        {{-- STEP 2: KONFIRMASI --}}
                        <template x-if="step === 'confirm'">
                            <div>
                                {{-- ICON --}}
                                <div class="flex justify-center mb-4">
                                    <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center">
                                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                    </div>
                                </div>

                                <h3 class="text-base font-bold text-slate-800 text-center">
                                    Yakin ingin menghapus akun ini?
                                </h3>
                                <p class="text-sm text-slate-500 text-center mt-2 leading-relaxed">
                                    Tindakan ini akan menghapus akun <strong
                                        class="text-slate-700">{{ $user->name }}</strong>
                                    beserta semua data terkait secara permanen. Anda tidak akan bisa memulihkannya
                                    kembali.
                                </p>

                                {{-- INFO KHUSUS PENGELOLA --}}
                                @if ($user->role === 'pengelola')
                                    <div class="mt-4 p-4 bg-amber-50 border border-amber-200/60 rounded-xl">
                                        <div class="flex gap-3">
                                            <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <div>
                                                <p class="text-xs font-bold text-amber-800">
                                                    Informasi Penting untuk Pengelola
                                                </p>
                                                <p class="text-xs text-amber-700 mt-1 leading-relaxed">
                                                    Jika Anda menghapus akun ini, seluruh <strong>dana campaign yang
                                                        sudah terkumpul</strong> akan disalurkan dan dialihkan ke
                                                    campaign
                                                    lain yang sejenis oleh admin. Pastikan Anda sudah menarik sisa dana
                                                    yang tersedia sebelum melanjutkan.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- BUTTON --}}
                                <div class="flex gap-3 mt-6">
                                    <button @click="step = 'idle'"
                                        class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition-colors">
                                        Batal
                                    </button>
                                    <button
                                        @click="step = 'password'; $nextTick(() => { $refs.passwordInput?.focus(); })"
                                        class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-xl transition-colors shadow-sm shadow-red-200/50">
                                        Lanjutkan
                                    </button>
                                </div>
                            </div>
                        </template>

                        {{-- STEP 3: INPUT PASSWORD --}}
                        <template x-if="step === 'password'">
                            <div>
                                {{-- ICON --}}
                                <div class="flex justify-center mb-4">
                                    <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center">
                                        <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                </div>

                                <h3 class="text-base font-bold text-slate-800 text-center">
                                    Konfirmasi Password
                                </h3>
                                <p class="text-sm text-slate-500 text-center mt-2">
                                    Masukkan password Anda untuk melanjutkan penghapusan akun.
                                </p>

                                {{-- ERROR MESSAGE --}}
                                <div x-show="error" x-transition
                                    class="mt-4 flex items-center gap-2 px-4 py-3 bg-red-50 border border-red-200/60 rounded-xl">
                                    <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm text-red-700" x-text="error"></span>
                                </div>

                                {{-- FORM PASSWORD --}}
                                <form action="{{ route('profile.destroy') }}" method="POST"
                                    @submit="loading = true">
                                    @csrf
                                    @method('DELETE')

                                    <div class="mt-4">
                                        <input type="password" name="password" x-ref="passwordInput"
                                            x-model="password"
                                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-center font-medium tracking-wider"
                                            placeholder="••••••••">
                                    </div>

                                    <div class="flex gap-3 mt-4">
                                        <button type="button" @click="step = 'confirm'; error = ''; password = '';"
                                            class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition-colors"
                                            :disabled="loading">
                                            Kembali
                                        </button>
                                        <button type="submit"
                                            class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 disabled:bg-red-300 text-white text-sm font-medium rounded-xl transition-colors shadow-sm shadow-red-200/50 flex items-center justify-center gap-2"
                                            :disabled="!password || loading">
                                            <svg x-show="loading" class="animate-spin w-4 h-4" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                                                </path>
                                            </svg>
                                            <span x-text="loading ? 'Menghapus...' : 'Hapus Akun'"></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </template>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
