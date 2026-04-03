@extends('layouts.app')

@section('title', 'Tambah Rekening Bank')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-amber-50/20">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('admin.banks.manage') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-amber-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Kelola Rekening
            </a>

            {{-- HEADER --}}
            <div class="flex items-center gap-4 mb-8">
                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-800">Tambah Rekening</h1>
                    <p class="text-slate-500 text-sm mt-0.5">Tambahkan rekening bank untuk pencairan dana</p>
                </div>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">

                {{-- FORM HEADER --}}
                <div class="px-6 sm:px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <h2 class="font-bold text-sm text-slate-700">Data Rekening</h2>
                    </div>
                </div>

                {{-- VALIDATION ERRORS --}}
                @if ($errors->any())
                    <div class="mx-6 sm:mx-8 mt-6 bg-red-50 border border-red-100 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-1.964-1.333-2.732 0L4.082 16.5c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-red-700 mb-1">Ada {{ $errors->count() }} kesalahan</p>
                                <ul class="text-xs text-red-600 space-y-0.5">
                                    @foreach ($errors->all() as $error)
                                        <li class="flex items-start gap-1.5">
                                            <span class="text-red-400 mt-0.5">•</span>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('bank.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">

                    @csrf

                    <div class="space-y-6">

                        {{-- PILIH BANK --}}
                        <div>
                            <label for="bank_id"
                                class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Pilih Bank
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
                                <select id="bank_id" name="bank_id" required
                                    class="w-full pl-12 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 focus:bg-white transition-all appearance-none cursor-pointer
                                @error('bank_id') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                                    <option value="" disabled selected>-- Pilih Bank --</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}"
                                            {{ old('bank_id') == $bank->id ? 'selected' : '' }}>
                                            {{ $bank->name }}
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
                            @error('bank_id')
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

                        {{-- NO REKENING --}}
                        <div>
                            <label for="account_number"
                                class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Nomor Rekening
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </div>
                                <input type="text" id="account_number" name="account_number"
                                    value="{{ old('account_number') }}" placeholder="Contoh: 1234567890" required
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 focus:bg-white transition-all font-mono tracking-wider
                                @error('account_number') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                            </div>
                            @error('account_number')
                                <div class="flex items-center gap-1.5 mt-2">
                                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
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
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Verifikasi
                                </span>
                            </div>
                        </div>

                        {{-- UPLOAD KTP --}}
                        <div x-data="{ preview: null, fileName: '' }">
                            <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Upload Foto KTP
                                <span class="text-red-400">*</span>
                            </label>

                            {{-- DROPZONE --}}
                            <div class="relative border-2 border-dashed rounded-xl p-6 text-center transition-colors
                            {{ $errors->has('ktp') ? 'border-red-300 bg-red-50/50' : 'border-slate-200 hover:border-amber-300 hover:bg-amber-50/30' }}"
                                :class="{ 'border-amber-400 bg-amber-50/50': preview }">

                                <input type="file" name="ktp" accept="image/*" id="ktp-input" required
                                    @change="let file = $event.target.files[0]; if(file) { preview = URL.createObjectURL(file); fileName = file.name; } else { preview = null; fileName = ''; }"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                                {{-- DEFAULT STATE --}}
                                <div x-show="!preview" class="space-y-3">
                                    <div
                                        class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto
                                    {{ $errors->has('ktp') ? 'bg-red-100' : '' }}">
                                        <svg class="w-7 h-7 {{ $errors->has('ktp') ? 'text-red-400' : 'text-slate-400' }}"
                                            fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p
                                            class="text-sm font-semibold {{ $errors->has('ktp') ? 'text-red-600' : 'text-slate-600' }}">
                                            {{ $errors->has('ktp') ? 'Upload ulang foto KTP' : 'Klik untuk upload foto KTP' }}
                                        </p>
                                        <p class="text-xs text-slate-400 mt-1">Format JPG, JPEG, PNG · Maks 2MB</p>
                                    </div>
                                </div>

                                {{-- PREVIEW STATE --}}
                                <div x-show="preview" x-cloak class="space-y-3">
                                    <div class="relative inline-block">
                                        <img :src="preview" alt="Preview KTP"
                                            class="max-h-48 object-contain rounded-xl border border-slate-200 mx-auto shadow-sm">
                                        <button type="button"
                                            @click="preview = null; fileName = ''; document.getElementById('ktp-input').value = '';"
                                            class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-xs font-medium text-amber-700" x-text="fileName"></p>
                                </div>
                            </div>

                            @error('ktp')
                                <div class="flex items-center gap-1.5 mt-2">
                                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                <p class="text-[11px] text-blue-600 leading-relaxed">
                                    <span class="font-semibold">Tips:</span> Pastikan foto KTP jelas, tidak blur, dan semua
                                    informasi terbaca dengan baik.
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                        <a href="{{ route('admin.banks.manage') }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold border border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold bg-gradient-to-r from-amber-500 to-orange-500 text-white hover:from-amber-600 hover:to-orange-600 shadow-lg shadow-amber-500/20 hover:shadow-amber-500/30 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Rekening
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
