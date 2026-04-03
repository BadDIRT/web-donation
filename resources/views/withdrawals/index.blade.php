@extends('layouts.app')

@section('title', 'Withdraw Request')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-red-50/20">
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
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-rose-500 flex items-center justify-center shadow-lg shadow-red-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Withdraw Request</h1>
                            <p class="text-slate-500 text-sm mt-0.5">Kelola pengajuan penarikan dana campaign</p>
                        </div>
                    </div>

                    {{-- BADGE COUNT --}}
                    <div class="flex items-center gap-2 px-4 py-2 bg-red-50 border border-red-200 rounded-xl">
                        <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                        <span class="text-sm font-semibold text-red-700">
                            {{ $withdraws->total() }} menunggu proses
                        </span>
                    </div>
                </div>
            </div>

            {{-- SEARCH --}}
            <form method="GET" class="mb-6">
                <div class="relative max-w-lg">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari nama pengelola atau judul campaign..."
                        class="w-full pl-12 pr-12 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all shadow-sm">
                    @if (request('q'))
                        <a href="{{ route('admin.withdrawals') }}"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors"
                            title="Reset pencarian">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </div>
            </form>

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
            <div class="space-y-4">

                @forelse($withdraws as $w)
                    <div
                        class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden hover:shadow-md hover:border-red-100 transition-all duration-200">

                        <div class="p-5 sm:p-6">
                            <div class="flex flex-col lg:flex-row gap-5">

                                {{-- INFO UTAMA --}}
                                <div class="flex-1 min-w-0">
                                    {{-- BADGE + JUDUL --}}
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center gap-2 flex-wrap mb-1">
                                                <span
                                                    class="text-[10px] font-bold uppercase tracking-wider bg-amber-100 text-amber-600 px-2 py-0.5 rounded-full flex items-center gap-1">
                                                    <span
                                                        class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                                    Pending
                                                </span>
                                                <span
                                                    class="text-[10px] text-slate-400 font-mono">#{{ $w->id }}</span>
                                            </div>
                                            <h3 class="text-base font-bold text-slate-800 truncate">
                                                {{ $w->campaign->title }}
                                            </h3>
                                        </div>

                                        {{-- NOMINAL --}}
                                        <div class="text-right flex-shrink-0">
                                            <p class="text-lg font-extrabold text-red-600">
                                                Rp {{ number_format($w->amount, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- META INFO --}}
                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 pt-3 border-t border-slate-100">

                                        {{-- PENGELOLA --}}
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-violet-100 flex items-center justify-center text-[10px] font-bold text-violet-600 flex-shrink-0">
                                                {{ strtoupper(substr($w->user->name ?? '?', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium text-slate-700">{{ $w->user->name ?? '-' }}
                                                </p>
                                                <p class="text-[10px] text-slate-400">{{ $w->user->email ?? '-' }}</p>
                                            </div>
                                        </div>

                                        <div class="w-px h-6 bg-slate-200 hidden sm:block"></div>

                                        {{-- BANK TUJUAN --}}
                                        @if ($w->bank)
                                            <div class="flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                                <span class="text-xs text-slate-600">
                                                    {{ $w->bank->bank->name ?? '-' }} •
                                                    {{ $w->bank->account_number ?? '-' }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400 italic">Bank tidak tersedia</span>
                                        @endif

                                        <div class="w-px h-6 bg-slate-200 hidden sm:block"></div>

                                        {{-- WAKTU --}}
                                        <span class="flex items-center gap-1.5 text-xs text-slate-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $w->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>

                                {{-- ACTION --}}
                                <div class="flex lg:flex-col items-center gap-2 flex-shrink-0 lg:pt-1">
                                    <a href="{{ route('admin.withdrawals.show', $w->id) }}"
                                        class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-red-500 to-rose-500 text-white hover:from-red-600 hover:to-rose-600 shadow-lg shadow-red-500/20 hover:shadow-red-500/30 transition-all w-full justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="hidden sm:inline">Proses</span>
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
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>

                            @if (request('q'))
                                <h3 class="font-bold text-slate-700 text-lg">Tidak Ditemukan</h3>
                                <p class="text-slate-500 text-sm mt-2 max-w-sm mx-auto">
                                    Tidak ada penarikan dengan kata kunci
                                    <span class="font-semibold text-slate-600">"{{ request('q') }}"</span>
                                </p>
                                <a href="{{ route('admin.withdrawals') }}"
                                    class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset Pencarian
                                </a>
                            @else
                                <h3 class="font-bold text-slate-700 text-lg">Semua Clear! 🎉</h3>
                                <p class="text-slate-500 text-sm mt-2 max-w-sm mx-auto">
                                    Tidak ada pengajuan penarikan yang menunggu proses saat ini.
                                </p>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 hover:bg-emerald-600 text-white shadow-lg shadow-emerald-500/20 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Kembali ke Dashboard
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- PAGINATION --}}
            @if ($withdraws->hasPages())
                <div class="mt-8 flex items-center justify-between">
                    <p class="text-sm text-slate-500">
                        Menampilkan
                        <span class="font-semibold text-slate-700">{{ $withdraws->firstItem() }}</span>
                        -
                        <span class="font-semibold text-slate-700">{{ $withdraws->lastItem() }}</span>
                        dari
                        <span class="font-semibold text-slate-700">{{ $withdraws->total() }}</span>
                    </p>

                    <div class="flex items-center gap-1">
                        {{-- PREV --}}
                        @if ($withdraws->onFirstPage())
                            <span
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-300 border border-slate-100 bg-slate-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $withdraws->previousPageUrl() }}"
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
                            $start = max(1, $withdraws->currentPage() - $onEachSide);
                            $end = min($withdraws->lastPage(), $withdraws->currentPage() + $onEachSide);
                        @endphp

                        @if ($start > 1)
                            <a href="{{ $withdraws->url(1) }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                1</a>
                            @if ($start > 2)
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-400">...</span>
                            @endif
                        @endif

                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $withdraws->currentPage())
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold text-white bg-gradient-to-r from-red-500 to-rose-500 shadow-lg shadow-red-500/20">
                                    {{ $i }}
                                </span>
                            @else
                                <a href="{{ $withdraws->url($i) }}"
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                    {{ $i }}</a>
                            @endif
                        @endfor

                        @if ($end < $withdraws->lastPage())
                            @if ($end < $withdraws->lastPage() - 1)
                                <span
                                    class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-400">...</span>
                            @endif
                            <a href="{{ $withdraws->url($withdraws->lastPage()) }}"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-sm text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                                {{ $withdraws->lastPage() }}</a>
                        @endif

                        {{-- NEXT --}}
                        @if ($withdraws->hasMorePages())
                            <a href="{{ $withdraws->nextPageUrl() }}"
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
