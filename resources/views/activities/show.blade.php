@extends('layouts.app')

@section('title', 'Detail Aktivitas #' . $notification->id)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('admin.activities') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Riwayat Aktivitas
            </a>

            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">Detail Aktivitas</h1>
                        <p class="text-slate-500 text-sm mt-0.5">Informasi lengkap log sistem</p>
                    </div>
                </div>

                {{-- BADGE ID --}}
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-500 bg-slate-100 self-start">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M6 15h14" />
                    </svg>
                    #{{ $notification->id }}
                </span>
            </div>

            {{-- MAIN INFO CARD --}}
            @php
                $typeColors = [
                    'profile_updated' => [
                        'bg' => 'bg-slate-100',
                        'text' => 'text-slate-600',
                        'ring' => 'ring-slate-500/20',
                    ],
                    'profile_photo_updated' => [
                        'bg' => 'bg-violet-100',
                        'text' => 'text-violet-600',
                        'ring' => 'ring-violet-500/20',
                    ],
                    'profile_photo_removed' => [
                        'bg' => 'bg-violet-100',
                        'text' => 'text-violet-600',
                        'ring' => 'ring-violet-500/20',
                    ],
                    'password_changed' => [
                        'bg' => 'bg-amber-100',
                        'text' => 'text-amber-600',
                        'ring' => 'ring-amber-500/20',
                    ],
                    'user_self_deleted' => [
                        'bg' => 'bg-red-100',
                        'text' => 'text-red-600',
                        'ring' => 'ring-red-500/20',
                    ],
                    'donation_success' => [
                        'bg' => 'bg-emerald-100',
                        'text' => 'text-emerald-600',
                        'ring' => 'ring-emerald-500/20',
                    ],
                    'pengelola_request' => [
                        'bg' => 'bg-amber-100',
                        'text' => 'text-amber-600',
                        'ring' => 'ring-amber-500/20',
                    ],
                    'pengelola_submitted' => [
                        'bg' => 'bg-amber-100',
                        'text' => 'text-amber-600',
                        'ring' => 'ring-amber-500/20',
                    ],
                    'pengelola_approve' => [
                        'bg' => 'bg-emerald-100',
                        'text' => 'text-emerald-600',
                        'ring' => 'ring-emerald-500/20',
                    ],
                    'pengelola_reject' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'ring' => 'ring-red-500/20'],
                    'campaign_request' => [
                        'bg' => 'bg-amber-100',
                        'text' => 'text-amber-600',
                        'ring' => 'ring-amber-500/20',
                    ],
                    'campaign_submitted' => [
                        'bg' => 'bg-amber-100',
                        'text' => 'text-amber-600',
                        'ring' => 'ring-amber-500/20',
                    ],
                    'campaign_approve' => [
                        'bg' => 'bg-emerald-100',
                        'text' => 'text-emerald-600',
                        'ring' => 'ring-emerald-500/20',
                    ],
                    'campaign_reject' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'ring' => 'ring-red-500/20'],
                    'campaign_status_changed' => [
                        'bg' => 'bg-blue-100',
                        'text' => 'text-blue-600',
                        'ring' => 'ring-blue-500/20',
                    ],
                    'withdraw_request' => [
                        'bg' => 'bg-amber-100',
                        'text' => 'text-amber-600',
                        'ring' => 'ring-amber-500/20',
                    ],
                    'withdraw_submitted' => [
                        'bg' => 'bg-amber-100',
                        'text' => 'text-amber-600',
                        'ring' => 'ring-amber-500/20',
                    ],
                    'withdraw_approved' => [
                        'bg' => 'bg-emerald-100',
                        'text' => 'text-emerald-600',
                        'ring' => 'ring-emerald-500/20',
                    ],
                    'withdraw_rejected' => [
                        'bg' => 'bg-red-100',
                        'text' => 'text-red-600',
                        'ring' => 'ring-red-500/20',
                    ],
                    'bank_created' => [
                        'bg' => 'bg-violet-100',
                        'text' => 'text-violet-600',
                        'ring' => 'ring-violet-500/20',
                    ],
                    'role_changed' => [
                        'bg' => 'bg-indigo-100',
                        'text' => 'text-indigo-600',
                        'ring' => 'ring-indigo-500/20',
                    ],
                    'user_updated' => [
                        'bg' => 'bg-slate-100',
                        'text' => 'text-slate-600',
                        'ring' => 'ring-slate-500/20',
                    ],
                    'user_deleted' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'ring' => 'ring-red-500/20'],
                ];

                $typeIcons = [
                    'profile_updated' => 'Profile Diperbarui',
                    'profile_photo_updated' => 'Foto Profile Diperbarui',
                    'profile_photo_removed' => 'Foto Profile Dihapus',
                    'password_changed' => 'Password Diubah',
                    'user_self_deleted' => 'Akun Dihapus Sendiri',
                    'donation_success' =>
                        'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    'pengelola_request' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                    'pengelola_submitted' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                    'pengelola_approve' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'pengelola_reject' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'campaign_request' =>
                        'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'campaign_submitted' =>
                        'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'campaign_approve' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'campaign_reject' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'campaign_status_changed' =>
                        'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
                    'withdraw_request' =>
                        'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z',
                    'withdraw_submitted' =>
                        'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z',
                    'withdraw_approved' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'withdraw_rejected' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'bank_created' =>
                        'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z',
                    'role_changed' =>
                        'M7 21a4 4 0 01-4-4V5a4 4 0 014-4h4a4 4 0 014 4v12a4 4 0 01-4 4H7zm0 0v-4m4 4v-4m0 0h-4m4 0h4',
                    'user_updated' =>
                        'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                    'user_deleted' =>
                        'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
                ];

                $colors = $typeColors[$notification->type] ?? [
                    'bg' => 'bg-slate-100',
                    'text' => 'text-slate-600',
                    'ring' => 'ring-slate-500/20',
                ];
                $iconPath =
                    $typeIcons[$notification->type] ?? 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';

                $typeLabels = [
                    'donation_success' => 'Donasi Berhasil',
                    'pengelola_request' => 'Pengajuan Pengelola',
                    'pengelola_submitted' => 'Pengajuan Dikirim',
                    'pengelola_approve' => 'Pengelola Disetujui',
                    'pengelola_reject' => 'Pengelola Ditolak',
                    'campaign_request' => 'Pengajuan Campaign',
                    'campaign_submitted' => 'Campaign Dikirim',
                    'campaign_approve' => 'Campaign Disetujui',
                    'campaign_reject' => 'Campaign Ditolak',
                    'campaign_status_changed' => 'Status Campaign Diubah',
                    'withdraw_request' => 'Pengajuan Withdraw',
                    'withdraw_submitted' => 'Withdraw Dikirim',
                    'withdraw_approved' => 'Withdraw Disetujui',
                    'withdraw_rejected' => 'Withdraw Ditolak',
                    'bank_created' => 'Bank Ditambahkan',
                    'role_changed' => 'Role Diubah',
                    'user_updated' => 'User Diperbarui',
                    'user_deleted' => 'User Dihapus',
                ];
            @endphp

            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">

                {{-- HERO SECTION --}}
                <div class="p-6 sm:p-8 bg-gradient-to-br from-slate-50 to-white border-b border-slate-100">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                        {{-- ICON --}}
                        <div
                            class="w-16 h-16 {{ $colors['bg'] }} rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm {{ $colors['ring'] }} ring-1">
                            <svg class="w-8 h-8 {{ $colors['text'] }}" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPath }}" />
                            </svg>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <h2 class="text-lg sm:text-xl font-bold text-slate-800">
                                    {{ $notification->title }}
                                </h2>
                            </div>
                            <span
                                class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full {{ $colors['bg'] }} {{ $colors['text'] }} w-fit">
                                @if (in_array($notification->type, ['withdraw_approved', 'campaign_approve', 'pengelola_approve', 'donation_success']))
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                @elseif(in_array($notification->type, ['withdraw_rejected', 'campaign_reject', 'pengelola_reject', 'user_deleted']))
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @else
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                                {{ $typeLabels[$notification->type] ?? str_replace('_', ' ', $notification->type) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- MESSAGE --}}
                @if ($notification->message)
                    <div class="px-6 sm:px-8 pb-6">
                        <div class="bg-slate-50 rounded-xl p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Detail Pesan</p>
                            </div>
                            <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap">
                                {{ $notification->message }}</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- META CARDS --}}
            <div class="grid gap-4 sm:grid-cols-2 mb-6">

                {{-- DILAKUKAN OLEH --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        @if ($notification->actor && $notification->actor->profile_photo_path)
                            <img src="{{ Storage::disk('public')->url($notification->actor->profile_photo_path) }}"
                                alt="{{ $notification->actor->name }}"
                                class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Dilakukan Oleh</p>
                            <p class="text-sm font-bold text-slate-800">{{ $notification->actor->name ?? 'System' }}</p>
                            @if ($notification->actor && $notification->actor->email)
                                <p class="text-xs text-slate-400 truncate">{{ $notification->actor->email }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- UNTUK PENGGUNA --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        @if ($notification->user && $notification->user->profile_photo_path)
                            <img src="{{ Storage::disk('public')->url($notification->user->profile_photo_path) }}"
                                alt="{{ $notification->user->name }}"
                                class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        @endif
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Target Pengguna
                            </p>
                            @if ($notification->user)
                                <p class="text-sm font-bold text-slate-800">{{ $notification->user->name }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ $notification->user->email }}</p>
                            @else
                                <p class="text-sm text-slate-400 italic">Tidak ada target</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- WAKTU KEJADIAN --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Waktu Kejadian
                            </p>
                            <p class="text-sm font-bold text-slate-800">
                                {{ $notification->created_at->translatedFormat('d F Y') }}</p>
                            <p class="text-sm text-slate-500 mt-0.5">{{ $notification->created_at->format('H:i') }} WIB
                            </p>
                            <p class="text-xs text-slate-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                {{-- STATUS BACA --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                            {{ $notification->is_read ? 'bg-emerald-50' : 'bg-amber-50' }}">
                            @if ($notification->is_read)
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a2.032 2.032 0 00-2.032-2.032H5.032A2.032 2.032 0 003 11v3.159c0 .538-.214 1.055-.595 1.436L4 17m5-4v-4h4" />
                                </svg>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Status Baca</p>
                            <span
                                class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg
                                {{ $notification->is_read ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                                @if ($notification->is_read)
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Sudah Dibaca
                                @else
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                    Belum Dibaca
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- RAW DATA --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                <div class="px-5 py-3 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 20l4-16m4 4l4-4m-4 4l-4-4m4 4l4-4" />
                        </svg>
                        <h3 class="font-bold text-sm text-slate-700">Data Mentah</h3>
                    </div>
                    <button type="button" onclick="document.getElementById('rawData').classList.toggle('hidden')"
                        class="text-xs font-semibold text-slate-500 hover:text-slate-700 transition-colors flex items-center gap-1">
                        <span id="toggleText">Tampilkan</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

                <div id="rawData" class="hidden p-5">
                    <pre class="text-xs text-slate-600 bg-slate-50 rounded-xl p-4 overflow-x-auto leading-relaxed font-mono">{{ json_encode(
                        [
                            'id' => $notification->id,
                            'title' => $notification->title,
                            'type' => $notification->type,
                            'message' => $notification->message,
                            'is_read' => $notification->is_read ? true : false,
                            'actor_id' => $notification->actor_id,
                            'user_id' => $notification->user_id,
                            'created_at' => $notification->created_at->toIso8601String(),
                        ],
                        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE,
                    ) }}</pre>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle raw data
        const toggleBtn = document.querySelector('button[onclick]');
        const toggleText = document.getElementById('toggleText');
        const rawData = document.getElementById('rawData');

        if (toggleBtn && rawData) {
            toggleBtn.addEventListener('click', () => {
                toggleText.textContent = rawData.classList.contains('hidden') ? 'Sembunyikan' : 'Tampilkan';
            });
        }
    </script>
@endpush
