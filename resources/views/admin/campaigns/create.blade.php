@extends('layouts.app')

@section('title', 'Buat Campaign - Admin')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>

                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">Buat Campaign Baru</h1>
                        <p class="text-slate-500 text-sm mt-0.5">Campaign yang dibuat admin akan langsung aktif tanpa
                            verifikasi.</p>
                    </div>
                </div>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">

                <form action="{{ route('admin.campaign.store') }}" method="POST" enctype="multipart/form-data"
                    id="campaignForm">
                    @csrf

                    <div class="p-6 sm:p-8 space-y-8">

                        {{-- BADGE INFO --}}
                        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3">
                            <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-sm text-emerald-700">
                                <span class="font-semibold">Mode Admin:</span> Campaign akan otomatis disetujui dan langsung
                                tampil di halaman publik.
                            </p>
                        </div>

                        {{-- JUDUL CAMPAIGN --}}
                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">
                                Judul Campaign <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                placeholder="Contoh: Bantu Pendidikan Anak Daerah Terpencil"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                required maxlength="255">
                            <div class="flex justify-between mt-1.5">
                                @error('title')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @else
                                    <p class="text-xs text-slate-400">Judul yang menarik akan meningkatkan donasi</p>
                                @enderror
                                <p class="text-xs text-slate-400" id="titleCount">0/255</p>
                            </div>
                        </div>

                        {{-- KATEGORI --}}
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">
                                Kategori
                            </label>
                            <select id="category_id" name="category_id"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all bg-white">
                                <option value="">-- Pilih Kategori (Opsional) --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- TARGET DONASI --}}
                        <div>
                            <label for="target_amount_display" class="block text-sm font-semibold text-slate-700 mb-2">
                                Target Donasi <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-500">Rp</span>
                                <input type="text" id="target_amount_display"
                                    value="{{ old('target_amount') ? number_format(old('target_amount'), 0, ',', '.') : '' }}"
                                    placeholder="100.000.000"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all font-mono"
                                    required oninput="formatCurrency(this)">
                                <input type="hidden" id="target_amount" name="target_amount"
                                    value="{{ old('target_amount') }}">
                            </div>
                            <div class="flex justify-between mt-1.5">
                                @error('target_amount')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @else
                                    <p class="text-xs text-slate-400">Minimal Rp 100.000</p>
                                @enderror
                                <p class="text-xs font-semibold text-emerald-600" id="targetPreview"></p>
                            </div>
                        </div>

                        {{-- GAMBAR COVER --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Gambar Cover <span class="text-red-400">*</span>
                            </label>
                            <div id="dropZone"
                                class="relative border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:border-emerald-400 hover:bg-emerald-50/30 transition-all cursor-pointer"
                                onclick="document.getElementById('image').click()">
                                <input type="file" id="image" name="image"
                                    accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden"
                                    onchange="previewImage(this)">

                                <div id="uploadPlaceholder">
                                    <div
                                        class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21zM16.5 7.5h.008v.008H16.5V7.5z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-slate-600 font-medium">Klik untuk upload gambar</p>
                                    <p class="text-xs text-slate-400 mt-1">JPEG, PNG, JPG, Webp • Maks 5MB</p>
                                </div>

                                <div id="imagePreviewContainer" class="hidden">
                                    <img id="imagePreview" class="max-h-48 mx-auto rounded-lg shadow-sm" alt="Preview">
                                    <p class="text-xs text-emerald-600 font-medium mt-2">Klik untuk ganti gambar</p>
                                </div>
                            </div>
                            @error('image')
                                <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- DESKRIPSI SINGKAT --}}
                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">
                                Deskripsi Singkat <span class="text-red-400">*</span>
                            </label>
                            <textarea id="description" name="description" rows="3"
                                placeholder="Tulis deskripsi singkat yang akan muncul di card campaign (maks 500 karakter)"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all resize-none"
                                required maxlength="500">{{ old('description') }}</textarea>
                            <div class="flex justify-between mt-1.5">
                                @error('description')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @else
                                    <p class="text-xs text-slate-400">Akan tampil di halaman listing campaign</p>
                                @enderror
                                <p class="text-xs text-slate-400" id="descCount">0/500</p>
                            </div>
                        </div>

                        {{-- KONTEN ARTIKEL --}}
                        <div>
                            <label for="article" class="block text-sm font-semibold text-slate-700 mb-2">
                                Konten Artikel <span class="text-red-400">*</span>
                            </label>
                            <div
                                class="border border-slate-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-emerald-500/20 focus-within:border-emerald-500 transition-all">

                                {{-- MINI TOOLBAR --}}
                                <div class="flex items-center gap-1 px-3 py-2 bg-slate-50 border-b border-slate-200">
                                    <button type="button" onclick="formatText('bold')"
                                        class="p-1.5 rounded-lg hover:bg-slate-200 transition-colors" title="Bold">
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                            stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z" />
                                        </svg>
                                    </button>
                                    <button type="button" onclick="formatText('italic')"
                                        class="p-1.5 rounded-lg hover:bg-slate-200 transition-colors" title="Italic">
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10 4h4m-2 0l-4 16m0 0h4" />
                                        </svg>
                                    </button>
                                    <div class="w-px h-5 bg-slate-300 mx-1"></div>
                                    <button type="button" onclick="formatText('insertUnorderedList')"
                                        class="p-1.5 rounded-lg hover:bg-slate-200 transition-colors" title="Bullet List">
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                        </svg>
                                    </button>
                                    <button type="button" onclick="formatText('insertOrderedList')"
                                        class="p-1.5 rounded-lg hover:bg-slate-200 transition-colors" title="Number List">
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 6h.01M8 6h12M4 12h.01M8 12h12M4 18h.01M8 18h12" />
                                        </svg>
                                    </button>
                                </div>

                                <textarea id="article" name="article" rows="12"
                                    placeholder="Tulis konten lengkap campaign di sini...&#10;&#10;Jelaskan latar belakang, tujuan penggalangan dana, dan bagaimana dana akan digunakan."
                                    class="w-full px-4 py-3 text-slate-800 placeholder-slate-400 text-sm focus:outline-none resize-y" required>{{ old('article') }}</textarea>
                            </div>
                            @error('article')
                                <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- FOOTER BUTTONS --}}
                    <div
                        class="px-6 sm:px-8 py-5 bg-slate-50/80 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <a href="{{ route('admin.dashboard') }}"
                            class="w-full sm:w-auto px-6 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors text-center">
                            Batal
                        </a>
                        <button type="submit" id="submitBtn"
                            class="w-full sm:w-auto px-8 py-2.5 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Buat & Publikasikan Campaign
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Character counters
        const titleInput = document.getElementById('title');
        const titleCount = document.getElementById('titleCount');
        const descInput = document.getElementById('description');
        const descCount = document.getElementById('descCount');

        titleInput.addEventListener('input', () => {
            titleCount.textContent = `${titleInput.value.length}/255`;
            titleCount.classList.toggle('text-amber-500', titleInput.value.length > 200);
            titleCount.classList.toggle('text-red-500', titleInput.value.length >= 250);
        });

        descInput.addEventListener('input', () => {
            descCount.textContent = `${descInput.value.length}/500`;
            descCount.classList.toggle('text-amber-500', descInput.value.length > 400);
            descCount.classList.toggle('text-red-500', descInput.value.length >= 480);
        });

        // Currency formatter
        function formatCurrency(displayInput) {
            let value = displayInput.value.replace(/\D/g, '');
            const hiddenInput = document.getElementById('target_amount');

            if (value === '') {
                displayInput.value = '';
                hiddenInput.value = '';
                document.getElementById('targetPreview').textContent = '';
                return;
            }

            let number = parseInt(value);
            displayInput.value = number.toLocaleString('id-ID');
            hiddenInput.value = number; // Simpan angka murni tanpa format
            document.getElementById('targetPreview').textContent = `≈ Rp ${number.toLocaleString('id-ID')}`;
        }

        // Restore formatted value on load
        document.addEventListener('DOMContentLoaded', () => {
            const displayInput = document.getElementById('target_amount_display');
            const hiddenInput = document.getElementById('target_amount');
            if (hiddenInput.value) {
                let number = parseInt(hiddenInput.value);
                displayInput.value = number.toLocaleString('id-ID');
                document.getElementById('targetPreview').textContent = `≈ Rp ${number.toLocaleString('id-ID')}`;
            }
        });

        // Image preview
        function previewImage(input) {
            const placeholder = document.getElementById('uploadPlaceholder');
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewImg = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    input.value = '';
                    alert('Ukuran gambar melebihi 5MB. Silakan pilih gambar lain.');
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

        // Drag and drop
        const dropZone = document.getElementById('dropZone');
        const imageInput = document.getElementById('image');

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
                imageInput.files = files;
                previewImage(imageInput);
            }
        });

        // Simple text format helpers (for visual only, textarea doesn't support execCommand)
        function formatText(command) {
            const textarea = document.getElementById('article');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);

            let formatted = '';
            switch (command) {
                case 'bold':
                    formatted = `**${selectedText || 'teks bold'}**`;
                    break;
                case 'italic':
                    formatted = `_${selectedText || 'teks miring'}_`;
                    break;
                case 'insertUnorderedList':
                    formatted = `• ${selectedText || 'item list'}`;
                    break;
                case 'insertOrderedList':
                    formatted = `1. ${selectedText || 'item list'}`;
                    break;
            }

            textarea.value = textarea.value.substring(0, start) + formatted + textarea.value.substring(end);
            textarea.focus();
            textarea.setSelectionRange(start + formatted.length, start + formatted.length);
        }

        // Form submission loading state
        document.getElementById('campaignForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = `
            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            Memproses...
        `;
        });
    </script>
@endpush
