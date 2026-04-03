@extends('layouts.app')

@section('title', 'Ajukan Penggalangan Dana')

@section('content')
    <div class="bg-gradient-to-br from-slate-50 via-white to-emerald-50/20 pb-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

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
            <div class="flex items-center gap-3 mb-8">
                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6m0 0v6m0 0h6m-6 4h12a2 2 0 002-2v-4a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2h12a2 2 0 002-2v-4a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800">Ajukan Penggalangan Dana</h1>
                    <p class="text-slate-500 text-sm mt-1">Lengkapi data berikut untuk proses verifikasi</p>
                </div>
            </div>

            {{-- ALERTS --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
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

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-5">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-red-700">Terjadi Kesalahan</h4>
                            <p class="text-xs text-red-600 mt-0.5">Mohon periksa kembali data yang Anda masukkan.</p>
                        </div>
                    </div>
                    <ul class="list-none space-y-2 mt-3">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-start gap-2 text-sm text-red-600">
                                <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <form method="POST" action="{{ route('pengelola.submit') }}" enctype="multipart/form-data"
                class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                @csrf

                {{-- FORM HEADER --}}
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span class="text-sm font-bold text-slate-600">Formulir Pengajuan</span>
                    </div>
                </div>

                <div class="p-6 sm:p-8 space-y-6">

                    {{-- SECTION: IDENTITAS --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-slate-700">Identitas Pemohon</h3>
                        </div>

                        {{-- PHONE --}}
                        <div>
                            <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Nomor Telepon <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 5a2 2 0 012-2V4a2 2 0 012-2h4m-1 11h2a1 1 0 011 1v1H7m10 11V7M3 15a4 4 0 004 4h4" />
                                    </svg>
                                </div>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all {{ $errors->has('phone') ? 'border-red-400 ring-2 ring-red-200 bg-red-50' : '' }}"
                                    required>
                                @error('phone')
                                    <p class="mt-1.5 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- DIVIDER --}}
                    <div class="flex items-center gap-3 my-8">
                        <div class="flex-1 h-px bg-slate-200"></div>
                        <span class="text-xs text-slate-400 font-medium">Dokumen Verifikasi</span>
                        <div class="flex-1 h-px bg-slate-200"></div>
                    </div>

                    {{-- SECTION: DOKUMEN KTP --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-slate-700">Dokumen KTP</h3>
                        </div>

                        <div x-data="{
                            preview: null,
                            fileName: '',
                            hasFile: false
                        }" x-init="if ('{{ old('ktp') }}') {
                            hasFile = true;
                            preview = '{{ old('ktp') }}';
                            fileName = 'File KTP sebelumnya';
                        }">
                            <div class="relative rounded-xl border-2 border-dashed border-slate-300 hover:border-blue-300 hover:bg-blue-50/50 p-6 text-center transition-all cursor-pointer border-2"
                                :class="hasFile ? 'border-emerald-300 bg-emerald-50/50' : ''"
                                @click="$refs.ktpInput.click()">

                                {{-- DIHAPUS: @error('ktp') class="hidden" yang menyebabkan error --}}
                                <input type="file" id="ktpInput" name="ktp" accept="image/*" x-ref="ktpInput"
                                    @change="fileName = $event.target.files[0]?.name || ''; hasFile = true; preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                                    class="hidden" required>

                                {{-- EMPTY STATE --}}
                                <div x-show="!hasFile" class="space-y-3">
                                    <div
                                        class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto">
                                        <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-600">Klik untuk upload foto KTP</p>
                                        <p class="text-xs text-slate-400 mt-1">JPG, JPEG, PNG · Maks 2MB</p>
                                    </div>
                                </div>

                                {{-- PREVIEW STATE --}}
                                <div x-show="hasFile" x-cloak class="space-y-3">
                                    <div class="relative inline-block">
                                        <img :src="preview" alt="Preview KTP"
                                            class="max-h-64 max-w-md mx-auto object-contain rounded-xl border border-emerald-200 shadow-sm">
                                        <button type="button"
                                            @click="preview = null; fileName = ''; hasFile = false; $refs.ktpInput.value = '';"
                                            class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 text-white rounded-lg flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-xs font-medium text-emerald-700 text-center" x-text="fileName"></p>
                                </div>
                            </div>

                            @error('ktp')
                                <div class="mt-3 flex items-center gap-1.5 p-3 bg-red-50 border border-red-200 rounded-xl">
                                    <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                </div>
                            @enderror

                            {{-- TIP --}}
                            <div class="flex items-start gap-2.5 mt-3 p-3 bg-blue-50 border border-blue-100 rounded-xl">
                                <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-blue-700 font-semibold">Tips Upload</p>
                                    <p class="text-[11px] text-blue-600 leading-relaxed">Pastikan foto KTP jelas, tidak
                                        blur, dan seluruh informasi terbaca.</p>
                                </div>
                            </div>
                        </div>

                        {{-- DIVIDER --}}
                        <div class="flex items-center gap-3 my-8">
                            <div class="flex-1 h-px bg-slate-200"></div>
                            <span class="text-xs text-slate-400 font-medium">Informasi Bank</span>
                            <div class="flex-1 h-px bg-slate-200"></div>
                        </div>

                        {{-- SECTION: BANK --}}
                        <div x-data="{
                            selectedBank: '{{ old('bank_id') }}',
                            showAccount: false
                        }" x-init="if ('{{ old('bank_id') }}') {
                            showAccount = true;
                        }">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-700">Rekening Bank Tujuan</h3>
                            </div>

                            {{-- BANK SELECT --}}
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <select x-model="selectedBank" name="bank_id" @change="showAccount = !!selectedBank"
                                    class="w-full appearance-none pl-12 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all cursor-pointer {{ $errors->has('bank_id') ? 'border-red-400 ring-2 ring-red-200 bg-red-50' : '' }}"
                                    required>
                                    <option value="">-- Pilih Bank --</option>
                                    @foreach ($banks as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('bank_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>

                                @error('bank_id')
                                    <p class="mt-1.5 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                    </p>
                                @enderror
                            </div>

                            {{-- ACCOUNT NUMBER (DYNAMIC) --}}
                            <div x-show="showAccount" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0">
                                <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                    Nomor Rekening <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <input type="text" name="account_number" value="{{ old('account_number') }}"
                                        placeholder="Masukkan nomor rekening"
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 font-mono tracking-wider placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all {{ $errors->has('account_number') ? 'border-red-400 ring-2 ring-red-200 bg-red-50' : '' }}"
                                        required>
                                    @error('account_number')
                                        <p class="mt-1.5 flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            {{-- PLACEHOLDER STATE --}}
                            <div x-show="!showAccount"
                                class="flex items-center gap-2.3 p-4 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                                <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m-1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm text-slate-400">Pilih bank terlebih dahulu</p>
                            </div>
                        </div>

                        {{-- DIVIDER --}}
                        <div class="flex items-center gap-3 my-8">
                            <div class="flex-1 h-px bg-slate-200"></div>
                            <span class="text-xs text-slate-400 font-medium">Konfirmasi</span>
                            <div class="flex-1 h-px bg-slate-200"></div>
                        </div>

                        {{-- SECTION: SUBMIT --}}
                        <div>
                            <div class="flex items-start gap-2.5 p-4 bg-slate-50 border border-slate-200 rounded-xl mb-6">
                                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m-1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-blue-700 font-semibold">Dengan mengirim formulir ini</p>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Anda menyetujui bahwa data yang diberikan
                                        adalah benar dan
                                        dapat dipertanggungjawab.</p>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Kirim Pengajuan
                            </button>

                            <p class="text-xs text-slate-400 text-center mt-3">
                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Data Anda aman dan hanya digunakan untuk proses verifikasi.
                            </p>
                        </div>

                    </div>
            </form>

            {{-- BACK LINK BOTTOM --}}
            <div class="mt-6 text-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

        </div>
    </div>
@endsection
