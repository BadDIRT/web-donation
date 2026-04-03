@extends('layouts.app')

@section('title', 'Buat Campaign Baru')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

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
            <div class="flex items-center gap-4 mb-8">
                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800">Buat Campaign</h1>
                    <p class="text-slate-500 text-sm mt-0.5">Buat penggalangan dana dengan cerita yang kuat</p>
                </div>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">

                {{-- FORM HEADER --}}
                <div
                    class="relative px-6 sm:px-8 py-8 bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-500 overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 400 100" fill="none">
                            <circle cx="350" cy="50" r="80" fill="white" />
                            <circle cx="50" cy="-20" r="60" fill="white" />
                        </svg>
                    </div>
                    <div class="relative flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Informasi Campaign</h2>
                            <p class="text-emerald-100 text-sm mt-0.5">Isi data campaign dengan lengkap dan akurat</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('campaign.store') }}" enctype="multipart/form-data"
                    class="p-6 sm:p-8">

                    @csrf

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-100 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-1.964-1.333-2.732 0L4.082 16.5c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-red-700 mb-1">Ada {{ $errors->count() }} kesalahan
                                    </p>
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

                    <div class="space-y-6">

                        {{-- JUDUL & TARGET ROW --}}
                        <div class="grid sm:grid-cols-2 gap-5">

                            {{-- JUDUL --}}
                            <div>
                                <label for="title"
                                    class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                    Judul Campaign
                                    <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                                        placeholder="Contoh: Bantu Anak Yatim" required
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all
                                    @error('title') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                                </div>
                                @error('title')
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

                            {{-- TARGET DANA --}}
                            <div>
                                <label for="target_display"
                                    class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                    Target Dana
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
                                    <input type="text" id="target_display" placeholder="Contoh: Rp 50.000.000"
                                        value="{{ old('target_amount') ? 'Rp ' . number_format(old('target_amount'), 0, ',', '.') : '' }}"
                                        x-data @input="formatRupiah($el)"
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all font-mono tracking-wider
                                    @error('target_amount') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                                    <input type="hidden" name="target_amount" id="target_amount"
                                        value="{{ old('target_amount') }}">
                                </div>
                                @error('target_amount')
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
                        </div>

                        {{-- KATEGORI --}}
                        <div>
                            <label for="category_id"
                                class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Kategori
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <select id="category_id" name="category_id" required
                                    class="w-full pl-12 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all appearance-none cursor-pointer
                                @error('category_id') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">
                                    <option value="" disabled {{ !old('category_id') ? 'selected' : '' }}>-- Pilih
                                        Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
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
                            @error('category_id')
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

                        {{-- GAMBAR CAMPAIGN --}}
                        <div x-data="{ preview: null, fileName: '' }">
                            <label class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Gambar Campaign
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="relative border-2 border-dashed rounded-2xl p-6 text-center transition-colors
                            {{ $errors->has('image') ? 'border-red-300 bg-red-50/50' : 'border-slate-200 hover:border-emerald-300 hover:bg-emerald-50/30' }}"
                                :class="{ 'border-emerald-400 bg-emerald-50/50': preview }">

                                <input type="file" name="image" accept="image/*" id="image-input" required
                                    @change="let file = $event.target.files[0]; if(file) { if(file.size > 5*1024*1024) { alert('Ukuran gambar maksimal 5MB'); $event.target.value = ''; return; } preview = URL.createObjectURL(file); fileName = file.name; } else { preview = null; fileName = ''; }"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                                {{-- DEFAULT --}}
                                <div x-show="!preview" class="py-4">
                                    <div
                                        class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-3
                                    {{ $errors->has('image') ? 'bg-red-100' : '' }}">
                                        <svg class="w-8 h-8 {{ $errors->has('image') ? 'text-red-400' : 'text-slate-400' }}"
                                            fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p
                                        class="text-sm font-semibold {{ $errors->has('image') ? 'text-red-600' : 'text-slate-600' }}">
                                        {{ $errors->has('image') ? 'Upload ulang gambar' : 'Klik untuk upload gambar' }}
                                    </p>
                                    <p class="text-xs text-slate-400 mt-1">JPG / PNG · Maks 5MB · Rasio 16:9</p>
                                </div>

                                {{-- PREVIEW --}}
                                <div x-show="preview" x-cloak>
                                    <div class="relative inline-block">
                                        <img :src="preview" alt="Preview"
                                            class="max-h-56 object-contain rounded-xl border border-slate-200 mx-auto shadow-sm">
                                        <button type="button"
                                            @click="preview = null; fileName = ''; document.getElementById('image-input').value = '';"
                                            class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-xs font-medium text-emerald-700 mt-3" x-text="fileName"></p>
                                </div>
                            </div>

                            @error('image')
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
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Cerita Campaign
                                </span>
                            </div>
                        </div>

                        {{-- DESKRIPSI --}}
                        <div>
                            <label for="description"
                                class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Deskripsi Singkat
                            </label>
                            <textarea id="description" name="description" rows="3"
                                placeholder="Ringkasan singkat tentang tujuan campaign (akan ditampilkan di card)"
                                class="w-full pl-4 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all resize-none">{{ old('description') }}</textarea>
                            <p class="text-[10px] text-slate-400 mt-1.5">Akan ditampilkan di card campaign</p>
                        </div>

                        {{-- ARTIKEL / CERITA --}}
                        <div>
                            <label for="article"
                                class="flex items-center gap-1.5 text-sm font-semibold text-slate-700 mb-2">
                                Cerita Lengkap
                                <span class="text-red-400">*</span>
                            </label>
                            <textarea id="article" name="article" rows="8"
                                placeholder="Ceritakan latar belakang masalah, tujuan penggalangan, rencana penggunaan dana, dan dampak yang diharapkan..."
                                required
                                class="w-full pl-4 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all resize-y
                            @error('article') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror">{{ old('article') }}</textarea>
                            <div class="flex items-center justify-between mt-1.5">
                                @error('article')
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                    </div>
                                @else
                                    <span></span>
                                @enderror
                                <p class="text-[10px] text-slate-400">Minimal 100 karakter</p>
                            </div>
                        </div>

                        {{-- TIPS --}}
                        <div class="flex items-start gap-3 p-4 bg-emerald-50 border border-emerald-100 rounded-xl">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.631a3.378 3.378 0 00-.862-2.206l.548-.547a5 5 0 00-7.072 0l-.548.547A3.374 3.374 0 005 11.074V12a2 2 0 014 0v-.631a3.378 3.378 0 00.862-2.206l-.548-.547z" />
                            </svg>
                            <div>
                                <p class="text-xs text-emerald-700 font-semibold">Tips Membuat Campaign yang Menarik</p>
                                <ul class="text-[11px] text-emerald-600 mt-1 space-y-0.5 leading-relaxed">
                                    <li>• Gunakan judul yang spesifik dan menarik perhatian</li>
                                    <li>• Ceritakan latar belakang masalah secara detail</li>
                                    <li>• Jelaskan rencana penggunaan dana secara transparan</li>
                                    <li>• Sertakan bukti foto jika memungkinkan</li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                        <a href="{{ route('dashboard') }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold border border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-[2] inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Publish Campaign
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    {{-- SCRIPT --}}
    @push('scripts')
        <script>
            function formatRupiah(el) {
                let value = el.value.replace(/[^0-9]/g, '');

                if (!value) {
                    document.getElementById('target_amount').value = '';
                    el.value = '';
                    return;
                }

                document.getElementById('target_amount').value = value;
                el.value = 'Rp ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        </script>
    @endpush
@endsection
