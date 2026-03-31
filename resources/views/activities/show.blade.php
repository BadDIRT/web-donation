@extends('layouts.app')

@section('title', 'Detail Aktivitas')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Detail Aktivitas
                    </h1>
                    <p class="text-gray-500 mt-1 text-sm">
                        Informasi lengkap aktivitas sistem
                    </p>
                </div>

                <a href="{{ route('admin.activities') }}"
                    class="text-sm px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
                    ← Kembali
                </a>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">

                {{-- TITLE + TYPE --}}
                <div class="flex justify-between items-start gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">
                            {{ $notification->title }}
                        </h2>
                    </div>

                    <span
                        class="text-xs px-3 py-1 rounded-full whitespace-nowrap
                    @if ($notification->type == 'withdraw_approved') bg-green-100 text-green-700
                    @elseif ($notification->type == 'withdraw_rejected') bg-red-100 text-red-700
                    @elseif ($notification->type == 'campaign_status_changed') bg-blue-100 text-blue-700
                    @else bg-gray-100 text-gray-600 @endif">
                        {{ str_replace('_', ' ', $notification->type) }}
                    </span>
                </div>

                {{-- MESSAGE --}}
                <div>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        {{ $notification->message }}
                    </p>
                </div>

                {{-- META INFO --}}
                <div class="grid md:grid-cols-2 gap-6 text-sm">

                    {{-- ACTOR --}}
                    <div>
                        <p class="text-gray-500 mb-1">Dilakukan oleh</p>
                        <p class="font-medium text-gray-800">
                            {{ $notification->actor->name ?? 'System' }}
                        </p>
                    </div>

                    {{-- TARGET USER --}}
                    <div>
                        <p class="text-gray-500 mb-1">Untuk pengguna</p>
                        <p class="font-medium text-gray-800">
                            {{ $notification->user->name ?? '-' }}
                        </p>
                    </div>

                    {{-- CREATED --}}
                    <div>
                        <p class="text-gray-500 mb-1">Waktu kejadian</p>
                        <p class="font-medium text-gray-800">
                            {{ $notification->created_at->format('d M Y, H:i') }}
                        </p>
                        <p class="text-xs text-gray-400">
                            {{ $notification->created_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- STATUS --}}
                    <div>
                        <p class="text-gray-500 mb-1">Status</p>
                        <span
                            class="text-xs px-2 py-1 rounded-full
                        {{ $notification->is_read ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $notification->is_read ? 'Sudah dibaca' : 'Belum dibaca' }}
                        </span>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
