@extends('layouts.app')

@section('title','Dashboard Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- HEADER --}}
        <div class="mb-12">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">
                Dashboard Admin
            </h1>
            <p class="text-gray-500 mt-2 max-w-2xl">
                Ringkasan data utama dan kontrol penuh terhadap platform donasi.
            </p>
        </div>

        {{-- STATS --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-14">

            {{-- TOTAL USER --}}
            <div
                class="bg-white rounded-2xl p-6 shadow-sm
                       border border-gray-100
                       hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">Total User</p>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 4a4 4 0 100-8 4 4 0 000 8z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold mt-4 text-gray-800">
                    {{ $totalUsers }}
                </p>
            </div>

            {{-- TOTAL CAMPAIGN --}}
            <div
                class="bg-white rounded-2xl p-6 shadow-sm
                       border border-gray-100
                       hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">Total Campaign</p>
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m4 0V9a2 2 0 00-2-2H7a2 2 0 00-2 2v8"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold mt-4 text-gray-800">
                    {{ $totalCampaigns }}
                </p>
            </div>

            {{-- TOTAL DONASI --}}
            <div
                class="bg-white rounded-2xl p-6 shadow-sm
                       border border-gray-100
                       hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">Total Donasi</p>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold mt-4 text-gray-800">
                    Rp {{ number_format($totalDonations,0,',','.') }}
                </p>
            </div>

        </div>

        {{-- QUICK ACTION --}}
        <div class="grid gap-6 md:grid-cols-2">

            {{-- PENGELOLA --}}
            <a href="{{ route('admin.pengelola') }}"
               class="group bg-white rounded-2xl p-6
                      shadow-sm border border-gray-100
                      hover:shadow-lg transition block">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 group-hover:text-green-600 transition">
                            Pengelola Pending
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Setujui atau tolak pengajuan pengelola dana.
                        </p>
                    </div>
                    <span class="text-green-500 text-xl">→</span>
                </div>
            </a>

            {{-- CAMPAIGN --}}
            <a href="{{ route('admin.campaign') }}"
               class="group bg-white rounded-2xl p-6
                      shadow-sm border border-gray-100
                      hover:shadow-lg transition block">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 group-hover:text-green-600 transition">
                            Campaign Pending
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Review dan verifikasi campaign baru.
                        </p>
                    </div>
                    <span class="text-green-500 text-xl">→</span>
                </div>
            </a>

        </div>

    </div>
</div>
@endsection
