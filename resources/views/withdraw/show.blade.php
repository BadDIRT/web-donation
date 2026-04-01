@extends('layouts.app')

@section('title', 'Detail Penarikan')

@section('content')
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="max-w-4xl mx-auto px-4 space-y-8">

            {{-- HEADER --}}
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Detail Penarikan
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Informasi lengkap pengajuan penarikan dana
                    </p>
                </div>

                <a href="{{ route('withdraw.history') }}"
                    class="px-4 py-2 rounded-xl border text-sm text-gray-600 hover:bg-gray-100">
                    ← Kembali
                </a>
            </div>

            {{-- STATUS CARD --}}
            <div class="bg-white rounded-2xl shadow-sm border p-6 flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">Status Penarikan</p>

                    <div class="mt-2">
                        <span
                            class="px-4 py-1 rounded-full text-sm font-semibold
                        {{ $withdraw->status == 'approved'
                            ? 'bg-green-100 text-green-700'
                            : ($withdraw->status == 'pending'
                                ? 'bg-yellow-100 text-yellow-700'
                                : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($withdraw->status) }}
                        </span>
                    </div>

                    <p class="text-xs text-gray-400 mt-2">
                        Diajukan pada {{ $withdraw->created_at->format('d M Y H:i') }}
                    </p>
                </div>

                {{-- ICON --}}
                <div class="text-4xl">
                    @if ($withdraw->status == 'approved')
                        ✅
                    @elseif($withdraw->status == 'pending')
                        ⏳
                    @else
                        ❌
                    @endif
                </div>

            </div>

            {{-- MAIN INFO --}}
            <div class="grid md:grid-cols-2 gap-6">

                {{-- LEFT --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6 space-y-4">

                    <h2 class="font-semibold text-gray-800">
                        Informasi Penarikan
                    </h2>

                    <div class="space-y-3 text-sm">

                        <div>
                            <p class="text-gray-500">Campaign</p>
                            <p class="font-medium text-gray-800">
                                {{ $withdraw->campaign->title ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Jumlah</p>
                            <p class="font-bold text-green-600 text-lg">
                                Rp {{ number_format($withdraw->amount, 0, ',', '.') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Rekening Tujuan</p>
                            <p class="text-gray-800">
                                {{ $withdraw->bank->name ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Keterangan</p>
                            <p class="text-gray-800">
                                {{ $withdraw->description }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6 space-y-4">

                    <h2 class="font-semibold text-gray-800">
                        Bukti Transfer
                    </h2>

                    @if ($withdraw->transfer_proof)
                        <div class="relative group cursor-pointer" onclick="openModal()">

                            <img src="{{ asset('storage/' . $withdraw->transfer_proof) }}"
                                class="rounded-xl w-full h-56 object-cover border">

                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100
                                    flex items-center justify-center text-white text-sm transition">
                                Klik untuk melihat
                            </div>

                        </div>
                    @else
                        <div
                            class="h-56 flex items-center justify-center
                                border-2 border-dashed rounded-xl text-gray-400 text-sm">
                            Belum ada bukti transfer
                        </div>
                    @endif

                </div>

            </div>

            {{-- TIMELINE --}}
            <div class="bg-white rounded-2xl shadow-sm border p-6">

                <h2 class="font-semibold text-gray-800 mb-4">
                    Timeline Status
                </h2>

                <div class="space-y-4 text-sm">

                    <div class="flex items-start gap-3">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mt-1"></div>
                        <div>
                            <p class="font-medium text-gray-800">
                                Pengajuan dibuat
                            </p>
                            <p class="text-gray-500">
                                {{ $withdraw->created_at->format('d M Y H:i') }}
                            </p>
                        </div>
                    </div>

                    @if ($withdraw->status == 'approved')
                        <div class="flex items-start gap-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full mt-1"></div>
                            <div>
                                <p class="font-medium text-gray-800">
                                    Disetujui & ditransfer
                                </p>
                                <p class="text-gray-500">
                                    Dana telah dikirim ke rekening Anda
                                </p>
                            </div>
                        </div>
                    @elseif($withdraw->status == 'rejected')
                        <div class="flex items-start gap-3">
                            <div class="w-3 h-3 bg-red-500 rounded-full mt-1"></div>
                            <div>
                                <p class="font-medium text-gray-800">
                                    Ditolak
                                </p>
                                <p class="text-gray-500">
                                    Pengajuan tidak disetujui oleh admin
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-start gap-3">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full mt-1"></div>
                            <div>
                                <p class="font-medium text-gray-800">
                                    Sedang diproses
                                </p>
                                <p class="text-gray-500">
                                    Menunggu verifikasi admin
                                </p>
                            </div>
                        </div>
                    @endif

                </div>

            </div>

        </div>
    </div>

    {{-- MODAL PREVIEW --}}
    <div id="imageModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50" onclick="closeModal()">

        <img src="{{ $withdraw->transfer_proof ? asset('storage/' . $withdraw->transfer_proof) : '' }}"
            class="max-w-4xl w-full rounded-xl">

    </div>

    <script>
        function openModal() {
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
        }
    </script>

@endsection
