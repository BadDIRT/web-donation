@extends('layouts.app')

@section('title', 'Detail Donasi #' . $donation->id)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('admin.donations.index') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Riwayat Donasi
            </a>

            {{-- HEADER --}}
            <div class="flex items-center gap-4 mb-8">
                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-extrabold text-slate-800">Detail Donasi</h1>
                        <span
                            class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg
                        {{ $donation->status === 'success' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : ($donation->status === 'pending' ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-red-50 text-red-600 border border-red-100') }}">
                            {{ ucfirst($donation->status) }}
                        </span>
                    </div>
                    <p class="text-slate-500 text-sm mt-0.5">ID: {{ $donation->id }} •
                        {{ $donation->created_at->translatedFormat('d F Y, H:i') }}</p>
                </div>
            </div>

            {{-- NOMINAL CARD --}}
            <div
                class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 text-white shadow-lg shadow-emerald-500/20 mb-6">
                <p class="text-emerald-100 text-xs font-semibold uppercase tracking-widest mb-2">Nominal Donasi</p>
                <p class="text-3xl sm:text-4xl font-extrabold">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
            </div>

            {{-- DATA GRID --}}
            <div class="grid gap-4 sm:grid-cols-2 mb-6">

                {{-- DONATUR --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        @if ($donation->anonymous)
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                        @elseif ($donation->user && $donation->user->profile_photo_path)
                            <img src="{{ $donation->user->profile_photo_url }}" alt="{{ $donation->user->name }}"
                                class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Donatur</p>
                            <p class="text-sm font-bold text-slate-800">
                                {{ $donation->anonymous ? 'Anonim (Hamba Allah)' : $donation->donor_name ?? ($donation->user->name ?? 'Guest') }}
                            </p>
                            @if (!$donation->anonymous && $donation->user)
                                <a href="{{ route('admin.users.show', $donation->user) }}"
                                    class="text-xs text-emerald-600 hover:underline mt-1 inline-block">
                                    {{ $donation->user->email }} →
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- CAMPAIGN --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Campaign</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $donation->campaign->title }}</p>
                            @if ($donation->campaign)
                                <a href="{{ route('admin.campaign.show', $donation->campaign) }}"
                                    class="text-xs text-emerald-600 hover:underline mt-1 inline-block">
                                    Lihat campaign →
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- WAKTU --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Waktu Transaksi
                            </p>
                            <p class="text-sm font-bold text-slate-800">{{ $donation->created_at->format('d M Y, H:i:s') }}
                            </p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $donation->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RAW DATA --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                <button type="button" onclick="document.getElementById('rawData').classList.toggle('hidden')"
                    class="w-full px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                        <span class="font-bold text-sm text-slate-700">Data Mentah (JSON)</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="rawData" class="hidden px-6 pb-6">
                    <pre class="bg-slate-900 rounded-xl p-5 text-xs text-emerald-400 overflow-x-auto leading-relaxed">{{ json_encode($donation->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            </div>

        </div>
    </div>
@endsection
