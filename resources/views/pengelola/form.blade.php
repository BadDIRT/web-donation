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

        @if ($errors->any())
            <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4">
                <ul class="text-sm text-red-600 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('pengelola.submit') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- PHONE --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Nomor Handphone
                </label>

                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx"
                    class="w-full border rounded-xl p-3 text-sm
               focus:ring-2 focus:ring-green-500 focus:outline-none
               @error('phone') border-red-500 @enderror"
                    required>

                @error('phone')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- KTP --}}
            <div x-data="{ preview: null }">
                <label for="ktp" class="block text-sm font-medium mb-2">
                    Foto KTP
                </label>

                <input type="file" id="ktp" name="ktp" accept="image/*"
                    @change="preview = URL.createObjectURL($event.target.files[0])"
                    class="block w-full text-sm text-gray-600
               file:mr-4 file:py-2 file:px-4
               file:rounded-lg file:border-0
               file:text-sm file:font-semibold
               file:bg-green-50 file:text-green-700
               hover:file:bg-green-100
               border rounded-xl p-2
               @error('ktp') border-red-500 @enderror"
                    required>

                @error('ktp')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror

                <template x-if="preview">
                    <img :src="preview" class="mt-3 w-full max-h-48 object-contain rounded-xl border"
                        alt="Preview KTP">
                </template>

                <p class="text-xs text-gray-500 mt-2">
                    Format JPG / PNG · Maks 2MB
                </p>
            </div>

            {{-- BANK --}}
            <div x-data="{ selectedBank: '{{ old('bank_id') }}' }">
                <label class="block text-sm font-medium mb-1">
                    Pilih Bank
                </label>

                <select x-model="selectedBank" name="bank_id"
                    class="w-full border rounded-xl p-3 text-sm
        focus:ring-2 focus:ring-green-500 focus:outline-none
        @error('bank_id') border-red-500 @enderror"
                    required>

                    <option value="">-- Pilih Bank --</option>

                    @foreach ($banks as $item)
                        <option value="{{ $item->id }}" {{ old('bank_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>

                @error('bank_id')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror

                {{-- INPUT REKENING --}}
                <template x-if="selectedBank">
                    <div class="mt-3">
                        <label class="block text-sm font-medium mb-1">
                            Nomor Rekening
                        </label>

                        <input type="text" name="account_number" value="{{ old('account_number') }}"
                            placeholder="Masukkan nomor rekening"
                            class="w-full border rounded-xl p-3 text-sm
                focus:ring-2 focus:ring-green-500 focus:outline-none
                @error('account_number') border-red-500 @enderror"
                            required>

                        @error('account_number')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
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
