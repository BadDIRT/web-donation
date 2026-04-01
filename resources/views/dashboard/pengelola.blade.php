@extends('layouts.app')

@section('title', 'Dashboard Pengelola')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">

            {{-- HEADER --}}
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    Dashboard @if(auth()->user()->is_approved) Pengelola @else Donatur @endif
                </h1>
                <p class="text-gray-500 mt-2 max-w-2xl">
                    Pantau status campaign Anda dan kelola penggalangan dana dengan mudah.
                </p>
            </div>

            {{-- STATS --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Total Campaign</p>
                    <p class="text-3xl font-bold mt-2 text-gray-800">
                        {{ $totalCampaign }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 border border-green-100 hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Campaign Aktif</p>
                    <p class="text-3xl font-bold mt-2 text-green-600">
                        {{ $approvedCampaign }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 border border-yellow-100 hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Menunggu Verifikasi</p>
                    <p class="text-3xl font-bold mt-2 text-yellow-500">
                        {{ $pendingCampaign }}
                    </p>
                </div>

            </div>

            {{-- BANK --}}
            @if (auth()->user()->is_approved)
                <div class="space-y-6">

                    {{-- TOTAL --}}
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl p-6 shadow-lg">
                        <p class="text-sm opacity-80">Total Saldo Anda</p>
                        <p class="text-3xl font-bold mt-2">
                            Rp {{ number_format($totalBalance, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- GRID --}}
                    <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                        @forelse ($userBanks as $bank)
                            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition">

                                <div class="flex justify-between items-center mb-3">
                                    <p class="text-sm text-gray-500 font-medium">
                                        {{ $bank->bank->name }}
                                    </p>

                                    @if ($bank->is_primary)
                                        <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded">
                                            Utama
                                        </span>
                                    @endif
                                </div>

                                <p class="text-xs text-gray-400 mb-1">
                                    {{ $bank->account_number }}
                                </p>

                                <p class="text-xl font-bold text-green-600">
                                    Rp {{ number_format($bank->balance, 0, ',', '.') }}
                                </p>

                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">
                                Belum ada rekening
                            </p>
                        @endforelse

                    </div>
                </div>
            @endif
            @if (auth()->user()->is_approved)
                {{-- QUICK ACTION --}}
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                    <a href="{{ route('campaign.create') }}"
                        class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Buat Campaign
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Mulai penggalangan dana baru
                        </p>
                    </a>

                    @if (auth()->user()->is_approved)
                        <a href="{{ route('bank.create') }}"
                            class="bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-2xl p-6 shadow hover:shadow-lg transition">

                            <h2 class="text-lg font-semibold">
                                Tambah Rekening
                            </h2>
                            <p class="text-sm opacity-80 mt-1">
                                Tambahkan rekening bank baru
                            </p>

                        </a>
                    @endif

                    @if (auth()->user()->is_approved)
                        <a href="{{ route('withdraw.create') }}"
                            class="bg-white border border-green-100 rounded-2xl p-6 shadow-sm hover:shadow-lg transition">

                            <div class="flex items-center justify-between">

                                <div>
                                    <h2 class="text-lg font-semibold text-gray-800">
                                        Ajukan Penarikan
                                    </h2>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Tarik dana dari campaign Anda
                                    </p>
                                </div>

                                <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-width="2" d="M17 9l-5 5-5-5" />
                                    </svg>
                                </div>

                            </div>
                        </a>
                    @endif

                </div>

                {{-- RIWAYAT PENARIKAN --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Riwayat Penarikan
                        </h2>
                        <p class="text-sm text-gray-500">
                            Pantau status pengajuan penarikan dana Anda
                        </p>
                    </div>

                    <div class="overflow-x-auto">
                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div class="bg-yellow-50 rounded-xl p-4 text-center">
                                <p class="text-xs text-gray-500">Pending</p>
                                <p class="text-lg font-bold text-yellow-600">
                                    {{ $withdraws->where('status', 'pending')->count() }}
                                </p>
                            </div>

                            <div class="bg-green-50 rounded-xl p-4 text-center">
                                <p class="text-xs text-gray-500">Approved</p>
                                <p class="text-lg font-bold text-green-600">
                                    {{ $withdraws->where('status', 'approved')->count() }}
                                </p>
                            </div>

                            <div class="bg-red-50 rounded-xl p-4 text-center">
                                <p class="text-xs text-gray-500">Rejected</p>
                                <p class="text-lg font-bold text-red-600">
                                    {{ $withdraws->where('status', 'rejected')->count() }}
                                </p>
                            </div>
                        </div>
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-gray-500 border-b">
                                    <th class="py-3 text-left">Campaign</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($withdraws->take(5) as $withdraw)
                                    <tr class="border-b hover:bg-gray-50 transition">

                                        {{-- CAMPAIGN --}}
                                        <td class="py-4 font-medium text-gray-800">
                                            {{ $withdraw->campaign->title ?? '-' }}
                                        </td>

                                        {{-- AMOUNT --}}
                                        <td class="text-center font-semibold">
                                            Rp {{ number_format($withdraw->amount, 0, ',', '.') }}
                                        </td>

                                        {{-- STATUS --}}
                                        <td class="text-center">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium
                                {{ $withdraw->status == 'approved'
                                    ? 'bg-green-100 text-green-700'
                                    : ($withdraw->status == 'pending'
                                        ? 'bg-yellow-100 text-yellow-700'
                                        : 'bg-red-100 text-red-700') }}">
                                                {{ ucfirst($withdraw->status) }}
                                            </span>
                                        </td>

                                        {{-- DATE --}}
                                        <td class="text-center text-gray-500">
                                            {{ $withdraw->created_at->format('d M Y') }}
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-10 text-gray-500">
                                            Belum ada riwayat penarikan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4 text-right">
                            <a href="{{ route('withdraw.history') }}" class="text-sm text-green-600 hover:underline">
                                Lihat semua →
                            </a>
                        </div>
                    </div>

                </div>

                {{-- CAMPAIGN LIST --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                    <div class="flex justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">
                                Campaign Saya
                            </h2>
                            <p class="text-sm text-gray-500">
                                Riwayat campaign Anda
                            </p>
                        </div>

                        <a href="{{ route('campaign.create') }}"
                            class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl text-sm font-semibold transition">
                            + Buat Campaign
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-gray-500 border-b">
                                    <th class="py-3 text-left">Judul</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Target</th>
                                    <th class="text-center">Progress</th>
                                    <th class="text-center">Tanggal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($campaigns as $campaign)
                                    <tr class="border-b hover:bg-gray-50 transition">

                                        <td class="py-4 font-medium text-gray-800">
                                            {{ $campaign->title }}
                                        </td>

                                        <td class="text-center">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $campaign->status == 'approved'
                                        ? 'bg-green-100 text-green-700'
                                        : ($campaign->status == 'pending'
                                            ? 'bg-yellow-100 text-yellow-700'
                                            : 'bg-red-100 text-red-700') }}">
                                                {{ ucfirst($campaign->status) }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                                        </td>

                                        <td class="text-center w-40">
                                            @php
                                                $progress =
                                                    $campaign->target_amount > 0
                                                        ? ($campaign->current_amount / $campaign->target_amount) * 100
                                                        : 0;
                                            @endphp

                                            <div class="w-full bg-gray-100 rounded-full h-2">
                                                <div class="bg-green-500 h-2 rounded-full"
                                                    style="width: {{ min($progress, 100) }}%">
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-center text-gray-500">
                                            {{ $campaign->created_at->format('d M Y') }}
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-10 text-gray-500">
                                            Belum ada campaign
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            @else
                {{-- 🔒 BELUM APPROVED --}}
                <div class="bg-white rounded-2xl shadow-sm border border-yellow-100 p-8 text-center">

                    <div class="max-w-md mx-auto">
                        <div
                            class="w-16 h-16 mx-auto bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mb-4">
                            ⏳
                        </div>

                        <h2 class="text-lg font-semibold text-gray-800 mb-2">
                            Akun Anda Sedang Diverifikasi
                        </h2>

                        <p class="text-sm text-gray-500 leading-relaxed">
                            Anda belum dapat membuat campaign atau melakukan penarikan dana.<br>
                            Proses verifikasi membutuhkan waktu maksimal
                            <span class="font-semibold text-gray-700">3x24 jam</span>.
                        </p>
                    </div>

                </div>

            @endif
        </div>
    </div>
@endsection
