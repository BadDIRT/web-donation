@extends('layouts.auth')

@section('title', 'Approve Withdraw')

@section('content')
    <div class="max-w-3xl mx-auto py-10">

        <div class="bg-white p-6 rounded-2xl shadow space-y-6">

            <h1 class="text-xl font-bold text-gray-800">
                Verifikasi Penarikan Dana
            </h1>

            {{-- INFO --}}
            <div class="space-y-2 text-sm bg-gray-50 p-4 rounded-xl">
                <p><b>User:</b> {{ $withdraw->user->name }}</p>
                <p><b>Campaign:</b> {{ $withdraw->campaign->title }}</p>
                <p><b>Jumlah:</b> Rp {{ number_format($withdraw->amount, 0, ',', '.') }}</p>
                <p><b>Keterangan:</b> {{ $withdraw->description }}</p>
            </div>

            {{-- MAIN --}}
            <div x-data="{ mode: null }" class="space-y-6">

                {{-- ================= APPROVE ================= --}}
                <div class="space-y-4">

                    <button type="button" @click="mode = mode === 'approve' ? null : 'approve'"
                        class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold transition">
                        Approve & Upload Bukti Transfer
                    </button>

                    {{-- FORM APPROVE --}}
                    <div x-show="mode === 'approve'" x-transition>
                        <form method="POST" action="{{ route('admin.withdrawals.approve', $withdraw->id) }}"
                            enctype="multipart/form-data" class="space-y-4">

                            @csrf

                            <div>
                                <label class="text-sm font-medium text-gray-700">
                                    Upload Bukti Transfer
                                </label>

                                <input type="file" name="transfer_proof" required
                                    class="w-full mt-2 border rounded-xl p-3 bg-gray-50
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:bg-green-100 file:text-green-700
                                hover:file:bg-green-200">

                                <p class="text-xs text-gray-400 mt-1">
                                    Format: JPG/PNG • Maks 4MB
                                </p>
                            </div>

                            <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold">
                                Konfirmasi Approve
                            </button>
                        </form>
                    </div>

                </div>

                {{-- ================= REJECT ================= --}}
                <div class="space-y-4">

                    <button type="button" @click="mode = mode === 'reject' ? null : 'reject'"
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-semibold transition">
                        Tolak Pengajuan
                    </button>

                    {{-- FORM REJECT --}}
                    <div x-show="mode === 'reject'" x-transition>
                        <form method="POST" action="{{ route('admin.withdrawals.reject', $withdraw->id) }}"
                            class="space-y-3">
                            @csrf

                            <textarea name="reason" required class="w-full border rounded-xl p-3" placeholder="Masukkan alasan penolakan..."></textarea>

                            <button class="w-full bg-gray-800 hover:bg-gray-900 text-white py-2 rounded-xl">
                                Konfirmasi Tolak
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
