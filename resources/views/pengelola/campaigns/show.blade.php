@extends('layouts.app')

@section('title', $campaign->title)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>

            {{-- COVER IMAGE --}}
            <div class="relative rounded-2xl overflow-hidden shadow-sm shadow-black/5 border border-slate-100 mb-6 group">
                <div class="aspect-video bg-slate-100">
                    @if ($campaign->image)
                        <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->title }}"
                            class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- FLOATING BADGE --}}
                <div class="absolute top-4 right-4">
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold uppercase tracking-wider backdrop-blur-md shadow-lg
                        {{ $campaign->status === 'pending'
                            ? 'bg-amber-500/90 text-white'
                            : ($campaign->status === 'approved'
                                ? 'bg-emerald-500/90 text-white'
                                : ($campaign->status === 'closed'
                                    ? 'bg-red-500/90 text-white'
                                    : 'bg-slate-500/90 text-white')) }}">
                        @if ($campaign->status === 'pending')
                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                        @elseif ($campaign->status === 'approved')
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        @endif
                        {{ ucfirst($campaign->status) }}
                    </span>
                </div>
            </div>

            {{-- CAMPAIGN INFO --}}
            <div x-data="{
                openEditTitle: false,
                openEditDesc: false,
                form: {
                    title: @js($campaign->title),
                    description: @js($campaign->description),
                }
            }"
                class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-6 sm:p-8 mb-6">

                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
                    <div class="min-w-0 flex-1">
                        {{-- TITLE + EDIT BUTTON --}}
                        <div class="flex items-start gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold text-slate-800 leading-tight flex-1">
                                {{ $campaign->title }}
                            </h1>
                            @if ($campaign->status === 'approved')
                                <button type="button"
                                    @click="form.title = @js($campaign->title); openEditTitle = true"
                                    class="flex-shrink-0 w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:text-emerald-600 hover:border-emerald-300 hover:bg-emerald-50 transition-all mt-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            @endif
                        </div>

                        <div class="flex flex-wrap items-center gap-3 mt-3">
                            <div class="flex items-center gap-1.5 text-xs text-slate-400">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $campaign->created_at->translatedFormat('d F Y') }}
                            </div>
                            <div class="w-px h-8 bg-slate-200 hidden sm:block"></div>
                            <span class="text-xs text-slate-400 font-mono">#{{ $campaign->id }}</span>
                        </div>
                    </div>
                </div>

                {{-- DESKRIPSI + EDIT BUTTON --}}
                @if ($campaign->description)
                    <div class="bg-slate-50 rounded-xl p-4 mb-6">
                        <div class="flex items-start justify-between gap-3">
                            <p class="text-sm text-slate-600 leading-relaxed flex-1">{{ $campaign->description }}</p>
                            @if ($campaign->status === 'approved')
                                <button type="button"
                                    @click="form.description = @js($campaign->description); openEditDesc = true"
                                    class="flex-shrink-0 w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:text-emerald-600 hover:border-emerald-300 hover:bg-emerald-50 transition-all">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                @else
                    @if ($campaign->status === 'approved')
                        <div class="mb-6">
                            <button type="button" @click="form.description = ''; openEditDesc = true"
                                class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-emerald-600 border border-dashed border-slate-200 hover:border-emerald-300 px-4 py-2.5 rounded-xl transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Deskripsi Singkat
                            </button>
                        </div>
                    @endif
                @endif

                {{-- FINANCIAL CARDS --}}
                @php
                    $progress =
                        $campaign->target_amount > 0
                            ? min(($campaign->current_amount / $campaign->target_amount) * 100, 100)
                            : 0;
                    $withdrawn = $campaign->current_amount - $campaign->current_amount_rd_pengelola;
                @endphp

                <div class="space-y-4">
                    {{-- TARGET (HERO) --}}
                    <div
                        class="relative bg-gradient-to-br from-emerald-600 via-green-600 to-teal-600 rounded-2xl p-6 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2">
                        </div>
                        <div class="relative">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-4 h-4 text-emerald-200" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                <p class="text-sm font-medium text-emerald-200">Target Dana</p>
                            </div>
                            <p class="text-2xl sm:text-3xl font-extrabold text-white">
                                Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- 3 METRIC CARDS --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        {{-- TERKUMPUL --}}
                        <div
                            class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all group">
                            <div class="flex items-center gap-2 mb-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Terkumpul</p>
                            </div>
                            <p class="text-lg font-extrabold text-slate-800">
                                Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- SALDO PENGELOLA --}}
                        <div
                            class="bg-emerald-50/50 rounded-2xl p-5 border border-emerald-100 hover:shadow-md transition-all group">
                            <div class="flex items-center gap-2 mb-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">Saldo Tersedia
                                </p>
                            </div>
                            <p class="text-lg font-extrabold text-emerald-700">
                                Rp {{ number_format($campaign->current_amount_rd_pengelola, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- SUDAH DITARIK --}}
                        <div
                            class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all group">
                            <div class="flex items-center gap-2 mb-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Sudah Ditarik</p>
                            </div>
                            <p class="text-lg font-extrabold text-slate-800">
                                Rp {{ number_format($withdrawn, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- PROGRESS BAR --}}
                    <div class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Progress
                                Campaign</span>
                            <span
                                class="text-sm font-extrabold {{ $progress >= 100 ? 'text-emerald-600' : 'text-slate-700' }}">
                                {{ number_format($progress, 1) }}%
                            </span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                            <div class="h-3 rounded-full transition-all duration-700 ease-out
                                {{ $progress >= 100 ? 'bg-gradient-to-r from-emerald-400 to-teal-400' : 'bg-gradient-to-r from-emerald-500 to-green-500' }}"
                                style="width: {{ $progress }}%"></div>
                        </div>
                        @if ($progress >= 100)
                            <p class="text-xs text-emerald-600 font-medium mt-2 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Target telah tercapai!
                            </p>
                        @endif
                    </div>
                </div>

                {{-- ==================== MODAL EDIT TITLE ==================== --}}
                <div x-show="openEditTitle" x-cloak x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">

                    <div @click.outside="openEditTitle = false" x-show="openEditTitle" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden">

                        <div class="px-6 pt-8 pb-2 text-center">
                            <div
                                class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Ubah Judul Campaign</h3>
                        </div>

                        <div class="px-6 py-4">
                            <form method="POST" action="{{ route('pengelola.campaign.update', $campaign->id) }}"
                                class="space-y-3">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="update_type" value="title">

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Judul Baru <span class="text-red-400">*</span>
                                    </label>
                                    <input type="text" name="title" x-model="form.title" required maxlength="255"
                                        placeholder="Masukkan judul campaign..."
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                                </div>

                                <div class="flex gap-3 pt-1">
                                    <button type="button" @click="openEditTitle = false"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 transition-all">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- ==================== MODAL EDIT DESKRIPSI ==================== --}}
                <div x-show="openEditDesc" x-cloak x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">

                    <div @click.outside="openEditDesc = false" x-show="openEditDesc" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden">

                        <div class="px-6 pt-8 pb-2 text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Ubah Deskripsi Singkat</h3>
                        </div>

                        <div class="px-6 py-4">
                            <form method="POST" action="{{ route('pengelola.campaign.update', $campaign->id) }}"
                                class="space-y-3">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="update_type" value="description">

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Deskripsi <span class="text-red-400">*</span>
                                    </label>
                                    <textarea name="description" x-model="form.description" required maxlength="500" rows="4"
                                        placeholder="Tuliskan deskripsi singkat campaign..."
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none"></textarea>
                                    <p class="text-[11px] text-slate-400 mt-1">Maksimal 500 karakter</p>
                                </div>

                                <div class="flex gap-3 pt-1">
                                    <button type="button" @click="openEditDesc = false"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-blue-500 to-indigo-500 text-white hover:from-blue-600 hover:to-indigo-600 shadow-lg shadow-blue-500/20 transition-all">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ARTIKEL --}}
            <div x-data="{
                openEditArticle: false,
                form: { article: @js($campaign->article) }
            }"
                class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h2 class="font-bold text-slate-800">Konten Artikel</h2>
                    </div>

                    @if ($campaign->status === 'approved')
                        <button type="button"
                            @click="form.article = @js($campaign->article); openEditArticle = true"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 hover:text-emerald-700 hover:bg-emerald-50 px-3 py-1.5 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Ubah
                        </button>
                    @endif
                </div>

                @if ($campaign->article)
                    <div class="p-6 sm:p-8 prose prose-sm prose-slate max-w-none">
                        {!! nl2br(e($campaign->article)) !!}
                    </div>
                @else
                    <div class="p-6 sm:p-8 text-center">
                        @if ($campaign->status === 'approved')
                            <button type="button" @click="form.article = ''; openEditArticle = true"
                                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-400 hover:text-emerald-600 border border-dashed border-slate-200 hover:border-emerald-300 px-5 py-3 rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tulis Konten Artikel
                            </button>
                        @else
                            <p class="text-sm text-slate-400">Belum ada konten artikel</p>
                        @endif
                    </div>
                @endif

                {{-- ==================== MODAL EDIT ARTIKEL ==================== --}}
                <div x-show="openEditArticle" x-cloak x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">

                    <div @click.outside="openEditArticle = false" x-show="openEditArticle" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden">

                        <div class="px-6 pt-8 pb-2 text-center">
                            <div class="w-16 h-16 bg-violet-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-violet-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Ubah Konten Artikel</h3>
                            <p class="text-xs text-slate-500 mt-1">Tuliskan cerita lengkap campaign kamu</p>
                        </div>

                        <div class="px-6 py-4">
                            <form method="POST" action="{{ route('pengelola.campaign.update', $campaign->id) }}"
                                class="space-y-3">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="update_type" value="article">

                                <div>
                                    <textarea name="article" x-model="form.article" required rows="10"
                                        placeholder="Ceritakan secara detail mengenai campaign ini..."
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition-all resize-y min-h-[200px]"></textarea>
                                </div>

                                <div class="flex gap-3 pt-1">
                                    <button type="button" @click="openEditArticle = false"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-violet-500 to-purple-500 text-white hover:from-violet-600 hover:to-purple-600 shadow-lg shadow-violet-500/20 transition-all">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== BUAT KABAR TERBARU ==================== --}}
            @if ($campaign->status === 'approved')
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="font-bold text-slate-800">Kabar Terbaru</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Beri tahu donatur tentang perkembangan campaign ini
                            </p>
                        </div>

                        <a href="{{ route('pengelola.updates.create', $campaign->id) }}"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Kabar Terbaru
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
