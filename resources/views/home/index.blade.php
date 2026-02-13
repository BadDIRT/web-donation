@extends('layouts.app')

@section('title','Beranda')

@section('content')

<div class="text-center mb-12">
    <h1 class="text-4xl font-bold text-green-600">
        Mari Berbagi Kebaikan Hari Ini
    </h1>
    <p class="mt-4 text-gray-600">
        Bantu sesama melalui campaign terpercaya
    </p>
</div>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($campaigns as $campaign)
        @include('components.campaign-card')
    @endforeach
</div>

@endsection
