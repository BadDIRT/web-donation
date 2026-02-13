@extends('layouts.app')

@section('title','Dashboard Admin')

@section('content')

<h1 class="text-2xl font-bold mb-8">Admin Dashboard</h1>

<div class="grid md:grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-gray-500">Total User</h2>
        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-gray-500">Total Campaign</h2>
        <p class="text-3xl font-bold">{{ $totalCampaigns }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-gray-500">Total Donasi</h2>
        <p class="text-3xl font-bold">
            Rp {{ number_format($totalDonations) }}
        </p>
    </div>

</div>

@endsection
