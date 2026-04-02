@extends('layouts.app')

@section('title', 'Kelola Rekening')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-1.5 h-8 bg-green-500 rounded-full"></div>
                    <h1 class="text-3xl font-bold text-gray-800">Kelola Rekening</h1>
                </div>
                <p class="text-gray-500 max-w-xl">
                    Pilih salah satu rekening bank yang akan digunakan sebagai rekening utama (default) untuk menerima dana
                    pencairan.
                </p>
            </div>

            {{-- ALERT MESSAGE --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- LIST REKENING --}}
            <div class="space-y-4">
                @forelse ($userBanks as $bank)
                    <div
                        class="bg-white rounded-2xl p-6 shadow-sm border-2 transition
                        {{ $bank->is_primary ? 'border-green-500 shadow-green-100' : 'border-gray-100 hover:border-gray-200' }}">

                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                            {{-- INFO BANK --}}
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 {{ $bank->is_primary ? 'bg-green-100' : 'bg-gray-100' }} rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 {{ $bank->is_primary ? 'text-green-600' : 'text-gray-500' }}"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-width="2" d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-3" />
                                    </svg>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        {{ $bank->bank->name }}
                                        @if ($bank->is_primary)
                                            <span
                                                class="ml-2 text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full font-medium align-middle">
                                                Utama
                                            </span>
                                        @endif
                                    </h3>
                                    <p class="text-sm text-gray-500 font-mono tracking-wider mt-1">
                                        {{ $bank->account_number }}
                                    </p>
                                </div>
                            </div>

                            {{-- TOMBOL AKSI --}}
                            <div>
                                @if ($bank->is_primary)
                                    <span
                                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-green-50 text-green-600 cursor-default">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Rekening Aktif
                                    </span>
                                @else
                                    <form action="{{ route('admin.banks.set-primary', $bank->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-gray-100 text-gray-700 hover:bg-green-500 hover:text-white transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Jadikan Utama
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-gray-300">
                        <svg class="mx-auto w-16 h-16 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-3" />
                        </svg>
                        <h3 class="mt-4 text-lg font-semibold text-gray-700">Belum ada rekening</h3>
                        <p class="text-gray-500 mt-1 text-sm">Silakan tambahkan rekening bank terlebih dahulu.</p>
                        <a href="{{ route('bank.create') }}"
                            class="mt-4 inline-block bg-green-500 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-green-600 transition">
                            Tambah Rekening
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- KEMBALI --}}
            <div class="mt-8">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-green-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

        </div>
    </div>
@endsection
