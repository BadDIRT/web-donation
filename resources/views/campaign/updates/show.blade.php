@extends('layouts.app')

@section('title', $update->title . ' - ' . $campaign->title)

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-teal-50/20 py-6 sm:py-8 lg:py-10 px-4 sm:px-6 lg:px-8">

        <div class="max-w-4xl mx-auto">

            {{-- BACK LINK --}}
            <a href="{{ route('campaign.updates.index', $campaign->slug) }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-teal-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="hidden sm:inline">Kembali ke kabar Terbaru</span>
                <span class="sm:hidden">←</span>
            </a>

            {{-- MAIN CARD WRAPPER --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-200 overflow-hidden relative">

                {{-- IMAGE --}}
                @if ($update->image)
                    <div class="aspect-video w-full bg-slate-100 relative group">
                        <img src="{{ Storage::url($update->image) }}" alt="{{ $update->title }}"
                            class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>
                @endif

                <div class="p-6 sm:p-8">

                    {{-- TITLE + DATE --}}
                    <div class="mb-6">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 leading-tight break-words">
                            {{ $update->title }}
                        </h1>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-3 text-sm text-slate-400">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $update->created_at->translatedFormat('d F Y') }}</span>
                            </div>
                            <span class="text-slate-300 hidden sm:inline">•</span>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $update->created_at->translatedFormat('H:i') }} WIB</span>
                            </div>
                        </div>
                    </div>

                    {{-- META INFO CARD --}}
                    <div class="bg-slate-50 rounded-2xl p-4 sm:p-5 mb-8">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6">
                            {{-- CAMPAIGN LINK --}}
                            <a href="{{ route('campaign.show', $campaign->slug) }}"
                                class="flex items-center gap-3 hover:bg-white hover:shadow-sm rounded-lg px-1 py-2 -ml-1 transition-all duration-200 group w-full sm:w-auto">
                                @if ($campaign->image)
                                    <div class="w-10 h-10 rounded-lg bg-slate-200 overflow-hidden flex-shrink-0">
                                        <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->title }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="w-10 h-10 rounded-lg bg-slate-200 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <span
                                    class="text-xs font-semibold text-slate-600 group-hover:text-teal-600 transition-colors truncate">
                                    {{ $campaign->title }}
                                </span>
                            </a>

                            {{-- Divider (Desktop Only) --}}
                            <div class="hidden sm:block w-px h-8 bg-slate-200 flex-shrink-0"></div>

                            {{-- AUTHOR INFO --}}
                            @if ($campaign->user)
                                <div class="flex items-center gap-3">
                                    @if ($campaign->user->profile_photo_path)
                                        <img src="{{ $campaign->user->profile_photo_url }}"
                                            alt="{{ $campaign->user->name }}"
                                            class="w-8 h-8 rounded-full object-cover flex-shrink-0 ring-2 ring-white shadow-sm">
                                    @else
                                        <div
                                            class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                            <span class="text-xs font-bold text-emerald-700">
                                                {{ strtoupper(substr($campaign->user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-slate-700 truncate">
                                            {{ $campaign->user->name }}
                                        </p>
                                        <p class="text-[10px] text-slate-400">Pengelola Campaign</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div
                        class="prose prose-slate prose-sm sm:prose-base lg:prose-lg w-full text-slate-600 leading-relaxed break-words">
                        {!! nl2br(e($update->content)) !!}
                    </div>

                    {{-- ==================== KOMENTAR SECTION ==================== --}}
                    <div class="border-t border-slate-200 mt-10 pt-8" x-data="{ showAll: false, isSubmitting: false, deleteModalOpen: false, deleteUrl: '' }" x-cloak>

                        {{-- Header --}}
                        <div class="flex items-center gap-2.5 mb-6">
                            <div class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800">
                                Komentar ({{ $update->comments->count() }})
                            </h2>
                        </div>

                        {{-- COMMENT LIST --}}
                        <div class="space-y-4 mb-8">
                            @forelse($update->comments as $comment)
                                @php
                                    $commentUser = $comment->user;
                                    $isGuest = is_null($comment->user_id);
                                    $hasPhoto = !$isGuest && $commentUser && $commentUser->profile_photo_path;
                                    $displayName = $commentUser?->name ?? ($comment->name ?? 'Tamu');
                                    $initial = strtoupper(substr($displayName, 0, 1));
                                @endphp

                                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-5 transition-all duration-300"
                                    id="comment-card-{{ $comment->id }}" x-show="showAll || {{ $loop->index }} < 3"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0">

                                    <div class="flex items-start gap-3 sm:gap-4">

                                        {{-- ============================================= --}}
                                        {{-- ✅ AVATAR: FOTO PROFILE / GUEST / INITIAL --}}
                                        {{-- ============================================= --}}
                                        <div class="flex-shrink-0">
                                            @if ($isGuest)
                                                {{-- GUEST: icon user default --}}
                                                <div
                                                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center">
                                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-slate-400" fill="none"
                                                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                            @elseif ($hasPhoto)
                                                {{-- FOTO PROFILE --}}
                                                <img src="{{ $commentUser->profile_photo_url }}" alt="{{ $displayName }}"
                                                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full object-cover ring-2 ring-white shadow-sm">
                                            @else
                                                {{-- INITIAL --}}
                                                <div
                                                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-teal-50 border border-teal-100 flex items-center justify-center text-xs sm:text-sm font-bold text-teal-700">
                                                    {{ $initial }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <div
                                                class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-2 mb-2">
                                                <div class="flex items-center gap-2 min-w-0">
                                                    <p class="font-semibold text-slate-700 text-sm truncate">
                                                        {{ $displayName }}
                                                    </p>
                                                    @if ($isGuest)
                                                        <span
                                                            class="text-[10px] font-medium text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded flex-shrink-0">
                                                            Tamu
                                                        </span>
                                                    @endif
                                                    <span
                                                        class="text-[10px] text-slate-400 whitespace-nowrap">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>

                                                {{-- ACTION BUTTONS (EDIT/DELETE) --}}
                                                @if (auth()->check() && auth()->id() == $comment->user_id)
                                                    <div class="flex items-center gap-2">
                                                        {{-- EDIT BUTTON --}}
                                                        <button onclick="toggleEdit({{ $comment->id }})"
                                                            class="text-slate-400 hover:text-teal-600 transition-colors p-1 rounded hover:bg-teal-50"
                                                            title="Edit">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                stroke-width="2" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </button>

                                                        {{-- DELETE BUTTON --}}
                                                        <button type="button"
                                                            @click="deleteUrl = '{{ route('campaign.updates.comment.destroy', [$campaign->slug, $update->id, $comment->id]) }}'; deleteModalOpen = true"
                                                            class="text-slate-400 hover:text-red-600 transition-colors p-1 rounded hover:bg-red-50"
                                                            title="Hapus">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                stroke-width="2" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- DISPLAY CONTENT --}}
                                            <div id="content-display-{{ $comment->id }}">
                                                <p
                                                    class="text-slate-600 text-sm leading-relaxed whitespace-pre-wrap break-words">
                                                    {{ $comment->content }}
                                                </p>
                                            </div>

                                            {{-- EDIT FORM --}}
                                            <div id="content-edit-{{ $comment->id }}" class="hidden">
                                                <form
                                                    action="{{ route('campaign.updates.comment.update', [$campaign->slug, $update->id, $comment->id]) }}"
                                                    method="POST" class="space-y-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <textarea name="content" rows="3"
                                                        class="w-full text-sm border border-slate-300 rounded-lg p-2 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none resize-none">{{ $comment->content }}</textarea>
                                                    <div class="flex justify-end gap-2">
                                                        <button type="button" onclick="toggleEdit({{ $comment->id }})"
                                                            class="text-xs text-slate-500 hover:text-slate-700 px-3 py-1.5 bg-slate-100 rounded-lg">Batal</button>
                                                        <button type="submit"
                                                            class="text-xs text-white bg-teal-600 hover:bg-teal-700 px-3 py-1.5 rounded-lg font-medium">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="text-center py-12 bg-slate-50/50 rounded-2xl border border-slate-100 border-dashed">
                                    <div
                                        class="w-12 h-12 mx-auto bg-slate-100 rounded-full flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 text-sm font-medium">Belum ada komentar.</p>
                                    <p class="text-slate-300 text-xs mt-1">Jadilah yang pertama memberikan tanggapan!</p>
                                </div>
                            @endforelse

                            {{-- TOMBOL TOGGLE --}}
                            @if ($update->comments->count() > 3)
                                <div class="text-center mt-4" x-show="!showAll || {{ $update->comments->count() <= 3 }}">
                                    <button @click="showAll = !showAll"
                                        class="text-xs font-semibold text-teal-600 hover:text-teal-700 bg-teal-50 hover:bg-teal-100 px-4 py-2 rounded-lg transition-colors">
                                        <span
                                            x-text="showAll ? 'Tampilkan Sedikit' : 'Lihat Semua Komentar (' + ({{ $update->comments->count() }} - 3) + ' lainnya)'"></span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        {{-- COMMENT FORM --}}
                        <form method="POST"
                            action="{{ route('campaign.updates.comment.store', [$campaign->slug, $update->id]) }}"
                            @submit.prevent="isSubmitting = true; $el.submit()">
                            @csrf
                            <div
                                class="bg-white rounded-2xl p-1 sm:p-2 border border-slate-200 shadow-sm focus-within:ring-2 focus-within:ring-teal-500/10 focus-within:border-teal-300 transition-all">

                                @if (!auth()->check())
                                    <div class="px-4 pb-2">
                                        <input type="text" name="name"
                                            class="w-full px-0 py-2 rounded-lg border-none text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-0 bg-transparent"
                                            placeholder="Nama Lengkap Anda" required autocomplete="off">
                                    </div>
                                @endif

                                <div class="flex flex-col sm:flex-row gap-2">
                                    <div class="flex-1">
                                        <textarea name="content" rows="3" required placeholder="Tulis komentar Anda..."
                                            class="w-full h-full min-h-[80px] px-4 py-3 rounded-xl border-none text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-0 resize-none bg-transparent"></textarea>
                                    </div>
                                    <div class="flex items-end sm:items-end p-1 sm:p-2">
                                        <button type="submit" :disabled="isSubmitting"
                                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 sm:py-3 rounded-xl text-sm font-semibold bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white shadow-sm shadow-teal-500/20 hover:shadow-teal-500/30 transition-all active:scale-[0.98] disabled:opacity-70 disabled:cursor-not-allowed h-fit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                            </svg>
                                            <span x-text="isSubmitting ? 'Mengirim...' : 'Kirim'"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- ==================== MODAL DELETE ==================== --}}
                        <div x-show="deleteModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4"
                            x-cloak role="dialog" aria-modal="true">
                            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity"
                                @click="deleteModalOpen = false"></div>
                            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 transform transition-all"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-90">
                                <div
                                    class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800 text-center mb-2">Hapus Komentar?</h3>
                                <p class="text-sm text-slate-500 text-center mb-6">
                                    Apakah Anda yakin ingin menghapus komentar ini? Tindakan ini tidak dapat dibatalkan.
                                </p>
                                <form :action="deleteUrl" method="POST" class="flex gap-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" @click="deleteModalOpen = false"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-600 hover:bg-red-700 text-white shadow-lg shadow-red-500/30 transition-all">
                                        Ya, Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                    {{-- ==================== END KOMENTAR ==================== ---

                    {{-- ==================== NAVIGATION PREV/NEXT ==================== --}}
                    @if ($prevUpdate || $nextUpdate)
                        <div
                            class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mt-8 pt-6 border-t border-slate-100">

                            {{-- PREV BUTTON --}}
                            @if ($prevUpdate)
                                <a href="{{ route('campaign.updates.show', [$campaign->slug, $prevUpdate->id]) }}"
                                    class="flex items-center gap-3 p-3 sm:p-4 rounded-xl border border-slate-200 hover:border-teal-300 hover:bg-teal-50/50 transition-all group order-2 sm:order-1">
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-teal-600 transition-colors flex-shrink-0"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    <div class="min-w-0 text-right">
                                        <p
                                            class="text-[10px] sm:text-xs text-slate-400 uppercase tracking-wider font-medium">
                                            Sebelumnya</p>
                                        <p
                                            class="text-sm font-semibold text-slate-700 group-hover:text-teal-700 transition-colors truncate mt-0.5">
                                            {{ $prevUpdate->title }}
                                        </p>
                                    </div>
                                </a>
                            @else
                                <div class="order-2 sm:order-1"></div>
                            @endif

                            {{-- NEXT BUTTON --}}
                            @if ($nextUpdate)
                                <a href="{{ route('campaign.updates.show', [$campaign->slug, $nextUpdate->id]) }}"
                                    class="flex items-center gap-3 p-3 sm:p-4 rounded-xl border border-slate-200 hover:border-teal-300 hover:bg-teal-50/50 transition-all group order-1 sm:order-2 ml-auto sm:ml-0">
                                    <div class="min-w-0 text-left">
                                        <p
                                            class="text-[10px] sm:text-xs text-slate-400 uppercase tracking-wider font-medium">
                                            Selanjutnya</p>
                                        <p
                                            class="text-sm font-semibold text-slate-700 group-hover:text-teal-700 transition-colors truncate mt-0.5">
                                            {{ $nextUpdate->title }}
                                        </p>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-teal-600 transition-colors flex-shrink-0"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @else
                                <div class="order-1 sm:order-2"></div>
                            @endif

                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- Script Toggle Edit --}}
    <script>
        function toggleEdit(id) {
            const displayDiv = document.getElementById('content-display-' + id);
            const editDiv = document.getElementById('content-edit-' + id);

            if (displayDiv.classList.contains('hidden')) {
                displayDiv.classList.remove('hidden');
                editDiv.classList.add('hidden');
            } else {
                displayDiv.classList.add('hidden');
                editDiv.classList.remove('hidden');
            }
        }
    </script>
@endsection
