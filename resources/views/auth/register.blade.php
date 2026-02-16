@extends('layouts.app')

@section('title','Daftar')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-6">Daftar</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name"
               placeholder="Nama"
               class="w-full border p-3 rounded-xl mb-4" required>

        <input type="email" name="email"
               placeholder="Email"
               class="w-full border p-3 rounded-xl mb-4" required>

        <input type="password" name="password"
               placeholder="Password"
               class="w-full border p-3 rounded-xl mb-4" required>

        <input type="password" name="password_confirmation"
               placeholder="Konfirmasi Password"
               class="w-full border p-3 rounded-xl mb-4" required>

        <button class="w-full bg-green-500 text-white py-3 rounded-xl">
            Daftar
        </button>
    </form>
</div>
@endsection
