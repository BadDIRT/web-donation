@extends('layouts.app')

@section('title', 'Riwayat Penarikan')

@section('content')
    <div class="bg-gradient-to-br from-slate-50 via-white to-indigo-50/20 pb-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-indigo-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>

            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800">Riwayat Penarikan</h1>
                        <p class="text-slate-500 text-sm mt-0.5">Semua aktivitas penarikan dana Anda</p>
                    </div>
                </div>
                <a href="{{ route('withdraw.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-indigo-500 to-violet-500 text-white hover:from-indigo-600 hover:to-violet-600 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/30 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Ajukan Penarikan
                </a>
            </div>

            {{-- FILTER BAR --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-4 sm:p-5 mb-4">
                <form method="GET" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari campaign..."
                            class="w-full pl-12 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all">
                        @if (request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => '']) }}"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-3 items-center">
                        <div class="relative">
                            <select name="status" onchange="this.form.submit()"
                                class="appearance-none pl-4 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all cursor-pointer min-w-[150px]">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui
                                </option>
                                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak
                                </option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        @if (request()->hasAny(['search', 'status']))
                            <a href="{{ route('withdraw.history') }}"
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

                @if (request('status'))
                    <div class="flex items-center gap-2 mt-3 pt-3 border-t border-slate-100">
                        <span class="text-xs text-slate-400">Filter aktif:</span>
                        <span
                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-600 text-xs font-medium">
                            {{ request('status') === 'pending' ? 'Pending' : (request('status') === 'approved' ? 'Disetujui' : (request('status') === 'rejected' ? 'Ditolak' : 'Selesai')) }}
                            <a href="{{ request()->fullUrlWithQuery(['status' => '']) }}" class="hover:text-indigo-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </span>
                    </div>
                @endif
            </div>

            @if (request('search'))
                <div class="flex items-center gap-2 mb-4 text-sm text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Hasil untuk <span class="font-semibold text-slate-700">"{{ request('search') }}"</span></span>
                </div>
            @endif

            {{-- ==================== MOBILE: CARD LIST ==================== --}}
            <div class="sm:hidden space-y-3">
                @forelse ($withdraws as $withdraw)
                    <a href="{{ route('withdraw.show', $withdraw) }}"
                        class="bg-white rounded-xl shadow-sm shadow-black/5 border border-slate-100 p-4 hover:shadow-md hover:border-indigo-100 transition-all block">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-700 truncate">
                                    {{ $withdraw->campaign->title ?? '-' }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $withdraw->created_at->diffForHumans() }}</p>
                            </div>
                            <span
                                class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md flex-shrink-0
                            {{ $withdraw->status === 'approved' ? 'bg-emerald-100 text-emerald-600 border border-emerald-100' : ($withdraw->status === 'completed' ? 'bg-blue-100 text-blue-600 border border-blue-100' : ($withdraw->status === 'rejected' ? 'bg-red-100 text-red-600 border border-red-100' : 'bg-amber-100 text-amber-600 border border-amber-100')) }}">
                                @if ($withdraw->status === 'approved')
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                @elseif ($withdraw->status === 'completed')
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                @elseif ($withdraw->status === 'rejected')
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @else
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                @endif
                                {{ $withdraw->status === 'pending' ? 'Pending' : ($withdraw->status === 'approved' ? 'Disetujui' : ($withdraw->status === 'rejected' ? 'Ditolak' : 'Selesai')) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-base font-bold text-slate-800">Rp
                                {{ number_format($withdraw->amount, 0, ',', '.') }}</span>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7-7" />
                            </svg>
                        </div>
                    </a>
                @empty
                    <div class="bg-white rounded-xl shadow-sm shadow-black/5 border border-slate-100 py-12 text-center">
                        <div class="w-14 h-14 bg-slate-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <p class="text-slate-500 font-semibold text-sm">Belum Ada Penarikan</p>
                        <a href="{{ route('withdraw.create') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:underline mt-3">Ajukan
                            Sekarang →</a>
                    </div>
                @endforelse

                {{-- MOBILE PAGINATION --}}
                @if ($withdraws->hasPages())
                    <div class="flex items-center justify-between pt-4">
                        <p class="text-[10px] text-slate-400">
                            {{ $withdraws->firstItem() }}-{{ $withdraws->lastItem() }} / {{ $withdraws->total() }}
                        </p>
                        <div class="flex items-center gap-1">
                            @unless ($withdraws->onFirstPage())
                                <a href="{{ $withdraws->previousPageUrl() }}"
                                    class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-600 border border-slate-200 bg-white text-xs hover:bg-slate-50">←</a>
                            @endunless

                            @for ($i = max(1, $withdraws->currentPage() - 1); $i <= min($withdraws->lastPage(), $withdraws->currentPage() + 1); $i++)
                                @if ($i == $withdraws->currentPage())
                                    <span
                                        class="w-7 h-7 rounded-lg flex items-center justify-center text-[10px] font-bold text-white bg-indigo-500">{{ $i }}</span>
                                @else
                                    <a href="{{ $withdraws->url($i) }}"
                                        class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-600 border border-slate-200 bg-white text-[10px] hover:bg-slate-50">{{ $i }}</a>
                                @endif
                            @endfor

                            @if ($withdraws->hasMorePages())
                                <a href="{{ $withdraws->nextPageUrl() }}"
                                    class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-600 border border-slate-200 bg-white text-xs hover:bg-slate-50">→</a>
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
                                    class="px-6 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 pl-12">
                                    Campaign</th>
                                <th
                                    class="px-6 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-right">
                                    Nominal</th>
                                <th
                                    class="px-6 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                    Status</th>
                                <th class="px-6 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                    Waktu</th>
                                <th
                                    class="px-6 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($withdraws as $withdraw)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-semibold text-slate-700 truncate max-w-[280px]">
                                                    {{ $withdraw->campaign->title ?? '-' }}</p>
                                                <p class="text-[11px] text-slate-400">ID:
                                                    {{ $withdraw->campaign->id ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-bold text-slate-800">Rp
                                            {{ number_format($withdraw->amount, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg
                                        {{ $withdraw->status === 'approved' ? 'bg-emerald-100 text-emerald-600 border border-emerald-100' : ($withdraw->status === 'completed' ? 'bg-blue-100 text-blue-600 border border-blue-100' : ($withdraw->status === 'rejected' ? 'bg-red-100 text-red-600 border border-red-100' : 'bg-amber-100 text-amber-600 border border-amber-100')) }}">
                                            @if ($withdraw->status === 'approved')
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    stroke-width="3" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            @elseif ($withdraw->status === 'completed')
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            @elseif ($withdraw->status === 'rejected')
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    stroke-width="3" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @else
                                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                            @endif
                                            {{ $withdraw->status === 'pending' ? 'Pending' : ($withdraw->status === 'approved' ? 'Disetujui' : ($withdraw->status === 'rejected' ? 'Ditolak' : 'Selesai')) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-slate-600">{{ $withdraw->created_at->format('d M Y') }}</p>
                                        <p class="text-[11px] text-slate-400">{{ $withdraw->created_at->diffForHumans() }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('withdraw.show', $withdraw) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition-all"
                                                title="Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            @if ($withdraw->transfer_proof)
                                                <a href="{{ Storage::url($withdraw->transfer_proof) }}" target="_blank"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-emerald-200 text-emerald-600 hover:bg-emerald-50 transition-all"
                                                    title="Bukti Transfer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12h6m-6 4h6m-6 4h.01M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div
                                            class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                                stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-500 font-semibold text-sm">Belum Ada Penarikan</p>
                                        <a href="{{ route('withdraw.create') }}"
                                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:underline mt-3">Ajukan
                                            Sekarang →</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- DESKTOP PAGINATION --}}
                @if ($withdraws->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between">
                        <p class="text-xs text-slate-500">
                            Menampilkan <span class="font-semibold text-slate-700">{{ $withdraws->firstItem() }}</span> -
                            <span class="font-semibold text-slate-700">{{ $withdraws->lastItem() }}</span> dari
                            <span class="font-semibold text-slate-700">{{ $withdraws->total() }}</span> data
                        </p>
                        <div class="flex items-center gap-1">
                            {{-- PREV --}}
                            @if ($withdraws->onFirstPage())
                                <span
                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-300 border border-slate-100 bg-slate-50">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $withdraws->previousPageUrl() }}"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </a>
                            @endif

                            {{-- NUMBERS --}}
                            @php
                                $start = max(1, $withdraws->currentPage() - 1);
                                $end = min($withdraws->lastPage(), $withdraws->currentPage() + 1);
                            @endphp

                            @if ($start > 1)
                                <a href="{{ $withdraws->url(1) }}"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-xs text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-all">1</a>
                                @if ($start > 2)
                                    <span
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-xs text-slate-400">...</span>
                                @endif
                            @endif

                            @for ($i = $start; $i <= $end; $i++)
                                @if ($i == $withdraws->currentPage())
                                    <span
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-white bg-indigo-500 shadow-sm shadow-indigo-500/20">{{ $i }}</span>
                                @else
                                    <a href="{{ $withdraws->url($i) }}"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-xs text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-all">{{ $i }}</a>
                                @endif
                            @endfor

                            @if ($end < $withdraws->lastPage())
                                @if ($end < $withdraws->lastPage() - 1)
                                    <span
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-xs text-slate-400">...</span>
                                @endif
                                <a href="{{ $withdraws->url($withdraws->lastPage()) }}"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-xs text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-all">{{ $withdraws->lastPage() }}</a>
                            @endif

                            {{-- NEXT --}}
                            @if ($withdraws->hasMorePages())
                                <a href="{{ $withdraws->nextPageUrl() }}"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-600 border border-slate-200 bg-white hover:bg-slate-50 transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7-7" />
                                    </svg>
                                </a>
                            @else
                                <span
                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-300 border border-slate-100 bg-slate-50">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7-7" />
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
