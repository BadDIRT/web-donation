@extends('layouts.app')

@section('title', 'Dashboard Pengelola')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center shadow-lg shadow-violet-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                            Dashboard @if (auth()->user()->is_approved)
                                Pengelola
                            @else
                                Donatur
                            @endif
                        </h1>
                    </div>
                    <p class="text-slate-500 text-sm sm:text-base ml-[52px]">Pantau status campaign dan kelola penggalangan
                        dana Anda.</p>
                </div>
                <div class="ml-[52px] sm:ml-0 text-sm text-slate-500">
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>

            @if (auth()->user()->is_approved)

                {{-- STATS --}}
                <div class="grid gap-4 sm:grid-cols-3 mb-10">
                    <div
                        class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Total Campaign
                                </p>
                                <p
                                    class="text-3xl font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">
                                    {{ $totalCampaign }}</p>
                            </div>
                            <div
                                class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Campaign Aktif
                                </p>
                                <p
                                    class="text-3xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                    {{ $approvedCampaign }}</p>
                            </div>
                            <div
                                class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-5 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md transition-all duration-200 group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Menunggu
                                    Verifikasi</p>
                                <p
                                    class="text-3xl font-extrabold text-slate-800 group-hover:text-amber-600 transition-colors">
                                    {{ $pendingCampaign }}</p>
                            </div>
                            <div
                                class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MAIN GRID LAYOUT --}}
                <div class="grid lg:grid-cols-5 gap-6 mb-10">

                    {{-- LEFT COL (Tables) --}}
                    <div class="lg:col-span-3 space-y-6">

                        {{-- CAMPAIGN SAYA --}}
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
                                    <h2 class="font-bold text-slate-800">Campaign Saya</h2>
                                </div>
                                <a href="{{ route('campaign.create') }}"
                                    class="text-xs font-semibold bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg transition-colors shadow-sm shadow-emerald-500/20">
                                    + Buat Baru
                                </a>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm">
                                    <thead>
                                        <tr class="bg-slate-50/50">
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                                Judul</th>
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                                Status</th>
                                            <th
                                                class="px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400 text-center">
                                                Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @forelse($campaigns as $campaign)
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <td class="px-5 py-4">
                                                    <p class="font-semibold text-slate-700 truncate max-w-[200px]">
                                                        {{ $campaign->title }}</p>
                                                    <p class="text-[11px] text-slate-400 mt-0.5">Rp
                                                        {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                                                </td>
                                                <td class="px-5 py-4 text-center">
                                                    <span
                                                        class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                                        @if ($campaign->status == 'approved') bg-emerald-100 text-emerald-600
                                                        @elseif($campaign->status == 'pending') bg-amber-100 text-amber-600
                                                        @elseif($campaign->status == 'ended') bg-blue-100 text-blue-600
                                                        @else bg-red-100 text-red-600 @endif">
                                                        {{ ucfirst($campaign->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4 w-32">
                                                    @php
                                                        $progress =
                                                            $campaign->target_amount > 0
                                                                ? ($campaign->current_amount /
                                                                        $campaign->target_amount) *
                                                                    100
                                                                : 0;
                                                    @endphp
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex-1 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                                            <div class="bg-emerald-500 h-full rounded-full"
                                                                style="width: {{ min($progress, 100) }}%"></div>
                                                        </div>
                                                        <span
                                                            class="text-[10px] font-semibold text-slate-500 w-8 text-right">{{ floor($progress) }}%</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-10 text-slate-400 text-sm">Belum
                                                    ada campaign</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- RIWAYAT DONASI SAYA (BARU) --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </div>
                                    <h2 class="font-bold text-slate-800">Donasi Saya</h2>
                                </div>
                                <a href="{{ route('my.donations') }}"
                                    class="text-xs font-semibold text-pink-600 hover:text-pink-700 transition-colors">Lihat
                                    Semua</a>
                            </div>

                            <div class="divide-y divide-slate-100">
                                @forelse($myDonations as $donation)
                                    <div class="flex items-center gap-4 px-5 py-4 hover:bg-slate-50/50 transition-colors">
                                        <div
                                            class="w-9 h-9 rounded-full bg-pink-100 flex items-center justify-center text-xs font-bold text-pink-700 flex-shrink-0">
                                            {{ $donation->anonymous ? 'A' : strtoupper(substr($donation->donor_name ?? auth()->user()->name, 0, 1)) }}
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-semibold text-slate-700 truncate">
                                                {{ $donation->campaign->title }}</p>
                                            <p class="text-[11px] text-slate-400">
                                                {{ $donation->created_at->translatedFormat('d M Y, H:i') }}</p>
                                        </div>
                                        <div class="text-right flex-shrink-0">
                                            <p class="text-sm font-bold text-slate-800">Rp
                                                {{ number_format($donation->amount, 0, ',', '.') }}</p>
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider
                                                @if ($donation->status == 'success') text-emerald-600
                                                @elseif($donation->status == 'pending') text-amber-600
                                                @else text-red-600 @endif">
                                                {{ ucfirst($donation->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="px-5 py-10 text-center text-slate-400 text-sm">
                                        Anda belum pernah berdonasi
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>

                    {{-- RIGHT COL (Cards & Sidebar) --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- SALDO CARD --}}
                        <div
                            class="bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-2xl p-6 shadow-lg shadow-emerald-500/20 relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-20 h-20 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2">
                            </div>

                            <div class="relative">
                                <p class="text-sm text-emerald-100 font-medium">Saldo Yang Bisa Ditarik</p>
                                <p class="text-3xl font-extrabold mt-2 tracking-tight">
                                    Rp {{ number_format($totalWithdrawable, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-emerald-200 mt-3 opacity-80">Total dari seluruh campaign Anda</p>
                            </div>
                        </div>

                        {{-- REKENING SECTION --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-bold text-sm text-slate-800">Rekening Saya</h3>
                                <a href="{{ route('bank.create') }}"
                                    class="text-[10px] font-bold text-emerald-600 hover:underline">+ Tambah</a>
                            </div>

                            <div class="space-y-3">
                                @forelse ($userBanks as $bank)
                                    <div
                                        class="bg-slate-50 rounded-xl p-3 hover:bg-emerald-50/50 transition-colors group border border-transparent hover:border-emerald-200">
                                        <div class="flex items-center justify-between">
                                            <p class="text-xs font-bold text-slate-600">{{ $bank->bank->name }}</p>
                                            @if ($bank->is_primary)
                                                <span
                                                    class="text-[9px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-full">Utama</span>
                                            @endif
                                        </div>
                                        <p class="text-xs font-mono text-slate-400 tracking-wide mt-1.5">
                                            {{ $bank->account_number }}
                                        </p>
                                    </div>
                                @empty
                                    <p class="text-slate-400 text-xs text-center py-4">Belum ada rekening</p>
                                @endforelse
                            </div>

                            <a href="{{ route('admin.banks.manage') }}"
                                class="block mt-4 text-center text-xs font-semibold text-slate-500 hover:text-emerald-600 transition-colors py-2 border border-slate-200 rounded-lg hover:border-emerald-300">
                                Kelola Rekening
                            </a>
                        </div>

                        {{-- QUICK ACTIONS --}}
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('campaign.create') }}"
                                class="bg-white rounded-2xl p-4 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-blue-200 transition-all duration-200 text-center group">
                                <div
                                    class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-100 transition-colors">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <p class="text-xs font-bold text-slate-700 group-hover:text-blue-700">Buat Campaign</p>
                            </a>

                            <a href="{{ route('withdraw.create') }}"
                                class="bg-white rounded-2xl p-4 shadow-sm shadow-black/5 border border-slate-100 hover:shadow-md hover:border-amber-200 transition-all duration-200 text-center group">
                                <div
                                    class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-amber-100 transition-colors">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9l-5 5-5-5" />
                                    </svg>
                                </div>
                                <p class="text-xs font-bold text-slate-700 group-hover:text-amber-700">Tarik Dana</p>
                            </a>
                        </div>

                        {{-- PENARIKAN TERAKHIR --}}
                        <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                            <div class="p-5 border-b border-slate-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                        </div>
                                        <h3 class="font-bold text-sm text-slate-800">Riwayat Tarik Dana</h3>
                                    </div>
                                    <a href="{{ route('withdraw.history') }}"
                                        class="text-[10px] font-bold text-amber-600 hover:underline">Lihat Semua</a>
                                </div>
                            </div>

                            {{-- Mini Stats --}}
                            <div class="grid grid-cols-3 border-b border-slate-100">
                                <div class="p-3 text-center border-r border-slate-100">
                                    <p class="text-lg font-extrabold text-amber-500">
                                        {{ $withdraws->where('status', 'pending')->count() }}</p>
                                    <p class="text-[9px] font-semibold text-slate-400 uppercase">Pending</p>
                                </div>
                                <div class="p-3 text-center border-r border-slate-100">
                                    <p class="text-lg font-extrabold text-emerald-500">
                                        {{ $withdraws->where('status', 'approved')->count() }}</p>
                                    <p class="text-[9px] font-semibold text-slate-400 uppercase">Sukses</p>
                                </div>
                                <div class="p-3 text-center">
                                    <p class="text-lg font-extrabold text-red-500">
                                        {{ $withdraws->where('status', 'rejected')->count() }}</p>
                                    <p class="text-[9px] font-semibold text-slate-400 uppercase">Gagal</p>
                                </div>
                            </div>

                            <div class="divide-y divide-slate-100 max-h-[250px] overflow-y-auto">
                                @forelse($withdraws->take(4) as $withdraw)
                                    <div class="px-5 py-3 hover:bg-slate-50/50 transition-colors">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-xs font-semibold text-slate-700 truncate max-w-[160px]">
                                                {{ $withdraw->campaign->title ?? '-' }}</p>
                                            <span
                                                class="text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full
                                                @if ($withdraw->status == 'approved') bg-emerald-100 text-emerald-600
                                                @elseif($withdraw->status == 'pending') bg-amber-100 text-amber-600
                                                @else bg-red-100 text-red-600 @endif">
                                                {{ ucfirst($withdraw->status) }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-[11px] text-slate-400">
                                                {{ $withdraw->created_at->diffForHumans() }}</p>
                                            <p class="text-xs font-bold text-slate-800">Rp
                                                {{ number_format($withdraw->amount, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="px-5 py-8 text-center text-slate-400 text-xs">Belum ada riwayat</div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            @else
                {{-- 🔒 BELUM APPROVED --}}
                <div class="max-w-lg mx-auto mt-20">
                    <div class="bg-white rounded-3xl shadow-sm shadow-black/5 border border-amber-100 p-10 text-center">
                        <div class="w-20 h-20 mx-auto bg-amber-100 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800 mb-3">Akun Sedang Diverifikasi</h2>
                        <p class="text-sm text-slate-500 leading-relaxed mb-6">
                            Anda belum dapat membuat campaign atau melakukan penarikan dana. Proses verifikasi membutuhkan
                            waktu maksimal <span class="font-bold text-slate-700">3x24 jam</span>.
                        </p>
                        <div class="bg-slate-50 rounded-xl p-4 text-left">
                            <p class="text-xs font-semibold text-slate-600 mb-2">Yang bisa Anda lakukan saat ini:</p>
                            <ul class="text-xs text-slate-500 space-y-1.5">
                                <li class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Melihat campaign yang sedang berjalan
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Melakukan donasi ke campaign lain
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
