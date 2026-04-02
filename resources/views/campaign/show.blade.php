@extends('layouts.app')

@section('title', $campaign->title)

@section('content')

    {{-- ================= HERO ================= --}}
    <section class="relative h-[60vh] sm:h-[75vh] lg:h-[85vh] -mt-[72px]">
        <img src="{{ asset('storage/' . $campaign->image) }}" class="absolute inset-0 w-full h-full object-cover"
            alt="{{ $campaign->title }}">

        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/10"></div>

        {{-- decorative subtle grain --}}
        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 256 256%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.9%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22/%3E%3C/svg%3E');">
        </div>

        <div class="relative h-full flex items-end">
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pb-14 sm:pb-20 lg:pb-24 text-white">
                <div class="max-w-4xl">
                    <span
                        class="inline-flex items-center gap-1.5 mb-4 sm:mb-5 px-4 sm:px-5 py-1.5 sm:py-2 text-xs sm:text-sm font-medium rounded-full bg-emerald-500/90 backdrop-blur-sm shadow-lg shadow-emerald-500/20 border border-emerald-400/30">
                        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        {{ $campaign->category->name }}
                    </span>

                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold leading-tight drop-shadow-lg">
                        {{ $campaign->title }}
                    </h1>

                    <div class="mt-3 sm:mt-4 flex items-center gap-3 text-sm text-white/70">
                        @if ($campaign->user)
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-7 h-7 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-xs font-bold">
                                    {{ strtoupper(substr($campaign->user->name, 0, 1)) }}
                                </div>
                                <span>{{ $campaign->user->name }}</span>
                            </div>
                            <span class="text-white/30">•</span>
                        @endif
                        <span>{{ $campaign->created_at->translatedFormat('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= PAGE WRAPPER ================= --}}
    <section class="bg-gradient-to-br from-slate-50 via-white to-emerald-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 lg:py-20">

            {{-- Stats Bar --}}
            <div class="grid grid-cols-3 gap-3 sm:gap-4 -mt-14 sm:-mt-16 relative z-10 mb-8 sm:mb-12">
                <div class="bg-white rounded-2xl shadow-lg shadow-black/5 p-4 sm:p-5 text-center border border-slate-100">
                    <p class="text-[10px] sm:text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Terkumpul
                    </p>
                    <p class="text-sm sm:text-lg lg:text-xl font-extrabold text-emerald-600">Rp
                        {{ number_format($campaign->current_amount) }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg shadow-black/5 p-4 sm:p-5 text-center border border-slate-100">
                    <p class="text-[10px] sm:text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Target</p>
                    <p class="text-sm sm:text-lg lg:text-xl font-extrabold text-slate-700">Rp
                        {{ number_format($campaign->target_amount) }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg shadow-black/5 p-4 sm:p-5 text-center border border-slate-100">
                    <p class="text-[10px] sm:text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Donatur</p>
                    <p class="text-sm sm:text-lg lg:text-xl font-extrabold text-slate-700">
                        {{ $campaign->donations()->where('status', 'success')->count() }}</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-10">

                {{-- ================= LEFT CONTENT ================= --}}
                <div class="lg:col-span-2 space-y-6 sm:space-y-8">

                    {{-- DESCRIPTION CARD --}}
                    <div
                        class="bg-white rounded-2xl lg:rounded-3xl shadow-sm shadow-black/5 border border-slate-100 p-5 sm:p-8 lg:p-10">
                        <div class="flex items-center gap-2.5 mb-4 sm:mb-5">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-800">Tentang Campaign</h2>
                        </div>
                        <p class="text-slate-600 leading-relaxed text-sm sm:text-base lg:text-[17px]">
                            {{ $campaign->description }}
                        </p>
                    </div>

                    {{-- ARTICLE CARD --}}
                    @if ($campaign->article)
                        <div
                            class="bg-white rounded-2xl lg:rounded-3xl shadow-sm shadow-black/5 border border-slate-100 p-5 sm:p-8 lg:p-10">
                            <div class="flex items-center gap-2.5 mb-5 sm:mb-6">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h2 class="text-lg sm:text-xl font-bold text-slate-800">Cerita Lengkap</h2>
                            </div>
                            <article
                                class="prose prose-sm sm:prose-base lg:prose-lg max-w-none
                                prose-headings:text-slate-800 prose-headings:font-bold
                                prose-p:text-slate-600 prose-p:leading-relaxed
                                prose-img:rounded-xl prose-img:shadow-md
                                prose-a:text-emerald-600 prose-a:no-underline hover:prose-a:underline
                                prose-li:text-slate-600">
                                {!! $campaign->article !!}
                            </article>
                        </div>
                    @endif

                    {{-- DOA & DUKUNGAN --}}
                    <div
                        class="bg-white rounded-2xl lg:rounded-3xl shadow-sm shadow-black/5 border border-slate-100 p-5 sm:p-8 lg:p-10">
                        <div class="flex items-center gap-2.5 mb-5 sm:mb-6">
                            <div class="w-8 h-8 rounded-lg bg-violet-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-800">Doa & Dukungan</h2>
                        </div>

                        <div class="space-y-3">
                            @forelse ($campaign->donations()
                                                    ->where('status','success')
                                                    ->latest()
                                                    ->take(5)
                                                    ->get() as $donation)
                                <div
                                    class="group bg-slate-50 hover:bg-emerald-50/50 rounded-xl p-4 border border-slate-100 hover:border-emerald-200 transition-colors duration-200">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div
                                                class="w-9 h-9 rounded-full {{ $donation->anonymous ? 'bg-slate-200' : 'bg-emerald-100' }} flex items-center justify-center flex-shrink-0">
                                                @if ($donation->anonymous)
                                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                @else
                                                    <span
                                                        class="text-xs font-bold text-emerald-700">{{ strtoupper(substr($donation->donor_name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-semibold text-slate-700 text-sm truncate">
                                                    {{ $donation->anonymous ? 'Hamba Allah' : $donation->donor_name }}
                                                </p>
                                                <p class="text-xs text-slate-400 mt-0.5">
                                                    {{ $donation->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                        <p class="text-sm font-bold text-emerald-600 flex-shrink-0">
                                            Rp {{ number_format($donation->amount) }}
                                        </p>
                                    </div>
                                    @if ($donation->message)
                                        <div class="mt-3 pl-12">
                                            <p class="text-slate-500 text-sm italic leading-relaxed">
                                                "{{ $donation->message }}"
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div
                                        class="w-12 h-12 mx-auto mb-3 rounded-full bg-slate-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 text-sm">Belum ada doa & dukungan</p>
                                    <p class="text-slate-300 text-xs mt-1">Jadilah yang pertama berdonasi</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                {{-- ================= RIGHT SIDEBAR ================= --}}
                <aside class="lg:col-span-1">
                    <div class="lg:sticky lg:top-28 space-y-5 sm:space-y-6">

                        {{-- PROGRESS --}}
                        <div
                            class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 sm:p-6 overflow-hidden relative">
                            <div
                                class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-400 via-emerald-500 to-teal-500">
                            </div>

                            <div class="flex justify-between items-end text-xs sm:text-sm mb-3">
                                <span class="text-slate-400 font-medium">Terkumpul</span>
                                <span class="font-extrabold text-slate-800 text-sm sm:text-base">
                                    Rp {{ number_format($campaign->current_amount) }}
                                </span>
                            </div>

                            <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                                <div id="progress-bar"
                                    class="bg-gradient-to-r from-emerald-400 via-emerald-500 to-teal-500 h-full rounded-full transition-all duration-[1.5s] ease-out relative"
                                    style="width:0%">
                                    <div class="absolute inset-0 bg-white/20 animate-[shimmer_2s_infinite] rounded-full"
                                        style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mt-2.5">
                                <p class="text-xs sm:text-sm text-slate-500">
                                    <span
                                        class="font-bold text-emerald-600">{{ number_format($campaign->progress_percent, 1) }}%</span>
                                    dari target
                                </p>
                                @if ($campaign->current_amount >= $campaign->target_amount)
                                    <span
                                        class="inline-flex items-center gap-1 text-[10px] sm:text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Tercapai
                                    </span>
                                @endif
                            </div>

                            @if ($campaign->deadline)
                                <div
                                    class="mt-3.5 pt-3.5 border-t border-slate-100 flex items-center gap-2 text-xs sm:text-sm text-amber-600 bg-amber-50/50 -mx-5 sm:-mx-6 px-5 sm:px-6 py-2.5">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-medium"><span id="countdown"></span></span>
                                </div>
                            @endif
                        </div>

                        {{-- TOP DONORS --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 sm:p-6">
                            <div class="flex items-center gap-2.5 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-sm sm:text-base text-slate-800">Top Donatur</h3>
                            </div>

                            <div class="space-y-2.5">
                                @foreach ($topDonors as $index => $donor)
                                    <div
                                        class="flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-50 transition-colors duration-150">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div
                                                class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center text-xs font-bold shadow-sm
                                                @if ($index == 0) bg-gradient-to-br from-amber-300 to-amber-500 text-white
                                                @elseif($index == 1) bg-gradient-to-br from-slate-300 to-slate-400 text-white
                                                @elseif($index == 2) bg-gradient-to-br from-orange-300 to-orange-500 text-white
                                                @else bg-slate-100 text-slate-500 @endif">
                                                {{ $index + 1 }}
                                            </div>
                                            <p class="font-semibold text-slate-700 truncate text-sm">
                                                {{ $donor->donor_name ?? 'Hamba Allah' }}
                                            </p>
                                        </div>
                                        <p class="text-xs font-bold text-emerald-600 flex-shrink-0 ml-3">
                                            Rp {{ number_format($donor->total) }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- DONATION FORM --}}
                        <div id="donation-form"
                            class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-5 sm:px-6 py-4">
                                <h3 class="text-base sm:text-lg font-bold text-white flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Donasi Sekarang
                                </h3>
                                <p class="text-emerald-100 text-xs mt-1">Setiap rupiah sangat berarti bagi mereka</p>
                            </div>

                            <form id="donation-form-inner" class="p-5 sm:p-6 space-y-4">
                                @csrf
                                @method('POST')

                                {{-- AMOUNT --}}
                                <div>
                                    <label
                                        class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 block">
                                        Nominal Donasi
                                    </label>

                                    <div class="relative">
                                        <span
                                            class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-medium">Rp</span>
                                        <input id="amount_display" placeholder="10.000"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 text-base lg:text-lg font-bold text-slate-800 placeholder:text-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-shadow bg-slate-50 focus:bg-white">
                                        <input type="hidden" name="amount" id="amount" required>
                                    </div>

                                    <div class="grid grid-cols-3 gap-2 mt-3">
                                        <button type="button"
                                            class="quick-amount px-2 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-700 transition-all duration-150 active:scale-95"
                                            data-amount="10000">
                                            10rb
                                        </button>
                                        <button type="button"
                                            class="quick-amount px-2 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-700 transition-all duration-150 active:scale-95"
                                            data-amount="20000">
                                            20rb
                                        </button>
                                        <button type="button"
                                            class="quick-amount px-2 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-700 transition-all duration-150 active:scale-95"
                                            data-amount="50000">
                                            50rb
                                        </button>
                                        <button type="button"
                                            class="quick-amount px-2 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-700 transition-all duration-150 active:scale-95"
                                            data-amount="100000">
                                            100rb
                                        </button>
                                        <button type="button"
                                            class="quick-amount px-2 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-700 transition-all duration-150 active:scale-95"
                                            data-amount="200000">
                                            200rb
                                        </button>
                                        <button type="button"
                                            class="quick-amount px-2 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-700 transition-all duration-150 active:scale-95"
                                            data-amount="500000">
                                            500rb
                                        </button>
                                    </div>
                                </div>

                                <input type="text" name="donor_name" placeholder="Nama Donatur (opsional)"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white placeholder:text-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-shadow">

                                <label
                                    class="flex items-center gap-2.5 text-sm text-slate-600 cursor-pointer py-1 px-1 hover:bg-slate-50 rounded-lg transition-colors">
                                    <div class="relative">
                                        <input type="checkbox" name="anonymous" value="1" class="peer sr-only">
                                        <div
                                            class="w-5 h-5 rounded-md border-2 border-slate-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-500 transition-colors flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity"
                                                fill="none" stroke="currentColor" stroke-width="3"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    Donasi sebagai anonim
                                </label>

                                <textarea name="message" rows="2" placeholder="Tulis doa / pesan untuk mereka..."
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white placeholder:text-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-shadow resize-none"></textarea>

                                <button id="donate-btn"
                                    class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white py-3.5 rounded-xl font-bold shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 transition-all duration-200 text-sm sm:text-base active:scale-[0.98]">
                                    Donasi Sekarang
                                </button>
                            </form>

                            <div
                                class="px-5 sm:px-6 pb-5 flex items-center justify-center gap-2 text-[10px] sm:text-xs text-slate-400">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Transaksi aman & terenkripsi
                            </div>
                        </div>

                    </div>
                </aside>

            </div>
        </div>

        <div class="h-20 lg:hidden"></div>
    </section>

    {{-- ================= MOBILE DONATE BAR ================= --}}
    <div id="mobile-donate-bar"
        class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-lg border-t border-slate-200/50 p-3 sm:p-4 lg:hidden z-50">
        <button onclick="document.querySelector('#donation-form').scrollIntoView({behavior:'smooth'})"
            class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 active:from-emerald-700 active:to-teal-700 text-white py-3 rounded-xl font-bold shadow-lg shadow-emerald-500/25 transition-all text-sm sm:text-base active:scale-[0.98]">
            💚 Donasi Sekarang
        </button>
    </div>

    {{-- ================= SNAP JS ================= --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    {{-- ================= PAYMENT STATUS TOAST ================= --}}
    @if (request('payment'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2500)" x-show="show" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed top-20 sm:top-24 left-3 right-3 sm:left-auto sm:right-6 sm:w-full sm:max-w-sm z-[9999]">
            <div
                class="relative overflow-hidden rounded-2xl bg-white shadow-2xl shadow-black/10 backdrop-blur-sm
                @if (request('payment') == 'success') border border-emerald-200
                @elseif(request('payment') == 'pending') border border-amber-200
                @elseif(request('payment') == 'failed') border border-red-200
                @else border border-slate-200 @endif">
                <div class="flex items-start gap-4 p-4 sm:p-5">
                    <div class="flex-shrink-0">
                        @if (request('payment') == 'success')
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        @elseif(request('payment') == 'pending')
                            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2 2" />
                                </svg>
                            </div>
                        @elseif(request('payment') == 'failed')
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        @else
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 text-sm text-slate-700 leading-relaxed">
                        @if (request('payment') == 'success')
                            <p class="font-semibold text-emerald-700">Pembayaran berhasil</p>
                            <p class="text-slate-500 text-xs mt-0.5">Terima kasih atas donasi Anda 🎉</p>
                        @elseif(request('payment') == 'pending')
                            <p class="font-semibold text-amber-700">Pembayaran pending</p>
                            <p class="text-slate-500 text-xs mt-0.5">Menunggu pembayaran selesai ⏳</p>
                        @elseif(request('payment') == 'failed')
                            <p class="font-semibold text-red-700">Pembayaran gagal</p>
                            <p class="text-slate-500 text-xs mt-0.5">Silakan coba lagi ❌</p>
                        @else
                            <p class="font-semibold text-slate-700">Transaksi dibatalkan</p>
                        @endif
                    </div>
                    <button @click="show=false" class="text-slate-300 hover:text-slate-500 flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div
                    class="absolute bottom-0 left-0 h-1
                    @if (request('payment') == 'success') bg-emerald-500
                    @elseif(request('payment') == 'pending') bg-amber-500
                    @elseif(request('payment') == 'failed') bg-red-500
                    @else bg-slate-500 @endif
                    animate-[shrink_2.5s_linear_forwards]">
                </div>
            </div>
        </div>
    @endif

    {{-- ================= ERROR POPUP ================= --}}
    <div id="error-popup" class="fixed inset-0 z-[9999] flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
            onclick="document.getElementById('error-popup').classList.add('hidden')"></div>
        <div
            class="relative bg-white rounded-2xl shadow-2xl shadow-black/10 p-6 sm:p-8 w-[calc(100%-2rem)] max-w-md text-center">
            <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-red-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1.5">Gagal Donasi</h3>
            <p id="error-popup-message" class="text-slate-500 text-sm mb-5">Terjadi kesalahan</p>
            <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                <div id="error-popup-bar" class="h-2 bg-red-500 rounded-full" style="width:100%"></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                function showErrorPopup(message) {
                    const popup = document.getElementById('error-popup');
                    const bar = document.getElementById('error-popup-bar');
                    const text = document.getElementById('error-popup-message');

                    if (!popup) return;

                    text.innerText = message || 'Terjadi kesalahan';
                    popup.classList.remove('hidden');

                    bar.style.transition = 'none';
                    bar.style.width = '100%';
                    bar.offsetHeight;
                    bar.style.transition = 'width 6s linear';
                    bar.style.width = '0%';

                    setTimeout(() => {
                        popup.classList.add('hidden');
                        bar.style.transition = 'none';
                        bar.style.width = '100%';
                    }, 6000);
                }

                const isFull = {{ $campaign->current_amount >= $campaign->target_amount ? 'true' : 'false' }};

                if (isFull) {
                    const btn = document.getElementById('donate-btn');
                    const mobileBtn = document.querySelector('#mobile-donate-bar button');

                    if (btn) {
                        btn.disabled = true;
                        btn.innerText = 'Target Tercapai';
                        btn.classList.replace('bg-gradient-to-r', 'bg-slate-300');
                        btn.classList.remove('from-emerald-500', 'to-teal-500', 'hover:from-emerald-600',
                            'hover:to-teal-600', 'shadow-lg', 'shadow-emerald-500/25', 'hover:shadow-emerald-500/40'
                        );
                        btn.classList.add('cursor-not-allowed');
                    }

                    if (mobileBtn) {
                        mobileBtn.disabled = true;
                        mobileBtn.innerText = 'Target Tercapai';
                        mobileBtn.classList.replace('bg-gradient-to-r', 'bg-slate-300');
                        mobileBtn.classList.remove('from-emerald-500', 'to-teal-500', 'hover:from-emerald-600',
                            'hover:to-teal-600', 'shadow-lg', 'shadow-emerald-500/25');
                        mobileBtn.classList.add('cursor-not-allowed');
                    }
                }

                // ================= PROGRESS BAR =================
                const percent = {{ $campaign->progress_percent }};
                const progressBar = document.getElementById("progress-bar");

                if (progressBar) {
                    setTimeout(() => {
                        progressBar.style.width = Math.min(percent, 100) + "%";
                    }, 300);
                }

                // ================= COUNTDOWN =================
                const deadline = "{{ $campaign->deadline }}";
                if (deadline) {
                    const countdownEl = document.getElementById('countdown');
                    const countdownBarEl = document.getElementById('countdown-bar');

                    setInterval(() => {
                        if (!countdownEl) return;

                        const diff = new Date(deadline) - new Date();

                        if (diff <= 0) {
                            countdownEl.innerText = 'Campaign berakhir';
                            if (countdownBarEl) countdownBarEl.innerText = 'Berakhir';
                            return;
                        }

                        const d = Math.floor(diff / 86400000);
                        const h = Math.floor((diff / 3600000) % 24);
                        const m = Math.floor((diff / 60000) % 60);

                        const text = `${d} hari ${h} jam ${m} menit`;
                        countdownEl.innerText = text;
                        if (countdownBarEl) countdownBarEl.innerText = text;
                    }, 1000);
                }

                // ================= FORMAT INPUT =================
                const displayInput = document.getElementById('amount_display');
                const realInput = document.getElementById('amount');

                if (displayInput) {
                    displayInput.addEventListener('input', function() {
                        let value = this.value.replace(/\D/g, '');

                        if (!value) {
                            realInput.value = '';
                            this.value = '';
                            return;
                        }

                        realInput.value = value;
                        this.value = new Intl.NumberFormat('id-ID').format(value);
                    });
                }

                // ================= QUICK AMOUNT =================
                document.querySelectorAll('.quick-amount').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const value = this.dataset.amount;

                        realInput.value = value;
                        displayInput.value = new Intl.NumberFormat('id-ID').format(value);

                        document.querySelectorAll('.quick-amount').forEach(b => {
                            b.classList.remove('bg-emerald-500', 'text-white',
                                'border-emerald-500', 'hover:bg-emerald-50',
                                'hover:border-emerald-300', 'hover:text-emerald-700');
                            b.classList.add('border-slate-200', 'text-slate-600');
                        });

                        this.classList.remove('border-slate-200', 'text-slate-600',
                            'hover:bg-emerald-50', 'hover:border-emerald-300',
                            'hover:text-emerald-700');
                        this.classList.add('bg-emerald-500', 'text-white', 'border-emerald-500');
                    });
                });

                // ================= SUBMIT DONATION =================
                const form = document.getElementById('donation-form-inner');
                const maxAmount = {{ $campaign->target_amount - $campaign->current_amount }};

                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const btn = document.getElementById('donate-btn');
                        const amount = realInput.value;

                        if (!amount || parseInt(amount) < 1000) {
                            showErrorPopup('Minimal donasi Rp 1.000');
                            return;
                        }

                        if (parseInt(amount) > maxAmount) {
                            showErrorPopup('Donasi melebihi sisa target campaign');
                            return;
                        }

                        btn.disabled = true;
                        btn.innerText = 'Memproses...';

                        fetch("{{ route('donate', $campaign->id) }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    amount: amount,
                                    donor_name: form.donor_name.value,
                                    anonymous: form.anonymous.checked,
                                    message: form.message.value
                                })
                            })
                            .then(async res => {
                                const data = await res.json();

                                if (!res.ok) {
                                    showErrorPopup(data.error || 'Terjadi kesalahan');
                                    throw new Error(data.error);
                                }

                                return data;
                            })
                            .then(data => {
                                if (!data.snapToken) {
                                    throw new Error('Snap token tidak ditemukan');
                                }

                                window.snap.pay(data.snapToken, {
                                    onPending: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=pending",
                                    onError: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=failed",
                                    onClose: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=cancel",
                                    onSuccess: function(result) {
                                        const currentAmount = {{ $campaign->current_amount }};
                                        const targetAmount = {{ $campaign->target_amount }};
                                        const donatedAmount = parseInt(amount);

                                        const isTargetReached = (currentAmount +
                                            donatedAmount) >= targetAmount;

                                        if (isTargetReached) {
                                            window.location.href =
                                                "{{ route('campaign.index') }}?target_reached=1";
                                        } else {
                                            window.location.href =
                                                "{{ route('campaign.show', $campaign->slug) }}?payment=success";
                                        }
                                    },
                                    onPending: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=pending",
                                    onError: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=failed",
                                    onClose: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=cancel"
                                });
                            })
                            .catch(err => {
                                console.error(err);
                                btn.disabled = false;
                                btn.innerText = 'Donasi Sekarang';
                            });
                    });
                }

            });
        </script>
    @endpush

@endsection
