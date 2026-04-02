@extends('layouts.app')

@section('title', 'Semua Campaign')

@section('content')

    {{-- ================= CUSTOM STYLE ================= --}}
    <style>
        html {
            scroll-behavior: smooth;
        }

        .scroll-hide::-webkit-scrollbar {
            display: none;
        }

        .scroll-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>

    {{-- ================= ALERT TARGET REACHED ================= --}}
    @if (request('target_reached'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 flex items-start gap-3 shadow-sm">
                <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mt-0.5">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-sm sm:text-base">Selamat! Target Campaign Tercapai</h3>
                    <p class="text-xs sm:text-sm text-green-700 mt-0.5">Terima kasih atas kontribusi luar biasa Anda.
                        Campaign telah berhasil mencapai target.</p>
                </div>
                <button @click="show=false" class="flex-shrink-0 text-green-500 hover:text-green-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    {{-- ================= HERO HEADER ================= --}}
    <section
        class="bg-gradient-to-br from-green-600 via-green-500 to-emerald-400 pt-32 pb-20 md:pt-36 md:pb-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
        <div class="absolute top-1/2 left-1/4 w-40 h-40 bg-white/5 rounded-full"></div>

        <div class="relative max-w-4xl mx-auto px-6 text-center text-white">
            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight drop-shadow-sm">
                Temukan Campaign<br class="hidden sm:block"> Kebaikan
            </h1>
            <p class="mt-4 text-green-100 max-w-xl mx-auto text-sm md:text-lg">
                Jelajahi berbagai galangan dana yang terverifikasi dan mulai berbagi kebaikan hari ini.
            </p>
        </div>
    </section>

    {{-- ================= MAIN CONTENT WRAPPER ================= --}}
    {{-- Tidak ada -mt (margin negatif), diberi jarak normal dari hero --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 space-y-12 md:space-y-16">

        {{-- ================= SECTION: HAMPIR TERCAPAI (URGENCY) ================= --}}
        @php
            $urgentCampaign = \App\Models\Campaign::where('status', 'approved')
                ->where('target_amount', '>', 0)
                ->whereRaw('(current_amount / target_amount) >= 0.75')
                ->whereRaw('(current_amount / target_amount) < 1')
                ->inRandomOrder()
                ->first();
        @endphp

        @if ($urgentCampaign && !request()->hasAny(['search', 'category', 'sort', 'status']))
            <div
                class="relative overflow-hidden rounded-2xl border border-orange-100 bg-gradient-to-r from-orange-50 to-yellow-50 shadow-sm">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-2/5 relative">
                        <img src="{{ asset('storage/' . $urgentCampaign->image) }}"
                            class="w-full h-48 md:h-70 object-cover">
                        <div
                            class="absolute top-3 left-3 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full animate-pulse-slow flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tinggal Sedikit!
                        </div>
                    </div>
                    <div class="md:w-3/5 p-6 md:p-8 flex flex-col justify-center">
                        <div class="flex items-center gap-2.5 mb-3">
                            <svg class="w-6 h-6 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1.001A3.75 3.75 0 0012 18z" />
                            </svg>
                            <h3 class="text-lg md:text-xl font-bold text-gray-800">Campaign Yang Hampir Tercapai</h3>
                        </div>
                        <h4 class="text-md md:text-lg font-semibold text-green-700 hover:text-green-800 transition cursor-pointer mb-3"
                            onclick="window.location.href='{{ route('campaign.show', $urgentCampaign->slug) }}'">
                            {{ $urgentCampaign->title }}
                        </h4>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $urgentCampaign->description }}</p>

                        <div class="mb-5">
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="font-semibold text-orange-600">Rp
                                    {{ number_format($urgentCampaign->current_amount) }}</span>
                                <span class="text-gray-500">dari Rp
                                    {{ number_format($urgentCampaign->target_amount) }}</span>
                            </div>
                            <div class="w-full bg-orange-100 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-orange-500 h-full rounded-full transition-all"
                                    style="width: {{ ($urgentCampaign->current_amount / $urgentCampaign->target_amount) * 100 }}%">
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('campaign.show', $urgentCampaign->slug) }}"
                            class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow transition w-fit">
                            Donasi Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-5">Jelajahi Berdasarkan Kategori</h2>

        {{-- ================= FILTER CARD ================= --}}
        <div class="bg-white rounded-2xl shadow-xm border border-gray-100 p-4 md:p-6 space-y-4">
            <form method="GET" action="{{ route('campaign.index') }}"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
                <div class="sm:col-span-2 lg:col-span-2">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari campaign, pengelola..."
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <select name="sort" onchange="this.form.submit()"
                        class="w-full py-3 px-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 text-sm bg-white">
                        <option value="" {{ request('sort') === '' ? 'selected' : '' }}>Urutkan: Default</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Terpopuler</option>
                        <option value="target_high" {{ request('sort') === 'target_high' ? 'selected' : '' }}>Target
                            Tertinggi</option>
                    </select>
                </div>
                <div>
                    <select name="status" onchange="this.form.submit()"
                        class="w-full py-3 px-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 text-sm bg-white">
                        <option value="" {{ request('status') === '' ? 'selected' : '' }}>Status: Berlangsung
                        </option>
                        <option value="ended" {{ request('status') === 'ended' ? 'selected' : '' }}>Status: Selesai
                        </option>
                    </select>
                </div>
            </form>

            {{-- CATEGORIES & RESULTS INFO --}}
            <div class="relative group/category-scroll">
                {{-- Fade Out Indicator (Muncul saat bisa di-scroll) --}}
                <div
                    class="absolute right-0 top-0 bottom-0 w-10 bg-gradient-to-l from-white via-white/80 to-transparent z-10 pointer-events-none">
                </div>

                <div class="flex gap-2 overflow-x-auto scroll-hide pb-1 flex-nowrap">
                    <a href="{{ route('campaign.index', request()->except('category')) }}"
                        class="px-4 py-1.5 rounded-lg text-xs sm:text-sm font-medium whitespace-nowrap transition flex-shrink-0 {{ !request('category') ? 'bg-green-500 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-green-50' }}">Semua</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('campaign.index', array_merge(request()->all(), ['category' => $category->slug])) }}"
                            class="px-4 py-1.5 rounded-lg text-xs sm:text-sm font-medium whitespace-nowrap transition flex-shrink-0 {{ request('category') === $category->slug ? 'bg-green-500 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-green-50' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ================= SECTION: JELAJAHI KATEGORI ================= --}}
        @if (!request()->hasAny(['search', 'status']))
            <div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($categories->take(4) as $index => $cat)
                        @php
                            $count = \App\Models\Campaign::where('category_id', $cat->id)
                                ->where('status', 'approved')
                                ->count();
                        @endphp
                        <a href="{{ route('campaign.index', ['category' => $cat->slug]) }}"
                            class="group bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-lg hover:border-green-200 transition-all duration-300 flex flex-col items-center text-center gap-3">
                            <div
                                class="w-12 h-12 bg-green-50 text-green-600 group-hover:bg-green-100 rounded-xl flex items-center justify-center transition-colors duration-300">

                                @if ($index == 0)
                                    {{-- IKON AGAMA (Salib / simbol universal) --}}
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m-6-9h12" />
                                    </svg>
                                @elseif ($index == 1)
                                    {{-- IKON BENCANA ALAM (Segitiga peringatan) --}}
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3m0 4h.01M10.29 3.86L1.82 18a1.5 1.5 0 001.29 2.25h18.78a1.5 1.5 0 001.29-2.25L13.71 3.86a1.5 1.5 0 00-2.42 0z" />
                                    </svg>
                                @elseif ($index == 2)
                                    {{-- IKON EKONOMI (Grafik naik) --}}
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 17l6-6 4 4 8-8" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18" />
                                    </svg>
                                @else
                                    {{-- IKON HEWAN (Paw / jejak kaki) --}}
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <circle cx="5" cy="8" r="2" />
                                        <circle cx="19" cy="8" r="2" />
                                        <circle cx="12" cy="5" r="2" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 12c-2.5 0-4.5 2-4.5 4.5S9.5 21 12 21s4.5-2 4.5-4.5S14.5 12 12 12z" />
                                    </svg>
                                @endif

                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-sm">{{ $cat->name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $count }} Campaign</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ================= CAMPAIGN GRID ================= --}}
        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl md:text-2xl font-bold text-gray-800">Semua Campaign</h2>
            </div>

            @if ($campaigns->count())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach ($campaigns as $campaign)
                        @include('components.campaign-card')
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    <div class="inline-flex flex-col items-center gap-3">
                        {{ $campaigns->withQueryString()->links('components.pagination') }}
                    </div>
                </div>
            @else
                {{-- EMPTY STATE --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-10 md:p-16 text-center">
                    <div class="w-20 h-20 mx-auto bg-green-50 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-green-300" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Campaign Tidak Ditemukan</h3>
                    <p class="mt-2 text-gray-500 max-w-md mx-auto text-sm leading-relaxed">Maaf, tidak ada campaign yang
                        cocok dengan filter atau pencarian Anda saat ini.</p>
                    <a href="{{ route('campaign.index') }}"
                        class="mt-6 inline-flex items-center gap-2 bg-green-500 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-green-600 transition text-sm shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset Semua Filter
                    </a>
                </div>
            @endif
        </div>

        {{-- ================= BOTTOM CTA ================= --}}
        <div
            class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 border border-green-100">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-bold text-gray-800">Punya Ide Kebaikan?</h3>
                <p class="mt-1 text-gray-500 text-sm md:text-base">Mulai galang dana sekarang dan jadilah pengelola
                    campaign.</p>
            </div>
            @auth
                @if (auth()->user()->role === 'donatur')
                    <a href="{{ route('pengelola.terms') }}"
                        class="flex-shrink-0 bg-green-500 hover:bg-green-600 text-white px-8 py-3.5 rounded-xl font-semibold shadow-md transition w-full md:w-auto text-center">Jadi
                        Pengelola</a>
                @else
                    <a href="{{ route('campaign.create') }}"
                        class="flex-shrink-0 bg-green-500 hover:bg-green-600 text-white px-8 py-3.5 rounded-xl font-semibold shadow-md transition w-full md:w-auto text-center">Buat
                        Campaign</a>
                @endif
            @else
                <a href="{{ route('register') }}"
                    class="flex-shrink-0 bg-green-500 hover:bg-green-600 text-white px-8 py-3.5 rounded-xl font-semibold shadow-md transition w-full md:w-auto text-center">Daftar
                    Sekarang</a>
            @endauth
        </div>

    </div>
@endsection
