@extends('layouts.app')

@section('title','Dashboard Donatur')

@section('content')

<h1 class="text-2xl font-bold mb-6">Riwayat Donasi</h1>

<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-4">Campaign</th>
                <th class="p-4">Jumlah</th>
                <th class="p-4">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
            <tr class="border-t">
                <td class="p-4">{{ $donation->campaign->title }}</td>
                <td class="p-4">Rp {{ number_format($donation->amount) }}</td>
                <td class="p-4">{{ $donation->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
