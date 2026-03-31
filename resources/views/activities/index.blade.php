@extends('layouts.app')

@section('title', 'Riwayat Aktivitas')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">
                    Riwayat Aktivitas
                </h1>
                <p class="text-gray-500 mt-1">
                    Semua aktivitas sistem berdasarkan notifikasi
                </p>
            </div>

            {{-- FILTER --}}
            <form method="GET" class="mb-6 flex flex-wrap gap-3 items-center">

                {{-- SEARCH --}}
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari aktivitas..."
                    class="rounded-xl border border-gray-300 px-4 py-2.5 text-sm w-64 focus:ring-2 focus:ring-green-500">

                {{-- TYPE FILTER --}}
                <select name="type"
                    class="rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-500">

                    <option value="">Semua Tipe</option>

                    <option value="withdraw_approved" {{ request('type') == 'withdraw_approved' ? 'selected' : '' }}>
                        Withdraw Disetujui
                    </option>

                    <option value="withdraw_rejected" {{ request('type') == 'withdraw_rejected' ? 'selected' : '' }}>
                        Withdraw Ditolak
                    </option>

                    <option value="campaign_status_changed"
                        {{ request('type') == 'campaign_status_changed' ? 'selected' : '' }}>
                        Perubahan Status Campaign
                    </option>

                </select>

                {{-- BUTTON --}}
                <button type="submit"
                    class="px-4 py-2.5 rounded-xl text-sm font-medium
                bg-green-500 hover:bg-green-600 text-white transition">
                    Filter
                </button>

                {{-- RESET --}}
                <a href="{{ route('admin.activities') }}"
                    class="px-4 py-2.5 rounded-xl text-sm border border-gray-300 hover:bg-gray-100">
                    Reset
                </a>

            </form>

            {{-- STATUS SEARCH --}}
            @if (request('q'))
                <p class="text-sm text-gray-500 mb-4">
                    Hasil pencarian untuk:
                    <span class="font-medium text-gray-700">
                        "{{ request('q') }}"
                    </span>
                </p>
            @endif

            {{-- LIST --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- HEADER DESKTOP --}}
                <div class="hidden md:grid grid-cols-12 px-6 py-4 bg-gray-50 text-sm font-medium text-gray-500">
                    <div class="col-span-4">Aktivitas</div>
                    <div class="col-span-2">Tipe</div>
                    <div class="col-span-3">Dilakukan Oleh</div>
                    <div class="col-span-3 text-right">Waktu</div>
                </div>

                {{-- BODY --}}
                @forelse($notifications as $notif)
                    {{-- MOBILE --}}
                    <a href="{{ route('admin.activities.show', $notif->id) }}"
                        class="block md:hidden px-5 py-4 border-t space-y-2 hover:bg-gray-50 transition">

                        <div class="flex justify-between items-start">
                            <p class="font-medium text-gray-800">
                                {{ $notif->title }}
                            </p>

                            {{-- BADGE --}}
                            <span
                                class="text-xs px-2 py-1 rounded-full
            @if ($notif->type == 'withdraw_approved') bg-green-100 text-green-700
            @elseif ($notif->type == 'withdraw_rejected') bg-red-100 text-red-700
            @elseif ($notif->type == 'campaign_status_changed') bg-blue-100 text-blue-700
            @else bg-gray-100 text-gray-600 @endif">
                                {{ str_replace('_', ' ', $notif->type) }}
                            </span>
                        </div>

                        <p class="text-xs text-gray-500">
                            {{ $notif->message }}
                        </p>

                        <p class="text-xs text-gray-400">
                            {{ $notif->actor->name ?? 'System' }} •
                            {{ $notif->created_at->diffForHumans() }}
                        </p>

                    </a>

                    {{-- DESKTOP --}}
                    <a href="{{ route('admin.activities.show', $notif->id) }}"
                        class="hidden md:grid grid-cols-12 px-6 py-5 border-t hover:bg-gray-50 items-center gap-3 transition">

                        {{-- AKTIVITAS --}}
                        <div class="col-span-4 min-w-0">
                            <p class="font-medium text-gray-800 truncate hover:underline">
                                {{ $notif->title }}
                            </p>
                            <p class="text-xs text-gray-500 truncate">
                                {{ $notif->message }}
                            </p>
                        </div>

                        {{-- TYPE --}}
                        <div class="col-span-2">
                            <span
                                class="inline-block text-xs px-2 py-1 rounded-full
            @if ($notif->type == 'withdraw_approved') bg-green-100 text-green-700
            @elseif ($notif->type == 'withdraw_rejected') bg-red-100 text-red-700
            @elseif ($notif->type == 'campaign_status_changed') bg-blue-100 text-blue-700
            @else bg-gray-100 text-gray-600 @endif">
                                {{ str_replace('_', ' ', $notif->type) }}
                            </span>
                        </div>

                        {{-- ACTOR --}}
                        <div class="col-span-3 text-sm text-gray-600">
                            <p class="truncate">
                                {{ $notif->actor->name ?? 'System' }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ $notif->user->name ?? '-' }}
                            </p>
                        </div>

                        {{-- TIME --}}
                        <div class="col-span-3 text-right text-sm text-gray-500">
                            {{ $notif->created_at->diffForHumans() }}
                        </div>

                    </a>

                @empty

                    <div class="px-6 py-16 text-center text-gray-500">

                        @if (request('q'))
                            Tidak ditemukan aktivitas untuk
                            <span class="font-medium text-gray-700">
                                "{{ request('q') }}"
                            </span>
                        @else
                            Tidak ada aktivitas
                        @endif

                    </div>
                @endforelse

                {{-- PAGINATION --}}
                @if ($notifications->hasPages())
                    <div class="px-6 py-4 border-t bg-gray-50">
                        {{ $notifications->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
@endsection
