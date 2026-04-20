@extends('layouts.app')

@section('title', 'Riwayat Donasi Saya')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-pink-50/20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

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
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Donasi Saya</h1>
                    </div>
                    <p class="text-slate-500 text-sm sm:text-base ml-[52px]">Riwayat lengkap kebaikan yang telah Anda
                        berikan.</p>
                </div>

                <a href="{{ route('dashboard') }}"
                    class="ml-[52px] sm:ml-0 inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-700 font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            {{-- STATS CARD --}}
            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 text-center">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Total Transaksi</p>
                    <p class="text-2xl font-extrabold text-slate-800">{{ $donations->total() }}</p>
                </div>
                <div class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 text-center">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Total Berhasil</p>
                    <p class="text-2xl font-extrabold text-emerald-600">Rp {{ number_format($totalDonated, 0, ',', '.') }}
                    </p>
                </div>
                <div class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 text-center">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Campaign Didukung</p>
                    <p class="text-2xl font-extrabold text-violet-600">
                        {{ $donations->pluck('campaign.title')->unique()->count() }}</p>
                </div>
            </div>

            {{-- FILTER --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 mb-6">
                <form method="GET" action="{{ route('my.donations') }}" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul campaign..."
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <div class="flex gap-2">
                        <select name="status"
                            class="flex-1 py-2.5 px-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-pink-500 text-sm bg-white">
                            <option value="" {{ request('status') === '' ? 'selected' : '' }}>Semua Status</option>
                            <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Sukses</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
                        </select>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-pink-500 hover:bg-pink-600 text-white text-sm font-semibold shadow-sm shadow-pink-500/20 transition-colors active:scale-95 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="hidden sm:inline">Cari</span>
                        </button>
                    </div>
                </form>

                @if (request()->hasAny(['search', 'status']))
                    <div class="mt-3 pt-3 border-t border-slate-100">
                        <a href="{{ route('my.donations') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-pink-600 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Hapus Filter & Kembali ke Semua
                        </a>
                    </div>
                @endif
            </div>

            {{-- TABLE LIST --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-6 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                    Campaign</th>
                                <th
                                    class="px-6 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                    Nominal</th>
                                <th
                                    class="px-6 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                    Status</th>
                                <th
                                    class="px-6 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($donations as $donation)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if ($donation->anonymous)
                                                <div
                                                    class="w-9 h-9 rounded-full bg-pink-100 flex items-center justify-center text-xs font-bold text-pink-700 flex-shrink-0">
                                                    A</div>
                                            @elseif (auth()->user()->profile_photo_path)
                                                <img src="{{ auth()->user()->profile_photo_url }}"
                                                    class="w-9 h-9 rounded-full object-cover flex-shrink-0">
                                            @else
                                                <div
                                                    class="w-9 h-9 rounded-full bg-pink-100 flex items-center justify-center text-xs font-bold text-pink-700 flex-shrink-0">
                                                    {{ auth()->user()->initial }}
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <p class="font-semibold text-slate-700 truncate max-w-[250px]">
                                                    {{ $donation->campaign->title }}</p>
                                                <p class="text-[11px] text-slate-400">
                                                    {{ $donation->anonymous ? 'Hamba Allah' : $donation->donor_name ?? auth()->user()->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-slate-500 text-xs whitespace-nowrap">
                                        {{ $donation->created_at->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center font-bold text-slate-800 whitespace-nowrap">
                                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                            @if ($donation->status == 'success') bg-emerald-100 text-emerald-600
                                            @elseif($donation->status == 'pending') bg-amber-100 text-amber-600
                                            @else bg-red-100 text-red-600 @endif">
                                            {{ ucfirst($donation->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('campaign.show', $donation->campaign->slug) }}"
                                            class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-700 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div
                                            class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                                stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-500 font-semibold">Belum ada riwayat donasi</p>
                                        <p class="text-slate-400 text-xs mt-1">Atau tidak sesuai dengan filter pencarian
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if ($donations->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 flex justify-center">
                        {{ $donations->withQueryString()->links('components.pagination') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
