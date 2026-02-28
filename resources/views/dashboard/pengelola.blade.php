@extends('layouts.app')

@section('title', 'Dashboard Pengelola')

@section('content')
    <div class="min-h-screen bg-gray-50">
        {{-- FLASH WARNING --}}
        @if (session('warning'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2500)" x-show="show" x-transition
                class="fixed top-24 right-6 z-[9999] w-full max-w-sm">
                <div class="relative overflow-hidden rounded-2xl bg-white shadow-xl border border-yellow-100">
                    <div class="flex items-start gap-4 p-5">

                        {{-- ICON --}}
                        <div class="flex-shrink-0">
                            <div class="w-9 h-9 rounded-full bg-yellow-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                        {{-- MESSAGE --}}
                        <div class="flex-1 text-sm text-gray-700 leading-relaxed">
                            {{ session('warning') }}
                        </div>

                        {{-- CLOSE --}}
                        <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- PROGRESS BAR --}}
                    <div class="absolute bottom-0 left-0 h-1 bg-yellow-500 animate-[shrink_2.5s_linear_forwards]"></div>
                </div>
            </div>
        @endif
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-10">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    Dashboard Pengelola
                </h1>
                <p class="text-gray-500 mt-2 max-w-2xl">
                    Pantau status campaign Anda dan kelola penggalangan dana dengan mudah.
                </p>
            </div>

            {{-- STATS --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-12">

                {{-- TOTAL --}}
                <div
                    class="bg-white rounded-2xl shadow-sm p-6
                        border border-gray-100 hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Total Campaign</p>
                    <p class="text-3xl font-bold mt-2 text-gray-800">
                        {{ $totalCampaign }}
                    </p>
                </div>

                {{-- AKTIF --}}
                <div
                    class="bg-white rounded-2xl shadow-sm p-6
                        border border-green-100 hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Campaign Aktif</p>
                    <p class="text-3xl font-bold mt-2 text-green-600">
                        {{ $approvedCampaign }}
                    </p>
                </div>

                {{-- PENDING --}}
                <div
                    class="bg-white rounded-2xl shadow-sm p-6
                        border border-yellow-100 hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Menunggu Verifikasi</p>
                    <p class="text-3xl font-bold mt-2 text-yellow-500">
                        {{ $pendingCampaign }}
                    </p>
                </div>

            </div>

            {{-- CAMPAIGN LIST --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">
                            Campaign Saya
                        </h2>
                        <p class="text-sm text-gray-500">
                            Riwayat campaign yang pernah Anda buat
                        </p>
                    </div>

                    <a href="{{ route('campaign.create') }}"
                        class="inline-flex items-center gap-2
                          bg-green-500 hover:bg-green-600
                          text-white px-5 py-2.5
                          rounded-xl text-sm font-semibold
                          transition">
                        + Buat Campaign
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-gray-500 border-b text-left">
                                <th class="py-3">Judul</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Target</th>
                                <th class="text-center">Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($campaigns as $campaign)
                                <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                                    <td class="py-4 font-medium text-gray-800">
                                        {{ $campaign->title }}
                                    </td>

                                    <td class="text-center">
                                        @php
                                            $statusStyle = match ($campaign->status) {
                                                'approved' => 'bg-green-100 text-green-700',
                                                'pending' => 'bg-yellow-100 text-yellow-700',
                                                default => 'bg-red-100 text-red-700',
                                            };
                                        @endphp

                                        <span
                                            class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $statusStyle }}">
                                            {{ ucfirst($campaign->status) }}
                                        </span>
                                    </td>

                                    <td class="text-center text-gray-700">
                                        Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                                    </td>

                                    <td class="text-center text-gray-500">
                                        {{ $campaign->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-14 text-gray-500">
                                        <p class="font-medium">
                                            Belum ada campaign
                                        </p>
                                        <p class="text-sm mt-1">
                                            Mulai buat campaign pertama Anda sekarang
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
