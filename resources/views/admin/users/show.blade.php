@extends('layouts.app')

@section('title', 'Detail User - ' . $user->name)

@section('content')
    <div x-data="{
        roleModal: false,
        deleteModal: false
    }" class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/30">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 transition-colors mb-8 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar User
            </a>

            {{-- ==================== PROFILE HEADER ==================== --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">
                {{-- BANNER --}}
                <div
                    class="relative h-36 sm:h-44 bg-gradient-to-br from-blue-600 via-indigo-600 to-violet-600 overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 400 200" fill="none">
                            <circle cx="50" cy="50" r="80" fill="white" />
                            <circle cx="350" cy="150" r="100" fill="white" />
                            <circle cx="200" cy="-20" r="60" fill="white" />
                        </svg>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>

                    <div class="relative flex items-end h-full px-6 pb-5">
                        <div class="flex items-end gap-4 w-full">
                            {{-- AVATAR --}}
                            <div
                                class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl flex items-center justify-center text-3xl sm:text-4xl font-extrabold shadow-xl border-4 border-white flex-shrink-0
                            {{ $user->role === 'admin' ? 'bg-gradient-to-br from-red-400 to-rose-500 text-white' : ($user->role === 'pengelola' ? 'bg-gradient-to-br from-violet-400 to-purple-500 text-white' : 'bg-gradient-to-br from-blue-400 to-cyan-500 text-white') }}">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>

                            <div class="pb-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h1 class="text-xl sm:text-2xl font-extrabold text-white drop-shadow-lg">
                                        {{ $user->name }}
                                    </h1>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full bg-white/20 text-white/90 backdrop-blur-md border border-white/10">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                                <p class="text-sm text-white/70 mt-1 drop-shadow">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- META BAR --}}
                <div
                    class="px-6 py-3.5 bg-slate-50/80 border-t border-slate-100 flex flex-wrap items-center gap-x-5 gap-y-2 text-xs text-slate-500">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 9V7a2 2 0 012-2h10a2 2 0 012 2v2" />
                        </svg>
                        ID: <span class="font-semibold text-slate-700">{{ $user->id }}</span>
                    </span>
                    <div class="w-px h-4 bg-slate-200"></div>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $user->created_at->translatedFormat('d F Y') }}
                    </span>
                    <div class="w-px h-4 bg-slate-200"></div>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $user->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>

            {{-- ==================== INFO GRID ==================== --}}
            <div class="grid gap-4 sm:grid-cols-2 mb-6">

                {{-- INFO AKUN --}}
                <div
                    class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-11 h-11 rounded-xl bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-3">Informasi Akun
                            </p>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-[10px] text-slate-400 uppercase tracking-wider mb-0.5">Email</p>
                                    <p class="text-sm font-semibold text-slate-700 truncate">{{ $user->email }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 uppercase tracking-wider mb-0.5">Telepon</p>
                                    @if ($user->phone)
                                        <p class="text-sm font-semibold text-slate-700">{{ $user->phone }}</p>
                                    @else
                                        <p class="text-sm text-slate-400 italic">Belum diisi</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STATUS AKUN --}}
                <div
                    class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0
                        {{ $user->role === 'pengelola' && $user->is_approved ? 'bg-gradient-to-br from-emerald-100 to-emerald-50' : ($user->role === 'pengelola' ? 'bg-gradient-to-br from-amber-100 to-amber-50' : 'bg-gradient-to-br from-slate-100 to-slate-50') }}">
                            @if ($user->role === 'pengelola' && $user->is_approved)
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-3">Status Akun</p>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-[10px] text-slate-400 uppercase tracking-wider mb-0.5">Role</p>
                                    <span
                                        class="inline-flex text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg
                                    {{ $user->role === 'admin' ? 'bg-red-50 text-red-600 border border-red-100' : ($user->role === 'pengelola' ? 'bg-violet-50 text-violet-600 border border-violet-100' : 'bg-blue-50 text-blue-600 border border-blue-100') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 uppercase tracking-wider mb-0.5">Verifikasi</p>
                                    @if ($user->role === 'pengelola')
                                        <span
                                            class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg
                                        {{ $user->is_approved ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-amber-50 text-amber-600 border border-amber-100' }}">
                                            @if ($user->is_approved)
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    stroke-width="3" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Disetujui
                                            @else
                                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                                Menunggu
                                            @endif
                                        </span>
                                    @else
                                        <p class="text-sm text-slate-400 italic">Tidak berlaku</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== KTP SECTION ==================== --}}
            @if ($user->ktp_path)
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">
                    {{-- HEADER --}}
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-sm text-slate-800">Dokumen KTP</h2>
                        </div>
                        <a href="{{ route('admin.pengelola.ktp', $user->id) }}" target="_blank"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-100 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V8a2 2 0 00-2-2h-4M7 7h10" />
                            </svg>
                            Buka di Tab Baru
                        </a>
                    </div>

                    {{-- IMAGE PREVIEW --}}
                    <div class="p-6">
                        <div class="relative bg-slate-50 rounded-xl p-4 border border-slate-200 max-w-md mx-auto group">
                            <img src="{{ route('admin.pengelola.ktp', $user->id) }}" alt="KTP {{ $user->name }}"
                                class="w-full max-h-72 object-contain rounded-xl">

                            {{-- HOVER OVERLAY --}}
                            <div
                                class="absolute inset-0 bg-black/40 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <a href="{{ route('admin.pengelola.ktp', $user->id) }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-slate-700 hover:bg-slate-50 shadow-xl text-sm font-semibold transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                    Perbesar
                                </a>
                            </div>
                        </div>

                        {{-- TIP --}}
                        <div
                            class="flex items-start gap-2.5 mt-4 p-3 bg-blue-50 border border-blue-100 rounded-xl max-w-md mx-auto">
                            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-[11px] text-blue-600 leading-relaxed">
                                <span class="font-semibold">Periksa kejelasan foto KTP</span> — pastikan nama di KTP sesuai
                                dengan nama akun, foto tidak blur, dan informasi terlihat jelas.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">
                    {{-- HEADER --}}
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="font-bold text-sm text-slate-800">Dokumen KTP</h2>
                    </div>

                    {{-- EMPTY STATE --}}
                    <div class="px-6 py-12 text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-slate-500 font-semibold text-sm">User ini belum mengupload KTP</p>
                        <p class="text-slate-400 text-xs mt-1">Dokumen diperlukan untuk verifikasi pengelola</p>
                    </div>
                </div>
            @endif

            {{-- ==================== STATISTIK ==================== --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-6 mb-6">
                <div class="flex items-center gap-2.5 mb-5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="font-bold text-sm text-slate-800">Statistik</h2>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div
                        class="bg-gradient-to-br from-slate-50 to-slate-100/50 rounded-xl p-5 text-center border border-slate-100">
                        <p class="text-3xl font-extrabold text-slate-800">{{ $user->donations->count() }}</p>
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold mt-2">Donasi</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-xl p-5 text-center border border-emerald-100">
                        <p class="text-xl font-extrabold text-emerald-700">Rp
                            {{ number_format($user->donations->sum('amount'), 0, ',', '.') }}</p>
                        <p class="text-[10px] text-emerald-600 uppercase tracking-widest font-bold mt-2">Total Nominal</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl p-5 text-center border border-blue-100">
                        <p class="text-3xl font-extrabold text-blue-700">{{ $user->campaigns->count() }}</p>
                        <p class="text-[10px] text-blue-600 uppercase tracking-widest font-bold mt-2">Campaign</p>
                    </div>
                </div>
            </div>

            {{-- ==================== REKENING BANK ==================== --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h2 class="font-bold text-sm text-slate-800">Rekening Bank</h2>
                    @if ($user->userBanks->isNotEmpty())
                        <span class="ml-auto text-xs text-slate-400">{{ $user->userBanks->count() }} rekening</span>
                    @endif
                </div>

                @if ($user->userBanks->isNotEmpty())
                    <div class="p-6">
                        <div class="grid gap-3 sm:grid-cols-2">
                            @foreach ($user->userBanks as $user_bank)
                                <div
                                    class="bg-gradient-to-br from-slate-50 to-white rounded-xl p-4 border border-slate-100 hover:border-amber-200 hover:shadow-sm transition-all">
                                    <div class="flex items-center justify-between mb-3">
                                        <p class="text-sm font-bold text-slate-800">{{ $user_bank->bank->name ?? '-' }}
                                        </p>
                                        @if ($user_bank->is_primary)
                                            <span
                                                class="text-[9px] font-bold uppercase tracking-widest bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-md">
                                                Utama
                                            </span>
                                        @endif
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border border-slate-100">
                                        <p class="text-sm text-slate-600 font-mono tracking-wider font-semibold">
                                            {{ $user_bank->account_number ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <div class="w-14 h-14 bg-slate-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <p class="text-slate-400 text-sm font-medium">Belum ada rekening bank</p>
                    </div>
                @endif
            </div>

            {{-- ==================== ACTION BAR ==================== --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="font-bold text-slate-800">Kelola Akun</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Edit, ubah role, atau hapus akun user</p>
                    </div>

                    <div class="flex items-center gap-2.5 flex-shrink-0 flex-wrap">
                        {{-- EDIT --}}
                        <a href="{{ route('admin.users.edit', $user) }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-blue-500 to-indigo-500 text-white hover:from-blue-600 hover:to-indigo-600 shadow-lg shadow-blue-500/20 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>

                        {{-- CHANGE ROLE --}}
                        <button type="button" @click="roleModal = true"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold border border-indigo-200 text-indigo-600 hover:bg-indigo-50 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                            Ubah Role
                        </button>

                        {{-- DELETE --}}
                        <button type="button" @click="deleteModal = true"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium border border-red-200 text-red-600 hover:bg-red-50 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>

        </div>

        {{-- ==================== MODAL: UBAH ROLE ==================== --}}
        <template x-teleport="body">
            <div x-show="roleModal" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                @click.self="roleModal = false">

                <div x-show="roleModal" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">

                    {{-- HEADER --}}
                    <div class="relative px-6 pt-8 pb-4 text-center bg-gradient-to-br from-indigo-50 to-violet-50">
                        <button type="button" @click="roleModal = false"
                            class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-white/80 flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-indigo-100 to-violet-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Ubah Role User</h3>
                    </div>

                    {{-- BODY --}}
                    <div class="px-6 py-5">
                        {{-- USER PREVIEW --}}
                        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl mb-5">
                            <div
                                class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-600' : ($user->role === 'pengelola' ? 'bg-violet-100 text-violet-600' : 'bg-blue-100 text-blue-600') }}">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-800 text-sm">{{ $user->name }}</p>
                                <p class="text-xs text-slate-400">{{ $user->email }}</p>
                            </div>
                            <span
                                class="ml-auto text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md bg-slate-100 text-slate-500">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>

                        <form method="POST" action="{{ route('admin.users.updateRole', $user->id) }}">
                            @csrf @method('PUT')

                            <label class="block text-sm font-semibold text-slate-700 mb-2">Role Baru</label>
                            <select name="role" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all cursor-pointer mb-5">
                                <option value="donatur" {{ $user->role === 'donatur' ? 'selected' : '' }}>Donatur</option>
                                <option value="pengelola" {{ $user->role === 'pengelola' ? 'selected' : '' }}>Pengelola
                                </option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>

                            <div class="flex gap-3">
                                <button type="button" @click="roleModal = false"
                                    class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-indigo-500 to-violet-500 text-white hover:from-indigo-600 hover:to-violet-600 shadow-lg shadow-indigo-500/20 transition-all">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>

        {{-- ==================== MODAL: HAPUS ==================== --}}
        <template x-teleport="body">
            <div x-show="deleteModal" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                @click.self="deleteModal = false">

                <div x-show="deleteModal" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">

                    {{-- HEADER --}}
                    <div class="relative px-6 pt-8 pb-4 text-center bg-gradient-to-br from-red-50 to-rose-50">
                        <button type="button" @click="deleteModal = false"
                            class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-white/80 flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-red-100 to-rose-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Hapus User?</h3>
                    </div>

                    {{-- BODY --}}
                    <div class="px-6 py-5">
                        {{-- USER PREVIEW --}}
                        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl mb-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center text-sm font-bold text-red-600">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-800 text-sm">{{ $user->name }}</p>
                                <p class="text-xs text-slate-400">{{ $user->email }}</p>
                            </div>
                        </div>

                        <p class="text-sm text-slate-500 text-center mb-4">
                            Tindakan ini akan menghapus akun beserta semua data terkait secara permanen.
                        </p>

                        {{-- WARNING --}}
                        <div class="flex items-start gap-2.5 p-3 bg-red-50 border border-red-100 rounded-xl mb-5">
                            <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="text-xs text-red-600 font-medium">Tindakan ini tidak dapat dibatalkan.</p>
                        </div>

                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                            @csrf @method('DELETE')
                            <div class="flex gap-3">
                                <button type="button" @click="deleteModal = false"
                                    class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/20 transition-all flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Ya, Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>

    </div>
@endsection
