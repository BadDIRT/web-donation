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
                                    <div
                                        class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-bold text-emerald-700">
                                            {{ strtoupper(substr($campaign->user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-slate-700 truncate">
                                            {{ $campaign->user->name }}</p>
                                        <p class="text-[10px] text-slate-400">Pengelola Campaign</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- CONTENT (FIXED OVERFLOW) --}}
                    {{-- Menghapus max-w-none agar teks mengikuti lebar container dan tidak terpotong --}}
                    <div
                        class="prose prose-slate prose-sm sm:prose-base lg:prose-lg w-full text-slate-600 leading-relaxed break-words">
                        {!! nl2br(e($update->content)) !!}
                    </div>

                    {{-- ==================== KOMENTAR SECTION ==================== --}}
                    <div class="border-t border-slate-200 mt-10 pt-8">

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
                                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-5 transition-transform hover:scale-[1.005] duration-200 relative"
                                    id="comment-card-{{ $comment->id }}">
                                    <div class="flex items-start gap-3 sm:gap-4">

                                        {{-- Avatar --}}
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-teal-50 border border-teal-100 flex items-center justify-center text-xs sm:text-sm font-bold text-teal-700">
                                                {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
                                            </div>
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <div
                                                class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-2 mb-2">
                                                <div class="flex items-center gap-2">
                                                    <p class="font-semibold text-slate-700 text-sm truncate">
                                                        {{ $comment->user->name ?? 'User' }}
                                                    </p>
                                                    <span
                                                        class="text-[10px] text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>

                                                {{-- ACTION BUTTONS (EDIT/DELETE) --}}
                                                {{-- Hanya muncul jika pemilik komentar sedang login --}}
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
                                                        <form
                                                            action="{{ route('campaign.updates.comment.destroy', [$campaign->slug, $update->id, $comment->id]) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus komentar ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-slate-400 hover:text-red-600 transition-colors p-1 rounded hover:bg-red-50"
                                                                title="Hapus">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                    stroke-width="2" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- DISPLAY CONTENT --}}
                                            <div id="content-display-{{ $comment->id }}">
                                                <p
                                                    class="text-slate-600 text-sm leading-relaxed whitespace-pre-wrap break-words">
                                                    {{ $comment->content }}</p>
                                            </div>

                                            {{-- EDIT FORM (Hidden by default) --}}
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
                        </div>

                        {{-- COMMENT FORM --}}
                        <form method="POST"
                            action="{{ route('campaign.updates.comment.store', [$campaign->slug, $update->id]) }}">
                            @csrf
                            <div
                                class="bg-white rounded-2xl p-1 sm:p-2 border border-slate-200 shadow-sm focus-within:ring-2 focus-within:ring-teal-500/10 focus-within:border-teal-300 transition-all">
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <div class="flex-1">
                                        <textarea name="content" rows="3" required placeholder="Tulis komentar Anda..."
                                            class="w-full h-full min-h-[80px] px-4 py-3 rounded-xl border-none text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-0 resize-none bg-transparent"></textarea>
                                    </div>
                                    <div class="flex items-end sm:items-end p-1 sm:p-2">
                                        <button type="submit"
                                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 sm:py-3 rounded-xl text-sm font-semibold bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white shadow-sm shadow-teal-500/20 hover:shadow-teal-500/30 transition-all active:scale-[0.98] h-fit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                            </svg>
                                            <span>Kirim</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                    {{-- NAVIGATION PREV/NEXT --}}
                    @if ($prevUpdate || $nextUpdate)
                        <div
                            class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mt-8 pt-6 border-t border-slate-100">
                            @if ($prevUpdate)
                                <a href="{{ route('campaign.updates.show', [$campaign->slug, $prevUpdate->id]) }}"
                                    class="... order-2 sm:order-1">...</a>
                            @else
                                <div class="order-2 sm:order-1"></div>
                            @endif
                            @if ($nextUpdate)
                                <a href="{{ route('campaign.updates.show', [$campaign->slug, $nextUpdate->id]) }}"
                                    class="... order-1 sm:order-2">...</a>
                            @else
                                <div class="order-1 sm:order-2"></div>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- Simple Script for Toggle Edit --}}
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
