@extends('layouts.auth')

@section('title', 'Tambah Bank')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-6">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-xl font-bold text-gray-800">
                Tambah Rekening Bank
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Tambahkan rekening untuk menerima pencairan dana
            </p>
        </div>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 p-3 rounded-xl text-sm text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bank.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- PILIH BANK --}}
            <div>
                <label class="text-sm font-medium text-gray-700">
                    Pilih Bank
                </label>

                <select name="bank_id"
                    class="w-full mt-1 border rounded-xl p-3 text-sm
                    focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required>

                    <option value="">-- Pilih Bank --</option>

                    @foreach ($banks as $bank)
                        <option value="{{ $bank->id }}">
                            {{ $bank->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- NO REKENING --}}
            <div>
                <label class="text-sm font-medium text-gray-700">
                    Nomor Rekening
                </label>

                <input type="text" name="account_number"
                    class="w-full mt-1 border rounded-xl p-3 text-sm
                    focus:ring-2 focus:ring-green-500 focus:outline-none"
                    placeholder="Contoh: 1234567890"
                    required>
            </div>

            {{-- UPLOAD KTP --}}
            <div x-data="{ preview: null }">
                <label class="text-sm font-medium text-gray-700">
                    Upload Foto KTP
                </label>

                <input type="file" name="ktp" accept="image/*"
                    @change="preview = URL.createObjectURL($event.target.files[0])"
                    class="w-full mt-2 text-sm
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-green-50 file:text-green-700
                    hover:file:bg-green-100
                    border rounded-xl p-2"
                    required>

                {{-- PREVIEW --}}
                <template x-if="preview">
                    <img :src="preview"
                        class="mt-3 w-full max-h-48 object-contain rounded-xl border">
                </template>

                <p class="text-xs text-gray-500 mt-2">
                    Format JPG/PNG · Maks 2MB
                </p>
            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-2 pt-4">
                <a href="{{ url()->previous() }}"
                    class="px-4 py-2 text-sm rounded-xl border hover:bg-gray-100">
                    Batal
                </a>

                <button type="submit"
                    class="px-4 py-2 text-sm rounded-xl bg-green-500 text-white hover:bg-green-600 transition">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>
@endsection