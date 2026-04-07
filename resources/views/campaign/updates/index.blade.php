@extends('layouts.app')

@section('title', 'Kabar Terbaru - ' . $campaign->title)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-teal-50/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('campaign.show', $campaign->slug) }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-teal-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Campaign
            </a>

            {{-- HEADER --}}
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 to-cyan-600 flex items-center justify-center shadow-lg shadow-teal-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2zM9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-slate-800">Kabar Terbaru</h1>
                        <p class="text-sm text-slate-400 mt-0.5">Dari campaign "{{ $campaign->title }}"</p>
                    </div>
                </div>
            </div>

            {{-- MOBILE: CARD VIEW --}}
            <div class="sm:hidden space-y-4">
                @forelse($updates as $update)
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                        {{-- IMAGE --}}
                        @if ($update->image)
                            <div class="aspect-video bg-slate-100">
                                <img src="{{ Storage::url($update->image) }}" alt="{{ $update->title }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @endif

                        <div class="p-4">
                            {{-- TITLE + DATE + DETAIL BUTTON --}}
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <h3 class="font-bold text-slate-800 text-sm leading-snug flex-1">{{ $update->title }}</h3>
                                <a href="{{ route('campaign.updates.show', [$campaign->slug, $update->id]) }}"
                                    class="flex-shrink-0 text-[10px] font-semibold text-teal-600 hover:text-teal-700 bg-teal-50 px-2.5 py-1 rounded-lg hover:bg-teal-100 transition-colors flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                            </div>

                            {{-- DATE + TIME --}}
                            <p class="text-[10px] text-slate-400 mb-2">
                                {{ $update->created_at->translatedFormat('d M Y, H:i') }}
                            </p>

                            {{-- CONTENT PREVIEW --}}
                            @if ($update->content)
                                <p class="text-sm text-slate-600 leading-relaxed line-clamp-2 mb-3">{{ $update->content }}
                                </p>
                            @endif

                            {{-- FOOTER INFO --}}
                            <div class="flex items-center gap-2 pt-3 border-t border-slate-100">
                                @if ($campaign->user)
                                    <div
                                        class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="text-[9px] font-bold text-emerald-700">{{ strtoupper(substr($campaign->user->name, 0, 1)) }}</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400">{{ $campaign->user->name }}</span>
                                    <span class="text-[10px] text-slate-300">•</span>
                                @endif
                                <span class="text-[10px] text-slate-400">{{ $update->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-12 text-center">
                        <div class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2zM9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-slate-500 font-semibold">Belum ada kabar terbaru</p>
                        <p class="text-slate-400 text-xs mt-1">Update dari pengelola akan muncul di sini</p>
                    </div>
                @endforelse
            </div>

            {{-- DESKTOP: LIST VIEW --}}
            <div
                class="hidden sm:block bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                @forelse($updates as $update)
                    <div
                        class="flex flex-col md:flex-row border-b border-slate-100 last:border-0 hover:bg-slate-50/50 transition-colors">
                        {{-- IMAGE --}}
                        @if ($update->image)
                            <div class="flex-shrink-0 w-full md:w-56 lg:w-64">
                                <div class="aspect-video bg-slate-100">
                                    <img src="{{ Storage::url($update->image) }}" alt="{{ $update->title }}"
                                        class="w-full h-full object-cover">
                                </div>
                            </div>
                        @endif

                        {{-- CONTENT --}}
                        <div class="flex-1 p-5 lg:p-6">
                            {{-- TOP ROW --}}
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-bold text-slate-800 text-base lg:text-lg leading-snug">
                                        {{ $update->title }}</h3>
                                    <p class="text-xs text-slate-400 mt-1">
                                        {{ $update->created_at->translatedFormat('d M Y, H:i') }}</p>
                                </div>
                                <a href="{{ route('campaign.updates.show', [$campaign->slug, $update->id]) }}"
                                    class="flex-shrink-0 inline-flex items-center gap-1.5 text-xs font-semibold text-teal-600 hover:text-teal-700 bg-teal-50 hover:bg-teal-100 px-3.5 py-2 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                            </div>

                            {{-- CONTENT PREVIEW --}}
                            @if ($update->content)
                                <p class="text-sm text-slate-600 leading-relaxed line-clamp-3 mb-4">{{ $update->content }}
                                </p>
                            @endif

                            {{-- FOOTER INFO --}}
                            <div class="flex items-center gap-2 pt-3 border-t border-slate-100">
                                @if ($campaign->user)
                                    <div
                                        class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="text-[10px] font-bold text-emerald-700">{{ strtoupper(substr($campaign->user->name, 0, 1)) }}</span>
                                    </div>
                                    <span class="text-xs text-slate-400 font-medium">{{ $campaign->user->name }}</span>
                                    <span class="text-xs text-slate-300">•</span>
                                @endif
                                <span class="text-xs text-slate-400">{{ $update->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-16 text-center">
                        <div class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2zM9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-slate-500 font-semibold">Belum ada kabar terbaru</p>
                        <p class="text-slate-400 text-xs mt-1">Update dari pengelola akan muncul di sini</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if ($updates->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $updates->links('components.pagination2') }}
                </div>
            @endif

        </div>
    </div>
@endsection
