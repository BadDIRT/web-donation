@extends('layouts.app')

@section('title', 'Review Campaign')

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
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Review Campaign</h1>
                            <p class="text-slate-500 text-sm mt-0.5">Kelola campaign yang menunggu persetujuan</p>
                        </div>
                    </div>

                    {{-- BADGE COUNT --}}
                    <div class="flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-200 rounded-xl">
                        <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                        <span class="text-sm font-semibold text-amber-700">
                            {{ $campaigns->count() }} menunggu review
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
                        placeholder="Cari judul, ID, atau nama penggalang..."
                        class="w-full pl-12 pr-12 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-sm">
                    @if (request('q'))
                        <a href="{{ route('admin.campaign') }}"
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

                @forelse($campaigns as $campaign)
                    <div x-data="{ openReject: false, openApprove: false }"
                        class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden hover:shadow-md hover:border-blue-100 transition-all duration-200">

                        <div class="p-5 sm:p-6">
                            <div class="flex flex-col lg:flex-row gap-5">

                                {{-- THUMBNAIL --}}
                                <div class="flex-shrink-0">
                                    <a href="{{ route('admin.campaign.show', $campaign->id) }}"
                                        class="block w-full lg:w-40 h-32 rounded-xl overflow-hidden bg-slate-100 group">
                                        @if ($campaign->image)
                                            <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </a>
                                </div>

                                {{-- INFO --}}
                                <div class="flex-1 min-w-0 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-start justify-between gap-3">
                                            <div class="min-w-0">
                                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                                    <span
                                                        class="text-[10px] font-bold uppercase tracking-wider bg-amber-100 text-amber-600 px-2 py-0.5 rounded-full">
                                                        Pending
                                                    </span>
                                                    <span class="text-[10px] text-slate-400">
                                                        #{{ $campaign->id }}
                                                    </span>
                                                </div>
                                                <a href="{{ route('admin.campaign.show', $campaign->id) }}"
                                                    class="text-base font-bold text-slate-800 hover:text-blue-600 transition-colors line-clamp-2">
                                                    {{ $campaign->title }}
                                                </a>
                                            </div>
                                        </div>

                                        <p class="text-sm text-slate-500 mt-1.5 line-clamp-2">
                                            {{ $campaign->description }}
                                        </p>
                                    </div>

                                    {{-- META --}}
                                    <div
                                        class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-3 pt-3 border-t border-slate-100">
                                        {{-- PENGGALANG --}}
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-600 flex-shrink-0">
                                                {{ strtoupper(substr($campaign->user->name ?? '?', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium text-slate-700">
                                                    {{ $campaign->user->name ?? '-' }}</p>
                                                <p class="text-[10px] text-slate-400">{{ $campaign->user->email ?? '-' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="w-px h-6 bg-slate-200 hidden sm:block"></div>

                                        {{-- TARGET --}}
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-xs font-semibold text-slate-700">Rp
                                                {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                        </div>

                                        <div class="w-px h-6 bg-slate-200 hidden sm:block"></div>

                                        {{-- WAKTU --}}
                                        <span class="flex items-center gap-1.5 text-xs text-slate-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $campaign->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>

                                {{-- ACTIONS (DESKTOP) --}}
                                <div class="flex lg:flex-col items-center gap-2 flex-shrink-0 lg:pt-1">
                                    <a href="{{ route('admin.campaign.show', $campaign->id) }}"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all w-full justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="hidden lg:inline">Detail</span>
                                    </a>

                                    <button type="button" @click="openReject = true"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-medium border border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 transition-all w-full justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <span class="hidden lg:inline">Tolak</span>
                                    </button>

                                    <button type="button" @click="openApprove = true"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all w-full justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="hidden lg:inline">Approve</span>
                                    </button>
                                </div>
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
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
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
                                    <h3 class="text-lg font-bold text-slate-800">Setujui Campaign?</h3>
                                </div>

                                <div class="px-6 py-4">
                                    <div class="bg-slate-50 rounded-xl p-4">
                                        <p class="text-xs text-slate-500 mb-1">Campaign yang akan disetujui:</p>
                                        <p class="font-bold text-slate-800 text-sm line-clamp-2">{{ $campaign->title }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-2">
                                            <div
                                                class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center text-[9px] font-bold text-blue-600">
                                                {{ strtoupper(substr($campaign->user->name ?? '?', 0, 1)) }}
                                            </div>
                                            <span class="text-xs text-slate-500">{{ $campaign->user->name ?? '-' }}</span>
                                            <span class="text-xs text-slate-400">•</span>
                                            <span class="text-xs font-semibold text-slate-600">Rp
                                                {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 text-center mt-3">
                                        Campaign akan langsung dipublikasikan ke halaman utama.
                                    </p>
                                </div>

                                <div class="px-6 pb-6 flex gap-3">
                                    <button type="button" @click="openApprove = false"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                        Batal
                                    </button>
                                    <form method="POST" action="{{ route('admin.approve.campaign', $campaign->id) }}"
                                        class="flex-1">
                                        @csrf
                                        <button type="submit"
                                            class="w-full px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 transition-all">
                                            Ya, Approve
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
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
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
                                    <h3 class="text-lg font-bold text-slate-800">Tolak Campaign</h3>
                                </div>

                                <div class="px-6 py-4">
                                    <div class="bg-slate-50 rounded-xl p-4 text-center mb-4">
                                        <p class="text-sm text-slate-600">Menolak campaign</p>
                                        <p class="font-bold text-slate-800 mt-1 text-sm line-clamp-2">
                                            {{ $campaign->title }}</p>
                                    </div>

                                    <form method="POST" action="{{ route('admin.reject.campaign', $campaign->id) }}"
                                        class="space-y-3">
                                        @csrf
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                                Alasan Penolakan <span class="text-red-400">*</span>
                                            </label>
                                            <textarea name="reason" rows="3" required placeholder="Contoh: Judul tidak sesuai, deskripsi kurang jelas..."
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
                                    Tidak ada campaign pending dengan kata kunci
                                    <span class="font-semibold text-slate-600">"{{ request('q') }}"</span>
                                </p>
                                <a href="{{ route('admin.campaign') }}"
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
                                    Tidak ada campaign yang menunggu review saat ini.
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

        </div>
    </div>
@endsection
