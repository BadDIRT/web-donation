@extends('layouts.app')

@section('title', 'Detail Pengelola - ' . $user->name)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-violet-50/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('admin.pengelola') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar Pengelola
            </a>

            {{-- PROFILE HEADER CARD --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">
                <div class="relative">
                    {{-- TOP GRADIENT BAR --}}
                    <div class="h-28 bg-gradient-to-r from-violet-500 via-purple-500 to-fuchsia-500"></div>

                    <div class="px-6 sm:px-8 pb-6">
                        <div class="flex flex-col sm:flex-row sm:items-end gap-4 -mt-10">
                            {{-- AVATAR --}}
                            @if ($user->profile_photo_path)
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                    class="w-20 h-20 rounded-2xl object-cover flex-shrink-0 shadow-lg border-4 border-white">
                            @else
                                <div class="w-20 h-20 rounded-2xl bg-white border-4 border-white shadow-lg flex items-center justify-center text-2xl font-bold text-violet-600 flex-shrink-0"
                                    style="background: linear-gradient(135deg, #ede9fe, #ddd6fe);">
                                    {{ $user->initial }}
                                </div>
                            @endif

                            <div class="flex-1 min-w-0 sm:pb-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h1 class="text-xl sm:text-2xl font-bold text-slate-800 truncate">
                                        {{ $user->name }}
                                    </h1>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full
                                        {{ $user->is_approved ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                                        {{ $user->is_approved ? 'Approved' : 'Pending' }}
                                    </span>
                                </div>
                                <p class="text-slate-500 text-sm mt-0.5">{{ $user->email }}</p>
                            </div>

                            {{-- QUICK INFO --}}
                            <div class="flex items-center gap-3 text-xs text-slate-400 sm:pb-1">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $user->created_at->translatedFormat('d M Y') }}
                                </span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span>ID: {{ $user->id }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DATA GRID --}}
            <div class="grid gap-6 mb-6 sm:grid-cols-2">

                {{-- NOMOR TELEPON --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Nomor Telepon</p>
                            <p class="text-sm font-semibold text-slate-800">
                                {{ $user->phone ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- REKENING BANK --}}
                @if ($user->userBanks->isNotEmpty())
                    <div class="mt-6">
                        <div class="flex items-center gap-2.5 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-sm text-slate-800">Rekening Bank</h3>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            @forelse ($user->userBanks as $user_bank)
                                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">
                                                {{ $user_bank->bank->name ?? '-' }}
                                                @if ($user_bank->is_primary)
                                                    <span
                                                        class="ml-2 text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-full">Utama</span>
                                                @endif
                                            </p>
                                            <p class="text-sm font-semibold text-slate-800 font-mono tracking-wide">
                                                {{ $user_bank->account_number ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="col-span-full text-center py-8 bg-white rounded-2xl border border-dashed border-slate-200">
                                    <p class="text-slate-400 text-sm">User ini belum memiliki rekening bank</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @else
                    <div class="mt-6 text-center py-8 bg-white rounded-2xl border border-dashed border-slate-200">
                        <p class="text-slate-400 text-sm">User ini belum memiliki rekening bank</p>
                    </div>
                @endif

                {{-- ROLE --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Role</p>
                            <span
                                class="inline-block px-3 py-1 rounded-lg text-xs font-semibold bg-violet-100 text-violet-600">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- STATUS --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                            {{ $user->is_approved ? 'bg-emerald-50' : 'bg-amber-50' }}">
                            @if ($user->is_approved)
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Status Pengajuan
                            </p>
                            @if ($user->is_approved)
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-100 text-emerald-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Disetujui
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-amber-100 text-amber-600">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                    Menunggu Review
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- KTP SECTION --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="font-bold text-slate-800">Dokumen KTP</h2>
                    </div>

                    @if ($user->ktp_path)
                        <a href="{{ route('admin.pengelola.ktp', $user->id) }}" target="_blank"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Buka di Tab Baru
                        </a>
                    @endif
                </div>

                <div class="p-6">
                    @if ($user->ktp_path)
                        {{-- KTP PREVIEW --}}
                        <div class="relative group">
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                <img src="{{ route('admin.pengelola.ktp', $user->id) }}" alt="KTP {{ $user->name }}"
                                    class="w-full max-h-80 object-contain rounded-lg" loading="lazy">
                            </div>
                            <div
                                class="absolute inset-0 bg-black/0 group-hover:bg-black/5 rounded-xl transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <a href="{{ route('admin.pengelola.ktp', $user->id) }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-lg text-sm font-semibold text-slate-700 hover:text-emerald-600 transition-colors">
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
                        <div class="flex items-start gap-2.5 mt-4 px-4 py-3 bg-blue-50 border border-blue-200 rounded-xl">
                            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-xs text-blue-600 leading-relaxed">
                                Pastikan nama di KTP sesuai dengan nama akun. Periksa juga kejelasan foto dan informasi
                                lainnya sebelum menyetujui.
                            </p>
                        </div>
                    @else
                        {{-- NO KTP --}}
                        <div class="text-center py-10">
                            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-600">Belum Upload KTP</p>
                            <p class="text-xs text-slate-400 mt-1">Pengguna ini belum melampirkan foto KTP</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ACTION BAR --}}
            @if (!$user->is_approved)
                <div x-data="{ openReject: false, openApprove: false }"
                    class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 sm:p-6">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="font-bold text-slate-800">Keputusan Pengajuan</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Review data di atas, lalu pilih aksi yang sesuai</p>
                        </div>

                        <div class="flex items-center gap-3 flex-shrink-0">
                            {{-- REJECT BUTTON --}}
                            <button type="button" @click="openReject = true"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium border border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Tolak
                            </button>

                            {{-- APPROVE BUTTON --}}
                            <button type="button" @click="openApprove = true"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Setujui
                            </button>
                        </div>
                    </div>

                    {{-- MODAL APPROVE --}}
                    <div x-show="openApprove" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">

                        <div @click.outside="openApprove = false" x-show="openApprove" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden">

                            <div class="px-6 pt-8 pb-2 text-center">
                                <div
                                    class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800">Setujui Pengajuan?</h3>
                            </div>

                            <div class="px-6 py-4">
                                <div class="bg-slate-50 rounded-xl p-4 text-center">
                                    <p class="text-sm text-slate-600">Anda akan menyetujui</p>
                                    <p class="font-bold text-slate-800 mt-1">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ $user->email }}</p>
                                </div>
                                <p class="text-xs text-slate-500 text-center mt-3">
                                    Pengguna langsung bisa membuat dan mengelola campaign setelah disetujui.
                                </p>
                            </div>

                            <div class="px-6 pb-6 flex gap-3">
                                <button type="button" @click="openApprove = false"
                                    class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                    Batal
                                </button>
                                <form method="POST" action="{{ route('admin.approve.pengelola', $user->id) }}"
                                    class="flex-1">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 transition-all">
                                        Ya, Setujui
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- MODAL REJECT --}}
                    <div x-show="openReject" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">

                        <div @click.outside="openReject = false" x-show="openReject" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden">

                            <div class="px-6 pt-8 pb-2 text-center">
                                <div
                                    class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800">Tolak Pengajuan</h3>
                            </div>

                            <div class="px-6 py-4">
                                <div class="bg-slate-50 rounded-xl p-4 text-center mb-4">
                                    <p class="text-sm text-slate-600">Menolak pengajuan dari</p>
                                    <p class="font-bold text-slate-800 mt-1">{{ $user->name }}</p>
                                </div>

                                <form method="POST" action="{{ route('admin.reject.pengelola', $user->id) }}"
                                    class="space-y-3">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                            Alasan Penolakan <span class="text-red-400">*</span>
                                        </label>
                                        <textarea name="reason" rows="3" required placeholder="Contoh: Data KTP tidak jelas, rekening tidak valid..."
                                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all resize-none"></textarea>
                                    </div>

                                    <div class="flex gap-3 pt-1">
                                        <button type="button" @click="openReject = false"
                                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/20 transition-all">
                                            Tolak
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- ALREADY APPROVED INFO --}}
                <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-5 flex items-center gap-4">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-emerald-800">Pengajuan Sudah Disetujui</p>
                        <p class="text-xs text-emerald-600 mt-0.5">
                            Pengguna ini sudah aktif sebagai pengelola campaign.
                        </p>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
