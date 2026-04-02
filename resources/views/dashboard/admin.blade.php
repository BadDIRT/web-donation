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

            {{-- STATS --}}
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-10">
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

                {{-- TOTAL CAMPAIGN --}}
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
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

                {{-- SALDO BANK --}}
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Saldo Bank</p>
                            <p
                                class="text-2xl sm:text-3xl font-extrabold text-slate-800 group-hover:text-amber-600 transition-colors">
                                Rp {{ number_format($totalBankBalance, 0, ',', '.') }}</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABLES SECTION (DONASI & USER) --}}
            <div class="grid lg:grid-cols-5 gap-6 mb-10">

                {{-- RIWAYAT DONASI TERBARU --}}
                <div
                    class="lg:col-span-3 bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-slate-800">Donasi Terbaru</h2>
                        </div>
                        <a href="#"
                            class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">Lihat
                            Semua</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                        Donatur</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                        Campaign</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                        Nominal</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
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

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    {{-- PENGELOLA PENDING --}}
                    <a href="{{ route('admin.pengelola') }}"
                        class="group bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-lg hover:border-violet-200 transition-all duration-200">
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
                        class="group bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-lg hover:border-blue-200 transition-all duration-200">
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
                </div>
            </div>

        </div>
    </div>
@endsection
