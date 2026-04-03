@extends('layouts.app')

@section('title', 'Campaign Aktif')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/20">
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
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Campaign Aktif</h1>
                            <p class="text-slate-500 text-sm mt-0.5">Pantau dan kelola campaign yang sedang berjalan</p>
                        </div>
                    </div>

                    {{-- RESULT COUNT --}}
                    <div class="text-sm text-slate-500">
                        <span class="font-semibold text-slate-700">{{ $campaigns->total() }}</span> campaign ditemukan
                    </div>
                </div>
            </div>

            {{-- FILTER BAR --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-4 sm:p-5 mb-6">
                <form method="GET" class="flex flex-col lg:flex-row gap-3">

                    {{-- SEARCH --}}
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Cari judul, ID, atau penggalang..."
                            class="w-full pl-11 pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all">
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

                    {{-- FILTERS WRAPPER --}}
                    <div class="flex flex-wrap gap-3">
                        {{-- STATUS FILTER --}}
                        <div class="relative">
                            <select name="status"
                                class="appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all cursor-pointer min-w-[140px]">
                                <option value="">Semua Status</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="ended" {{ request('status') == 'ended' ? 'selected' : '' }}>Selesai</option>
                                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Ditutup
                                </option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        {{-- SORT --}}
                        <div class="relative">
                            <select name="sort"
                                class="appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all cursor-pointer min-w-[150px]">
                                <option value="">Terbaru</option>
                                <option value="target" {{ request('sort') == 'target' ? 'selected' : '' }}>Target Terbesar
                                </option>
                                <option value="donation" {{ request('sort') == 'donation' ? 'selected' : '' }}>Donasi
                                    Terbanyak</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        {{-- APPLY BUTTON --}}
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span class="hidden sm:inline">Filter</span>
                        </button>

                        {{-- RESET --}}
                        @if (request('q') || request('status') || request('sort'))
                            <a href="{{ route('admin.campaign.active') }}"
                                class="px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 hover:border-slate-300 transition-all flex items-center gap-2">
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

                {{-- ACTIVE FILTERS --}}
                @if (request('status'))
                    <div class="flex flex-wrap items-center gap-2 mt-3 pt-3 border-t border-slate-100">
                        <span class="text-xs text-slate-400">Filter aktif:</span>
                        @if (request('status'))
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-medium">
                                Status:
                                {{ request('status') == 'approved' ? 'Aktif' : (request('status') == 'ended' ? 'Selesai' : 'Ditutup') }}
                            </span>
                        @endif
                        @if (request('sort'))
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-600 text-xs font-medium">
                                Urutkan:
                                {{ request('sort') == 'target' ? 'Target Terbesar' : (request('sort') == 'donation' ? 'Donasi Terbanyak' : 'Terlama') }}
                            </span>
                        @endif
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

            {{-- CAMPAIGN LIST --}}
            <div class="space-y-4">

                @forelse($campaigns as $campaign)
                    @php
                        $progress =
                            $campaign->target_amount > 0
                                ? min(($campaign->current_amount / $campaign->target_amount) * 100, 100)
                                : 0;
                    @endphp

                    <div
                        class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden hover:shadow-md hover:border-emerald-100 transition-all duration-200">

                        <div class="p-5 sm:p-6">
                            <div class="flex flex-col sm:flex-row gap-5">

                                {{-- THUMBNAIL --}}
                                <div class="flex-shrink-0">
                                    <a href="{{ route('admin.campaign.show', $campaign->id) }}"
                                        class="block w-full sm:w-44 h-28 rounded-xl overflow-hidden bg-slate-100 group">
                                        @if ($campaign->image)
                                            <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-10 h-10 text-slate-300" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </a>
                                </div>

                                {{-- CONTENT --}}
                                <div class="flex-1 min-w-0 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-start justify-between gap-3">
                                            <div class="min-w-0 flex-1">
                                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                                    <span
                                                        class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full
                                                        @if ($campaign->status == 'approved') bg-emerald-100 text-emerald-600
                                                        @elseif($campaign->status == 'ended') bg-blue-100 text-blue-600
                                                        @else bg-red-100 text-red-600 @endif">
                                                        @if ($campaign->status == 'approved')
                                                            Aktif
                                                        @elseif($campaign->status == 'ended')
                                                            Selesai
                                                        @else
                                                            Ditutup
                                                        @endif
                                                    </span>
                                                    <span
                                                        class="text-[10px] text-slate-400 font-mono">#{{ $campaign->id }}</span>
                                                </div>
                                                <a href="{{ route('admin.campaign.show', $campaign->id) }}"
                                                    class="text-base font-bold text-slate-800 hover:text-emerald-600 transition-colors line-clamp-2">
                                                    {{ $campaign->title }}
                                                </a>
                                            </div>
                                        </div>

                                        <p class="text-sm text-slate-500 mt-1.5 line-clamp-1">
                                            {{ $campaign->description }}
                                        </p>
                                    </div>

                                    {{-- META INFO --}}
                                    <div
                                        class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-3 pt-3 border-t border-slate-100">
                                        {{-- PENGGALANG --}}
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-600 flex-shrink-0">
                                                {{ strtoupper(substr($campaign->user->name ?? '?', 0, 1)) }}
                                            </div>
                                            <span
                                                class="text-xs text-slate-600 font-medium">{{ $campaign->user->name ?? '-' }}</span>
                                        </div>

                                        <div class="w-px h-4 bg-slate-200 hidden sm:block"></div>

                                        {{-- TARGET & TERKUMPUL --}}
                                        <div class="flex items-center gap-3">
                                            <span class="flex items-center gap-1 text-xs text-slate-400">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                                </svg>
                                                Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                                            </span>
                                            <span
                                                class="flex items-center gap-1 text-xs font-semibold
                                                @if ($progress >= 100) text-emerald-600 @else text-slate-700 @endif">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}
                                            </span>
                                        </div>

                                        <div class="w-px h-4 bg-slate-200 hidden sm:block"></div>

                                        {{-- WAKTU --}}
                                        <span class="flex items-center gap-1 text-xs text-slate-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $campaign->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    {{-- PROGRESS BAR --}}
                                    <div class="mt-3">
                                        <div class="flex justify-between items-center mb-1">
                                            <span
                                                class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold">Progress</span>
                                            <span
                                                class="text-xs font-bold
                                                @if ($progress >= 100) text-emerald-600 @else text-slate-600 @endif">
                                                {{ number_format($progress, 0) }}%
                                            </span>
                                        </div>
                                        <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                            <div class="h-1.5 rounded-full transition-all duration-500
                                                @if ($progress >= 100) bg-gradient-to-r from-emerald-400 to-teal-400
                                                @else bg-gradient-to-r from-blue-400 to-indigo-400 @endif"
                                                style="width: {{ $progress }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ACTIONS (DESKTOP) --}}
                                <div class="flex sm:flex-col items-center gap-2 flex-shrink-0 sm:pt-1">
                                    <a href="{{ route('admin.campaign.show', $campaign->id) }}"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all w-full justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="hidden sm:inline">Detail</span>
                                    </a>

                                    <a href="{{ route('campaign.show', $campaign->slug) }}" target="_blank"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-medium border border-blue-200 text-blue-600 hover:bg-blue-50 hover:border-blue-300 transition-all w-full justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        <span class="hidden sm:inline">Lihat</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- EMPTY STATE --}}
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                        <div class="px-6 py-20 text-center">
                            <div class="w-20 h-20 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>

                            @if (request('q'))
                                <h3 class="font-bold text-slate-700 text-lg">Tidak Ditemukan</h3>
                                <p class="text-slate-500 text-sm mt-2 max-w-sm mx-auto">
                                    Tidak ada campaign dengan kata kunci
                                    <span class="font-semibold text-slate-600">"{{ request('q') }}"</span>
                                </p>
                                <a href="{{ route('admin.campaign.active') }}"
                                    class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset Pencarian
                                </a>
                            @else
                                <h3 class="font-bold text-slate-700 text-lg">Belum Ada Campaign</h3>
                                <p class="text-slate-500 text-sm mt-2 max-w-sm mx-auto">
                                    Belum ada campaign yang sesuai dengan filter ini.
                                </p>
                                <div class="flex items-center justify-center gap-3 mt-5">
                                    <a href="{{ route('admin.campaign.active') }}"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Reset Filter
                                    </a>
                                    <a href="{{ route('admin.campaign.create') }}"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Buat Campaign
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- PAGINATION --}}
            @if ($campaigns->hasPages())
                <div class="mt-8 flex items-center justify-between">
                    <p class="text-sm text-slate-500">
                        Menampilkan
                        <span class="font-semibold text-slate-700">{{ $campaigns->firstItem() }}</span>
                        -
                        <span class="font-semibold text-slate-700">{{ $campaigns->lastItem() }}</span>
                        dari
                        <span class="font-semibold text-slate-700">{{ $campaigns->total() }}</span>
                    </p>

                    <div class="flex items-center gap-1">
                        {{-- PREV --}}
                        @if ($campaigns->onFirstPage())
                            <span
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-300 border border-slate-100 bg-slate-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $campaigns->previousPageUrl() }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        @endif

                        {{-- NUMBERS --}}
                        @php
                            $onEachSide = 1;
                            $start = max(1, $campaigns->currentPage() - $onEachSide);
                            $end = min($campaigns->lastPage(), $campaigns->currentPage() + $onEachSide);
                        @endphp

                        {{-- FIRST PAGE + DOTS --}}
                        @if ($start > 1)
                            <a href="{{ $campaigns->url(1) }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                1
                            </a>
                            @if ($start > 2)
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-400">...</span>
                            @endif
                        @endif

                        {{-- PAGE NUMBERS --}}
                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $campaigns->currentPage())
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-500 shadow-lg shadow-emerald-500/20">
                                    {{ $i }}
                                </span>
                            @else
                                <a href="{{ $campaigns->url($i) }}"
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                    {{ $i }}
                                </a>
                            @endif
                        @endfor

                        {{-- LAST PAGE + DOTS --}}
                        @if ($end < $campaigns->lastPage())
                            @if ($end < $campaigns->lastPage() - 1)
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-400">...</span>
                            @endif
                            <a href="{{ $campaigns->url($campaigns->lastPage()) }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                {{ $campaigns->lastPage() }}
                            </a>
                        @endif

                        {{-- NEXT --}}
                        @if ($campaigns->hasMorePages())
                            <a href="{{ $campaigns->nextPageUrl() }}"
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
