@extends('layouts.app')

@section('title','Buat Campaign')

@section('content')

<h1 class="text-2xl font-bold mb-6">Buat Campaign Baru</h1>

<form method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded-2xl shadow-lg space-y-4">
    @csrf

    <input type="text" name="title"
           placeholder="Judul Campaign"
           class="w-full border p-3 rounded-xl">

    <textarea name="description"
              placeholder="Deskripsi"
              class="w-full border p-3 rounded-xl"></textarea>

    <input type="number" name="target_amount"
           placeholder="Target Dana"
           class="w-full border p-3 rounded-xl">

    <input type="file" name="image"
           class="w-full border p-3 rounded-xl">

    <button class="bg-green-500 text-white px-6 py-3 rounded-xl">
        Submit Campaign
    </button>

</form>

@endsection
