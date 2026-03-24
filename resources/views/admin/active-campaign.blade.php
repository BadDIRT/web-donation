@extends('layouts.app')

@section('title', 'Campaign Aktif')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">
                    Campaign Aktif
                </h1>
                <p class="text-gray-500 mt-1">
                    Daftar campaign yang sudah disetujui dan sedang berjalan
                </p>
            </div>

            <form method="GET" class="mb-6 flex flex-wrap gap-3 items-center">

                {{-- SEARCH --}}
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Cari judul, ID, atau penggalang..."
                    class="rounded-xl border border-gray-300
        px-4 py-2.5 text-sm w-64
        focus:ring-2 focus:ring-green-500">

                {{-- STATUS FILTER --}}
                <select name="status"
                    class="rounded-xl border border-gray-300
        px-4 py-2.5 text-sm
        focus:ring-2 focus:ring-green-500">

                    <option value="">Semua Status</option>

                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="ended" {{ request('status') == 'ended' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>
                        Ditutup
                    </option>

                </select>

                {{-- SORT --}}
                <select name="sort"
                    class="rounded-xl border border-gray-300
        px-4 py-2.5 text-sm
        focus:ring-2 focus:ring-green-500">

                    <option value="">Terbaru</option>

                    <option value="target" {{ request('sort') == 'target' ? 'selected' : '' }}>
                        Target Terbesar
                    </option>

                    <option value="donation" {{ request('sort') == 'donation' ? 'selected' : '' }}>
                        Donasi Terbanyak
                    </option>

                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                        Terlama
                    </option>

                </select>

                {{-- BUTTON --}}
                <button type="submit"
                    class="px-4 py-2.5 rounded-xl text-sm font-medium
        bg-green-500 hover:bg-green-600
        text-white transition">
                    Filter
                </button>

                {{-- RESET --}}
                <a href="{{ route('admin.campaign.active') }}"
                    class="px-4 py-2.5 rounded-xl text-sm
        border border-gray-300
        hover:bg-gray-100">
                    Reset
                </a>

            </form>

            {{-- STATUS PENCARIAN --}}
            @if (request('q'))
                <p class="text-sm text-gray-500 mb-4">
                    Hasil pencarian untuk:
                    <span class="font-medium text-gray-700">
                        "{{ request('q') }}"
                    </span>
                </p>
            @endif

            {{-- LIST --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- HEADER DESKTOP --}}
                <div class="hidden md:grid grid-cols-12 px-6 py-4
        bg-gray-50 text-sm font-medium text-gray-500">
                    <div class="col-span-4">Campaign</div>
                    <div class="col-span-2">Status</div>
                    <div class="col-span-3">Penggalang</div>
                    <div class="col-span-3 text-right">Aksi</div>
                </div>

                {{-- BODY --}}
                @forelse($campaigns as $campaign)

                        {{-- MOBILE --}}
                        <div class="md:hidden px-5 py-4 border-t space-y-2">

                            <div class="flex justify-between items-start">
                                <p class="font-medium text-gray-800 leading-snug">
                                    {{ $campaign->title }}
                                </p>

                                {{-- STATUS --}}
                                <span
                                    class="text-xs px-2 py-1 rounded-full whitespace-nowrap
            @if ($campaign->status == 'approved') bg-green-100 text-green-700
            @elseif($campaign->status == 'ended') bg-blue-100 text-blue-700
            @elseif($campaign->status == 'closed') bg-red-100 text-red-700 @endif">
                                    @if ($campaign->status == 'approved')
                                        Aktif
                                    @elseif($campaign->status == 'ended')
                                        Selesai
                                    @elseif($campaign->status == 'closed')
                                        Ditutup
                                    @endif
                                </span>
                            </div>

                            <p class="text-xs text-gray-500">
                                ID: {{ $campaign->id }} •
                                Target: Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                            </p>

                            <div class="text-sm text-gray-600">
                                {{ $campaign->user->name }}
                                <div class="text-xs text-gray-400 break-all">
                                    {{ $campaign->user->email }}
                                </div>
                            </div>

                            <div class="flex gap-2 pt-2">
                                <a href="{{ route('admin.campaign.show', $campaign->id) }}"
                                    class="flex-1 text-center px-3 py-2 text-sm rounded-xl border">
                                    Detail
                                </a>

                                <a href="{{ route('campaign.show', $campaign->slug) }}"
                                    class="flex-1 text-center px-3 py-2 text-sm rounded-xl border border-blue-300 text-blue-600">
                                    Lihat
                                </a>
                            </div>
                        </div>

                        {{-- DESKTOP --}}
                        <div
                            class="hidden md:grid grid-cols-12
    px-6 py-5 border-t
    hover:bg-gray-50 transition items-center gap-3">

                            {{-- CAMPAIGN --}}
                            <div class="col-span-4 min-w-0">
                                <p class="font-medium text-gray-800 truncate">
                                    {{ $campaign->title }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    ID: {{ $campaign->id }} •
                                    Target: Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- STATUS --}}
                            <div class="col-span-2">
                                <span
                                    class="inline-block text-xs px-2 py-1 rounded-full whitespace-nowrap
            @if ($campaign->status == 'approved') bg-green-100 text-green-700
            @elseif($campaign->status == 'ended') bg-blue-100 text-blue-700
            @elseif($campaign->status == 'closed') bg-red-100 text-red-700 @endif">
                                    @if ($campaign->status == 'approved')
                                        Aktif
                                    @elseif($campaign->status == 'ended')
                                        Selesai
                                    @elseif($campaign->status == 'closed')
                                        Ditutup
                                    @endif
                                </span>
                            </div>

                            {{-- USER --}}
                            <div class="col-span-3 text-sm text-gray-600 min-w-0">
                                <p class="truncate">{{ $campaign->user->name }}</p>
                                <p class="text-xs text-gray-400 truncate">
                                    {{ $campaign->user->email }}
                                </p>
                            </div>

                            {{-- ACTION --}}
                            <div class="col-span-3 flex justify-end gap-2 flex-wrap">
                                <a href="{{ route('admin.campaign.show', $campaign->id) }}"
                                    class="px-4 py-2 rounded-xl text-sm border">
                                    Detail
                                </a>

                                <a href="{{ route('campaign.show', $campaign->slug) }}"
                                    class="px-4 py-2 rounded-xl text-sm border border-blue-300 text-blue-600">
                                    Lihat
                                </a>
                            </div>

                        </div>

                    @empty

                        <div class="px-6 py-16 text-center text-gray-500">

                            @if (request('q'))
                                Tidak ditemukan campaign dengan kata kunci
                                <span class="font-medium text-gray-700">
                                    "{{ request('q') }}"
                                </span>
                            @else
                                Tidak ada campaign aktif
                            @endif

                        </div>
                    @endforelse
                    {{-- PAGINATION --}}
                    @if ($campaigns->hasPages())
                        <div class="px-6 py-4 border-t bg-gray-50">
                            {{ $campaigns->links() }}
                        </div>
                    @endif
            </div>
        </div>
    </div>
@endsection
