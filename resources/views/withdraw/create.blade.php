@extends('layouts.app')

@section('title', 'Ajukan Penarikan Dana')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50/20">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-indigo-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>

            {{-- HEADER --}}
            <div class="flex items-center gap-4 mb-8">
                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800">Ajukan Penarikan</h1>
                    <p class="text-slate-500 text-sm mt-0.5">Tarik dana campaign ke rekening bank</p>
                </div>
            </div>

            {{-- ALERT --}}
            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
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

            {{-- FORM CARD --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">

                {{-- FORM HEADER --}}
                <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h2 class="font-bold text-sm text-slate-700">Formulir Penarikan</h2>
                    </div>
                </div>

                <form action="{{ route('withdraw.store') }}" method="POST" class="p-6 sm:p-8">

                    @csrf
                    <input type="hidden" name="campaign_id" id="campaign_id" value="{{ old('campaign_id') }}">

                    <div class="space-y-6">

                        {{-- PILIH CAMPAIGN --}}
                        <div x-data="{ selected: '{{ old('campaign_id') }}' }">
                            <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-3">
                                Pilih Campaign
                                <span class="text-red-400">*</span>
                            </label>

                            @forelse ($campaigns as $campaign)
                                <div class="space-y-2">
                                    <button type="button"
                                        @click="selected = '{{ $campaign->id }}'; document.getElementById('campaign_id').value = '{{ $campaign->id }}';"
                                        class="w-full text-left border rounded-xl p-4 transition-all duration-200 hover:shadow-sm
                                        @if (old('campaign_id') == $campaign->id) border-indigo-300 bg-indigo-50 ring-2 ring-indigo-200
                                        @else
                                            border-slate-200 hover:border-slate-300 @endif"
                                        :class="selected == '{{ $campaign->id }}' ?
                                            'border-indigo-300 bg-indigo-50 ring-2 ring-indigo-200 shadow-sm shadow-indigo-500/10' :
                                            'border-slate-200 hover:border-slate-300'">

                                        <div class="flex items-center justify-between gap-3">
                                            <div class="flex items-center gap-3 min-w-0">
                                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors
                                                    :class="selected=='{{ $campaign->id }}'
                                                    ? 'bg-indigo-100'
                                                    : 'bg-slate-100'">
                                                                    <svg class="w-5 h-5 transition-colors" :class="selected == '{{ $campaign->id }}' ?
                                                                        'text-indigo-600' :
                                                                        'text-slate-400'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d=" M19 11H5m14
                                                    0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0
                                                    00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-semibold text-slate-800 truncate">
                                                    {{ $campaign->title }}</p>
                                                <p class="text-xs text-slate-400 mt-0.5">ID: {{ $campaign->id }}</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-3 flex-shrink-0">
                                            <div class="text-right">
                                                <p class="text-xs text-slate-400">Saldo tersedia</p>
                                                <p class="text-sm font-bold text-emerald-600">Rp
                                                    {{ number_format($campaign->current_amount_rd_pengelola, 0, ',', '.') }}
                                                </p>
                                            </div>

                                            {{-- CHECK ICON --}}
                                            <div class="w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 transition-all"
                                                :class="selected == '{{ $campaign->id }}' ?
                                                    'bg-indigo-500 scale-100 opacity-100' :
                                                    'bg-slate-100 scale-0 opacity-0'">
                                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor"
                                                    stroke-width="3" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                        </div>
                                </div>
                                </button>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                            <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <p class="text-slate-500 font-semibold text-sm">Tidak Ada Campaign</p>
                            <p class="text-slate-400 text-xs mt-1">Belum ada campaign yang bisa ditarik dananya</p>
                            <a href="{{ route('admin.campaign.create') }}"
                                class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:underline mt-3">
                                Buat Campaign Baru
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V8a2 2 0 00-2-2h-2M10 6a2 2 0 002 2h2a2 2 0 002-2" />
                                </svg>
                            </a>
                        </div>
                        @endforelse

                        @error('campaign_id')
                            <div class="flex items-center gap-1.5 mt-2">
                                <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    {{-- DIVIDER --}}
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span
                                class="bg-white px-4 text-xs text-slate-400 uppercase tracking-widest font-semibold flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Detail Penarikan
                            </span>
                        </div>
                    </div>

                    {{-- JUMLAH PENARIKAN --}}
                    <div x-data="{
                        display: '{{ old('amount') ? 'Rp ' . number_format(old('amount'), 0, ',', '.') : '' }}',
                        value: '{{ old('amount') }}',
                        formatRupiah() {
                            let num = this.display.replace(/[^0-9]/g, '');
                            this.value = num;
                            if (!num) { this.display = ''; return; }
                            this.display = 'Rp ' + new Intl.NumberFormat('id-ID').format(num);
                        }
                    }">
                        <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                            Jumlah Penarikan
                            <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="text" x-model="display" @input="formatRupiah()"
                                placeholder="Contoh: Rp 5.000.000"
                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all font-mono tracking-wider
                                @error('amount') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                            <input type="hidden" name="amount" :value="value">
                        </div>

                        @if ($errors->has('amount'))
                            <div class="flex items-start gap-2 mt-2 p-2.5 bg-red-50 border border-red-100 rounded-lg">
                                <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-1.964-1.333-2.732 0L4.082 16.5c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <p class="text-xs text-red-600">{{ $errors->first('amount') }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- REKENING BANK --}}
                    <div>
                        <label for="user_bank_id"
                            class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                            Rekening Tujuan
                            <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <select id="user_bank_id" name="user_bank_id" required
                                class="w-full pl-12 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all appearance-none cursor-pointer
                                @error('user_bank_id') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                                <option value="" disabled {{ !old('user_bank_id') ? 'selected' : '' }}>-- Pilih
                                    Rekening --</option>
                                @foreach ($userBanks as $bank)
                                    <option value="{{ $bank->id }}"
                                        {{ (old('user_bank_id') ?? ($bank->is_primary ? $bank->id : null)) == $bank->id ? 'selected' : '' }}>
                                        {{ $bank->bank->name }} - {{ $bank->account_number }}
                                        @if ($bank->is_primary)
                                            (Utama)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        @error('user_bank_id')
                            <div class="flex items-center gap-1.5 mt-2">
                                <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                            </div>
                        @enderror

                        @if ($userBanks->isEmpty())
                            <div class="flex items-start gap-2.5 mt-3 p-3 bg-amber-50 border border-amber-100 rounded-xl">
                                <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-amber-700 font-semibold">Belum ada rekening</p>
                                    <a href="{{ route('bank.create') }}"
                                        class="text-[11px] text-indigo-600 hover:underline mt-0.5 inline-block">
                                        Tambah rekening terlebih dahulu →
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- KETERANGAN --}}
                    <div>
                        <label for="description"
                            class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                            Keterangan
                        </label>
                        <textarea id="description" name="description" rows="3"
                            placeholder="Contoh: Pencairan untuk biaya operasional campaign bulan ini"
                            class="w-full pl-4 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all resize-none">{{ old('description') }}</textarea>
                        <p class="text-[10px] text-slate-400 mt-1.5">Opsional, bisa diisi atau dikosongkan</p>
                    </div>

                    {{-- INFO BOX --}}
                    <div class="flex items-start gap-3 p-4 bg-indigo-50 border border-indigo-100 rounded-xl">
                        <svg class="w-5 h-5 text-indigo-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-xs text-indigo-700 font-semibold">Informasi Penarikan</p>
                            <ul class="text-[11px] text-indigo-600 mt-1 space-y-0.5 leading-relaxed">
                                <li>• Dana akan dikirim ke rekening yang dipilih dalam 1-3 hari kerja</li>
                                <li>• Minimal pencairan Rp 10.000</li>
                                <li>• Pastikan saldo campaign mencukupi</li>
                                <li>• Status penarikan bisa dipantau di menu penarikan</li>
                            </ul>
                        </div>
                    </div>

            </div>

            {{-- ACTIONS --}}
            <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                <a href="{{ route('dashboard') }}"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold border border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
                <button type="submit"
                    class="flex-[2] inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold bg-gradient-to-r from-indigo-500 to-violet-500 text-white hover:from-indigo-600 hover:to-violet-600 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/30 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Ajukan Penarikan
                </button>
            </div>

            </form>
        </div>

    </div>
    </div>
@endsection
