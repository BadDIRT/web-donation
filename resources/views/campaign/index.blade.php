@extends('layouts.app')

@section('title','Semua Campaign')

@section('content')

<h1 class="text-2xl font-bold mb-6">Semua Campaign</h1>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($campaigns as $campaign)
        @include('components.campaign-card')
    @endforeach
</div>

@endsection
