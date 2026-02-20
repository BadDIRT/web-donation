@extends('layouts.auth')

@section('title', 'Ajukan Penggalang Dana')

@section('content')

    <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8">

        {{-- HEADER --}}
        <div class="mb-6 text-center">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">
                Pengajuan Penggalang Dana
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Lengkapi data berikut untuk proses verifikasi
            </p>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('pengelola.submit') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- PHONE --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Nomor Handphone
                </label>
                <input type="text" name="phone" placeholder="08xxxxxxxxxx"
                    class="w-full border rounded-xl p-3 text-sm
                       focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required>
            </div>

            {{-- KTP --}}
            <div x-data="{ preview: null }">
                <label for="ktp" class="block text-sm font-medium mb-2">
                    Foto KTP
                </label>

                <input type="file" id="ktp" name="ktp" accept="image/*" required
                    @change="preview = URL.createObjectURL($event.target.files[0])"
                    class="block w-full text-sm text-gray-600
               file:mr-4 file:py-2 file:px-4
               file:rounded-lg file:border-0
               file:text-sm file:font-semibold
               file:bg-green-50 file:text-green-700
               hover:file:bg-green-100
               border rounded-xl p-2">

                {{-- PREVIEW --}}
                <template x-if="preview">
                    <img :src="preview" class="mt-3 w-full max-h-48 object-contain rounded-xl border"
                        alt="Preview KTP">
                </template>

                <p class="text-xs text-gray-500 mt-2">
                    Format JPG / PNG · Maks 2MB
                </p>
            </div>

            {{-- BANK --}}
            <div x-data="{ bank: '' }">
                <label class="block text-sm font-medium mb-1">
                    Pilih Bank
                </label>

                <select x-model="bank"
                    class="w-full border rounded-xl p-3 text-sm
               focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required>
                    <option value="">-- Pilih Bank --</option>
                    <option value="BCA">BCA</option>
                    <option value="BRI">BRI</option>
                    <option value="BNI">BNI</option>
                    <option value="Mandiri">Mandiri</option>
                    <option value="CIMB">CIMB Niaga</option>
                    <option value="BTN">BTN</option>
                    <option value="BSI">BSI</option>
                    <option value="Lainnya">Lainnya</option>
                </select>

                {{-- NOMOR REKENING --}}
                <template x-if="bank">
                    <div class="mt-3">
                        <label class="block text-sm font-medium mb-1">
                            Nomor Rekening {{ ' ' }} <span class="text-green-600" x-text="bank"></span>
                        </label>

                        <input type="text" name="bank_account" placeholder="Masukkan nomor rekening"
                            class="w-full border rounded-xl p-3 text-sm
                       focus:ring-2 focus:ring-green-500 focus:outline-none"
                            required>
                    </div>
                </template>
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600
                   text-white py-3 rounded-xl font-semibold transition">
                Kirim Pengajuan
            </button>

            <p class="text-xs text-gray-500 text-center">
                Data Anda aman dan hanya digunakan untuk proses verifikasi
            </p>

        </form>

    </div>

@endsection
