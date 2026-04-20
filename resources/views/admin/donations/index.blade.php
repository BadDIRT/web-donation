@extends('layouts.app')

@section('title', 'Riwayat Donasi')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">

            {{-- HEADER --}}
            <div class="mb-6 sm:mb-8">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-4 sm:mb-6 group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>

                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-800 truncate">Riwayat Donasi</h1>
                        <p class="text-slate-500 text-xs sm:text-sm mt-0.5">{{ $totalTransaksi }} transaksi • Rp
                            {{ number_format($totalNominal, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            {{-- ALERTS --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    class="mb-4 sm:mb-6 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3 sm:px-5 sm:py-4 flex items-center gap-3">
                    <div
                        class="w-7 h-7 sm:w-8 sm:h-8 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            {{-- MOBILE: STATS HORIZONTAL SCROLL --}}
            <div class="lg:hidden mb-4 sm:mb-6">
                <div class="flex gap-3 overflow-x-auto pb-2 -mx-4 px-4 snap-x snap-mandatory scrollbar-hide">
                    {{-- TOTAL --}}
                    <div
                        class="bg-white rounded-xl shadow-sm shadow-black/5 border border-slate-100 p-4 min-w-[140px] snap-start flex-shrink-0">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 mb-1">Transaksi</p>
                        <p class="text-xl font-extrabold text-slate-800">{{ $totalTransaksi }}</p>
                    </div>
                    {{-- NOMINAL --}}
                    <div
                        class="bg-white rounded-xl shadow-sm shadow-black/5 border border-slate-100 p-4 min-w-[160px] snap-start flex-shrink-0">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 mb-1">Total</p>
                        <p class="text-base font-extrabold text-emerald-600">Rp
                            {{ number_format($totalNominal, 0, ',', '.') }}</p>
                    </div>
                    {{-- PENDING --}}
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}"
                        class="bg-white rounded-xl shadow-sm shadow-black/5 border p-4 min-w-[120px] snap-start flex-shrink-0
                    {{ request('status') === 'pending' ? 'border-amber-300 ring-2 ring-amber-500/20' : 'border-slate-100' }}">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 mb-1">Pending</p>
                        <p class="text-xl font-extrabold text-amber-600">{{ $pendingCount }}</p>
                    </a>
                    {{-- FAILED --}}
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'failed']) }}"
                        class="bg-white rounded-xl shadow-sm shadow-black/5 border p-4 min-w-[120px] snap-start flex-shrink-0
                    {{ request('status') === 'failed' ? 'border-red-300 ring-2 ring-red-500/20' : 'border-slate-100' }}">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 mb-1">Gagal</p>
                        <p class="text-xl font-extrabold text-red-600">{{ $failedCount }}</p>
                    </a>
                    {{-- SUCCESS --}}
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'success']) }}"
                        class="bg-white rounded-xl shadow-sm shadow-black/5 border p-4 min-w-[120px] snap-start flex-shrink-0
                    {{ request('status') === 'success' ? 'border-emerald-300 ring-2 ring-emerald-500/20' : 'border-slate-100' }}">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 mb-1">Berhasil</p>
                        <p class="text-xl font-extrabold text-emerald-600">
                            {{ $totalTransaksi - $pendingCount - $failedCount }}</p>
                    </a>
                </div>
            </div>

            {{-- MAIN GRID --}}
            <div class="grid lg:grid-cols-4 gap-4 sm:gap-6">

                {{-- DESKTOP: SIDEBAR STATS --}}
                <div class="hidden lg:block lg:col-span-1 space-y-4 order-2 lg:order-1">

                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Transaksi</p>
                        <p class="text-2xl font-extrabold text-slate-800">{{ $totalTransaksi }}</p>
                        <p class="text-[11px] text-slate-400 mt-1">donasi tercatat</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Nominal</p>
                        <p class="text-lg font-extrabold text-emerald-600">Rp
                            {{ number_format($totalNominal, 0, ',', '.') }}</p>
                        <p class="text-[11px] text-slate-400 mt-1">seluruh donasi</p>
                    </div>

                    <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}"
                        class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 hover:border-amber-200 hover:shadow-md transition-all block
                    {{ request('status') === 'pending' ? 'ring-2 ring-amber-500/20 border-amber-200' : '' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Pending</p>
                                <p class="text-2xl font-extrabold text-amber-600">{{ $pendingCount }}</p>
                            </div>
                            <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ request()->fullUrlWithQuery(['status' => 'failed']) }}"
                        class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 hover:border-red-200 hover:shadow-md transition-all block
                    {{ request('status') === 'failed' ? 'ring-2 ring-red-500/20 border-red-200' : '' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Gagal</p>
                                <p class="text-2xl font-extrabold text-red-600">{{ $failedCount }}</p>
                            </div>
                            <div class="w-9 h-9 rounded-xl bg-red-50 flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ request()->fullUrlWithQuery(['status' => 'success']) }}"
                        class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 hover:border-emerald-200 hover:shadow-md transition-all block
                    {{ request('status') === 'success' ? 'ring-2 ring-emerald-500/20 border-emerald-200' : '' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Berhasil</p>
                                <p class="text-2xl font-extrabold text-emerald-600">
                                    {{ $totalTransaksi - $pendingCount - $failedCount }}</p>
                            </div>
                            <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- MAIN CONTENT --}}
                <div class="lg:col-span-3 order-1 lg:order-2">

                    {{-- FILTER BAR --}}
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-4 sm:p-5 mb-4">
                        <form method="GET" class="space-y-3">
                            {{-- ROW 1: SEARCH + SORT --}}
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-slate-400" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="q" value="{{ request('q') }}"
                                        placeholder="Cari donatur, campaign..."
                                        class="w-full pl-10 sm:pl-12 pr-10 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all">
                                    @if (request('q'))
                                        <a href="{{ request()->fullUrlWithQuery(['q' => '']) }}"
                                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>

                                <div class="relative">
                                    <select name="sort" onchange="this.form.submit()"
                                        class="appearance-none pl-3.5 sm:pl-4 pr-9 sm:pr-10 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all cursor-pointer w-full sm:w-auto sm:min-w-[160px]">
                                        <option value="latest"
                                            {{ request('sort') === 'latest' || !request('sort') ? 'selected' : '' }}>
                                            Terbaru</option>
                                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>
                                            Terlama</option>
                                        <option value="highest" {{ request('sort') === 'highest' ? 'selected' : '' }}>
                                            Nominal Tertinggi</option>
                                        <option value="lowest" {{ request('sort') === 'lowest' ? 'selected' : '' }}>
                                            Nominal Terendah</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- ROW 2: FILTERS --}}
                            <div class="flex flex-wrap gap-2 sm:gap-3 items-center">
                                <div class="relative flex-1 sm:flex-none">
                                    <select name="status" onchange="this.form.submit()"
                                        class="appearance-none pl-3.5 sm:pl-4 pr-9 sm:pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all cursor-pointer w-full sm:w-auto">
                                        <option value="">Semua Status</option>
                                        <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>
                                            Berhasil</option>
                                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>
                                            Gagal</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="relative flex-1 sm:flex-none">
                                    <select name="anonymous" onchange="this.form.submit()"
                                        class="appearance-none pl-3.5 sm:pl-4 pr-9 sm:pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all cursor-pointer w-full sm:w-auto">
                                        <option value="">Semua Tipe</option>
                                        <option value="1" {{ request('anonymous') === '1' ? 'selected' : '' }}>Anonim
                                        </option>
                                        <option value="0" {{ request('anonymous') === '0' ? 'selected' : '' }}>Publik
                                        </option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>

                                @if (request()->hasAny(['q', 'status', 'anonymous', 'sort']))
                                    <a href="{{ route('admin.donations.index') }}"
                                        class="px-3 sm:px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 hover:border-slate-300 transition-all flex items-center justify-center gap-1.5 sm:gap-2 flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        <span class="hidden sm:inline">Reset</span>
                                    </a>
                                @endif
                            </div>

                            {{-- ACTIVE FILTERS --}}
                            @if (request('status') || (request('anonymous') !== null && request('anonymous') !== ''))
                                <div class="flex items-center gap-2 pt-3 border-t border-slate-100 flex-wrap">
                                    <span class="text-[10px] sm:text-xs text-slate-400">Filter:</span>
                                    @if (request('status'))
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] sm:text-xs font-medium">
                                            {{ ucfirst(request('status')) }}
                                            <a href="{{ request()->fullUrlWithQuery(['status' => '']) }}"
                                                class="hover:text-emerald-800">
                                                <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3" fill="none"
                                                    stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </a>
                                        </span>
                                    @endif
                                    @if (request('anonymous') !== null && request('anonymous') !== '')
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-lg bg-indigo-50 text-indigo-600 text-[10px] sm:text-xs font-medium">
                                            {{ request('anonymous') === '1' ? 'Anonim' : 'Publik' }}
                                            <a href="{{ request()->fullUrlWithQuery(['anonymous' => '']) }}"
                                                class="hover:text-indigo-800">
                                                <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3" fill="none"
                                                    stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </a>
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </form>
                    </div>

                    {{-- SEARCH INFO --}}
                    @if (request('q'))
                        <div class="flex items-center gap-2 mb-3 sm:mb-4 text-xs sm:text-sm text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Hasil: <span class="font-semibold text-slate-700">"{{ request('q') }}"</span></span>
                        </div>
                    @endif

                    {{-- ==================== MOBILE: CARD LIST ==================== --}}
                    <div class="sm:hidden space-y-3">
                        @forelse ($donations as $donation)
                            <a href="{{ route('admin.donations.show', $donation) }}"
                                class="bg-white rounded-xl shadow-sm shadow-black/5 border border-slate-100 p-4 hover:shadow-md hover:border-emerald-100 transition-all block">
                                <div class="flex items-start justify-between gap-3 mb-3">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        @if ($donation->anonymous)
                                            <div
                                                class="w-9 h-9 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </div>
                                        @elseif ($donation->user && $donation->user->profile_photo_path)
                                            <img src="{{ $donation->user->profile_photo_url }}" alt=""
                                                class="w-9 h-9 rounded-lg object-cover flex-shrink-0">
                                        @else
                                            <div
                                                class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-700 flex-shrink-0">
                                                {{ strtoupper(substr($donation->donor_name ?? ($donation->user->name ?? '?'), 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-1 text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-md flex-shrink-0
                                    {{ $donation->status === 'success' ? 'bg-emerald-50 text-emerald-600' : ($donation->status === 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-red-600') }}">
                                        @if ($donation->status === 'success')
                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor"
                                                stroke-width="3" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @elseif ($donation->status === 'pending')
                                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                        @else
                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor"
                                                stroke-width="3" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </div>

                                <p class="text-xs text-slate-500 truncate mb-3" title="{{ $donation->campaign->title }}">
                                    <span class="text-slate-400">Campaign:</span> {{ $donation->campaign->title }}
                                </p>

                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-base font-bold
                                    {{ $donation->status === 'success' ? 'text-emerald-600' : ($donation->status === 'failed' ? 'text-red-500' : 'text-slate-600') }}">
                                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                    </span>
                                    <span
                                        class="text-[10px] text-slate-400">{{ $donation->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        @empty
                            <div
                                class="bg-white rounded-xl shadow-sm shadow-black/5 border border-slate-100 py-12 text-center">
                                <div
                                    class="w-14 h-14 bg-slate-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-slate-500 font-semibold text-sm">
                                    {{ request('q') || request('status') ? 'Tidak ditemukan' : 'Belum ada donasi' }}
                                </p>
                            </div>
                        @endforelse

                        {{-- MOBILE PAGINATION --}}
                        @if ($donations->hasPages())
                            <div class="flex items-center justify-between pt-2">
                                <p class="text-[10px] text-slate-400">
                                    {{ $donations->firstItem() }}-{{ $donations->lastItem() }} /
                                    {{ $donations->total() }}
                                </p>
                                <div class="flex items-center gap-1">
                                    @unless ($donations->onFirstPage())
                                        <a href="{{ $donations->previousPageUrl() }}"
                                            class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-600 border border-slate-200 bg-white text-xs">←</a>
                                    @endunless
                                    @for ($i = max(1, $donations->currentPage() - 1); $i <= min($donations->lastPage(), $donations->currentPage() + 1); $i++)
                                        @if ($i == $donations->currentPage())
                                            <span
                                                class="w-7 h-7 rounded-lg flex items-center justify-center text-[10px] font-bold text-white bg-emerald-500">{{ $i }}</span>
                                        @else
                                            <a href="{{ $donations->url($i) }}"
                                                class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-600 border border-slate-200 bg-white text-[10px]">{{ $i }}</a>
                                        @endif
                                    @endfor
                                    @if ($donations->hasMorePages())
                                        <a href="{{ $donations->nextPageUrl() }}"
                                            class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-600 border border-slate-200 bg-white text-xs">→</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- ==================== DESKTOP: TABLE ==================== --}}
                    <div
                        class="hidden sm:block bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-slate-50/80">
                                        <th
                                            class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                            Donatur</th>
                                        <th
                                            class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                            Campaign</th>
                                        <th
                                            class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-right">
                                            Nominal</th>
                                        <th
                                            class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                            Status</th>
                                        <th
                                            class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                            Waktu</th>
                                        <th
                                            class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse ($donations as $donation)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-5 py-4">
                                                <div class="flex items-center gap-3">
                                                    {{-- SESUDAH --}}
                                                    @if ($donation->anonymous)
                                                        <div
                                                            class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                                                            <svg class="w-4 h-4 text-slate-400" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                        </div>
                                                    @elseif ($donation->user && $donation->user->profile_photo_path)
                                                        <img src="{{ $donation->user->profile_photo_url }}"
                                                            alt=""
                                                            class="w-9 h-9 rounded-xl object-cover flex-shrink-0">
                                                    @else
                                                        <div
                                                            class="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-700 flex-shrink-0">
                                                            {{ strtoupper(substr($donation->donor_name ?? ($donation->user->name ?? '?'), 0, 1)) }}
                                                        </div>
                                                    @endif
                                                    <div class="min-w-0">
                                                        <div class="flex items-center gap-1.5">
                                                            <p
                                                                class="text-sm font-semibold text-slate-700 truncate max-w-[140px]">
                                                                {{ $donation->anonymous ? 'Anonim' : $donation->donor_name ?? ($donation->user->name ?? 'Guest') }}
                                                            </p>
                                                            @if ($donation->anonymous)
                                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg>
                                                            @endif
                                                        </div>
                                                        <p class="text-[11px] text-slate-400 truncate max-w-[140px]">
                                                            {{ $donation->anonymous ? 'Hamba Allah' : $donation->user->email ?? '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4">
                                                <p class="text-sm text-slate-600 truncate max-w-[180px]"
                                                    title="{{ $donation->campaign->title }}">
                                                    {{ $donation->campaign->title }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 text-right">
                                                <span
                                                    class="text-sm font-bold
                                                {{ $donation->status === 'success' ? 'text-emerald-600' : ($donation->status === 'failed' ? 'text-red-500' : 'text-slate-600') }}">
                                                    Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-4 text-center">
                                                <span
                                                    class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg
                                                {{ $donation->status === 'success' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : ($donation->status === 'pending' ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-red-50 text-red-600 border border-red-100') }}">
                                                    @if ($donation->status === 'success')
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            stroke-width="2.5" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    @elseif ($donation->status === 'pending')
                                                        <span
                                                            class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                                    @else
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            stroke-width="2.5" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    @endif
                                                    {{ ucfirst($donation->status) }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-4">
                                                <p class="text-xs text-slate-500">
                                                    {{ $donation->created_at->format('d M Y') }}</p>
                                                <p class="text-[10px] text-slate-400">
                                                    {{ $donation->created_at->diffForHumans() }}</p>
                                            </td>
                                            <td class="px-5 py-4 text-center">
                                                <a href="{{ route('admin.donations.show', $donation) }}"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 hover:border-slate-300 transition-all"
                                                    title="Detail">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-5 py-16 text-center">
                                                <div
                                                    class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                                    <svg class="w-8 h-8 text-slate-300" fill="none"
                                                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <p class="text-slate-500 font-semibold text-sm">
                                                    {{ request('q') || request('status') ? 'Tidak ditemukan' : 'Belum ada donasi' }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- DESKTOP PAGINATION --}}
                        @if ($donations->hasPages())
                            <div class="px-5 py-4 border-t border-slate-100 flex items-center justify-between">
                                <p class="text-xs text-slate-500">
                                    <span class="font-semibold text-slate-700">{{ $donations->firstItem() }}</span> -
                                    <span class="font-semibold text-slate-700">{{ $donations->lastItem() }}</span> dari
                                    <span class="font-semibold text-slate-700">{{ $donations->total() }}</span>
                                </p>
                                <div class="flex items-center gap-1">
                                    @if ($donations->onFirstPage())
                                        <span
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-300 border border-slate-100 bg-slate-50">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </span>
                                    @else
                                        <a href="{{ $donations->previousPageUrl() }}"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </a>
                                    @endif

                                    @php
                                        $start = max(1, $donations->currentPage() - 1);
                                        $end = min($donations->lastPage(), $donations->currentPage() + 1);
                                    @endphp

                                    @if ($start > 1)
                                        <a href="{{ $donations->url(1) }}"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-xs text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-all">1</a>
                                        @if ($start > 2)
                                            <span
                                                class="w-8 h-8 rounded-lg flex items-center justify-center text-xs text-slate-400">...</span>
                                        @endif
                                    @endif

                                    @for ($i = $start; $i <= $end; $i++)
                                        @if ($i == $donations->currentPage())
                                            <span
                                                class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-white bg-emerald-500 shadow-sm shadow-emerald-500/20">{{ $i }}</span>
                                        @else
                                            <a href="{{ $donations->url($i) }}"
                                                class="w-8 h-8 rounded-lg flex items-center justify-center text-xs text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-all">{{ $i }}</a>
                                        @endif
                                    @endfor

                                    @if ($end < $donations->lastPage())
                                        @if ($end < $donations->lastPage() - 1)
                                            <span
                                                class="w-8 h-8 rounded-lg flex items-center justify-center text-xs text-slate-400">...</span>
                                        @endif
                                        <a href="{{ $donations->url($donations->lastPage()) }}"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-xs text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-all">{{ $donations->lastPage() }}</a>
                                    @endif

                                    @if ($donations->hasMorePages())
                                        <a href="{{ $donations->nextPageUrl() }}"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    @else
                                        <span
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-300 border border-slate-100 bg-slate-50">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- Tambahkan di layout.app jika belum ada --}}
    @push('styles')
        <style>
            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }

            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    @endpush
@endsection
