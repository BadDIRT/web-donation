@extends('layouts.app')

@section('title','Pengelola Pending')

@section('content')

<h1 class="text-2xl font-bold mb-6">Pengelola Pending</h1>

<div class="bg-white rounded-2xl shadow p-6">

    @forelse($users as $user)
        <div class="flex justify-between items-center border-b py-4 last:border-0">
            <div>
                <p class="font-medium">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>

            <form method="POST" action="{{ route('admin.approve.pengelola',$user->id) }}">
                @csrf
                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm">
                    Approve
                </button>
            </form>
        </div>
    @empty
        <p class="text-gray-500">Tidak ada pengelola pending</p>
    @endforelse

</div>

@endsection
