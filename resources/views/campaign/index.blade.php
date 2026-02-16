@extends('layouts.app')

@section('title','Semua Campaign')

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

    {{-- SEARCH & FILTER (UI) --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">

        {{-- SEARCH --}}
        <div class="relative w-full md:w-1/3">
            <input
                type="text"
                placeholder="Cari campaign..."
                class="w-full rounded-xl border border-gray-300 pl-12 pr-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none"
            >
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                🔍
            </span>
        </div>

        {{-- FILTER --}}
        <div class="flex gap-3 overflow-x-auto">
            <button class="px-5 py-2 rounded-full bg-green-500 text-white font-medium">
                Semua
            </button>
            <button class="px-5 py-2 rounded-full bg-white border hover:bg-green-50">
                Pendidikan
            </button>
            <button class="px-5 py-2 rounded-full bg-white border hover:bg-green-50">
                Kesehatan
            </button>
            <button class="px-5 py-2 rounded-full bg-white border hover:bg-green-50">
                Bencana
            </button>
        </div>

    </div>

    {{-- CAMPAIGN LIST --}}
    @if ($campaigns->count())
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($campaigns as $campaign)
                @include('components.campaign-card')
            @endforeach
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
