@extends('layouts.app')

@section('title', 'Campaign Saya')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>

            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center shadow-lg shadow-blue-500/20">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Campaign Saya</h1>
                            <p class="text-sm text-slate-400 mt-0.5">{{ $campaigns->total() }} campaign terdaftar</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('campaign.create') }}"
                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all sm:self-end">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Campaign Baru
                </a>
            </div>

            {{-- SEARCH & FILTER --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-4 sm:p-5 mb-6">
                <form method="GET" action="{{ route('pengelola.campaigns.index') }}">
                    <div class="flex flex-col sm:flex-row gap-3">
                        {{-- SEARCH INPUT --}}
                        <div class="flex-1 relative">
                            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari judul campaign..."
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                        </div>

                        {{-- STATUS FILTER --}}
                        <select name="status"
                            class="w-full sm:w-48 px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all bg-white appearance-none cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved
                            </option>
                            <option value="ended" {{ request('status') === 'ended' ? 'selected' : '' }}>Ended</option>
                            <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected
                            </option>
                        </select>

                        {{-- TOMBOL SUBMIT --}}
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold bg-emerald-500 hover:bg-emerald-600 text-white shadow-sm shadow-emerald-500/20 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>
                    </div>

                    {{-- ACTIVE FILTERS INFO --}}
                    @if (request()->has('search') || request()->has('status'))
                        <div class="mt-3 pt-3 border-t border-slate-100 flex flex-wrap items-center gap-2">
                            <span class="text-[11px] font-semibold text-slate-400 uppercase">Filter Aktif:</span>

                            @if (request('search'))
                                <span
                                    class="inline-flex items-center gap-1.5 text-[11px] font-medium bg-blue-50 text-blue-600 px-2.5 py-1 rounded-lg">
                                    Cari: "{{ request('search') }}"
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                        class="hover:text-blue-800 transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </a>
                                </span>
                            @endif

                            @if (request('status'))
                                <span
                                    class="inline-flex items-center gap-1.5 text-[11px] font-medium bg-emerald-50 text-emerald-600 px-2.5 py-1 rounded-lg capitalize">
                                    Status: {{ request('status') }}
                                    <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}"
                                        class="hover:text-emerald-800 transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </a>
                                </span>
                            @endif

                            <a href="{{ route('pengelola.campaigns.index') }}"
                                class="text-[11px] font-semibold text-red-500 hover:text-red-600 hover:underline ml-auto">
                                Hapus Semua
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            {{-- MOBILE: CARD VIEW --}}
            <div class="md:hidden space-y-4">
                @forelse($campaigns as $campaign)
                    @php
                        $progress =
                            $campaign->target_amount > 0
                                ? ($campaign->current_amount / $campaign->target_amount) * 100
                                : 0;
                        $withdrawn = $campaign->current_amount - $campaign->current_amount_rd_pengelola;
                    @endphp

                    <a href="{{ route('pengelola.campaign.show', $campaign->slug) }}"
                        class="block bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden hover:shadow-md transition-all group">
                        {{-- COVER MINI --}}
                        <div class="h-36 bg-slate-100 relative overflow-hidden">
                            @if ($campaign->image)
                                <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->title }}"
                                    class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            {{-- BADGE STATUS --}}
                            <div class="absolute top-3 right-3">
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider backdrop-blur-md shadow-lg
                                    @if ($campaign->status == 'approved') bg-emerald-500/90 text-white
                                    @elseif($campaign->status == 'pending') bg-amber-500/90 text-white
                                    @elseif($campaign->status == 'ended') bg-blue-500/90 text-white
                                    @else bg-red-500/90 text-white @endif">
                                    @if ($campaign->status == 'pending')
                                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                                    @endif
                                    {{ ucfirst($campaign->status) }}
                                </span>
                            </div>
                        </div>

                        {{-- CONTENT --}}
                        <div class="p-4">
                            <h3 class="font-bold text-slate-800 text-sm truncate mb-1">{{ $campaign->title }}</h3>
                            <p class="text-[11px] text-slate-400 mb-4">
                                {{ $campaign->created_at->translatedFormat('d F Y') }}</p>

                            {{-- PROGRESS --}}
                            <div class="mb-3">
                                <div class="flex justify-between items-center mb-1.5">
                                    <span class="text-[11px] text-slate-400">Terkumpul</span>
                                    <span
                                        class="text-[11px] font-bold text-slate-600">{{ number_format($progress, 1) }}%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-1.5 rounded-full transition-all duration-700 {{ $progress >= 100 ? 'bg-emerald-400' : 'bg-emerald-500' }}"
                                        style="width: {{ min($progress, 100) }}%"></div>
                                </div>
                            </div>

                            {{-- METRICS ROW --}}
                            <div class="grid grid-cols-2 gap-2 pt-3 border-t border-slate-100">
                                <div>
                                    <p class="text-[10px] text-slate-400 uppercase">Terkumpul</p>
                                    <p class="text-xs font-bold text-slate-700">Rp
                                        {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] text-slate-400 uppercase">Target</p>
                                    <p class="text-xs font-bold text-slate-700">Rp
                                        {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-12 text-center">
                        <div class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <p class="text-slate-500 font-semibold">Tidak ditemukan</p>
                        <p class="text-slate-400 text-xs mt-1">Coba ubah kata kunci atau filter kamu</p>
                        <a href="{{ route('pengelola.campaigns.index') }}"
                            class="inline-block mt-4 text-xs font-bold text-emerald-600 hover:underline">
                            Reset Filter →
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- DESKTOP: TABLE VIEW --}}
            <div
                class="hidden md:block bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                Campaign</th>
                            <th
                                class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                Status</th>
                            <th
                                class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                Terkumpul</th>
                            <th
                                class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                Saldo Tersedia</th>
                            <th
                                class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                Progress</th>
                            <th
                                class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($campaigns as $campaign)
                            @php
                                $progress =
                                    $campaign->target_amount > 0
                                        ? ($campaign->current_amount / $campaign->target_amount) * 100
                                        : 0;
                                $withdrawn = $campaign->current_amount - $campaign->current_amount_rd_pengelola;
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                            @if ($campaign->image)
                                                <img src="{{ Storage::url($campaign->image) }}" alt=""
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-slate-400" fill="none"
                                                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-semibold text-slate-700 truncate max-w-[250px]">
                                                {{ $campaign->title }}</p>
                                            <p class="text-[11px] text-slate-400 mt-0.5">
                                                {{ $campaign->created_at->translatedFormat('d F Y') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                        @if ($campaign->status == 'approved') bg-emerald-100 text-emerald-600
                                        @elseif($campaign->status == 'pending') bg-amber-100 text-amber-600
                                        @elseif($campaign->status == 'ended') bg-blue-100 text-blue-600
                                        @else bg-red-100 text-red-600 @endif">
                                        @if ($campaign->status == 'pending')
                                            <span class="w-1.5 h-1.5 bg-current rounded-full animate-pulse"></span>
                                        @elseif ($campaign->status == 'approved')
                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor"
                                                stroke-width="3" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @endif
                                        {{ ucfirst($campaign->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <p class="text-sm font-bold text-slate-800">Rp
                                        {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
                                    <p class="text-[10px] text-slate-400">dari Rp
                                        {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <p class="text-sm font-bold text-emerald-600">Rp
                                        {{ number_format($campaign->current_amount_rd_pengelola, 0, ',', '.') }}</p>
                                    <p class="text-[10px] text-slate-400">ditarik Rp
                                        {{ number_format($withdrawn, 0, ',', '.') }}</p>
                                </td>
                                <td class="px-5 py-4 w-32">
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                            <div class="h-1.5 rounded-full transition-all duration-700 {{ $progress >= 100 ? 'bg-emerald-400' : 'bg-emerald-500' }}"
                                                style="width: {{ min($progress, 100) }}%"></div>
                                        </div>
                                        <span
                                            class="text-[10px] font-semibold text-slate-500 w-10 text-right">{{ number_format($progress, 0) }}%</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <a href="{{ route('pengelola.campaign.show', $campaign->slug) }}"
                                        class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-700 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-16 text-center">
                                    <div
                                        class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 font-semibold">Tidak ditemukan</p>
                                    <p class="text-slate-400 text-xs mt-1">Coba ubah kata kunci atau filter kamu</p>
                                    <a href="{{ route('pengelola.campaigns.index') }}"
                                        class="inline-block mt-4 text-xs font-bold text-emerald-600 hover:underline">
                                        Reset Filter →
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- PAGINATION --}}
                @if ($campaigns->hasPages())
                    <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <p class="text-xs text-slate-400">
                            Menampilkan {{ $campaigns->firstItem() }}-{{ $campaigns->lastItem() }} dari
                            <span class="font-semibold text-slate-600">{{ $campaigns->total() }}</span> campaign
                        </p>
                        {{ $campaigns->links('components.pagination2') }}
                    </div>
                @endif
            </div>

            {{-- MOBILE PAGINATION --}}
            @if ($campaigns->hasPages())
                <div class="md:hidden mt-6">
                    <p class="text-xs text-slate-400 text-center mb-3">
                        Halaman {{ $campaigns->currentPage() }} dari {{ $campaigns->lastPage() }}
                    </p>
                    {{ $campaigns->links('components.pagination2') }}
                </div>
            @endif

        </div>
    </div>
@endsection
