@extends('layouts.app')

@section('title','Campaign Pending')

@section('content')

<h1 class="text-2xl font-bold mb-6">Campaign Pending</h1>

<div class="bg-white rounded-2xl shadow p-6">

    @forelse($campaigns as $campaign)
        <div class="flex justify-between items-center border-b py-4 last:border-0">
            <div>
                <p class="font-medium">{{ $campaign->title }}</p>
                <p class="text-sm text-gray-500">
                    Target: Rp {{ number_format($campaign->target_amount,0,',','.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('admin.approve.campaign',$campaign->id) }}">
                @csrf
                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm">
                    Approve
                </button>
            </form>
        </div>
    @empty
        <p class="text-gray-500">Tidak ada campaign pending</p>
    @endforelse

</div>

@endsection
