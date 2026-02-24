@extends('layouts.app')

@section('title','Notifikasi')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Notifikasi
                </h1>
                <p class="text-gray-500 mt-1">
                    Informasi terbaru terkait aktivitas akun Anda
                </p>
            </div>

            @php
                $unread = $notifications->where('is_read', false)->count();
            @endphp

            @if($unread > 0)
                <span
                    class="inline-flex items-center gap-2
                           bg-green-100 text-green-700
                           px-4 py-2 rounded-xl text-sm font-semibold">
                    🔔 {{ $unread }} belum dibaca
                </span>
            @endif
        </div>

        {{-- LIST --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            @forelse($notifications as $notif)
                <div
                    class="flex gap-4 px-6 py-5 border-b last:border-0
                           transition hover:bg-gray-50
                           {{ !$notif->is_read ? 'bg-green-50/60' : '' }}">

                    {{-- ICON --}}
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 rounded-xl
                                   flex items-center justify-center
                                   {{ !$notif->is_read
                                        ? 'bg-green-100 text-green-600'
                                        : 'bg-gray-100 text-gray-500' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14V11a6 6 0 00-12 0v3a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0" />
                            </svg>
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="flex-1">
                        <div class="flex justify-between gap-4">
                            <h3 class="font-semibold text-gray-800">
                                {{ $notif->title }}
                            </h3>

                            <span class="text-xs text-gray-400 whitespace-nowrap">
                                {{ $notif->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                            {{ $notif->message }}
                        </p>

                        @if(!$notif->is_read)
                            <span
                                class="inline-block mt-3
                                       text-xs font-semibold
                                       text-green-700 bg-green-100
                                       px-3 py-1 rounded-full">
                                Baru
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                {{-- EMPTY STATE --}}
                <div class="py-20 text-center">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 rounded-full bg-gray-100
                                    flex items-center justify-center text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14V11a6 6 0 00-12 0v3a2 2 0 01-.6 1.4L4 17h5" />
                            </svg>
                        </div>
                    </div>

                    <p class="text-gray-600 font-medium">
                        Belum ada notifikasi
                    </p>
                    <p class="text-sm text-gray-500 mt-1">
                        Semua informasi penting akan muncul di sini
                    </p>
                </div>
            @endforelse

        </div>

    </div>
</div>
@endsection