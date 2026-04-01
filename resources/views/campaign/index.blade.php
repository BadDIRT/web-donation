@extends('layouts.app')

@section('title', 'Semua Campaign')

@section('content')

    {{-- LETAKKAN KODE INI DI PALING ATAS CONTENT campaign.index --}}
    @if (request('target_reached'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
            class="mb-8 bg-green-50 border border-green-200 text-green-800 rounded-2xl p-5 flex items-start gap-4 shadow-sm">

            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <div class="flex-1">
                <h3 class="font-bold text-base sm:text-lg mb-1">🎉 Target Campaign Tercapai!</h3>
                <p class="text-sm sm:text-base text-green-700">
                    Terima kasih atas kontribusi luar biasa Anda. Berkat donasi tersebut, campaign telah berhasil mencapai
                    target yang ditetapkan.
                </p>
            </div>

            <button @click="show=false" class="flex-shrink-0 text-green-500 hover:text-green-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    {{-- ================= HERO HEADER ================= --}}
    <section class="relative bg-gradient-to-br from-green-100 via-green-50 to-white pt-36 pb-28 mb-10">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h1 class="relative inline-block text-4xl md:text-5xl font-extrabold text-gray-800 tracking-tight">
                Semua Campaign
                <span
                    class="absolute -bottom-4 left-1/2 -translate-x-1/2 w-28 h-1.5 bg-gradient-to-r from-green-400 to-green-600 rounded-full">
                </span>
            </h1>
            <p class="mt-10 text-gray-600 leading-relaxed text-lg">
                Temukan dan dukung campaign kebaikan yang sedang berlangsung.
                Setiap donasi membawa harapan baru bagi mereka yang membutuhkan.
            </p>
        </div>

        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" class="w-full h-16 fill-white">
                <path d="M0,32L1440,0L1440,60L0,60Z"></path>
            </svg>
        </div>
    </section>

    {{-- ================= WRAPPER ================= --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-10 pb-36 space-y-20">

        {{-- ================= INFO BAR ================= --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div class="relative bg-white rounded-2xl p-7 border shadow-sm overflow-hidden">
                <div class="absolute inset-y-0 left-0 w-1 bg-green-500"></div>
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3z" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-500">Total Campaign</p>
                </div>
                <p class="mt-4 text-2xl font-bold text-gray-800">
                    {{ $campaigns->total() }}
                </p>
            </div>

            <div class="relative bg-white rounded-2xl p-7 border shadow-sm overflow-hidden">
                <div class="absolute inset-y-0 left-0 w-1 bg-green-500"></div>
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-500">Campaign Aktif</p>
                </div>
                <p class="mt-4 text-2xl font-bold text-green-600">
                    {{ $campaigns->count() }}
                </p>
            </div>

            <div class="relative bg-gradient-to-br from-green-50 to-white rounded-2xl p-7 border shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 22v-2a6 6 0 0112 0v2" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-500">Partisipasi</p>
                </div>
                <p class="mt-4 text-gray-700 leading-relaxed">
                    Setiap kontribusi memiliki dampak nyata bagi banyak orang
                </p>
            </div>
        </div>

        {{-- ================= FILTER SECTION ================= --}}
        <div class="bg-gradient-to-br from-white to-green-50 rounded-3xl p-12 border shadow-sm space-y-14">

            {{-- SEARCH & SORT --}}
            <form method="GET" action="{{ route('campaign.index') }}"
                class="flex flex-col lg:flex-row lg:items-end gap-10">

                {{-- SEARCH --}}
                <div class="w-full lg:w-1/2">
                    <label class="text-sm font-semibold text-gray-600 mb-3 block">
                        Cari Campaign
                    </label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Masukkan kata kunci campaign"
                            class="w-full rounded-xl border border-gray-300
                                   pl-12 pr-4 py-3.5
                                   focus:ring-2 focus:ring-green-500 focus:outline-none">

                        <svg class="absolute left-4 top-1/2 -translate-y-1/2
                                    w-5 h-5 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m1.6-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                {{-- SORT --}}
                <div class="w-full lg:w-1/4">
                    <label class="text-sm font-semibold text-gray-600 mb-3 block">
                        Urutkan
                    </label>
                    <select name="sort" onchange="this.form.submit()"
                        class="w-full rounded-xl border border-gray-300
                               px-4 py-3.5
                               focus:ring-2 focus:ring-green-500">
                        <option value="">Default</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Terpopuler</option>
                        <option value="target_high" {{ request('sort') === 'target_high' ? 'selected' : '' }}>
                            Target Tertinggi
                        </option>
                        <option value="target_low" {{ request('sort') === 'target_low' ? 'selected' : '' }}>
                            Target Terendah
                        </option>
                    </select>
                </div>
            </form>

            <div class="border-t border-green-100"></div>

            {{-- CATEGORY --}}
            <div class="flex gap-3 overflow-x-auto">
                <a href="{{ route('campaign.index', request()->except('category')) }}"
                    class="px-5 py-2.5 rounded-full text-sm font-medium whitespace-nowrap
                    {{ request('category') ? 'bg-gray-100 text-gray-700 hover:bg-green-100' : 'bg-green-500 text-white shadow-md' }}">
                    Semua
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('campaign.index', array_merge(request()->all(), ['category' => $category->slug])) }}"
                        class="px-5 py-2.5 rounded-full text-sm whitespace-nowrap transition
                        {{ request('category') === $category->slug
                            ? 'bg-green-500 text-white shadow-md'
                            : 'bg-gray-100 text-gray-700 hover:bg-green-100 hover:text-green-700' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- ================= CAMPAIGN LIST ================= --}}
        @if ($campaigns->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-16">
                @foreach ($campaigns as $campaign)
                    @include('components.campaign-card')
                @endforeach
            </div>

            <div class="-mt-24">
                <div class="max-w-md mx-auto flex flex-col items-center gap-4 text-center">
                    {{ $campaigns->withQueryString()->links('components.pagination') }}
                </div>
            </div>
        @else
            <div class="text-center py-20">
                <svg class="mx-auto w-20 h-20 text-green-200" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                <h3 class="mt-10 text-2xl font-semibold text-gray-700">
                    Belum ada campaign
                </h3>
                <p class="text-gray-500 mt-4 max-w-md mx-auto">
                    Saat ini belum ada campaign yang tersedia.
                    Silakan kembali lagi nanti.
                </p>
            </div>
        @endif

    </div>

@endsection
