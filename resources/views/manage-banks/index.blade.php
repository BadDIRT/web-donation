@extends('layouts.app')

@section('title', 'Kelola Rekening')

@section('content')
    <div x-data="{
        primaryModal: false,
        deleteModal: false,
        targetId: null,
        targetName: null,
        targetNumber: null,
        openPrimary(id, name, number) {
            this.targetId = id;
            this.targetName = name;
            this.targetNumber = number;
            this.primaryModal = true;
        },
        openDelete(id, name, number) {
            this.targetId = id;
            this.targetName = name;
            this.targetNumber = number;
            this.deleteModal = true;
        }
    }" class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-amber-50/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>

            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800">Kelola Rekening</h1>
                        <p class="text-slate-500 text-sm mt-0.5">Atur rekening utama untuk pencairan dana</p>
                    </div>
                </div>

                <a href="{{ route('bank.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-amber-500 to-orange-500 text-white hover:from-amber-600 hover:to-orange-600 shadow-lg shadow-amber-500/20 hover:shadow-amber-500/30 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Rekening
                </a>
            </div>

            {{-- ALERTS --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    class="mb-6 bg-red-50 border border-red-200 rounded-xl px-5 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            @endif

            {{-- INFO BOX --}}
            <div class="flex items-start gap-3 p-4 bg-blue-50 border border-blue-100 rounded-xl mb-6">
                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-xs text-blue-700 font-semibold">Rekening Utama</p>
                    <p class="text-[11px] text-blue-600 leading-relaxed mt-0.5">
                        Hanya satu rekening yang bisa dijadikan utama. Dana pencairan akan dikirim ke rekening yang ditandai
                        sebagai <span class="font-bold">Utama</span>.
                    </p>
                </div>
            </div>

            {{-- LIST REKENING --}}
            <div class="space-y-4">
                @forelse ($userBanks as $bank)
                    <div
                        class="bg-white rounded-2xl shadow-sm shadow-black/5 border-2 transition-all duration-200 overflow-hidden
                    {{ $bank->is_primary ? 'border-emerald-300 shadow-emerald-500/10' : 'border-slate-100 hover:border-slate-200 hover:shadow-md' }}">

                        @if ($bank->is_primary)
                            <div class="h-1 bg-gradient-to-r from-emerald-400 to-teal-400"></div>
                        @endif

                        <div class="p-5 sm:p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                {{-- INFO BANK --}}
                                <div class="flex items-center gap-4 min-w-0">
                                    <div
                                        class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0
                                    {{ $bank->is_primary ? 'bg-gradient-to-br from-emerald-100 to-teal-100 shadow-sm shadow-emerald-500/10' : 'bg-slate-100' }}">
                                        <svg class="w-6 h-6 {{ $bank->is_primary ? 'text-emerald-600' : 'text-slate-400' }}"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h3 class="text-base sm:text-lg font-bold text-slate-800">
                                                {{ $bank->bank->name }}</h3>
                                            @if ($bank->is_primary)
                                                <span
                                                    class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-widest bg-emerald-100 text-emerald-600 px-2.5 py-0.5 rounded-md">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        stroke-width="3" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Utama
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-2 mt-1">
                                            <p class="text-sm text-slate-500 font-mono tracking-wider font-semibold">
                                                {{ $bank->account_number }}</p>
                                            <button type="button"
                                                onclick="navigator.clipboard.writeText('{{ $bank->account_number }}'); this.innerHTML = '<span class=\'text-emerald-500 text-xs\'>Tersalin!</span>'; setTimeout(() => this.innerHTML = '<svg class=\'w-4 h-4 text-slate-400 hover:text-slate-600\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3\' /></svg>'; , 2000)"
                                                class="flex-shrink-0">
                                                <svg class="w-4 h-4 text-slate-400 hover:text-slate-600" fill="none"
                                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- TOMBOL AKSI --}}
                                <div class="flex-shrink-0">
                                    @if ($bank->is_primary)
                                        <span
                                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Aktif
                                        </span>
                                    @else
                                        <button type="button"
                                            @click="openPrimary({{ $bank->id }}, '{{ $bank->bank->name }}', '{{ $bank->account_number }}')"
                                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold border border-slate-200 text-slate-600 hover:bg-emerald-500 hover:text-white hover:border-emerald-500 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Jadikan Utama
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                        <div class="px-6 py-16 sm:py-20 text-center">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-slate-100 to-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-5">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-700">Belum Ada Rekening</h3>
                            <p class="text-slate-400 text-sm mt-1 max-w-sm mx-auto">Tambahkan rekening bank untuk menerima
                                dana pencairan dari campaign.</p>
                            <a href="{{ route('bank.create') }}"
                                class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-amber-500 to-orange-500 text-white hover:from-amber-600 hover:to-orange-600 shadow-lg shadow-amber-500/20 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Rekening Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- DANGER ZONE --}}
            @if ($userBanks->isNotEmpty())
                <div class="mt-8 bg-white rounded-2xl shadow-sm shadow-black/5 border border-red-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-red-50 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-1.964-1.333-2.732 0L4.082 16.5c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-sm text-red-600">Hapus Rekening</h3>
                    </div>
                    <div class="px-6 py-5">
                        <p class="text-sm text-slate-500 mb-4">Hapus rekening bank yang tidak digunakan. Rekening utama
                            tidak dapat dihapus.</p>
                        <div class="space-y-2">
                            @foreach ($userBanks as $bank)
                                <div
                                    class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100
                                {{ $bank->is_primary ? 'opacity-50' : 'hover:bg-red-50 hover:border-red-100' }} transition-colors">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <span
                                            class="text-sm font-semibold text-slate-700 truncate">{{ $bank->bank->name }}</span>
                                        <span
                                            class="text-xs text-slate-400 font-mono hidden sm:inline">{{ $bank->account_number }}</span>
                                        @if ($bank->is_primary)
                                            <span
                                                class="text-[9px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-md hidden sm:inline">Utama</span>
                                        @endif
                                    </div>
                                    @if ($bank->is_primary)
                                        <span class="text-xs text-slate-400 font-medium flex-shrink-0">Dilindungi</span>
                                    @else
                                        <button type="button"
                                            @click="openDelete({{ $bank->id }}, '{{ $bank->bank->name }}', '{{ $bank->account_number }}')"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium border border-red-200 text-red-600 hover:bg-red-500 hover:text-white hover:border-red-500 transition-all flex-shrink-0">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>

        {{-- ==================== MODAL: JADIKAN UTAMA ==================== --}}
        <template x-teleport="body">
            <div x-show="primaryModal" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                @click.self="primaryModal = false">

                <div x-show="primaryModal" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden">

                    {{-- HEADER --}}
                    <div class="relative px-6 pt-8 pb-4 text-center bg-gradient-to-br from-emerald-50 to-teal-50">
                        <button type="button" @click="primaryModal = false"
                            class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-white/80 flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Jadikan Utama?</h3>
                    </div>

                    {{-- BODY --}}
                    <div class="px-6 py-5">
                        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl mb-4">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-slate-800 text-sm" x-text="targetName"></p>
                                <p class="text-xs text-slate-400 font-mono" x-text="targetNumber"></p>
                            </div>
                        </div>

                        <p class="text-sm text-slate-500 text-center mb-5">
                            Rekening ini akan menjadi tujuan utama untuk menerima dana pencairan.
                        </p>

                        <form method="POST" action="{{ route('admin.banks.set-primary', '__ID__') }}"
                            x-ref="primaryForm">
                            @csrf @method('PUT')
                            <input type="hidden" name="_method" value="PUT">
                            <div class="flex gap-3">
                                <button type="button" @click="primaryModal = false"
                                    class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 transition-all"
                                    @click="$refs.primaryForm.action = '{{ route('admin.banks.set-primary', '__ID__') }}'.replace('__ID__', targetId)">
                                    Ya, Jadikan Utama
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>

        {{-- ==================== MODAL: HAPUS ==================== --}}
        <template x-teleport="body">
            <div x-show="deleteModal" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                @click.self="deleteModal = false">

                <div x-show="deleteModal" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden">

                    {{-- HEADER --}}
                    <div class="relative px-6 pt-8 pb-4 text-center bg-gradient-to-br from-red-50 to-rose-50">
                        <button type="button" @click="deleteModal = false"
                            class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-white/80 flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-red-100 to-rose-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Hapus Rekening?</h3>
                    </div>

                    {{-- BODY --}}
                    <div class="px-6 py-5">
                        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl mb-4">
                            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-slate-800 text-sm" x-text="targetName"></p>
                                <p class="text-xs text-slate-400 font-mono" x-text="targetNumber"></p>
                            </div>
                        </div>

                        <p class="text-sm text-slate-500 text-center mb-4">Tindakan ini akan menghapus rekening secara
                            permanen.</p>

                        <div class="flex items-start gap-2.5 p-3 bg-red-50 border border-red-100 rounded-xl mb-5">
                            <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-1.964-1.333-2.732 0L4.082 16.5c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="text-xs text-red-600 font-medium">Pastikan tidak ada proses pencairan yang
                                menggunakan rekening ini.</p>
                        </div>

                        <form method="POST" action="{{ route('bank.destroy', '__ID__') }}" x-ref="deleteForm">
                            @csrf @method('DELETE')
                            <input type="hidden" name="_method" value="DELETE">
                            <div class="flex gap-3">
                                <button type="button" @click="deleteModal = false"
                                    class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/20 transition-all flex items-center justify-center gap-2"
                                    @click="$refs.deleteForm.action = '{{ route('bank.destroy', '__ID__') }}'.replace('__ID__', targetId)">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Ya, Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>

    </div>

    {{-- ==================== MODAL: HAPUS ==================== --}}
    <template x-teleport="body">
        <div x-show="deleteModal" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="deleteModal = false">

            <div x-show="deleteModal" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden">

                {{-- HEADER --}}
                <div class="relative px-6 pt-8 pb-4 text-center bg-gradient-to-br from-red-50 to-rose-50">
                    <button type="button" @click="deleteModal = false"
                        class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-white/80 flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-red-100 to-rose-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Hapus Rekening?</h3>
                </div>

                {{-- BODY --}}
                <div class="px-6 py-5">
                    <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl mb-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center text-sm font-bold text-red-600 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="font-bold text-slate-800 text-sm" x-text="targetName"></p>
                            <p class="text-xs text-slate-400 font-mono" x-text="targetNumber"></p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-500 text-center mb-4">Tindakan ini akan menghapus rekening secara
                        permanen.</p>

                    <div class="flex items-start gap-2.5 p-3 bg-red-50 border border-red-100 rounded-xl mb-5">
                        <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-1.964-1.333-2.732 0L4.082 16.5c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-xs text-red-600 font-medium">Pastikan tidak ada proses pencairan yang
                            menggunakan rekening ini.</p>
                    </div>

                    <form method="POST" :action="`{{ url('/banks') }}/${targetId}`">
                        @csrf @method('DELETE')
                        <div class="flex gap-3">
                            <button type="button" @click="deleteModal = false"
                                class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/20 transition-all flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Ya, Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    </div>
@endsection
