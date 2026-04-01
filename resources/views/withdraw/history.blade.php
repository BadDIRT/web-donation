@extends('layouts.app')

@section('title', 'Riwayat Penarikan')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">
                    Riwayat Penarikan
                </h1>
                <p class="text-gray-500 mt-1">
                    Semua aktivitas penarikan dana Anda
                </p>
            </div>

            {{-- FILTER --}}
            <form method="GET" class="mb-6 flex flex-wrap gap-3 items-center">

                {{-- SEARCH --}}
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari campaign..."
                    class="rounded-xl border border-gray-300 px-4 py-2.5 text-sm w-64
                    focus:ring-2 focus:ring-green-500">

                {{-- STATUS --}}
                <select name="status"
                    class="rounded-xl border border-gray-300 px-4 py-2.5 text-sm
                    focus:ring-2 focus:ring-green-500">

                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                        Approved
                    </option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                        Rejected
                    </option>

                </select>

                {{-- BUTTON --}}
                <button type="submit"
                    class="px-4 py-2.5 rounded-xl text-sm font-medium
                    bg-green-500 hover:bg-green-600 text-white transition">
                    Filter
                </button>

                {{-- RESET --}}
                <a href="{{ route('withdraw.history') }}"
                    class="px-4 py-2.5 rounded-xl text-sm border border-gray-300 hover:bg-gray-100">
                    Reset
                </a>

            </form>

            {{-- LIST --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- HEADER DESKTOP --}}
                <div class="hidden md:grid grid-cols-12 px-6 py-4 bg-gray-50 text-sm font-medium text-gray-500">
                    <div class="col-span-4">Campaign</div>
                    <div class="col-span-2 text-center">Jumlah</div>
                    <div class="col-span-2 text-center">Status</div>
                    <div class="col-span-2 text-center">Tanggal</div>
                    <div class="col-span-2 text-right">Aksi</div>
                </div>

                {{-- BODY --}}
                @forelse($withdraws as $withdraw)
                    {{-- MOBILE --}}
                    <div class="md:hidden px-5 py-4 border-t space-y-2">

                        <div class="flex justify-between items-start">
                            <p class="font-medium text-gray-800 leading-snug">
                                {{ $withdraw->campaign->title ?? '-' }}
                            </p>

                            {{-- STATUS --}}
                            <span
                                class="text-xs px-2 py-1 rounded-full
                                {{ $withdraw->status == 'approved'
                                    ? 'bg-green-100 text-green-700'
                                    : ($withdraw->status == 'pending'
                                        ? 'bg-yellow-100 text-yellow-700'
                                        : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($withdraw->status) }}
                            </span>
                        </div>

                        <p class="text-xs text-gray-500">
                            Rp {{ number_format($withdraw->amount, 0, ',', '.') }}
                        </p>

                        <p class="text-xs text-gray-400">
                            {{ $withdraw->created_at->format('d M Y') }}
                        </p>

                        <div class="flex gap-2 pt-2">

                            {{-- DETAIL --}}
                            <a href="{{ route('withdraw.show', $withdraw->id) }}"
                                class="flex-1 text-center px-3 py-2 text-sm rounded-xl border">
                                Detail
                            </a>

                            {{-- BUKTI --}}
                            @if ($withdraw->transfer_proof)
                                <a href="{{ asset('storage/' . $withdraw->transfer_proof) }}" target="_blank"
                                    class="flex-1 text-center px-3 py-2 text-sm rounded-xl border border-green-300 text-green-600">
                                    Bukti
                                </a>
                            @endif

                        </div>

                    </div>

                    {{-- DESKTOP --}}
                    <div class="hidden md:grid grid-cols-12 px-6 py-5 border-t hover:bg-gray-50 transition items-center">

                        {{-- CAMPAIGN --}}
                        <div class="col-span-4">
                            <p class="font-medium text-gray-800 truncate">
                                {{ $withdraw->campaign->title ?? '-' }}
                            </p>
                        </div>

                        {{-- JUMLAH --}}
                        <div class="col-span-2 text-center font-semibold">
                            Rp {{ number_format($withdraw->amount, 0, ',', '.') }}
                        </div>

                        {{-- STATUS --}}
                        <div class="col-span-2 text-center">
                            <span
                                class="px-2 py-1 rounded-full text-xs
                                {{ $withdraw->status == 'approved'
                                    ? 'bg-green-100 text-green-700'
                                    : ($withdraw->status == 'pending'
                                        ? 'bg-yellow-100 text-yellow-700'
                                        : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($withdraw->status) }}
                            </span>
                        </div>

                        {{-- TANGGAL --}}
                        <div class="col-span-2 text-center text-gray-500 text-sm">
                            {{ $withdraw->created_at->format('d M Y') }}
                        </div>

                        {{-- AKSI --}}
                        <div class="col-span-2 flex justify-end gap-2">

                            <a href="{{ route('withdraw.show', $withdraw->id) }}"
                                class="px-4 py-2 rounded-xl text-sm border">
                                Detail
                            </a>

                            @if ($withdraw->transfer_proof)
                                <a href="{{ asset('storage/' . $withdraw->transfer_proof) }}" target="_blank"
                                    class="px-4 py-2 rounded-xl text-sm border border-green-300 text-green-600">
                                    Bukti
                                </a>
                            @endif

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-16 text-center text-gray-500">
                        Belum ada data penarikan
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
