@extends('layouts.app')

@if (auth()->user()->is_approved)
    @section('title', 'Dashboard Pengelola')
@else
    @section('title', 'Dashboard Donatur')
@endif

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            @if (auth()->user()->is_approved)
                {{-- HEADER --}}
                <div class="mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center shadow-lg shadow-violet-500/20">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Dashboard Pengelola</h1>
                        </div>
                        <p class="text-slate-500 text-sm sm:text-base ml-[52px]">Pantau status campaign dan kelola
                            penggalangan dana Anda.</p>
                    </div>
                    <div class="ml-[52px] sm:ml-0 text-sm text-slate-500">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>
            @else
                {{-- HEADER UNTUK BELUM APPROVED --}}
                <div class="mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center shadow-lg shadow-pink-500/20">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Dashboard Donatur</h1>
                        </div>
                        <p class="text-slate-500 text-sm sm:text-base ml-[52px]">Ringkasan kebaikan yang telah Anda berikan.
                        </p>
                    </div>
                    <div class="ml-[52px] sm:ml-0 text-sm text-slate-500">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                {{-- STATS RINGKASAN --}}
                <div class="grid gap-4 sm:grid-cols-3 mb-10">
                    <div
                        class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total
                                    Transaksi</p>
                                <p
                                    class="text-3xl font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">
                                    {{ $donations->count() }}</p>
                                <p class="text-[11px] text-slate-400 mt-1">kali donasi</p>
                            </div>
                            <div
                                class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Nominal
                                </p>
                                <p
                                    class="text-2xl sm:text-3xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                    Rp {{ number_format($donations->sum('amount'), 0, ',', '.') }}</p>
                                <p class="text-[11px] text-slate-400 mt-1">telah disalurkan</p>
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
                    <div
                        class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Campaign
                                    Didukung</p>
                                <p
                                    class="text-3xl font-extrabold text-slate-800 group-hover:text-violet-600 transition-colors">
                                    {{ $donations->pluck('campaign.title')->unique()->count() }}</p>
                                <p class="text-[11px] text-slate-400 mt-1">campaign berbeda</p>
                            </div>
                            <div
                                class="w-11 h-11 bg-violet-50 rounded-xl flex items-center justify-center group-hover:bg-violet-100 transition-colors">
                                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (auth()->user()->is_approved)

                {{-- STATS --}}
                <div class="grid gap-4 sm:grid-cols-3 mb-10">
                    <div
                        class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Campaign
                                </p>
                                <p
                                    class="text-3xl font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">
                                    {{ $totalCampaign }}</p>
                            </div>
                            <div
                                class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Campaign Aktif
                                </p>
                                <p
                                    class="text-3xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                    {{ $approvedCampaign }}</p>
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
                    </div>
                    <div
                        class="bg-white rounded-2xl p-5 shadow-sm shadow-black-500/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Donatur
                                    Unik</p>
                                <p
                                    class="text-3xl font-extrabold text-slate-800 group-hover:text-violet-600 transition-colors">
                                    {{ $uniqueDonorsCount }}</p>
                                <p class="text-[11px] text-slate-400 mt-1">donatur terdaftar</p>
                            </div>
                            <div
                                class="w-11 h-11 bg-violet-50 rounded-xl flex items-center justify-center group-hover:bg-violet-100 transition-colors">
                                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MAIN GRID LAYOUT --}}
                <div class="grid lg:grid-cols-5 gap-6 mb-10">

                    {{-- LEFT COL (Tables) --}}
                    <div class="lg:col-span-3 space-y-6">

                        {{-- CAMPAIGN SAYA --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <h2 class="font-bold text-slate-800">Campaign Saya</h2>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if ($campaigns->count() > 3)
                                        <a href="{{ route('pengelola.campaigns.index') }}"
                                            class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 px-3 py-2 rounded-lg transition-colors">
                                            Lihat Semua →
                                        </a>
                                    @endif
                                    <a href="{{ route('campaign.create') }}"
                                        class="text-xs font-semibold bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg transition-colors shadow-sm shadow-emerald-500/20">
                                        + Buat Baru
                                    </a>
                                </div>
                            </div>

                            {{-- MOBILE: CARD VIEW --}}
                            <div class="md:hidden divide-y divide-slate-100">
                                @forelse($campaigns->take(3) as $campaign)
                                    @php
                                        $progress =
                                            $campaign->target_amount > 0
                                                ? ($campaign->current_amount / $campaign->target_amount) * 100
                                                : 0;
                                    @endphp
                                    <div class="p-4">
                                        <div class="flex items-start justify-between gap-3 mb-3">
                                            <div class="min-w-0 flex-1">
                                                <p class="font-semibold text-slate-700 text-sm truncate">
                                                    {{ $campaign->title }}</p>
                                                <p class="text-[11px] text-slate-400 mt-0.5">Rp
                                                    {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                                            </div>
                                            <span
                                                class="flex-shrink-0 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                        @if ($campaign->status == 'approved') bg-emerald-100 text-emerald-600
                        @elseif($campaign->status == 'pending') bg-amber-100 text-amber-600
                        @elseif($campaign->status == 'ended') bg-blue-100 text-blue-600
                        @else bg-red-100 text-red-600 @endif">
                                                {{ ucfirst($campaign->status) }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <div class="flex-1 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                                <div class="bg-emerald-500 h-full rounded-full"
                                                    style="width: {{ min($progress, 100) }}%"></div>
                                            </div>
                                            <span
                                                class="text-[10px] font-semibold text-slate-500">{{ floor($progress) }}%</span>
                                            <a href="{{ route('pengelola.campaign.show', $campaign->slug) }}"
                                                class="flex-shrink-0 text-[10px] font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg hover:bg-blue-100 transition-colors">
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-8 text-center text-slate-400 text-sm">Belum ada campaign</div>
                                @endforelse
                            </div>

                            {{-- DESKTOP: TABLE VIEW --}}
                            <div class="hidden md:block overflow-x-auto">
                                <table class="w-full text-left text-sm">
                                    <thead>
                                        <tr class="bg-slate-50/50">
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                                Judul</th>
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                                Status</th>
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                                Progress</th>
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                                Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @forelse($campaigns->take(3) as $campaign)
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <td class="px-5 py-4">
                                                    <p class="font-semibold text-slate-700 truncate max-w-[200px]">
                                                        {{ $campaign->title }}</p>
                                                    <p class="text-[11px] text-slate-400 mt-0.5">Rp
                                                        {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                                                </td>
                                                <td class="px-5 py-4 text-center">
                                                    <span
                                                        class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                @if ($campaign->status == 'approved') bg-emerald-100 text-emerald-600
                                @elseif($campaign->status == 'pending') bg-amber-100 text-amber-600
                                @elseif($campaign->status == 'ended') bg-blue-100 text-blue-600
                                @else bg-red-100 text-red-600 @endif">
                                                        {{ ucfirst($campaign->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4 w-32">
                                                    @php
                                                        $progress =
                                                            $campaign->target_amount > 0
                                                                ? ($campaign->current_amount /
                                                                        $campaign->target_amount) *
                                                                    100
                                                                : 0;
                                                    @endphp
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="flex-1 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                                            <div class="bg-emerald-500 h-full rounded-full"
                                                                style="width: {{ min($progress, 100) }}%"></div>
                                                        </div>
                                                        <span
                                                            class="text-[10px] font-semibold text-slate-500 w-8 text-right">{{ floor($progress) }}%</span>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 text-center">
                                                    <a href="{{ route('pengelola.campaign.show', $campaign->slug) }}"
                                                        class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-700 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-10 text-slate-400 text-sm">Belum
                                                    ada campaign</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- RIWAYAT PEMASUKAN --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h2 class="font-bold text-slate-800">Pemasukan Campaign</h2>
                                </div>
                                <a href="{{ route('pengelola.income.index') }}"
                                    class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition-colors flex items-center gap-1.5">
                                    Lihat Semua
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>

                            {{-- MOBILE: CARD VIEW --}}
                            <div class="md:hidden divide-y divide-slate-100">
                                @forelse($recentIncome as $donation)
                                    <div class="p-4">
                                        <div class="flex items-start justify-between gap-2 mb-2">
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-slate-700 text-sm truncate">
                                                    {{ $donation->campaign->title }}</p>
                                                <p class="text-[11px] text-slate-400 mt-0.5">
                                                    {{ $donation->anonymous ? 'Hamba Allah' : $donation->donor_name ?? 'Donatur' }}
                                                </p>
                                            </div>
                                            <span
                                                class="flex-shrink-0 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                        @if ($donation->status == 'success') bg-emerald-100 text-emerald-600
                        @elseif($donation->status == 'pending') bg-amber-100 text-amber-600
                        @else bg-red-100 text-red-600 @endif">
                                                {{ ucfirst($donation->status) }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-xs font-bold text-emerald-600">+Rp
                                                {{ number_format($donation->amount, 0, ',', '.') }}</p>
                                            <p class="text-[11px] text-slate-400">
                                                {{ $donation->created_at->translatedFormat('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="px-5 py-16 text-center">
                                        <div
                                            class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                                stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-500 font-semibold">Belum ada pemasukan</p>
                                        <p class="text-slate-400 text-xs mt-1">Pemasukan akan muncul setelah ada donasi
                                            masuk</p>
                                    </div>
                                @endforelse
                            </div>

                            {{-- DESKTOP: TABLE VIEW --}}
                            <div class="hidden md:block overflow-x-auto">
                                <table class="w-full text-left text-sm">
                                    <thead>
                                        <tr class="bg-slate-50/50">
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                                Donatur</th>
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                                Campaign</th>
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                                Nominal</th>
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                                Status</th>
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-right">
                                                Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @forelse($recentIncome as $donation)
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <td class="px-5 py-4">
                                                    <p class="font-semibold text-slate-700 text-sm">
                                                        {{ $donation->anonymous ? 'Hamba Allah' : $donation->donor_name ?? 'Donatur' }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <p class="text-slate-600 truncate max-w-[180px]">
                                                        {{ $donation->campaign->title }}</p>
                                                </td>
                                                <td class="px-5 py-4 text-center font-bold text-emerald-600">+Rp
                                                    {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                                <td class="px-5 py-4 text-center">
                                                    <span
                                                        class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                @if ($donation->status == 'success') bg-emerald-100 text-emerald-600
                                @elseif($donation->status == 'pending') bg-amber-100 text-amber-600
                                @else bg-red-100 text-red-600 @endif">
                                                        {{ ucfirst($donation->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4 text-right text-slate-400 text-xs">
                                                    {{ $donation->created_at->translatedFormat('d M Y, H:i') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-5 py-16 text-center">
                                                    <div
                                                        class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                                        <svg class="w-8 h-8 text-slate-300" fill="none"
                                                            stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </div>
                                                    <p class="text-slate-500 font-semibold">Belum ada pemasukan</p>
                                                    <p class="text-slate-400 text-xs mt-1">Pemasukan akan muncul setelah
                                                        ada donasi masuk</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- FOOTER --}}
                            @if ($totalIncome > 0)
                                <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50 text-center">
                                    <p class="text-xs text-slate-400 mb-2">Total pemasukan dari semua campaign</p>
                                    <div class="flex items-center justify-center gap-4">
                                        <p class="text-lg font-extrabold text-emerald-600">Rp
                                            {{ number_format($totalIncome, 0, ',', '.') }}</p>
                                        <a href="{{ route('pengelola.income.index') }}"
                                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors">
                                            Lihat Detail
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>

                    {{-- RIGHT COL (Cards & Sidebar) --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- SALDO CARD --}}
                        <div
                            class="bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-2xl p-6 shadow-lg shadow-emerald-500/20 relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-20 h-20 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2">
                            </div>
                            <div class="relative">
                                <p class="text-sm text-emerald-100 font-medium">Saldo Yang Bisa Ditarik</p>
                                <p class="text-3xl font-extrabold mt-2 tracking-tight">Rp
                                    {{ number_format($totalWithdrawable, 0, ',', '.') }}</p>
                                <p class="text-xs text-emerald-200 mt-3 opacity-80">Total dari seluruh campaign Anda</p>
                            </div>
                        </div>

                        {{-- REKENING SECTION --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-bold text-sm text-slate-800">Rekening Saya</h3>
                                <a href="{{ route('bank.create') }}"
                                    class="text-[10px] font-bold text-emerald-600 hover:underline">+ Tambah</a>
                            </div>
                            <div class="space-y-3">
                                @forelse ($userBanks as $bank)
                                    <div
                                        class="bg-slate-50 rounded-xl p-3 hover:bg-emerald-50/50 transition-colors group border border-transparent hover:border-emerald-200">
                                        <div class="flex items-center justify-between">
                                            <p class="text-xs font-bold text-slate-600">{{ $bank->bank->name }}</p>
                                            @if ($bank->is_primary)
                                                <span
                                                    class="text-[9px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-full">Utama</span>
                                            @endif
                                        </div>
                                        <p class="text-xs font-mono text-slate-400 tracking-wide mt-1.5">
                                            {{ $bank->account_number }}</p>
                                    </div>
                                @empty
                                    <p class="text-slate-400 text-xs text-center py-4">Belum ada rekening</p>
                                @endforelse
                            </div>
                            <a href="{{ route('admin.banks.manage') }}"
                                class="block mt-4 text-center text-xs font-semibold text-slate-500 hover:text-emerald-600 transition-colors py-2 border border-slate-200 rounded-lg hover:border-emerald-300">
                                Kelola Rekening
                            </a>
                        </div>

                        {{-- QUICK ACTIONS --}}
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('campaign.create') }}"
                                class="bg-white rounded-2xl p-4 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-blue-200 transition-all duration-200 text-center group">
                                <div
                                    class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-100 transition-colors">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <p class="text-xs font-bold text-slate-700 group-hover:text-blue-700">Buat Campaign</p>
                            </a>
                            <a href="{{ route('withdraw.create') }}"
                                class="bg-white rounded-2xl p-4 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-amber-200 transition-all duration-200 text-center group">
                                <div
                                    class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-amber-100 transition-colors">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9l-5 5-5-5" />
                                    </svg>
                                </div>
                                <p class="text-xs font-bold text-slate-700 group-hover:text-amber-700">Tarik Dana</p>
                            </a>
                        </div>

                        {{-- PENARIKAN TERAKHIR --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                            <div class="p-5 border-b border-slate-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                        </div>
                                        <h3 class="font-bold text-sm text-slate-800">Riwayat Tarik Dana</h3>
                                    </div>
                                    <a href="{{ route('withdraw.history') }}"
                                        class="text-[10px] font-bold text-amber-600 hover:underline">Lihat Semua</a>
                                </div>
                            </div>

                            {{-- Mini Stats --}}
                            <div class="grid grid-cols-3 border-b border-slate-100">
                                <div class="p-3 text-center border-r border-slate-100">
                                    <p class="text-lg font-extrabold text-amber-500">
                                        {{ $withdraws->where('status', 'pending')->count() }}</p>
                                    <p class="text-[9px] font-semibold text-slate-400 uppercase">Pending</p>
                                </div>
                                <div class="p-3 text-center border-r border-slate-100">
                                    <p class="text-lg font-extrabold text-emerald-500">
                                        {{ $withdraws->where('status', 'approved')->count() }}</p>
                                    <p class="text-[9px] font-semibold text-slate-400 uppercase">Sukses</p>
                                </div>
                                <div class="p-3 text-center">
                                    <p class="text-lg font-extrabold text-red-500">
                                        {{ $withdraws->where('status', 'rejected')->count() }}</p>
                                    <p class="text-[9px] font-semibold text-slate-400 uppercase">Gagal</p>
                                </div>
                            </div>

                            <div class="divide-y divide-slate-100 max-h-[250px] overflow-y-auto">
                                @forelse($withdraws->take(4) as $withdraw)
                                    <div class="px-5 py-3 hover:bg-slate-50/50 transition-colors">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-xs font-semibold text-slate-700 truncate max-w-[160px]">
                                                {{ $withdraw->campaign->title ?? '-' }}</p>
                                            <span
                                                class="text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full
                                                @if ($withdraw->status == 'approved') bg-emerald-100 text-emerald-600
                                                @elseif($withdraw->status == 'pending') bg-amber-100 text-amber-600
                                                @else bg-red-100 text-red-600 @endif">
                                                {{ ucfirst($withdraw->status) }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-[11px] text-slate-400">
                                                {{ $withdraw->created_at->diffForHumans() }}</p>
                                            <p class="text-xs font-bold text-slate-800">Rp
                                                {{ number_format($withdraw->amount, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="px-5 py-8 text-center text-slate-400 text-xs">Belum ada riwayat</div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            @else
                {{-- 🔒 BELUM APPROVED --}}
                <div class="max-w-lg mx-auto mt-20">
                    <div class="bg-white rounded-3xl shadow-sm shadow-black/5 border border-amber-100 p-10 text-center">
                        <div class="w-20 h-20 mx-auto bg-amber-100 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800 mb-3">Akun Sedang Diverifikasi</h2>
                        <p class="text-sm text-slate-500 leading-relaxed mb-6">
                            Anda belum dapat membuat campaign atau melakukan penarikan dana. Proses verifikasi
                            membutuhkan
                            waktu maksimal <span class="font-bold text-slate-700">3x24 jam</span>.
                        </p>
                        <div class="bg-slate-50 rounded-xl p-4 text-left">
                            <p class="text-xs font-semibold text-slate-600 mb-2">Yang bisa Anda lakukan saat ini:</p>
                            <ul class="text-xs text-slate-500 space-y-1.5">
                                <li class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Melihat campaign yang sedang berjalan
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Melakukan donasi ke campaign lain
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- MAIN GRID --}}
                <div class="grid lg:grid-cols-5 gap-6 mt-20">

                    {{-- LEFT: RIWAYAT DONASI --}}
                    <div
                        class="lg:col-span-3 bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h2 class="font-bold text-slate-800">Riwayat Donasi</h2>
                            </div>
                            <a href="{{ route('my.donations') }}"
                                class="text-xs font-semibold text-pink-600 hover:text-pink-700 transition-colors flex items-center gap-1.5">
                                Lihat Semua
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead>
                                    <tr class="bg-slate-50/50 text-slate-500">
                                        <th
                                            class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                            Campaign</th>
                                        <th
                                            class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                            Nominal</th>
                                        <th
                                            class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                            Status</th>
                                        <th
                                            class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-right">
                                            Waktu</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($recentDonations as $donation)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-5 py-4">
                                                <p class="font-semibold text-slate-700 truncate max-w-[200px]">
                                                    {{ $donation->campaign->title }}</p>
                                                <p class="text-[11px] text-slate-400 mt-0.5">
                                                    {{ $donation->anonymous ? 'Hamba Allah' : $donation->donor_name ?? auth()->user()->name }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 text-center font-bold text-slate-800">Rp
                                                {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                            <td class="px-5 py-4 text-center">
                                                <span
                                                    class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                                @if ($donation->status == 'success') bg-emerald-100 text-emerald-600
                                                @elseif($donation->status == 'pending') bg-amber-100 text-amber-600
                                                @else bg-red-100 text-red-600 @endif">
                                                    {{ ucfirst($donation->status) }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-4 text-right text-slate-400 text-xs">
                                                {{ $donation->created_at->translatedFormat('d M Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-5 py-16 text-center">
                                                <div
                                                    class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                                    <svg class="w-8 h-8 text-slate-300" fill="none"
                                                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                    </svg>
                                                </div>
                                                <p class="text-slate-500 font-semibold">Belum ada riwayat donasi</p>
                                                <p class="text-slate-400 text-xs mt-1">Yuk mulai berdonasi untuk membantu
                                                    mereka</p>
                                                <a href="{{ route('campaign.index') }}"
                                                    class="inline-block mt-4 text-xs font-bold text-emerald-600 hover:underline">Cari
                                                    Campaign →</a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- FOOTER LIHAT SEMUA --}}
                        @if ($donations->count() > 5)
                            <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50 text-center">
                                <p class="text-xs text-slate-400 mb-2">
                                    Menampilkan 5 dari <span
                                        class="font-semibold text-slate-600">{{ $donations->count() }}</span> donasi
                                </p>
                                <a href="{{ route('my.donations') }}"
                                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold bg-pink-50 text-pink-600 hover:bg-pink-100 transition-colors">
                                    Lihat Semua Riwayat
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- RIGHT: SIDEBAR --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- BADGE / ACHIEVEMENT --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                            <div class="flex items-center gap-2.5 mb-4">
                                <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-sm text-slate-800">Status Kebaikan</h3>
                            </div>

                            <div
                                class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-4 border border-amber-100/50">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-2xl">
                                        @if ($donations->count() >= 10)
                                            🌟
                                        @elseif($donations->count() >= 5)
                                            ⭐
                                        @elseif($donations->count() > 0)
                                            🌱
                                        @else
                                            💤
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">
                                            @if ($donations->count() >= 10)
                                                Donatur Legendaris
                                            @elseif($donations->count() >= 5)
                                                Donatur Setia
                                            @elseif($donations->count() > 0)
                                                Pemula Kebaikan
                                            @else
                                                Belum Memulai
                                            @endif
                                        </p>
                                        <p class="text-[11px] text-slate-500 mt-0.5">
                                            {{ $donations->count() }}/10 donasi untuk level berikutnya
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-3 w-full bg-white rounded-full h-1.5">
                                    <div class="bg-amber-400 h-1.5 rounded-full transition-all duration-500"
                                        style="width: {{ min(($donations->count() / 10) * 100, 100) }}%"></div>
                                </div>
                            </div>
                        </div>

                        {{-- CAMPAIGN YANG PERNAH DIDUKUNG --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <h3 class="font-bold text-sm text-slate-800">Pernah Didukung</h3>
                                </div>
                            </div>

                            <div class="divide-y divide-slate-100 max-h-[300px] overflow-y-auto">
                                @php
                                    // Mengelompokkan dan menghitung total donasi per campaign unik
                                    $groupedCampaigns = $donations
                                        ->where('status', 'success')
                                        ->groupBy('campaign_id')
                                        ->map(function ($items) {
                                            return [
                                                'title' => $items->first()->campaign->title,
                                                'slug' => $items->first()->campaign->slug,
                                                'total' => $items->sum('amount'),
                                                'count' => $items->count(),
                                            ];
                                        })
                                        ->take(5);
                                @endphp

                                @forelse($groupedCampaigns as $item)
                                    <a href="{{ route('campaign.show', $item['slug']) }}"
                                        class="flex items-center justify-between px-5 py-3.5 hover:bg-slate-50/50 transition-colors group">
                                        <div class="min-w-0 flex-1">
                                            <p
                                                class="text-sm font-semibold text-slate-700 group-hover:text-emerald-700 transition-colors truncate">
                                                {{ $item['title'] }}
                                            </p>
                                            <p class="text-[11px] text-slate-400 mt-0.5">{{ $item['count'] }}x donasi</p>
                                        </div>
                                        <div class="text-right flex-shrink-0 ml-3">
                                            <p class="text-xs font-bold text-emerald-600">Rp
                                                {{ number_format($item['total'], 0, ',', '.') }}</p>
                                            <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-emerald-500 transition-colors ml-auto mt-0.5"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </a>
                                @empty
                                    <div class="px-5 py-8 text-center text-slate-400 text-xs">
                                        Belum ada campaign
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- INFO CARD --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                            <div class="flex items-center gap-2.5 mb-4">
                                <div class="w-8 h-8 rounded-lg bg-violet-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-sm text-slate-800">Tahukah Kamu?</h3>
                            </div>
                            <div class="space-y-3 text-xs text-slate-500 leading-relaxed">
                                <div class="flex gap-3">
                                    <div
                                        class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor"
                                            stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <p>Donasi yang sudah berhasil tidak dapat dibatalkan atau dikembalikan.</p>
                                </div>
                                <div class="flex gap-3">
                                    <div
                                        class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor"
                                            stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <p>Kamu bisa memantau langsung perkembangan campaign yang kamu dukung.</p>
                                </div>
                                <div class="flex gap-3">
                                    <div
                                        class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor"
                                            stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <p>Pilih "Donasi Anonim" jika tidak ingin namamu tampil di list donatur.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
