@extends('layouts.form')

@section('title', 'Buat Campaign')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-white py-10 px-4">

        <div class="max-w-4xl mx-auto">

            {{-- CARD --}}
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                {{-- HEADER --}}
                <div class="relative px-6 sm:px-10 py-10 bg-gradient-to-r from-green-500 to-emerald-500 text-white">
                    <div class="relative z-10">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                                {{-- ICON --}}
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2
                                                                                                                 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2" />
                                </svg>
                            </div>

                            <div>
                                <h1 class="text-2xl sm:text-3xl font-bold">
                                    Buat Campaign Baru
                                </h1>
                                <p class="text-white/90 mt-1 max-w-xl text-sm sm:text-base">
                                    Buat penggalangan dana dengan cerita yang kuat dan transparan.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- DECORATIVE SVG --}}
                    <svg class="absolute right-0 top-0 h-full opacity-10" viewBox="0 0 200 200"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill="white"
                            d="M40,-60C53,-52,66,-44,73,-32C80,-20,80,-5,75,9C70,23,60,36,47,44C34,52,17,55,1,54C-15,53,-30,48,-44,40C-58,32,-71,21,-75,7C-79,-7,-74,-25,-63,-37C-52,-49,-35,-55,-18,-62C-1,-69,15,-77,40,-60Z"
                            transform="translate(100 100)" />
                    </svg>
                </div>

                {{-- FORM --}}
                <form method="POST" enctype="multipart/form-data" class="px-6 sm:px-10 py-8 space-y-8">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
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
                        <div>
                            <label class="flex items-center gap-2 text-sm font-medium text-gray-700 mb-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h10M7 11h10M7 15h6" />
                                </svg>
                                Judul Campaign
                            </label>

                            <input type="text" name="title" value="{{ old('title') }}"
                                class="w-full rounded-xl px-4 py-3
    border {{ $errors->has('title') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }}
    focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Contoh: Bantu Biaya Pengobatan Anak Yatim">

                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- TARGET --}}

                        <div>
                            <label class="flex items-center gap-2 text-sm font-medium text-gray-700 mb-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2
                                                     3 .895 3 2-1.343 2-3 2" />
                                </svg>
                                Target Dana (Rp)
                            </label>

                            {{-- INPUT TAMPILAN --}}
                            <input type="text" id="target_display" placeholder="Contoh: Rp 50.000.000"
                                value="{{ old('target_amount') ? 'Rp ' . number_format(old('target_amount'), 0, ',', '.') : '' }}"
                                class="w-full rounded-xl px-4 py-3
        border {{ $errors->has('target_amount') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }}"
                                oninput="formatRupiah(this)">

                            {{-- INPUT ASLI (DIKIRIM KE SERVER) --}}
                            <input type="hidden" name="target_amount" id="target_amount"
                                value="{{ old('target_amount') }}">

                            @error('target_amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Deskripsi Singkat
                            </label>
                            <textarea name="description" rows="3"
                                class="w-full rounded-xl px-4 py-3
    border {{ $errors->has('description') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }}"
                                placeholder="Ringkasan singkat mengenai tujuan campaign">{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ARTIKEL --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Cerita Lengkap Campaign
                            </label>
                            <textarea name="article" rows="6"
                                class="w-full rounded-xl px-4 py-3
    border {{ $errors->has('article') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }}"
                                placeholder="Ceritakan latar belakang masalah, tujuan penggalangan dana, dan rencana penggunaan dana">{{ old('article') }}</textarea>

                            @error('article')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- KATEGORI --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Kategori
                            </label>
                            <select name="category_id"
                                class="w-full rounded-xl border-gray-300 px-4 py-3 bg-white
                                   focus:ring-2 focus:ring-green-500 focus:border-green-500">
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
                        <div>
                            <label class="flex items-center gap-2 text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M12 12v9M8 12l4-4 4 4" />
                                </svg>
                                Gambar Campaign
                            </label>

                            <label id="image-dropzone"
                                class="relative w-full aspect-video
        flex items-center justify-center
        border-2 border-dashed rounded-2xl
        cursor-pointer overflow-hidden transition
        {{ $errors->has('image')
            ? 'border-red-400 bg-red-50'
            : 'border-gray-300 hover:border-green-400 hover:bg-green-50' }}">

                                {{-- PREVIEW --}}
                                <img id="image-preview" class="hidden max-h-full max-w-full object-contain" />

                                {{-- PLACEHOLDER --}}
                                <div id="image-placeholder"
                                    class="absolute inset-0 flex flex-col items-center justify-center text-center">
                                    <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 15a4 4 0 004 4h10a4 4 0 004-4M7 10l5-5 5 5M12 5v9" />
                                    </svg>

                                    <p class="text-sm text-gray-600">
                                        Klik untuk upload gambar
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        JPG / PNG • Maks 5MB • Rasio 16:9
                                    </p>
                                </div>

                                <input type="file" name="image" class="hidden" accept="image/*"
                                    onchange="previewImage(event)">
                            </label>

                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ACTION --}}
                        <div class="md:col-span-2">
                            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t">
                                <a href="{{ route('dashboard') }}"
                                    class="inline-flex justify-center items-center
                   px-6 py-3 rounded-xl border
                   text-gray-600 hover:bg-gray-50 transition">
                                    Batal
                                </a>

                                <button type="submit" onclick="this.disabled=true;this.form.submit();"
                                    class="inline-flex justify-center items-center
                   px-6 py-3 rounded-xl bg-green-500 hover:bg-green-600
                   text-white font-semibold shadow transition disabled:opacity-60">
                                    Submit Campaign
                                </button>
                            </div>
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
    </script>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;

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
