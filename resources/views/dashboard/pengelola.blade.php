@extends('layouts.app')

@section('title', 'Dashboard Pengelola')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- HEADER --}}
        <div class="mb-10">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Dashboard Pengelola
            </h1>
            <p class="text-gray-500 mt-2 max-w-2xl">
                Kelola campaign penggalangan dana Anda, pantau status verifikasi,
                dan perkembangan campaign secara real-time.
            </p>
        </div>

        {{-- STATS --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-12">

            {{-- TOTAL --}}
            <div class="bg-white rounded-2xl shadow-sm p-6
                        border-l-4 border-green-500 hover:shadow-md transition">
                <p class="text-sm text-gray-500">Total Campaign</p>
                <p class="text-3xl font-bold mt-2 text-gray-800">
                    {{ $campaigns->count() }}
                </p>
            </div>

            {{-- AKTIF --}}
            <div class="bg-white rounded-2xl shadow-sm p-6
                        border-l-4 border-emerald-500 hover:shadow-md transition">
                <p class="text-sm text-gray-500">Campaign Aktif</p>
                <p class="text-3xl font-bold mt-2 text-emerald-600">
                    {{ $campaigns->where('status','approved')->count() }}
                </p>
            </div>

            {{-- PENDING --}}
            <div class="bg-white rounded-2xl shadow-sm p-6
                        border-l-4 border-yellow-400 hover:shadow-md transition">
                <p class="text-sm text-gray-500">Menunggu Verifikasi</p>
                <p class="text-3xl font-bold mt-2 text-yellow-500">
                    {{ $campaigns->where('status','pending')->count() }}
                </p>
            </div>

        </div>

        {{-- CAMPAIGN LIST --}}
        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        Campaign Saya
                    </h2>
                    <p class="text-sm text-gray-500">
                        Daftar campaign yang pernah Anda buat
                    </p>
                </div>

                <a href="{{ route('campaign.create') }}"
                   class="inline-flex items-center gap-2
                          bg-green-500 hover:bg-green-600
                          text-white px-5 py-2.5
                          rounded-xl text-sm font-semibold
                          shadow-sm transition">
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
                            <th class="text-center">Dibuat</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($campaigns as $campaign)
                            <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                                <td class="py-4 font-medium text-gray-800">
                                    {{ $campaign->title }}
                                </td>

                                <td class="text-center">
                                    @if ($campaign->status === 'approved')
                                        <span class="inline-flex px-3 py-1 rounded-full
                                                     text-xs font-medium
                                                     bg-green-100 text-green-700">
                                            Aktif
                                        </span>
                                    @elseif ($campaign->status === 'pending')
                                        <span class="inline-flex px-3 py-1 rounded-full
                                                     text-xs font-medium
                                                     bg-yellow-100 text-yellow-700">
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex px-3 py-1 rounded-full
                                                     text-xs font-medium
                                                     bg-red-100 text-red-700">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center text-gray-700">
                                    Rp {{ number_format($campaign->target_amount,0,',','.') }}
                                </td>

                                <td class="text-center text-gray-500">
                                    {{ $campaign->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-12 text-gray-500">
                                    Anda belum memiliki campaign
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
