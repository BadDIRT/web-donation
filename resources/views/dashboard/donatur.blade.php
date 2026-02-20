@extends('layouts.app')

@section('title','Dashboard Donatur')

@section('content')

{{-- HEADER --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Donatur</h1>
    <p class="text-gray-500 mt-1">
        Riwayat donasi & kesempatan menjadi penggalang dana
    </p>
</div>

{{-- CTA PENGGALANG DANA --}}
@if(auth()->user()->role === 'donatur')
<div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-2xl p-6 mb-10 shadow-lg">
    <h2 class="text-xl font-semibold">
        Ingin Menggalang Dana?
    </h2>
    <p class="text-sm text-white/90 mt-2 max-w-2xl">
        Kamu bisa membuat campaign penggalangan dana sendiri dan membantu lebih banyak orang.
        Ajukan diri sebagai penggalang dana sekarang.
    </p>

    <a href="{{ route('pengelola.terms') }}"
       class="inline-block mt-4 bg-white text-green-600 font-semibold px-5 py-2 rounded-xl hover:bg-gray-100 transition">
        Ajukan Penggalangan Dana
    </a>
</div>
@endif

{{-- RIWAYAT DONASI --}}
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b">
        <h2 class="text-lg font-semibold">Riwayat Donasi</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="p-4 text-left">Campaign</th>
                    <th class="p-4 text-left">Jumlah</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-4 font-medium">
                            {{ $donation->campaign->title }}
                        </td>
                        <td class="p-4">
                            Rp {{ number_format($donation->amount,0,',','.') }}
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs
                                {{ $donation->status === 'success'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </td>
                        <td class="p-4 text-gray-500">
                            {{ $donation->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            Belum ada riwayat donasi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection