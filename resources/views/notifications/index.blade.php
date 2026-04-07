@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">

            {{-- HEADER --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-10">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-800">Notifikasi</h1>
                            @php
                                $unread = $notifications->where('is_read', false)->count();
                            @endphp
                            @if ($unread > 0)
                                <span
                                    class="inline-flex items-center justify-center min-w-[22px] h-[22px] px-1.5 rounded-full bg-emerald-500 text-white text-[10px] font-bold">
                                    {{ $unread }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <p class="text-slate-500 text-xs sm:text-sm lg:text-base ml-[52px]">Informasi terbaru terkait aktivitas
                        akun Anda.</p>
                </div>

                @if ($unread > 0)
                    <form action="{{ route('notifications.read-all') }}" method="POST" class="sm:self-end">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-colors border border-emerald-100 active:scale-[0.98]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="hidden xs:inline">Tandai Semua Dibaca</span>
                            <span class="xs:hidden">Baca Semua</span>
                            <span class="hidden xs:inline">({{ $unread }})</span>
                        </button>
                    </form>
                @endif
            </div>

            {{-- LIST --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">

                @forelse($notifications as $notif)
                    <div
                        class="flex gap-3 sm:gap-4 lg:gap-5 px-4 sm:px-5 lg:px-8 py-4 sm:py-5 border-b border-slate-100 last:border-0 transition-colors duration-150
                        {{ !$notif->is_read ? 'bg-emerald-50/40 hover:bg-emerald-50/60' : 'hover:bg-slate-50/50' }}">

                        {{-- ICON TYPE --}}
                        <div class="flex-shrink-0 mt-0.5">
                            <div
                                class="w-10 h-10 sm:w-11 sm:h-11 lg:w-12 lg:h-12 rounded-xl flex items-center justify-center
                                @if (str_contains($notif->type, 'approve') ||
                                        str_contains($notif->type, 'success') ||
                                        str_contains($notif->type, 'ended') ||
                                        str_contains($notif->type, 'created')) {{ !$notif->is_read ? 'bg-emerald-200' : 'bg-emerald-100' }}
                                @elseif(str_contains($notif->type, 'reject') ||
                                        str_contains($notif->type, 'failed') ||
                                        str_contains($notif->type, 'deleted'))
                                    {{ !$notif->is_read ? 'bg-red-200' : 'bg-red-100' }}
                                @elseif(str_contains($notif->type, 'request') ||
                                        str_contains($notif->type, 'pending') ||
                                        str_contains($notif->type, 'submitted'))
                                    {{ !$notif->is_read ? 'bg-amber-200' : 'bg-amber-100' }}
                                @elseif(str_contains($notif->type, 'withdraw') || str_contains($notif->type, 'income'))
                                    {{ !$notif->is_read ? 'bg-blue-200' : 'bg-blue-100' }}
                                @elseif(str_contains($notif->type, 'update'))
                                    {{ !$notif->is_read ? 'bg-violet-200' : 'bg-violet-100' }}
                                @else
                                    {{ !$notif->is_read ? 'bg-slate-200' : 'bg-slate-100' }} @endif">

                                @if (str_contains($notif->type, 'approve') ||
                                        str_contains($notif->type, 'success') ||
                                        str_contains($notif->type, 'ended') ||
                                        str_contains($notif->type, 'created'))
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-emerald-600" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @elseif(str_contains($notif->type, 'reject') ||
                                        str_contains($notif->type, 'failed') ||
                                        str_contains($notif->type, 'deleted'))
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-red-500" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @elseif(str_contains($notif->type, 'request') ||
                                        str_contains($notif->type, 'pending') ||
                                        str_contains($notif->type, 'submitted'))
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-amber-600" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @elseif(str_contains($notif->type, 'withdraw') || str_contains($notif->type, 'income'))
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-blue-600" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                @elseif(str_contains($notif->type, 'update'))
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-violet-600" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-slate-500" fill="none"
                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>
                        </div>

                        {{-- CONTENT --}}
                        <div class="flex-1 min-w-0">
                            {{-- TOP ROW: Title + Meta --}}
                            <div class="flex items-start justify-between gap-2 sm:gap-4">
                                <h3
                                    class="text-sm sm:text-base font-bold text-slate-800 {{ !$notif->is_read ? 'text-emerald-900' : '' }} line-clamp-1 sm:line-clamp-2">
                                    {{ $notif->title }}
                                </h3>
                                <div class="flex items-center gap-1.5 flex-shrink-0 pt-0.5">
                                    @if (!$notif->is_read)
                                        <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/30">
                                        </div>
                                    @endif
                                    <span
                                        class="text-[10px] sm:text-[11px] lg:text-xs text-slate-400 whitespace-nowrap font-medium">
                                        {{ $notif->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                            {{-- MESSAGE --}}
                            <p
                                class="text-xs sm:text-sm text-slate-500 mt-1 sm:mt-1.5 leading-relaxed line-clamp-2 lg:line-clamp-3">
                                {{ $notif->message }}
                            </p>

                            {{-- ACTOR + ACTIONS (Mobile: Inline, Desktop: Separate) --}}
                            <div class="flex items-center justify-between gap-3 mt-2 sm:mt-3">
                                @if ($notif->actor)
                                    <p class="text-[10px] sm:text-[11px] text-slate-400 font-medium truncate">
                                        Oleh: <span class="text-slate-600">{{ $notif->actor->name }}</span>
                                    </p>
                                @else
                                    <span></span>
                                @endif

                                <div class="flex items-center gap-2 flex-shrink-0">
                                    @if (!$notif->is_read)
                                        <form action="{{ route('notifications.read', $notif->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-[10px] sm:text-xs font-semibold text-emerald-600 hover:text-emerald-800 hover:underline transition-colors">
                                                Dibaca
                                            </button>
                                        </form>
                                    @endif

                                    {{-- DELETE BUTTON + MODAL --}}
                                    <div x-data="{ showDeleteModal: false }">
                                        <button @click="showDeleteModal = true" type="button"
                                            class="text-slate-300 hover:text-red-500 transition-colors p-1 -m-1">
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>

                                        {{-- MODAL --}}
                                        <div x-show="showDeleteModal" x-cloak
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
                                            @keydown.escape.window="showDeleteModal = false">
                                            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
                                                @click="showDeleteModal = false"></div>
                                            <div
                                                class="relative bg-white rounded-2xl shadow-2xl shadow-black/10 p-5 sm:p-6 lg:p-8 w-full max-w-[calc(100%-2rem)] sm:max-w-sm text-center z-10">
                                                <div
                                                    class="w-14 h-14 sm:w-16 sm:h-16 mx-auto mb-4 sm:mb-5 rounded-2xl bg-red-100 flex items-center justify-center">
                                                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-red-500" fill="none"
                                                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-base sm:text-lg font-bold text-slate-800 mb-1.5 sm:mb-2">
                                                    Hapus Notifikasi?</h3>
                                                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-4 sm:mb-6">
                                                    Notifikasi ini akan dihapus secara permanen.</p>
                                                <form action="{{ route('notifications.destroy', $notif->id) }}"
                                                    method="POST" id="delete-form-{{ $notif->id }}">
                                                    @csrf @method('DELETE')
                                                </form>
                                                <div class="flex gap-2 sm:gap-3">
                                                    <button @click="showDeleteModal = false" type="button"
                                                        class="flex-1 py-2 sm:py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                                                        Batal
                                                    </button>
                                                    <button
                                                        @click="document.getElementById('delete-form-{{ $notif->id }}').submit()"
                                                        type="button"
                                                        class="flex-1 py-2 sm:py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-xs sm:text-sm font-semibold text-white shadow-sm shadow-red-500/20 transition-colors">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- EMPTY STATE --}}
                    <div class="py-16 sm:py-24 text-center px-6">
                        <div
                            class="w-16 h-16 sm:w-20 sm:h-20 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4 sm:mb-6">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-slate-300" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <h3 class="text-slate-700 font-bold text-base sm:text-lg">Semua Bersih</h3>
                        <p class="text-slate-400 text-xs sm:text-sm mt-2 max-w-xs sm:max-w-sm mx-auto leading-relaxed">
                            Belum ada notifikasi masuk. Semua informasi penting akan muncul di sini.</p>
                    </div>
                @endforelse

            </div>
            
        </div>
    </div>
@endsection
