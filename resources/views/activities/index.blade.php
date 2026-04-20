@extends('layouts.app')

@section('title', 'Riwayat Aktivitas')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50/20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
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
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Riwayat Aktivitas</h1>
                            <p class="text-slate-500 text-sm mt-0.5">Log aktivitas seluruh user di platform</p>
                        </div>
                    </div>

                    <div class="text-sm text-slate-500">
                        <span class="font-semibold text-slate-700">{{ $notifications->total() }}</span> aktivitas
                    </div>
                </div>
            </div>

            {{-- FILTER BAR --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-4 sm:p-5 mb-6">
                <form method="GET" class="flex flex-col lg:flex-row gap-3">

                    {{-- SEARCH --}}
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Cari judul atau pesan aktivitas..."
                            class="w-full pl-12 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all">
                        @if (request('q'))
                            <a href="{{ request()->fullUrlWithQuery(['q' => '']) }}"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>

                    {{-- TYPE FILTER --}}
                    <div class="flex flex-wrap gap-3">
                        <div class="relative">
                            <select name="type"
                                class="appearance-none pl-4 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all cursor-pointer min-w-[180px]">
                                <option value="">Semua Tipe</option>

                                <optgroup label="💰 Donasi">
                                    <option value="donation_success"
                                        {{ request('type') == 'donation_success' ? 'selected' : '' }}>Donasi Berhasil
                                    </option>
                                </optgroup>

                                <optgroup label="👤 Pengelola">
                                    <option value="pengelola_request"
                                        {{ request('type') == 'pengelola_request' ? 'selected' : '' }}>Pengajuan Pengelola
                                    </option>
                                    <option value="pengelola_submitted"
                                        {{ request('type') == 'pengelola_submitted' ? 'selected' : '' }}>Pengajuan Dikirim
                                    </option>
                                    <option value="pengelola_approve"
                                        {{ request('type') == 'pengelola_approve' ? 'selected' : '' }}>Pengelola Disetujui
                                    </option>
                                    <option value="pengelola_reject"
                                        {{ request('type') == 'pengelola_reject' ? 'selected' : '' }}>Pengelola Ditolak
                                    </option>
                                </optgroup>

                                <optgroup label="📋 Campaign">
                                    <option value="campaign_request"
                                        {{ request('type') == 'campaign_request' ? 'selected' : '' }}>Pengajuan Campaign
                                    </option>
                                    <option value="campaign_submitted"
                                        {{ request('type') == 'campaign_submitted' ? 'selected' : '' }}>Campaign Dikirim
                                    </option>
                                    <option value="campaign_approve"
                                        {{ request('type') == 'campaign_approve' ? 'selected' : '' }}>Campaign Disetujui
                                    </option>
                                    <option value="campaign_reject"
                                        {{ request('type') == 'campaign_reject' ? 'selected' : '' }}>Campaign Ditolak
                                    </option>
                                    <option value="campaign_status_changed"
                                        {{ request('type') == 'campaign_status_changed' ? 'selected' : '' }}>Status Diubah
                                    </option>
                                    <option value="campaign_update"
                                        {{ request('type') == 'campaign_update' ? 'selected' : '' }}>Kabar terbaru campaign
                                    </option>
                                    <option value="campaign_update_deleted"
                                        {{ request('type') == 'campaign_update_deleted' ? 'selected' : '' }}>Kabar terbaru
                                        campaign dihapus
                                    </option>
                                    <option value="campaign_updated"
                                        {{ request('type') == 'campaign_updated' ? 'selected' : '' }}>Campaign Diperbarui
                                    </option>
                                </optgroup>

                                <optgroup label="💸 Withdraw">
                                    <option value="withdraw_request"
                                        {{ request('type') == 'withdraw_request' ? 'selected' : '' }}>Pengajuan Withdraw
                                    </option>
                                    <option value="withdraw_submitted"
                                        {{ request('type') == 'withdraw_submitted' ? 'selected' : '' }}>Withdraw Dikirim
                                    </option>
                                    <option value="withdraw_approved"
                                        {{ request('type') == 'withdraw_approved' ? 'selected' : '' }}>Withdraw Disetujui
                                    </option>
                                    <option value="withdraw_rejected"
                                        {{ request('type') == 'withdraw_rejected' ? 'selected' : '' }}>Withdraw Ditolak
                                    </option>
                                </optgroup>

                                <optgroup label="⚙️ Lainnya">
                                    <option value="bank_created" {{ request('type') == 'bank_created' ? 'selected' : '' }}>
                                        Bank Ditambahkan</option>
                                    <option value="role_changed" {{ request('type') == 'role_changed' ? 'selected' : '' }}>
                                        Role Diubah</option>
                                    <option value="user_updated" {{ request('type') == 'user_updated' ? 'selected' : '' }}>
                                        User Diperbarui</option>
                                    <option value="user_deleted" {{ request('type') == 'user_deleted' ? 'selected' : '' }}>
                                        User Dihapus</option>
                                    <option value="comment_update"
                                        {{ request('type') == 'comment_update' ? 'selected' : '' }}>
                                        Komen baru</option>
                                    <option value="profile_updated"
                                        {{ request('type') == 'profile_updated' ? 'selected' : '' }}>Profile Diperbarui
                                    </option>
                                    <option value="profile_photo_updated"
                                        {{ request('type') == 'profile_photo_updated' ? 'selected' : '' }}>Foto Profile
                                        Diperbarui</option>
                                    <option value="profile_photo_removed"
                                        {{ request('type') == 'profile_photo_removed' ? 'selected' : '' }}>Foto Profile
                                        Dihapus</option>
                                    <option value="password_changed"
                                        {{ request('type') == 'password_changed' ? 'selected' : '' }}>Password Diubah
                                    </option>
                                    <option value="user_self_deleted"
                                        {{ request('type') == 'user_self_deleted' ? 'selected' : '' }}>Akun Dihapus Sendiri
                                    </option>
                                </optgroup>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        {{-- APPLY --}}
                        <button type="submit"
                            class="px-5 py-3 rounded-xl text-sm font-semibold bg-gradient-to-r from-indigo-500 to-violet-500 text-white hover:from-indigo-600 hover:to-violet-600 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/30 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span class="hidden sm:inline">Filter</span>
                        </button>

                        {{-- RESET --}}
                        @if (request('q') || request('type'))
                            <a href="{{ route('admin.activities') }}"
                                class="px-4 py-3 rounded-xl text-sm font-medium border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 hover:border-slate-300 transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span class="hidden sm:inline">Reset</span>
                            </a>
                        @endif
                    </div>
                </form>

                {{-- ACTIVE FILTER TAG --}}
                @if (request('type'))
                    <div class="flex items-center gap-2 mt-3 pt-3 border-t border-slate-100">
                        <span class="text-xs text-slate-400">Filter aktif:</span>
                        <span
                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-600 text-xs font-medium">
                            {{ str_replace('_', ' ', request('type')) }}
                            <a href="{{ request()->fullUrlWithQuery(['type' => '']) }}" class="hover:text-indigo-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </span>
                    </div>
                @endif
            </div>

            {{-- SEARCH INFO --}}
            @if (request('q'))
                <div class="flex items-center gap-2 mb-4 text-sm text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Menampilkan hasil untuk <span
                            class="font-semibold text-slate-700">"{{ request('q') }}"</span></span>
                </div>
            @endif

            {{-- LIST --}}
            <div class="space-y-3">

                @php
                    $typeColors = [
                        'profile_updated' => ['bg-slate-100', 'text-slate-600'],
                        'profile_photo_updated' => ['bg-violet-100', 'text-violet-600'],
                        'profile_photo_removed' => ['bg-violet-100', 'text-violet-600'],
                        'password_changed' => ['bg-amber-100', 'text-amber-600'],
                        'user_self_deleted' => ['bg-red-100', 'text-red-600'],
                        'donation_success' => ['bg-emerald-100', 'text-emerald-600'],
                        'pengelola_request' => ['bg-amber-100', 'text-amber-600'],
                        'pengelola_submitted' => ['bg-amber-100', 'text-amber-600'],
                        'pengelola_approve' => ['bg-emerald-100', 'text-emerald-600'],
                        'pengelola_reject' => ['bg-red-100', 'text-red-600'],
                        'campaign_request' => ['bg-amber-100', 'text-amber-600'],
                        'campaign_submitted' => ['bg-amber-100', 'text-amber-600'],
                        'campaign_approve' => ['bg-emerald-100', 'text-emerald-600'],
                        'campaign_reject' => ['bg-red-100', 'text-red-600'],
                        'campaign_status_changed' => ['bg-blue-100', 'text-blue-600'],
                        'withdraw_request' => ['bg-amber-100', 'text-amber-600'],
                        'withdraw_submitted' => ['bg-amber-100', 'text-amber-600'],
                        'withdraw_approved' => ['bg-emerald-100', 'text-emerald-600'],
                        'withdraw_rejected' => ['bg-red-100', 'text-red-600'],
                        'bank_created' => ['bg-violet-100', 'text-violet-600'],
                        'role_changed' => ['bg-indigo-100', 'text-indigo-600'],
                        'user_updated' => ['bg-slate-100', 'text-slate-600'],
                        'user_deleted' => ['bg-red-100', 'text-red-600'],
                    ];

                    $typeIcons = [
                        'profile_updated' =>
                            'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                        'profile_photo_updated' =>
                            'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'profile_photo_removed' =>
                            'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'password_changed' =>
                            'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z',
                        'user_self_deleted' =>
                            'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
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
                @endphp

                @forelse($notifications as $notif)
                    @php
                        $colors = $typeColors[$notif->type] ?? ['bg-slate-100', 'text-slate-600'];
                        $iconPath =
                            $typeIcons[$notif->type] ?? 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
                    @endphp

                    <a href="{{ route('admin.activities.show', $notif->id) }}"
                        class="block bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden hover:shadow-md hover:border-indigo-100 transition-all duration-200">

                        <div class="p-4 sm:p-5">
                            <div class="flex flex-col sm:flex-row gap-4">

                                {{-- ICON --}}
                                <div class="flex-shrink-0 self-start">
                                    <div
                                        class="w-10 h-10 rounded-xl {{ $colors[0] }} flex items-center justify-center">
                                        <svg class="w-5 h-5 {{ $colors[1] }}" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="{{ $iconPath }}" />
                                        </svg>
                                    </div>
                                </div>

                                {{-- CONTENT --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-1">
                                        <h3 class="text-sm font-bold text-slate-800 truncate">
                                            {{ $notif->title }}
                                        </h3>
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full {{ $colors[0] }} {{ $colors[1] }} whitespace-nowrap">
                                            {{ str_replace('_', ' ', $notif->type) }}
                                        </span>
                                    </div>

                                    @if ($notif->message)
                                        <p class="text-sm text-slate-500 line-clamp-2 mt-1">
                                            {{ $notif->message }}
                                        </p>
                                    @endif

                                    {{-- META --}}
                                    <div
                                        class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-3 pt-3 border-t border-slate-100">
                                        {{-- ACTOR --}}
                                        <div class="flex items-center gap-1.5">
                                            @if ($notif->actor && $notif->actor->profile_photo_path)
                                                <img src="{{ Storage::disk('public')->url($notif->actor->profile_photo_path) }}"
                                                    alt="{{ $notif->actor->name }}"
                                                    class="w-5 h-5 rounded-full object-cover flex-shrink-0">
                                            @else
                                                <div
                                                    class="w-5 h-5 rounded-full bg-slate-200 flex items-center justify-center text-[9px] font-bold text-slate-500 flex-shrink-0">
                                                    {{ strtoupper(substr($notif->actor->name ?? 'S', 0, 1)) }}
                                                </div>
                                            @endif
                                            <span
                                                class="text-xs text-slate-600 font-medium">{{ $notif->actor->name ?? 'System' }}</span>
                                        </div>

                                        <div class="w-px h-4 bg-slate-200 hidden sm:block"></div>

                                        {{-- TARGET USER --}}
                                        @if ($notif->user && $notif->user->id !== ($notif->actor->id ?? null))
                                            <div class="flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none"
                                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                </svg>
                                                <span
                                                    class="text-xs text-slate-500">{{ $notif->user->name ?? '-' }}</span>
                                            </div>
                                        @endif

                                        <div class="w-px h-4 bg-slate-200 hidden sm:block"></div>

                                        {{-- TIME --}}
                                        <span class="flex items-center gap-1.5 text-xs text-slate-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $notif->created_at->diffForHumans() }}
                                        </span>

                                        <div class="w-px h-4 bg-slate-200 hidden sm:block"></div>

                                        {{-- ID --}}
                                        <span class="text-[10px] text-slate-400 font-mono">#{{ $notif->id }}</span>
                                    </div>
                                </div>

                                {{-- ARROW --}}
                                <div class="hidden sm:flex items-center flex-shrink-0 self-center">
                                    <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-500 transition-colors"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    {{-- EMPTY STATE --}}
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                        <div class="px-6 py-20 text-center">
                            <div class="w-20 h-20 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            @if (request('q') || request('type'))
                                <h3 class="font-bold text-slate-700 text-lg">Tidak Ditemukan</h3>
                                <p class="text-slate-500 text-sm mt-2 max-w-sm mx-auto">
                                    Tidak ada aktivitas dengan filter yang dipilih.
                                </p>
                                <a href="{{ route('admin.activities') }}"
                                    class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset Filter
                                </a>
                            @else
                                <h3 class="font-bold text-slate-700 text-lg">Belum Ada Aktivitas</h3>
                                <p class="text-slate-500 text-sm mt-2 max-w-sm mx-auto">
                                    Aktivitas sistem akan muncul di sini saat ada aksi dari user.
                                </p>
                            @endif
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- PAGINATION --}}
            @if ($notifications->hasPages())
                <div class="mt-8 flex items-center justify-between">
                    <p class="text-sm text-slate-500">
                        Menampilkan
                        <span class="font-semibold text-slate-700">{{ $notifications->firstItem() }}</span> -
                        <span class="font-semibold text-slate-700">{{ $notifications->lastItem() }}</span> dari
                        <span class="font-semibold text-slate-700">{{ $notifications->total() }}</span>
                    </p>

                    <div class="flex items-center gap-1">
                        {{-- PREV --}}
                        @if ($notifications->onFirstPage())
                            <span
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-300 border border-slate-100 bg-slate-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $notifications->previousPageUrl() }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        @endif

                        {{-- NUMBERS --}}
                        @php
                            $start = max(1, $notifications->currentPage() - 1);
                            $end = min($notifications->lastPage(), $notifications->currentPage() + 1);
                        @endphp

                        @if ($start > 1)
                            <a href="{{ $notifications->url(1) }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">1</a>
                            @if ($start > 2)
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-400">...</span>
                            @endif
                        @endif

                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $notifications->currentPage())
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold text-white bg-gradient-to-r from-indigo-500 to-violet-500 shadow-lg shadow-indigo-500/20">{{ $i }}</span>
                            @else
                                <a href="{{ $notifications->url($i) }}"
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">{{ $i }}</a>
                            @endif
                        @endfor

                        @if ($end < $notifications->lastPage())
                            @if ($end < $notifications->lastPage() - 1)
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-400">...</span>
                            @endif
                            <a href="{{ $notifications->url($notifications->lastPage()) }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">{{ $notifications->lastPage() }}</a>
                        @endif

                        {{-- NEXT --}}
                        @if ($notifications->hasMorePages())
                            <a href="{{ $notifications->nextPageUrl() }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <span
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-300 border border-slate-100 bg-slate-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
