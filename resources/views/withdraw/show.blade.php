@extends('layouts.app')

@section('title', 'Detail Penarikan #' . $withdraw->id)

@section('content')
    <div x-data="{ imageModal: false }" class="bg-gradient-to-br from-slate-50 via-white to-indigo-50/20 pb-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('withdraw.history') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-indigo-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Riwayat
            </a>

            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800">Detail Penarikan</h1>
                        <p class="text-slate-500 text-sm mt-0.5">ID: #{{ $withdraw->id }} • Informasi lengkap penarikan dana
                        </p>
                    </div>
                </div>
            </div>

            {{-- STATUS CARD --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">
                <div class="relative p-6 sm:p-8">
                    <div
                        class="absolute top-0 left-0 w-full h-1.5
                    {{ $withdraw->status === 'approved' ? 'bg-gradient-to-r from-emerald-400 to-emerald-500' : ($withdraw->status === 'completed' ? 'bg-gradient-to-r from-blue-400 to-blue-500' : ($withdraw->status === 'rejected' ? 'bg-gradient-to-r from-red-400 to-red-500' : 'bg-gradient-to-r from-amber-400 to-amber-500')) }}">
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-16 h-16 rounded-2xl flex items-center justify-center
                            {{ $withdraw->status === 'approved' ? 'bg-emerald-100' : ($withdraw->status === 'completed' ? 'bg-blue-100' : ($withdraw->status === 'rejected' ? 'bg-red-100' : 'bg-amber-100')) }}">
                                @if ($withdraw->status === 'approved')
                                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @elseif ($withdraw->status === 'completed')
                                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                @elseif ($withdraw->status === 'rejected')
                                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @else
                                    <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>

                            <div>
                                <p class="text-sm text-slate-500 mb-1">Status Penarikan</p>
                                <span
                                    class="inline-flex items-center gap-2 text-lg font-bold
                                {{ $withdraw->status === 'approved' ? 'text-emerald-600' : ($withdraw->status === 'completed' ? 'text-blue-600' : ($withdraw->status === 'rejected' ? 'text-red-600' : 'text-amber-600')) }}">
                                    @if ($withdraw->status === 'approved')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Disetujui
                                    @elseif ($withdraw->status === 'completed')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Selesai
                                    @elseif ($withdraw->status === 'rejected')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Ditolak
                                    @else
                                        <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                                        Menunggu Verifikasi
                                    @endif
                                </span>
                                <p class="text-xs text-slate-400 mt-1">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Diajukan {{ $withdraw->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-sm text-slate-500">Jumlah Penarikan</p>
                            <p class="text-2xl sm:text-3xl font-extrabold text-slate-800 mt-1">Rp
                                {{ number_format($withdraw->amount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- INFO GRID --}}
            <div class="grid sm:grid-cols-2 gap-4 mb-6">
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Campaign</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $withdraw->campaign->title ?? '-' }}
                            </p>
                            @if ($withdraw->campaign)
                                <a href="{{ route('campaign.show', $withdraw->campaign) }}"
                                    class="text-xs text-indigo-600 hover:underline mt-0.5 inline-block">Lihat campaign
                                    →</a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- REKENING --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Rekening Tujuan
                            </p>
                            @if ($withdraw->userBank)
                                <p class="text-sm font-bold text-slate-800">
                                    {{ $withdraw->userBank->bank->name ?? '-' }}
                                </p>
                                <p class="text-sm text-slate-600 font-mono tracking-wide mt-0.5">
                                    {{ $withdraw->userBank->account_number ?? '-' }}
                                </p>
                            @elseif ($withdraw->account_number)
                                <p class="text-sm font-bold text-slate-800">
                                    {{ $withdraw->bank->name ?? '-' }}
                                </p>
                                <p class="text-sm text-slate-600 font-mono tracking-wide mt-0.5">
                                    {{ $withdraw->account_number }}
                                </p>
                            @else
                                <p class="text-sm text-slate-400">-</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 sm:col-span-2">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Keterangan</p>
                            @if ($withdraw->description)
                                <p class="text-sm text-slate-700">{{ $withdraw->description }}</p>
                            @else
                                <p class="text-sm text-slate-400 italic">Tidak ada keterangan</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- BUKTI TRANSFER --}}
            @if ($withdraw->transfer_proof)
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-sm text-slate-800">Bukti Transfer</h2>
                        </div>
                        <span
                            class="text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-600 px-2.5 py-1 rounded-full">Tersedia</span>
                    </div>

                    <div class="p-6">
                        <div class="relative group cursor-pointer max-w-md mx-auto" @click="imageModal = true">
                            <img src="{{ Storage::url($withdraw->transfer_proof) }}" alt="Bukti Transfer"
                                class="w-full max-h-72 object-contain rounded-xl border border-slate-200 bg-slate-50">
                            <div
                                class="absolute inset-0 bg-black/40 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <div
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/95 text-slate-700 shadow-lg text-sm font-semibold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                    Perbesar
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- TIMELINE --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="font-bold text-sm text-slate-800">Timeline Status</h2>
                    </div>
                </div>

                <div class="p-6">
                    <div class="relative">
                        <div class="absolute left-[15px] top-6 bottom-6 w-0.5 bg-slate-200"></div>

                        <div class="space-y-8">
                            <div class="flex items-start gap-5 relative">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0 z-10 shadow-sm shadow-blue-500/30">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="pt-0.5">
                                    <p class="text-sm font-bold text-slate-800">Pengajuan Dibuat</p>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        {{ $withdraw->created_at->format('d M Y, H:i WIB') }}</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">
                                        {{ $withdraw->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 relative">
                                @if ($withdraw->status === 'pending')
                                    <div
                                        class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 z-10 ring-4 ring-amber-50">
                                        <span class="w-2.5 h-2.5 bg-amber-500 rounded-full animate-pulse"></span>
                                    </div>
                                    <div class="pt-0.5">
                                        <p class="text-sm font-bold text-amber-600">Menunggu Verifikasi</p>
                                        <p class="text-xs text-slate-500 mt-0.5">Admin sedang memverifikasi pengajuan Anda
                                        </p>
                                    </div>
                                @else
                                    <div
                                        class="w-8 h-8 rounded-full {{ $withdraw->status === 'rejected' ? 'bg-red-100' : 'bg-emerald-100' }} flex items-center justify-center flex-shrink-0 z-10">
                                        @if ($withdraw->status === 'rejected')
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                                stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor"
                                                stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="pt-0.5">
                                        <p
                                            class="text-sm font-bold {{ $withdraw->status === 'rejected' ? 'text-red-600' : 'text-emerald-600' }}">
                                            {{ $withdraw->status === 'rejected' ? 'Ditolak' : 'Disetujui' }}
                                        </p>
                                        <p class="text-xs text-slate-500 mt-0.5">
                                            {{ $withdraw->status === 'rejected' ? 'Pengajuan ditolak oleh admin' : 'Pengajuan disetujui oleh admin' }}
                                        </p>
                                        @if ($withdraw->updated_at && $withdraw->updated_at->diffInMinutes($withdraw->created_at) > 0)
                                            <p class="text-[11px] text-slate-400 mt-0.5">
                                                {{ $withdraw->updated_at->diffForHumans() }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            @if ($withdraw->status === 'approved' || $withdraw->status === 'completed')
                                <div class="flex items-start gap-5 relative">
                                    @if ($withdraw->transfer_proof)
                                        <div
                                            class="w-8 h-8 rounded-full {{ $withdraw->status === 'completed' ? 'bg-blue-500' : 'bg-blue-100' }} flex items-center justify-center flex-shrink-0 z-10 {{ $withdraw->status === 'completed' ? 'shadow-sm shadow-blue-500/30' : '' }}">
                                            @if ($withdraw->status === 'completed')
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="pt-0.5">
                                            <p
                                                class="text-sm font-bold {{ $withdraw->status === 'completed' ? 'text-blue-600' : 'text-blue-500' }}">
                                                {{ $withdraw->status === 'completed' ? 'Transfer Selesai' : 'Transfer Sedang Diproses' }}
                                            </p>
                                            <p class="text-xs text-slate-500 mt-0.5">
                                                {{ $withdraw->status === 'completed' ? 'Dana telah berhasil dikirim ke rekening Anda' : 'Dana sedang dikirim ke rekening tujuan' }}
                                            </p>
                                        </div>
                                    @else
                                        <div
                                            class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 z-10">
                                            <span class="w-2.5 h-2.5 bg-slate-400 rounded-full animate-pulse"></span>
                                        </div>
                                        <div class="pt-0.5">
                                            <p class="text-sm font-bold text-slate-500">Menunggu Transfer</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Admin akan melakukan transfer dalam
                                                1-3 hari kerja</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- RAW DATA --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                <button type="button" @click="$refs.rawData.classList.toggle('hidden')"
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
                <div x-ref="rawData" class="hidden px-6 pb-6">
                    <pre class="bg-slate-900 rounded-xl p-5 text-xs text-emerald-400 overflow-x-auto leading-relaxed">{{ json_encode($withdraw->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL - PINDAH KE SINI --}}
    <div x-data="{ imageModal: false }" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" x-show="imageModal"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="imageModal = false">

        <div x-show="imageModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" class="relative max-w-4xl w-full">

            <button @click="imageModal = false"
                class="absolute -top-12 right-0 w-10 h-10 rounded-xl bg-white/20 hover:bg-white/30 text-white flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <img src="{{ $withdraw->transfer_proof ? Storage::url($withdraw->transfer_proof) : '' }}"
                alt="Bukti Transfer" class="w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl">
        </div>
    </div>
@endsection
