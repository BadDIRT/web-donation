@extends('layouts.form')

@section('title', 'Buat Campaign')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-white py-10 px-4">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                {{-- HEADER --}}
                <div class="relative px-6 sm:px-10 py-10 bg-gradient-to-r from-green-500 to-emerald-500 text-white">
                    <div class="relative z-10 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2
                                    3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold">
                                Buat Campaign Baru
                            </h1>
                            <p class="text-white/90 mt-1 text-sm">
                                Buat penggalangan dana dengan cerita yang kuat dan transparan.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <form method="POST" action="{{ route('campaign.store') }}" enctype="multipart/form-data"
                    class="px-6 sm:px-10 py-8 space-y-8">
                    @csrf

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="rounded-xl bg-red-50 border border-red-200 p-4">
                            <div class="font-semibold text-red-700 mb-2">
                                ⚠️ Terjadi kesalahan
                            </div>
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- GRID --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- JUDUL --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">
                                Judul Campaign
                            </label>
                            <input type="text" name="title" placeholder="Contoh: Bantu Biaya Operasi Anak Yatim"
                                value="{{ old('title') }}"
                                class="w-full rounded-xl px-4 py-3 border
                            {{ $errors->has('title') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }}
                            focus:ring-2 focus:ring-green-500">
                            @error('title')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- TARGET --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">
                                Target Dana (Rp)
                            </label>

                            <input type="text" id="target_display" placeholder="Contoh: Rp 50.000.000"
                                value="{{ old('target_amount') ? 'Rp ' . number_format(old('target_amount'), 0, ',', '.') : '' }}"
                                class="w-full rounded-xl px-4 py-3 border
                            {{ $errors->has('target_amount') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }}"
                                oninput="formatRupiah(this)">

                            <input type="hidden" name="target_amount" id="target_amount"
                                value="{{ old('target_amount') }}">

                            @error('target_amount')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-medium text-gray-700">
                                Deskripsi Singkat
                            </label>
                            <textarea name="description" rows="3" placeholder="Ringkasan singkat tentang tujuan campaign"
                                class="w-full rounded-xl px-4 py-3 border
                            {{ $errors->has('description') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }}">{{ old('description') }}</textarea>
                        </div>

                        {{-- ARTIKEL --}}
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-medium text-gray-700">
                                Cerita Lengkap Campaign
                            </label>
                            <textarea name="article" rows="6" placeholder="Ceritakan latar belakang masalah, tujuan, dan penggunaan dana"
                                class="w-full rounded-xl px-4 py-3 border
                            {{ $errors->has('article') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }}">{{ old('article') }}</textarea>
                        </div>

                        {{-- KATEGORI --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">
                                Kategori
                            </label>
                            <select name="category_id" class="w-full rounded-xl px-4 py-3 border border-gray-300">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- IMAGE --}}
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">
                                Gambar Campaign
                            </label>

                            <label
                                class="relative w-full aspect-video flex items-center justify-center border-2 border-dashed rounded-2xl cursor-pointer overflow-hidden hover:border-green-400 hover:bg-green-50 transition">

                                {{-- PREVIEW --}}
                                <img id="image-preview" class="hidden max-h-full max-w-full object-contain" />

                                {{-- PLACEHOLDER --}}
                                <div id="image-placeholder" class="text-center text-gray-500 px-4">
                                    <p class="font-medium">Klik untuk upload gambar</p>
                                    <p class="text-xs mt-1 text-gray-400">
                                        JPG / PNG • Maks 5MB • Rasio disarankan 16:9
                                    </p>
                                </div>

                                <input type="file" name="image" class="hidden" accept="image/*"
                                    onchange="previewImage(event)">
                            </label>

                            @error('image')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div class="flex justify-end gap-3 pt-6 border-t">
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-3 rounded-xl border text-gray-600 hover:bg-gray-50">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-6 py-3 rounded-xl bg-green-500 hover:bg-green-600 text-white font-semibold shadow">
                            Submit Campaign
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/[^0-9]/g, '');

            if (!value) {
                document.getElementById('target_amount').value = '';
                input.value = '';
                return;
            }

            document.getElementById('target_amount').value = value;

            input.value = 'Rp ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;

            // VALIDASI SIZE (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran gambar maksimal 5MB');
                event.target.value = '';
                return;
            }

            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('image-placeholder');

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };

            reader.readAsDataURL(file);
        }
    </script>
@endsection
