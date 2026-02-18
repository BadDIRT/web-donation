@extends('layouts.app')

@section('title', 'Semua Campaign')

@section('content')

    {{-- ================= HEADER ================= --}}
    <section class="bg-green-50 py-14 mb-14">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-extrabold text-gray-800">
                Semua Campaign
            </h1>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                Temukan dan dukung campaign kebaikan yang sedang berlangsung.
                Setiap donasi membawa harapan baru.
            </p>
        </div>
    </section>

    {{-- ================= CONTENT ================= --}}
    <div class="container mx-auto px-4 pb-24">

        {{-- SEARCH & SORT --}}
        <form method="GET" action="{{ route('campaign.index') }}"
            class="flex flex-col lg:flex-row lg:items-center gap-6 mb-6">

            {{-- SEARCH --}}
            <div class="relative w-full lg:w-1/2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari campaign..."
                    class="w-full rounded-xl border border-gray-300 pl-12 pr-4 py-3
                       focus:ring-2 focus:ring-green-500 focus:outline-none">

                {{-- MODERN SEARCH ICON --}}
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m1.6-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            {{-- SORTING --}}
            <div class="w-full lg:w-1/4">
                <select name="sort" onchange="this.form.submit()"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3
                           focus:ring-2 focus:ring-green-500">
                    <option value="">Urutkan</option>
                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>🔥 Terpopuler</option>
                    <option value="target_high" {{ request('sort') === 'target_high' ? 'selected' : '' }}>
                        Target Tertinggi
                    </option>
                    <option value="target_low" {{ request('sort') === 'target_low' ? 'selected' : '' }}>
                        Target Terendah
                    </option>
                </select>
            </div>

        </form>

        {{-- CATEGORY (DI BAWAH SEARCH & SORT) --}}
        <div class="flex gap-3 overflow-x-auto pb-4 mb-10">
            <a href="{{ route('campaign.index', request()->except('category')) }}"
                class="px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap
           {{ request('category') ? 'bg-white border' : 'bg-green-500 text-white' }}">
                Semua
            </a>

            @foreach ($categories as $category)
                <a href="{{ route('campaign.index', array_merge(request()->all(), ['category' => $category->slug])) }}"
                    class="px-5 py-2 rounded-full text-sm border whitespace-nowrap
               {{ request('category') === $category->slug ? 'bg-green-500 text-white' : 'bg-white hover:bg-green-50' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        {{-- CAMPAIGN LIST --}}
        @if ($campaigns->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($campaigns as $campaign)
                    @include('components.campaign-card')
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="mt-14">
                {{ $campaigns->withQueryString()->links('components.pagination') }}
            </div>
        @else
            {{-- EMPTY STATE --}}
            <div class="text-center py-24">
                <div class="text-6xl mb-6">📭</div>
                <h3 class="text-xl font-semibold text-gray-700">
                    Belum ada campaign tersedia
                </h3>
                <p class="text-gray-500 mt-3">
                    Campaign kebaikan akan segera hadir.
                </p>
            </div>
        @endif

    </div>

@endsection
