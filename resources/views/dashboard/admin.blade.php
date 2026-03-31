@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-1.5 h-8 bg-green-500 rounded-full"></div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        Dashboard Admin
                    </h1>
                </div>
                <p class="text-gray-500 max-w-xl">
                    Ringkasan data utama dan kontrol platform donasi.
                </p>
            </div>

            {{-- STATS --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-12">

                {{-- TOTAL USER --}}
                <div class="bg-gradient-to-br from-blue-100 to-white rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-500">Total User</p>
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold mt-4 text-gray-800">
                        {{ $totalUsers }}
                    </p>
                </div>

                {{-- TOTAL CAMPAIGN --}}
                <div
                    class="bg-gradient-to-br from-violet-100 to-white rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Total Campaign</p>
                    <p class="text-3xl font-bold mt-4 text-gray-800">
                        {{ $totalCampaigns }}
                    </p>
                </div>

                {{-- TOTAL DONASI --}}
                <div class="bg-gradient-to-br from-green-100 to-white rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Total Donasi</p>
                    <p class="text-3xl font-bold mt-4 text-gray-800">
                        Rp {{ number_format($totalDonations, 0, ',', '.') }}
                    </p>
                </div>

            </div>

            {{-- BANK SECTION --}}
            <div class="mb-12">

                {{-- TOTAL SALDO --}}
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl p-6 shadow-lg mb-8">
                    <p class="text-sm opacity-80">Total Saldo Seluruh Bank</p>
                    <p class="text-3xl font-bold mt-2">
                        Rp {{ number_format($totalBankBalance, 0, ',', '.') }}
                    </p>
                </div>

                {{-- TITLE --}}
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Saldo per Bank
                    </h2>
                </div>

                {{-- BANK GRID --}}
                <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                    @forelse ($userBanks as $bank)
                        <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition">

                            <div class="flex items-center justify-between mb-4">
                                <p class="text-sm text-gray-500 font-medium">
                                    {{ $bank->bank->name }}
                                </p>

                                @if ($bank->is_primary)
                                    <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded">
                                        Utama
                                    </span>
                                @endif

                                <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center">
                                    {{-- SVG --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-width="2" d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-3" />
                                    </svg>
                                </div>
                            </div>

                            <p class="text-xs text-gray-400 mb-1">
                                {{ $bank->account_number }}
                            </p>

                            <p class="text-xl font-bold text-green-600">
                                Rp {{ number_format($bank->balance, 0, ',', '.') }}
                            </p>

                        </div>
                    @empty
                        <p class="text-gray-500 col-span-full text-center">
                            Tidak ada rekening tersedia
                        </p>
                    @endforelse

                </div>
            </div>

            {{-- QUICK ACTION --}}
            <div class="grid gap-6 md:grid-cols-3">

                <a href="{{ route('admin.pengelola') }}"
                    class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold text-gray-800 group-hover:text-green-600">
                        Pengelola Pending
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Setujui atau tolak pengajuan.
                    </p>
                </a>

                <a href="{{ route('admin.campaign') }}"
                    class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold text-gray-800 group-hover:text-green-600">
                        Campaign Pending
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Review campaign baru.
                    </p>
                </a>

                <a href="{{ route('admin.campaign.active') }}"
                    class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold text-gray-800 group-hover:text-green-600">
                        Campaign Aktif
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Kelola campaign berjalan.
                    </p>
                </a>

                <a href="{{ route('bank.create') }}"
                    class="group bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-2xl p-6 shadow hover:shadow-lg transition">

                    <div class="flex items-center justify-between">

                        <div>
                            <h2 class="text-lg font-semibold">
                                Tambah Rekening
                            </h2>

                            <p class="text-sm opacity-80 mt-1">
                                Tambahkan rekening bank baru
                            </p>
                        </div>

                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            {{-- SVG PLUS --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>

                    </div>
                </a>

                <a href="{{ route('admin.withdrawals') }}"
                    class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition">

                    <div class="flex items-center justify-between mb-3">

                        <h2 class="text-lg font-semibold text-gray-800 group-hover:text-green-600">
                            Withdraw Request
                        </h2>

                        <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 10H6L5 9z" />
                            </svg>
                        </div>

                    </div>

                    <p class="text-sm text-gray-500">
                        Persetujuan penarikan dana pengelola
                    </p>

                    {{-- BADGE JUMLAH --}}
                    @if ($pendingWithdraws > 0)
                        <div class="mt-4">
                            <span
                                class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-red-100 text-red-600 rounded-full">
                                {{ $pendingWithdraws }} pending
                            </span>
                        </div>
                    @endif

                </a>

                <a href="{{ route('admin.activities') }}"
                    class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition">

                    <div class="flex items-center justify-between mb-3">

                        <h2 class="text-lg font-semibold text-gray-800 group-hover:text-green-600">
                            Riwayat Aktivitas
                        </h2>

                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-width="2" d="M12 8v4l3 3M12 3a9 9 0 100 18 9 9 0 000-18z" />
                            </svg>
                        </div>

                    </div>

                    <p class="text-sm text-gray-500">
                        Lihat semua aktivitas sistem dan notifikasi pengguna
                    </p>

                </a>

            </div>

        </div>
    </div>
@endsection
