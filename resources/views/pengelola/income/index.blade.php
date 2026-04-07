@extends('layouts.app')

@section('title', 'Riwayat Pemasukan')

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
                            class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Riwayat Pemasukan</h1>
                            <p class="text-sm text-slate-400 mt-0.5">{{ $donations->total() }} transaksi tercatat</p>
                        </div>
                    </div>
                </div>

                {{-- TOTAL INCOME CARD --}}
                <div
                    class="bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-xl px-6 py-4 shadow-lg shadow-emerald-500/20 sm:self-end">
                    <p class="text-xs text-emerald-100 font-medium">Total Pemasukan</p>
                    <p class="text-2xl font-extrabold">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- SEARCH & FILTER --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-4 sm:p-5 mb-6">
                <form method="GET" action="{{ route('pengelola.income.index') }}">
                    <div class="flex flex-col sm:flex-row gap-3">
                        {{-- SEARCH --}}
                        <div class="flex-1 relative">
                            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari donatur atau campaign..."
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                        </div>

                        {{-- FILTER CAMPAIGN --}}
                        <select name="campaign"
                            class="w-full sm:w-52 px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all bg-white appearance-none cursor-pointer">
                            <option value="">Semua Campaign</option>
                            @foreach ($campaigns as $id => $name)
                                <option value="{{ $id }}" {{ request('campaign') == $id ? 'selected' : '' }}>
                                    {{ $name }}</option>
                            @endforeach
                        </select>

                        {{-- FILTER STATUS --}}
                        <select name="status"
                            class="w-full sm:w-40 px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all bg-white appearance-none cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Sukses</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
                        </select>

                        {{-- SUBMIT --}}
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold bg-emerald-500 hover:bg-emerald-600 text-white shadow-sm shadow-emerald-500/20 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>
                    </div>

                    {{-- ACTIVE FILTERS --}}
                    @if (request()->has('search') || request()->has('status') || request()->has('campaign'))
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

                            @if (request('campaign'))
                                <span
                                    class="inline-flex items-center gap-1.5 text-[11px] font-medium bg-violet-50 text-violet-600 px-2.5 py-1 rounded-lg">
                                    Campaign: {{ $campaigns[request('campaign')] ?? request('campaign') }}
                                    <a href="{{ request()->fullUrlWithQuery(['campaign' => null]) }}"
                                        class="hover:text-violet-800 transition-colors">
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
                                    Status: {{ ucfirst(request('status')) }}
                                    <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}"
                                        class="hover:text-emerald-800 transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </a>
                                </span>
                            @endif

                            <a href="{{ route('pengelola.income.index') }}"
                                class="text-[11px] font-semibold text-red-500 hover:text-red-600 hover:underline ml-auto">
                                Hapus Semua
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            {{-- MOBILE: CARD VIEW --}}
            <div class="md:hidden space-y-3">
                @forelse($donations as $donation)
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-4">
                        <div class="flex items-start justify-between gap-2 mb-3">
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-slate-800 text-sm truncate">{{ $donation->campaign->title }}</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">
                                    {{ $donation->anonymous ? 'Hamba Allah' : $donation->donor_name ?? 'Donatur' }}
                                </p>
                            </div>
                            <span
                                class="flex-shrink-0 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                @if ($donation->status == 'success') bg-emerald-100 text-emerald-600
                                @elseif($donation->status == 'pending') bg-amber-100 text-amber-600
                                @else bg-red-100 text-red-600 @endif">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                            <p class="text-sm font-bold text-emerald-600">+Rp
                                {{ number_format($donation->amount, 0, ',', '.') }}</p>
                            <p class="text-[11px] text-slate-400">
                                {{ $donation->created_at->translatedFormat('d M Y, H:i') }}</p>
                        </div>
                    </div>
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
                        <a href="{{ route('pengelola.income.index') }}"
                            class="inline-block mt-4 text-xs font-bold text-emerald-600 hover:underline">Reset Filter →</a>
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
                                Donatur</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                Campaign</th>
                            <th
                                class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                Nominal</th>
                            <th
                                class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                Status</th>
                            <th
                                class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-right">
                                Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($donations as $donation)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-semibold text-slate-700 text-sm">
                                                {{ $donation->anonymous ? 'Hamba Allah' : $donation->donor_name ?? 'Donatur' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <p class="text-slate-600 truncate max-w-[200px]">{{ $donation->campaign->title }}</p>
                                </td>
                                <td class="px-5 py-4 text-center font-bold text-emerald-600">+Rp
                                    {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                <td class="px-5 py-4 text-center">
                                    <span
                                        class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                        @if ($donation->status == 'success') bg-emerald-100 text-emerald-600
                                        @elseif($donation->status == 'pending') bg-amber-100 text-amber-600
                                        @else bg-red-100 text-red-600 @endif">
                                        @if ($donation->status == 'success')
                                            <svg class="w-2.5 h-2.5 inline mr-0.5" fill="none" stroke="currentColor"
                                                stroke-width="3" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @elseif($donation->status == 'pending')
                                            <span
                                                class="w-1.5 h-1.5 inline-block mr-1 bg-current rounded-full animate-pulse"></span>
                                        @endif
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-right text-slate-400 text-xs">
                                    {{ $donation->created_at->translatedFormat('d M Y, H:i') }}</td>
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
                                    <a href="{{ route('pengelola.income.index') }}"
                                        class="inline-block mt-4 text-xs font-bold text-emerald-600 hover:underline">Reset
                                        Filter →</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- PAGINATION --}}
                @if ($donations->hasPages())
                    <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <p class="text-xs text-slate-400">
                            Menampilkan {{ $donations->firstItem() }}-{{ $donations->lastItem() }} dari
                            <span class="font-semibold text-slate-600">{{ $donations->total() }}</span> transaksi
                        </p>
                        {{ $donations->links('components.pagination2') }}
                    </div>
                @endif
            </div>

            {{-- MOBILE PAGINATION --}}
            @if ($donations->hasPages())
                <div class="md:hidden mt-6">
                    <p class="text-xs text-slate-400 text-center mb-3">
                        Halaman {{ $donations->currentPage() }} dari {{ $donations->lastPage() }}
                    </p>
                    {{ $donations->links('components.pagination2') }}
                </div>
            @endif

        </div>
    </div>
@endsection
