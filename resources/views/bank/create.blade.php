@extends('layouts.auth')

@section('title', 'Tambah Bank')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

        <div class="w-full max-w-md bg-white rounded-2xl shadow p-6">

            <h1 class="text-xl font-bold text-gray-800 mb-6">
                Tambah Rekening Bank
            </h1>

            <form action="{{ route('bank.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- PILIH BANK --}}
                <div>
                    <label class="text-sm text-gray-600">Bank</label>
                    <select name="bank_id" required class="w-full mt-1 border rounded-xl p-3 text-sm">

                        @foreach ($banks as $bank)
                            <option value="{{ $bank->id }}">
                                {{ $bank->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- NO REKENING --}}
                <div>
                    <label class="text-sm text-gray-600">Nomor Rekening</label>
                    <input type="text" name="account_number" required class="w-full mt-1 border rounded-xl p-3 text-sm"
                        placeholder="Contoh: 1234567890">
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end gap-2 pt-4">
                    <a href="{{ url()->previous() }}" class="px-4 py-2 text-sm rounded-xl border">
                        Batal
                    </a>

                    <button type="submit" class="px-4 py-2 text-sm rounded-xl bg-green-500 text-white">
                        Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>
@endsection
