@extends('layouts.app')

@section('title', 'Dashboard Donatur')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-pink-50/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center shadow-lg shadow-pink-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Dashboard Donatur</h1>
                    </div>
                    <p class="text-slate-500 text-sm sm:text-base ml-[52px]">Ringkasan kebaikan yang telah Anda berikan.</p>
                </div>
                <div class="ml-[52px] sm:ml-0 text-sm text-slate-500">
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>

            {{-- STATS RINGKASAN --}}
            <div class="grid gap-4 sm:grid-cols-3 mb-10">
                {{-- Total Donasi --}}
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Transaksi
                            </p>
                            <p class="text-3xl font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">
                                {{ $donations->count() }}</p>
                            <p class="text-[11px] text-slate-400 mt-1">kali donasi</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Total Nominal --}}
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Nominal</p>
                            <p
                                class="text-2xl sm:text-3xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                Rp {{ number_format($donations->sum('amount'), 0, ',', '.') }}</p>
                            <p class="text-[11px] text-slate-400 mt-1">telah disalurkan</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Campaign Didukung --}}
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Campaign Didukung
                            </p>
                            <p class="text-3xl font-extrabold text-slate-800 group-hover:text-violet-600 transition-colors">
                                {{ $donations->pluck('campaign.title')->unique()->count() }}</p>
                            <p class="text-[11px] text-slate-400 mt-1">campaign berbeda</p>
                        </div>
                        <div
                            class="w-11 h-11 bg-violet-50 rounded-xl flex items-center justify-center group-hover:bg-violet-100 transition-colors">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CTA PENGGALANG DANA --}}
            @if (auth()->user()->role === 'donatur')
                <div
                    class="bg-gradient-to-br from-emerald-500 via-emerald-600 to-teal-600 text-white rounded-2xl p-6 sm:p-8 mb-10 shadow-xl shadow-emerald-500/20 relative overflow-hidden">
                    {{-- Decorational elements --}}
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/4">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/4">
                    </div>

                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                Ingin Menggalang Dana?
                            </h2>
                            <p class="text-sm text-emerald-100 mt-2 max-w-xl leading-relaxed">
                                Kamu bisa membuat campaign penggalangan dana sendiri dan membantu lebih banyak orang. Ajukan
                                diri sebagai penggalang dana sekarang.
                            </p>
                        </div>
                        <a href="{{ route('pengelola.terms') }}"
                            class="flex-shrink-0 inline-flex items-center gap-2 bg-white text-emerald-700 font-bold px-6 py-3 rounded-xl hover:bg-emerald-50 transition-colors shadow-lg">
                            Ajukan Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endif

            {{-- MAIN GRID --}}
            <div class="grid lg:grid-cols-5 gap-6">

                {{-- LEFT: RIWAYAT DONASI --}}
                <div
                    class="lg:col-span-3 bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-slate-800">Riwayat Donasi</h2>
                        </div>
                        <a href="{{ route('my.donations') }}"
                            class="text-xs font-semibold text-pink-600 hover:text-pink-700 transition-colors flex items-center gap-1.5">
                            Lihat Semua
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="bg-slate-50/50 text-slate-500">
                                    <th
                                        class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                        Campaign</th>
                                    <th
                                        class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                        Nominal</th>
                                    <th
                                        class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                        Status</th>
                                    <th
                                        class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-right">
                                        Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($recentDonations as $donation)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-5 py-4">
                                            <p class="font-semibold text-slate-700 truncate max-w-[200px]">
                                                {{ $donation->campaign->title }}</p>
                                            <p class="text-[11px] text-slate-400 mt-0.5">
                                                {{ $donation->anonymous ? 'Hamba Allah' : $donation->donor_name ?? auth()->user()->name }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-4 text-center font-bold text-slate-800">Rp
                                            {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                        <td class="px-5 py-4 text-center">
                                            <span
                                                class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                                @if ($donation->status == 'success') bg-emerald-100 text-emerald-600
                                                @elseif($donation->status == 'pending') bg-amber-100 text-amber-600
                                                @else bg-red-100 text-red-600 @endif">
                                                {{ ucfirst($donation->status) }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4 text-right text-slate-400 text-xs">
                                            {{ $donation->created_at->translatedFormat('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-5 py-16 text-center">
                                            <div
                                                class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                </svg>
                                            </div>
                                            <p class="text-slate-500 font-semibold">Belum ada riwayat donasi</p>
                                            <p class="text-slate-400 text-xs mt-1">Yuk mulai berdonasi untuk membantu
                                                mereka</p>
                                            <a href="{{ route('campaign.index') }}"
                                                class="inline-block mt-4 text-xs font-bold text-emerald-600 hover:underline">Cari
                                                Campaign →</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- FOOTER LIHAT SEMUA --}}
                    @if ($donations->count() > 5)
                        <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50 text-center">
                            <p class="text-xs text-slate-400 mb-2">
                                Menampilkan 5 dari <span
                                    class="font-semibold text-slate-600">{{ $donations->count() }}</span> donasi
                            </p>
                            <a href="{{ route('my.donations') }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold bg-pink-50 text-pink-600 hover:bg-pink-100 transition-colors">
                                Lihat Semua Riwayat
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>

                {{-- RIGHT: SIDEBAR --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- BADGE / ACHIEVEMENT --}}
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                        <div class="flex items-center gap-2.5 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-sm text-slate-800">Status Kebaikan</h3>
                        </div>

                        <div
                            class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-4 border border-amber-100/50">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-2xl">
                                    @if ($donations->count() >= 10)
                                        🌟
                                    @elseif($donations->count() >= 5)
                                        ⭐
                                    @elseif($donations->count() > 0)
                                        🌱
                                    @else
                                        💤
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">
                                        @if ($donations->count() >= 10)
                                            Donatur Legendaris
                                        @elseif($donations->count() >= 5)
                                            Donatur Setia
                                        @elseif($donations->count() > 0)
                                            Pemula Kebaikan
                                        @else
                                            Belum Memulai
                                        @endif
                                    </p>
                                    <p class="text-[11px] text-slate-500 mt-0.5">
                                        {{ $donations->count() }}/10 donasi untuk level berikutnya
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3 w-full bg-white rounded-full h-1.5">
                                <div class="bg-amber-400 h-1.5 rounded-full transition-all duration-500"
                                    style="width: {{ min(($donations->count() / 10) * 100, 100) }}%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- CAMPAIGN YANG PERNAH DIDUKUNG --}}
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-sm text-slate-800">Pernah Didukung</h3>
                            </div>
                        </div>

                        <div class="divide-y divide-slate-100 max-h-[300px] overflow-y-auto">
                            @php
                                // Mengelompokkan dan menghitung total donasi per campaign unik
                                $groupedCampaigns = $donations
                                    ->where('status', 'success')
                                    ->groupBy('campaign_id')
                                    ->map(function ($items) {
                                        return [
                                            'title' => $items->first()->campaign->title,
                                            'slug' => $items->first()->campaign->slug,
                                            'total' => $items->sum('amount'),
                                            'count' => $items->count(),
                                        ];
                                    })
                                    ->take(5);
                            @endphp

                            @forelse($groupedCampaigns as $item)
                                <a href="{{ route('campaign.show', $item['slug']) }}"
                                    class="flex items-center justify-between px-5 py-3.5 hover:bg-slate-50/50 transition-colors group">
                                    <div class="min-w-0 flex-1">
                                        <p
                                            class="text-sm font-semibold text-slate-700 group-hover:text-emerald-700 transition-colors truncate">
                                            {{ $item['title'] }}
                                        </p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $item['count'] }}x donasi</p>
                                    </div>
                                    <div class="text-right flex-shrink-0 ml-3">
                                        <p class="text-xs font-bold text-emerald-600">Rp
                                            {{ number_format($item['total'], 0, ',', '.') }}</p>
                                        <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-emerald-500 transition-colors ml-auto mt-0.5"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </a>
                            @empty
                                <div class="px-5 py-8 text-center text-slate-400 text-xs">
                                    Belum ada campaign
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- INFO CARD --}}
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                        <div class="flex items-center gap-2.5 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-violet-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-sm text-slate-800">Tahukah Kamu?</h3>
                        </div>
                        <div class="space-y-3 text-xs text-slate-500 leading-relaxed">
                            <div class="flex gap-3">
                                <div
                                    class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor"
                                        stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p>Donasi yang sudah berhasil tidak dapat dibatalkan atau dikembalikan.</p>
                            </div>
                            <div class="flex gap-3">
                                <div
                                    class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor"
                                        stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p>Kamu bisa memantau langsung perkembangan campaign yang kamu dukung.</p>
                            </div>
                            <div class="flex gap-3">
                                <div
                                    class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor"
                                        stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p>Pilih "Donasi Anonim" jika tidak ingin namamu tampil di list donatur.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
