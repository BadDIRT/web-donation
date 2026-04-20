@extends('layouts.app')

@section('title', 'Detail Withdraw #' . $withdraw->id)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-red-50/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('admin.withdrawals') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar Withdraw
            </a>

            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-rose-500 flex items-center justify-center shadow-lg shadow-red-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">Verifikasi Penarikan Dana</h1>
                        <p class="text-slate-500 text-sm mt-0.5">Review detail pengajuan sebelum memproses</p>
                    </div>
                </div>

                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-600 self-start">
                    <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                    Pending
                </span>
            </div>

            {{-- DETAIL INFO --}}
            <div class="grid gap-4 sm:grid-cols-2 mb-6">

                {{-- NOMINAL (HERO) --}}
                <div
                    class="sm:col-span-2 relative bg-gradient-to-br from-red-500 via-rose-500 to-pink-500 rounded-2xl p-6 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2">
                    </div>
                    <div class="relative">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-red-200" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <p class="text-sm font-medium text-red-200">Jumlah Penarikan</p>
                        </div>
                        <p class="text-3xl sm:text-4xl font-extrabold text-white">
                            Rp {{ number_format($withdraw->amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                {{-- PENGELOLA --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        @if ($withdraw->user->profile_photo_path)
                            <img src="{{ $withdraw->user->profile_photo_url }}"
                                class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Pengelola</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $withdraw->user->name }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ $withdraw->user->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- CAMPAIGN --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Campaign</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $withdraw->campaign->title }}</p>
                            <p class="text-xs text-slate-400">ID: {{ $withdraw->campaign->id }}</p>
                        </div>
                    </div>
                </div>

                {{-- REKENING TUJUAN --}}
                @if ($withdraw->userBank)
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
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Rekening
                                    Tujuan</p>
                                <p class="text-sm font-bold text-slate-800">{{ $withdraw->userBank->bank->name ?? '-' }}</p>
                                <p class="text-sm text-slate-600 font-mono tracking-wide">
                                    {{ $withdraw->userBank->account_number ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Rekening
                                    Tujuan</p>
                                <p class="text-sm text-slate-400 italic">Data rekening tidak tersedia</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- KETERANGAN --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Keterangan</p>
                            <p class="text-sm text-slate-700">{{ $withdraw->description ?? 'Tidak ada keterangan' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- WAKTU INFO --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 p-5 mb-6">
                <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs text-slate-500">Diajukan: <span
                                class="font-semibold text-slate-700">{{ $withdraw->created_at->translatedFormat('d M Y, H:i') }}</span></span>
                    </div>
                    <div class="w-px h-4 bg-slate-200 hidden sm:block"></div>
                    <span class="text-xs text-slate-400">{{ $withdraw->created_at->diffForHumans() }}</span>
                    <div class="w-px h-4 bg-slate-200 hidden sm:block"></div>
                    <span class="text-xs text-slate-400 font-mono">Withdraw ID: #{{ $withdraw->id }}</span>
                </div>
            </div>

            {{-- ACTION SECTION --}}
            <div x-data="{ openApprove: false, openReject: false }"
                class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">

                {{-- SECTION HEADER --}}
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="font-bold text-slate-800">Keputusan Penarikan</h2>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <p class="text-sm text-slate-500">
                            Pastikan sudah melakukan transfer ke rekening tujuan, lalu upload bukti transfer.
                        </p>
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <button type="button" @click="openReject = true"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium border border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Tolak
                            </button>
                            <button type="button" @click="openApprove = true"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Approve
                            </button>
                        </div>
                    </div>

                    {{-- TIP --}}
                    <div class="flex items-start gap-2.5 px-4 py-3 bg-blue-50 border border-blue-200 rounded-xl">
                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs text-blue-600 leading-relaxed">
                            <span class="font-semibold">Penting:</span> Pastikan nominal transfer sesuai dengan jumlah
                            penarikan di atas. Bukti transfer wajib diupload untuk keperluan audit.
                        </p>
                    </div>
                </div>

                {{-- ==================== MODAL APPROVE ==================== --}}
                <div x-show="openApprove" x-cloak x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">

                    <div @click.outside="openApprove = false" x-show="openApprove" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">

                        {{-- MODAL HEADER --}}
                        <div class="px-6 pt-6 pb-2">
                            <div class="flex items-center gap-3 mb-1">
                                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800">Approve Penarikan</h3>
                            </div>
                        </div>

                        {{-- MODAL BODY --}}
                        <div class="px-6 py-4">
                            {{-- SUMMARY --}}
                            <div class="bg-slate-50 rounded-xl p-4 mb-5 space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Pengelola</span>
                                    <span class="font-semibold text-slate-800">{{ $withdraw->user->name }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Campaign</span>
                                    <span
                                        class="font-semibold text-slate-800 truncate max-w-[200px]">{{ $withdraw->campaign->title }}</span>
                                </div>
                                @if ($withdraw->userBank)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500">Rekening</span>
                                        <span
                                            class="font-semibold text-slate-800">{{ $withdraw->userBank->bank->name ?? '-' }}
                                            - {{ $withdraw->userBank->account_number ?? '-' }}</span>
                                    </div>
                                @endif
                                <div class="border-t border-slate-200 pt-2 mt-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500">Jumlah Transfer</span>
                                        <span class="font-extrabold text-emerald-600">Rp
                                            {{ number_format($withdraw->amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- FORM --}}
                            <form method="POST" action="{{ route('admin.withdrawals.approve', $withdraw->id) }}"
                                enctype="multipart/form-data" class="space-y-4" id="approveForm">

                                @csrf

                                {{-- UPLOAD BUKTI --}}
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">
                                        Bukti Transfer <span class="text-red-400">*</span>
                                    </label>

                                    <div id="dropZoneApprove"
                                        class="relative border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:border-emerald-400 hover:bg-emerald-50/30 transition-all cursor-pointer"
                                        onclick="document.getElementById('transfer_proof').click()">

                                        <input type="file" id="transfer_proof" name="transfer_proof"
                                            accept="image/jpeg,image/png,image/jpg" class="hidden" required
                                            onchange="previewProof(this)">

                                        <div id="proofPlaceholder">
                                            <div
                                                class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <p class="text-sm text-slate-600 font-medium">Klik untuk upload bukti</p>
                                            <p class="text-xs text-slate-400 mt-1">JPG, PNG • Maks 4MB</p>
                                        </div>

                                        <div id="proofPreviewContainer" class="hidden">
                                            <img id="proofPreview" class="max-h-40 mx-auto rounded-lg shadow-sm"
                                                alt="Preview">
                                            <p class="text-xs text-emerald-600 font-medium mt-2">Klik untuk ganti gambar
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- MODAL FOOTER --}}
                        <div class="px-6 pb-6 flex gap-3">
                            <button type="button" @click="openApprove = false"
                                class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                Batal
                            </button>
                            <button type="submit" form="approveForm"
                                class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 transition-all">
                                Konfirmasi Approve
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ==================== MODAL REJECT ==================== --}}
                <div x-show="openReject" x-cloak x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">

                    <div @click.outside="openReject = false" x-show="openReject" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden">

                        {{-- MODAL HEADER --}}
                        <div class="px-6 pt-8 pb-2 text-center">
                            <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Tolak Penarikan?</h3>
                        </div>

                        {{-- MODAL BODY --}}
                        <div class="px-6 py-4">
                            <div class="bg-slate-50 rounded-xl p-4 text-center mb-4">
                                <p class="text-sm text-slate-600">Penarikan dari</p>
                                <p class="font-bold text-slate-800 mt-1">{{ $withdraw->user->name }}</p>
                                <p class="text-xs text-slate-400 mt-0.5 truncate">{{ $withdraw->campaign->title }}</p>
                                <p class="text-sm font-extrabold text-red-600 mt-2">Rp
                                    {{ number_format($withdraw->amount, 0, ',', '.') }}</p>
                            </div>

                            <form method="POST" action="{{ route('admin.withdrawals.reject', $withdraw->id) }}"
                                class="space-y-3">
                                @csrf

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Alasan Penolakan <span class="text-red-400">*</span>
                                    </label>
                                    <textarea name="reason" rows="3" required
                                        placeholder="Contoh: Rekening tujuan tidak valid, saldo tidak mencukupi..."
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all resize-none"></textarea>
                                </div>

                                <div class="flex gap-3 pt-1">
                                    <button type="button" @click="openReject = false"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/20 transition-all">
                                        Tolak
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Preview bukti transfer
        function previewProof(input) {
            const placeholder = document.getElementById('proofPlaceholder');
            const previewContainer = document.getElementById('proofPreviewContainer');
            const previewImg = document.getElementById('proofPreview');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validate size (4MB)
                if (file.size > 4 * 1024 * 1024) {
                    input.value = '';
                    alert('Ukuran file melebihi 4MB. Silakan pilih gambar lain.');
                    return;
                }

                // Validate type
                if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    input.value = '';
                    alert('Format file harus JPG atau PNG.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    placeholder.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                placeholder.classList.remove('hidden');
                previewContainer.classList.add('hidden');
            }
        }

        // Drag and drop for approve proof
        const dropZone = document.getElementById('dropZoneApprove');
        const proofInput = document.getElementById('transfer_proof');

        if (dropZone) {
            ['dragenter', 'dragover'].forEach(event => {
                dropZone.addEventListener(event, (e) => {
                    e.preventDefault();
                    dropZone.classList.add('border-emerald-400', 'bg-emerald-50/50');
                });
            });

            ['dragleave', 'drop'].forEach(event => {
                dropZone.addEventListener(event, (e) => {
                    e.preventDefault();
                    dropZone.classList.remove('border-emerald-400', 'bg-emerald-50/50');
                });
            });

            dropZone.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    proofInput.files = files;
                    previewProof(proofInput);
                }
            });
        }
    </script>
@endpush
