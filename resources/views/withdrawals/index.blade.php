@extends('layouts.app')

@section('title', 'Withdraw Request')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">
                    Pengajuan Penarikan
                </h1>
                <p class="text-gray-500 mt-1">
                    Daftar request penarikan yang menunggu persetujuan admin
                </p>
            </div>

            {{-- FILTER --}}
            <form method="GET" class="mb-6 flex flex-wrap gap-3 items-center">

                {{-- SEARCH --}}
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari user atau campaign..."
                    class="rounded-xl border border-gray-300
                px-4 py-2.5 text-sm w-64
                focus:ring-2 focus:ring-green-500">

                {{-- BUTTON --}}
                <button type="submit"
                    class="px-4 py-2.5 rounded-xl text-sm font-medium
                bg-green-500 hover:bg-green-600
                text-white transition">
                    Filter
                </button>

                {{-- RESET --}}
                <a href="{{ route('admin.withdrawals') }}"
                    class="px-4 py-2.5 rounded-xl text-sm
                border border-gray-300
                hover:bg-gray-100">
                    Reset
                </a>

            </form>

            {{-- STATUS SEARCH --}}
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
                <div
                    class="hidden md:grid grid-cols-12 px-6 py-4
                bg-gray-50 text-sm font-medium text-gray-500">
                    <div class="col-span-4">Campaign</div>
                    <div class="col-span-3">User</div>
                    <div class="col-span-2">Jumlah</div>
                    <div class="col-span-3 text-right">Aksi</div>
                </div>

                {{-- BODY --}}
                @forelse($withdraws as $w)
                    {{-- MOBILE --}}
                    <div class="md:hidden px-5 py-4 border-t space-y-2">

                        <div class="flex justify-between items-start">
                            <p class="font-medium text-gray-800 leading-snug">
                                {{ $w->campaign->title }}
                            </p>

                            <span class="text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                Pending
                            </span>
                        </div>

                        <p class="text-xs text-gray-500">
                            {{ $w->user->name }} •
                            Rp {{ number_format($w->amount, 0, ',', '.') }}
                        </p>

                        <div class="text-xs text-gray-400">
                            {{ $w->campaign->user->email }}
                        </div>

                        <div class="flex gap-2 pt-2">
                            <a href="{{ route('admin.withdrawals.show', $w->id) }}"
                                class="flex-1 text-center px-3 py-2 text-sm rounded-xl border">
                                Detail
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
                                {{ $w->campaign->title }}
                            </p>

                            <p class="text-xs text-gray-500">
                                ID: {{ $w->campaign->id }}
                            </p>
                        </div>

                        {{-- USER --}}
                        <div class="col-span-3 text-sm text-gray-600 min-w-0">
                            <p class="truncate">{{ $w->user->name }}</p>
                            <p class="text-xs text-gray-400 truncate">
                                {{ $w->user->email }}
                            </p>
                        </div>

                        {{-- AMOUNT --}}
                        <div class="col-span-2 text-green-600 font-semibold">
                            Rp {{ number_format($w->amount, 0, ',', '.') }}
                        </div>

                        {{-- ACTION --}}
                        <div class="col-span-3 flex justify-end gap-2 flex-wrap">

                            <span class="text-xs px-2 py-3 rounded-full bg-yellow-100 text-yellow-700">
                                Pending
                            </span>

                            <a href="{{ route('admin.withdrawals.show', $w->id) }}"
                                class="px-4 py-2 rounded-xl text-sm border">
                                Detail
                            </a>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-16 text-center text-gray-500">

                        @if (request('q'))
                            Tidak ditemukan data untuk
                            <span class="font-medium text-gray-700">
                                "{{ request('q') }}"
                            </span>
                        @else
                            Tidak ada pengajuan penarikan
                        @endif

                    </div>
                @endforelse

                {{-- PAGINATION --}}
                @if ($withdraws->hasPages())
                    <div class="px-6 py-4 border-t bg-gray-50">
                        {{ $withdraws->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
