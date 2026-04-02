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

                {{-- TITLE --}}
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Daftar Rekening Tersedia
                    </h2>
                </div>

                {{-- BANK GRID --}}
                <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                    @forelse ($userBanks as $bank)
                        <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition border">

                            <div class="flex items-center justify-between mb-4">
                                <p class="text-sm text-gray-800 font-semibold">
                                    {{ $bank->bank->name }}
                                </p>

                                @if ($bank->is_primary)
                                    <span class="text-xs bg-green-100 text-green-600 px-2.5 py-1 rounded-full font-medium">
                                        Utama
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-width="2" d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-3" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 font-mono tracking-wide">
                                    {{ $bank->account_number }}
                                </p>
                            </div>

                        </div>
                    @empty
                        <p class="text-gray-500 col-span-full text-center py-8">
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

                {{-- CARD KELOLA USER BARU --}}
                <a href="{{ route('admin.users.index') }}"
                    class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-lg font-semibold text-gray-800 group-hover:text-green-600">
                            Kelola User
                        </h2>
                        <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m3 5.197V21" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500">
                        Tambah, edit, atau hapus akun pengguna.
                    </p>
                </a>

                <a href="{{ route('admin.pengelola') }}" ...>

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

                    {{-- 🔥 CARD KELOLA REKENING BARU --}}
                    <a href="{{ route('admin.banks.manage') }}"
                        class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition border-2 border-dashed border-gray-300 hover:border-green-500">

                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-lg font-semibold text-gray-800 group-hover:text-green-600">
                                Kelola Rekening
                            </h2>
                            <div
                                class="w-10 h-10 bg-gray-100 group-hover:bg-green-100 rounded-xl flex items-center justify-center transition">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-gray-600 group-hover:text-green-600 transition" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500">
                            Ubah rekening utama / default untuk menerima dana.
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
