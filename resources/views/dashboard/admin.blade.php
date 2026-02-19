@extends('layouts.app')

@section('title','Dashboard Admin')

@section('content')

{{-- HEADER --}}
<div class="mb-10">
    <h1 class="text-3xl font-bold text-gray-800">
        Dashboard Admin
    </h1>
    <p class="text-gray-500 mt-1">
        Ringkasan data utama platform donasi
    </p>
</div>

{{-- STATS --}}
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-12">

    {{-- TOTAL USER --}}
    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-sm text-gray-500">Total User</p>
        <p class="text-3xl font-bold mt-2">{{ $totalUsers }}</p>
    </div>

    {{-- TOTAL CAMPAIGN --}}
    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-sm text-gray-500">Total Campaign</p>
        <p class="text-3xl font-bold mt-2">{{ $totalCampaigns }}</p>
    </div>

    {{-- TOTAL DONASI --}}
    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-sm text-gray-500">Total Donasi</p>
        <p class="text-3xl font-bold mt-2">
            Rp {{ number_format($totalDonations,0,',','.') }}
        </p>
    </div>

</div>

{{-- QUICK ACTION --}}
<div class="grid md:grid-cols-2 gap-6">

    {{-- KELOLA PENGELOLA --}}
    <a href="{{ route('admin.pengelola') }}"
       class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition block">
        <h2 class="text-lg font-semibold mb-2">
            Pengelola Pending
        </h2>
        <p class="text-gray-500 text-sm">
            Setujui pengguna yang mengajukan menjadi pengelola
        </p>
    </a>

    {{-- KELOLA CAMPAIGN --}}
    <a href="{{ route('admin.campaign') }}"
       class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition block">
        <h2 class="text-lg font-semibold mb-2">
            Campaign Pending
        </h2>
        <p class="text-gray-500 text-sm">
            Review & setujui campaign yang diajukan
        </p>
    </a>

</div>

@endsection
