@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Dashboard Admin</h1>
                    </div>
                    <p class="text-slate-500 text-sm sm:text-base ml-[52px]">Ringkasan data utama dan kontrol platform
                        donasi.</p>
                </div>

                <div class="ml-[52px] sm:ml-0 text-sm text-slate-500">
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>

            {{-- STATS: PLATFORM OVERVIEW --}}
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5 mb-4">

                {{-- TOTAL USER --}}
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total User</p>
                            <p class="text-3xl font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">
                                {{ $totalUsers }}</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- TOTAL DONASI --}}
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Donasi</p>
                            <p
                                class="text-2xl sm:text-3xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                Rp {{ number_format($totalDonations, 0, ',', '.') }}</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- TOTAL DONATUR --}}
                @php
                    $totalDonaturCount = \App\Models\Donation::whereNotNull('user_id')
                        ->distinct('user_id')
                        ->count('user_id');
                @endphp
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Donatur</p>
                            <p class="text-3xl font-extrabold text-slate-800 group-hover:text-indigo-600 transition-colors">
                                {{ $totalDonaturCount }}</p>
                            <p class="text-[11px] text-slate-400 mt-1">donatur terdaftar</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-indigo-50 rounded-xl flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- PENGAJUAN PENGELOLA --}}
                @php
                    $pendingPengelola = \App\Models\User::where('role', 'pengelola')
                        ->where('is_approved', false)
                        ->count();
                @endphp
                <a href="{{ route('admin.pengelola') }}"
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-amber-200 transition-all duration-200 group block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Pengajuan
                                Pengelola</p>
                            <p class="text-3xl font-extrabold text-slate-800 group-hover:text-amber-600 transition-colors">
                                {{ $pendingPengelola }}</p>
                            <span class="inline-flex items-center gap-1 mt-1">
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                <span class="text-[10px] font-bold text-amber-600">Perlu Verifikasi</span>
                            </span>
                        </div>
                        <div
                            class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- TARIK DANA (MIDTRANS) --}}
                <a href="https://dashboard.midtrans.com/settings/withdrawal" target="_blank" rel="noopener noreferrer"
                    class="group bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl p-5 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 transition-all duration-200 block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-indigo-200 mb-2">Tarik Dana</p>
                            <h2 class="text-base font-bold text-white">Midtrans</h2>
                            <p class="text-[11px] text-indigo-200 mt-0.5">Dashboard penarikan</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center group-hover:bg-white/30 transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 mt-3">
                        <svg class="w-3 h-3 text-indigo-200" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span
                            class="text-[10px] font-semibold text-indigo-200 group-hover:text-white transition-colors">Buka
                            di tab baru</span>
                    </div>
                </a>
            </div>

            {{-- STATS: CAMPAIGN BREAKDOWN --}}
            @php
                $pendingCampaigns = \App\Models\Campaign::where('status', 'pending')->count();
                $approvedCampaigns = \App\Models\Campaign::where('status', 'approved')->count();
                $endedCampaigns = \App\Models\Campaign::where('status', 'ended')->count();
                $closedCampaigns = \App\Models\Campaign::where('status', 'closed')->count();
            @endphp
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5 mb-4">

                {{-- TOTAL CAMPAIGN --}}
                <a href="{{ route('admin.campaign.active') }}"
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-violet-200 transition-all duration-200 group block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Campaign</p>
                            <p class="text-3xl font-extrabold text-slate-800 group-hover:text-violet-600 transition-colors">
                                {{ $totalCampaigns }}</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-violet-50 rounded-xl flex items-center justify-center group-hover:bg-violet-100 transition-colors">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- CAMPAIGN PENDING --}}
                <a href="{{ route('admin.campaign') }}"
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-amber-200 transition-all duration-200 group block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Campaign Pending
                            </p>
                            <p class="text-3xl font-extrabold text-slate-800 group-hover:text-amber-600 transition-colors">
                                {{ $pendingCampaigns }}</p>
                            <p class="text-[11px] text-slate-400 mt-1">menunggu review</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- CAMPAIGN AKTIF --}}
                <a href="{{ route('admin.campaign.active', ['status' => 'approved']) }}"
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-emerald-200 transition-all duration-200 group block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Campaign Aktif
                            </p>
                            <p
                                class="text-3xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                {{ $approvedCampaigns }}</p>
                            <p class="text-[11px] text-slate-400 mt-1">sedang berjalan</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- CAMPAIGN BERAKHIR --}}
                <a href="{{ route('admin.campaign.active', ['status' => 'ended']) }}"
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-blue-200 transition-all duration-200 group block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Campaign Berakhir
                            </p>
                            <p class="text-3xl font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">
                                {{ $endedCampaigns }}</p>
                            <p class="text-[11px] text-slate-400 mt-1">target tercapai</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- CAMPAIGN DITUTUP --}}
                <a href="{{ route('admin.campaign.active', ['status' => 'closed']) }}"
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-slate-300 transition-all duration-200 group block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Campaign Ditutup
                            </p>
                            <p class="text-3xl font-extrabold text-slate-800 group-hover:text-slate-500 transition-colors">
                                {{ $closedCampaigns }}</p>
                            <p class="text-[11px] text-slate-400 mt-1">tidak aktif</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-slate-100 rounded-xl flex items-center justify-center group-hover:bg-slate-200 transition-colors">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            {{-- STATS: ACTIONS --}}
            @php
                $approvedPengelola = \App\Models\User::where('role', 'pengelola')->where('is_approved', true)->count();
            @endphp
            <div class="grid gap-4 sm:grid-cols-2 mb-10">

                {{-- BUAT CAMPAIGN --}}
                <a href="{{ route('admin.campaign.create') }}"
                    class="group bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl p-5 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transition-all duration-200 block">
                    <div
                        class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center mb-3 group-hover:bg-white/30 transition-colors">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <h2 class="text-sm font-bold text-white">Buat Campaign</h2>
                    <p class="text-xs text-emerald-100 mt-1 leading-relaxed">
                        Buat campaign baru yang langsung aktif tanpa verifikasi.
                    </p>
                </a>

                {{-- PENGELOLA AKTIF --}}
                <a href="{{ route('admin.users.index') }}"
                    class="group bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-violet-200 transition-all duration-200 block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Pengelola Aktif
                            </p>
                            <p
                                class="text-3xl font-extrabold text-slate-800 group-hover:text-violet-600 transition-colors">
                                {{ $approvedPengelola }}
                            </p>
                            <p class="text-[11px] text-slate-400 mt-1">sudah terverifikasi</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-violet-50 rounded-xl flex items-center justify-center group-hover:bg-violet-100 transition-colors">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            {{-- TABLES SECTION (DONASI & USER) --}}
            <div class="grid lg:grid-cols-5 gap-6 mb-10">

                {{-- RIWAYAT DONASI TERBARU --}}
                <div
                    class="lg:col-span-3 bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-slate-800">Donasi Terbaru</h2>
                        </div>
                        <a href="{{ route('admin.donations.index') }}"
                            class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">Lihat
                            Semua</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th
                                        class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                        Donatur</th>
                                    <th
                                        class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                        Campaign</th>
                                    <th
                                        class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                        Nominal</th>
                                    <th
                                        class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                        Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($recentDonations as $donation)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-700 flex-shrink-0">
                                                    {{ $donation->anonymous ? 'A' : strtoupper(substr($donation->donor_name ?? ($donation->user->name ?? '?'), 0, 1)) }}
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-sm font-semibold text-slate-700 truncate max-w-[120px]">
                                                        {{ $donation->anonymous ? 'Anonim' : $donation->donor_name ?? ($donation->user->name ?? 'Guest') }}
                                                    </p>
                                                    <p class="text-[11px] text-slate-400 truncate max-w-[120px]">
                                                        {{ $donation->user->email ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-sm text-slate-600 truncate max-w-[150px]"
                                                title="{{ $donation->campaign->title }}">
                                                {{ $donation->campaign->title }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="text-sm font-bold text-emerald-600">
                                                Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="text-xs text-slate-400">
                                                {{ $donation->created_at ? $donation->created_at->diffForHumans() : '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-5 py-12 text-center text-slate-400 text-sm">
                                            Belum ada donasi masuk
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- USER TERBARU DAFTAR --}}
                <div
                    class="lg:col-span-2 bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-slate-800">User Terbaru</h2>
                        </div>
                        <a href="{{ route('admin.users.index') }}"
                            class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">Kelola</a>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @forelse ($latestUsers as $user)
                            <div class="flex items-center gap-3 px-5 py-4 hover:bg-slate-50/50 transition-colors">
                                <div
                                    class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500 flex-shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-slate-700 truncate">{{ $user->name }}</p>
                                    <p class="text-[11px] text-slate-400 truncate">{{ $user->email }}</p>
                                </div>
                                <span
                                    class="text-[10px] font-semibold uppercase tracking-wider px-2 py-1 rounded-full
                                    @if ($user->role == 'admin') bg-red-100 text-red-600
                                    @elseif($user->role == 'pengelola') bg-violet-100 text-violet-600
                                    @else bg-slate-100 text-slate-500 @endif">
                                    {{ $user->role }}
                                </span>
                            </div>
                        @empty
                            <div class="px-5 py-12 text-center text-slate-400 text-sm">
                                Belum ada user terdaftar
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            {{-- BANK SECTION --}}
            <div class="mb-10">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <h2 class="font-bold text-slate-800">Rekening Platform</h2>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.banks.manage') }}"
                            class="text-xs font-semibold text-slate-500 hover:text-emerald-600 transition-colors">Kelola</a>
                        <span class="text-slate-300">|</span>
                        <a href="{{ route('bank.create') }}"
                            class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">+
                            Tambah Baru</a>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @forelse ($userBanks as $bank)
                        <div
                            class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:border-emerald-200 hover:shadow-md transition-all duration-200 group">
                            <div class="flex items-center justify-between mb-5">
                                <p class="text-sm text-slate-800 font-bold">
                                    {{ $bank->bank->name }}
                                </p>
                                @if ($bank->is_primary)
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-full">
                                        Utama
                                    </span>
                                @endif
                            </div>
                            <div
                                class="flex items-center gap-3 bg-slate-50 rounded-xl p-3 group-hover:bg-emerald-50/50 transition-colors">
                                <div class="w-9 h-9 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-3" />
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-600 font-mono tracking-wide font-semibold">
                                    {{ $bank->account_number }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-slate-200">
                            <p class="text-slate-400 text-sm">Belum ada rekening terdaftar</p>
                            <a href="{{ route('bank.create') }}"
                                class="text-sm text-emerald-600 font-semibold mt-2 inline-block hover:underline">+ Tambah
                                Rekening</a>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- QUICK ACTIONS --}}
            <div>
                <div class="flex items-center gap-2.5 mb-5">
                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h2 class="font-bold text-slate-800">Menu Cepat</h2>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">

                    {{-- PENGELOLA PENDING --}}
                    <a href="{{ route('admin.pengelola') }}"
                        class="group bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-lg hover:border-violet-200 transition-all duration-200 relative overflow-hidden">

                        {{-- BADGE PENDING PENGELOLA --}}
                        @if ($pendingPengelola > 0)
                            <div class="absolute top-3 right-3">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white shadow-sm shadow-red-500/30">
                                    {{ $pendingPengelola }}
                                </span>
                            </div>
                        @endif

                        <div
                            class="w-10 h-10 bg-violet-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-violet-100 transition-colors">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h2 class="text-sm font-bold text-slate-800 group-hover:text-violet-700 transition-colors">
                            Verifikasi Pengelola
                        </h2>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Setujui atau tolak pengajuan akun pengelola
                            baru.</p>
                    </a>

                    {{-- CAMPAIGN PENDING --}}
                    <a href="{{ route('admin.campaign') }}"
                        class="group bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-lg hover:border-blue-200 transition-all duration-200 relative overflow-hidden">

                        {{-- BADGE PENDING CAMPAIGN --}}
                        @if ($pendingCampaigns > 0)
                            <div class="absolute top-3 right-3">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white shadow-sm shadow-red-500/30">
                                    {{ $pendingCampaigns }}
                                </span>
                            </div>
                        @endif

                        <div
                            class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-100 transition-colors">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h2 class="text-sm font-bold text-slate-800 group-hover:text-blue-700 transition-colors">
                            Review Campaign
                        </h2>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Review dan setujui campaign yang menunggu.
                        </p>
                    </a>

                    {{-- CAMPAIGN AKTIF --}}
                    <a href="{{ route('admin.campaign.active') }}"
                        class="group bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-lg hover:border-emerald-200 transition-all duration-200">
                        <div
                            class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-100 transition-colors">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-sm font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">
                            Campaign Aktif
                        </h2>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Pantau dan kelola campaign yang sedang
                            berjalan.</p>
                    </a>

                    {{-- WITHDRAW REQUEST --}}
                    <a href="{{ route('admin.withdrawals') }}"
                        class="group bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-lg hover:border-red-200 transition-all duration-200 relative overflow-hidden">
                        @if ($pendingWithdraws > 0)
                            <div class="absolute top-3 right-3">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white shadow-sm shadow-red-500/30">
                                    {{ $pendingWithdraws }}
                                </span>
                            </div>
                        @endif
                        <div
                            class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-100 transition-colors">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 10H6L5 9z" />
                            </svg>
                        </div>
                        <h2 class="text-sm font-bold text-slate-800 group-hover:text-red-600 transition-colors">
                            Withdraw Request
                        </h2>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Persetujuan penarikan dana oleh pengelola.
                        </p>
                    </a>

                    {{-- RIWAYAT AKTIVITAS --}}
                    <a href="{{ route('admin.activities') }}"
                        class="group bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-lg hover:border-indigo-200 transition-all duration-200">
                        <div
                            class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-100 transition-colors">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-sm font-bold text-slate-800 group-hover:text-indigo-700 transition-colors">
                            Riwayat Aktivitas
                        </h2>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Log aktivitas seluruh user di platform.</p>
                    </a>

                </div>
            </div>

        </div>
    </div>
@endsection
