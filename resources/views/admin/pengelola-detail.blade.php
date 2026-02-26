@extends('layouts.app')

@section('title', 'Detail Pengelola')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Detail Pengajuan Pengelola
                    </h1>
                    <p class="text-gray-500 mt-1">
                        Review data pengguna sebelum menyetujui atau menolak
                    </p>
                </div>

                <a href="{{ route('admin.pengelola') }}" class="text-sm text-gray-600 hover:text-gray-800 underline">
                    ← Kembali
                </a>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- USER INFO --}}
                <div class="px-6 py-6 border-b bg-gray-50">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-full bg-green-100
                               flex items-center justify-center
                               text-green-700 font-bold text-xl">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $user->name }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $user->email }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                User ID: {{ $user->id }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- DETAIL DATA --}}
                <div class="px-6 py-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- PHONE --}}
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Nomor Telepon</p>
                        <p class="font-medium text-gray-800">
                            {{ $user->phone ?? '-' }}
                        </p>
                    </div>

                    {{-- BANK --}}
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Rekening Bank</p>
                        <p class="font-medium text-gray-800">
                            {{ $user->bank_account ?? '-' }}
                        </p>
                    </div>

                    {{-- ROLE --}}
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Role & Status</p>

                        <div class="flex flex-wrap gap-2">
                            {{-- ROLE --}}
                            <span
                                class="inline-block px-3 py-1 rounded-full text-xs font-medium
            {{ $user->role === 'pengelola' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                Role: {{ ucfirst($user->role) }}
                            </span>

                            {{-- APPROVAL STATUS --}}
                            <span
                                class="inline-block px-3 py-1 rounded-full text-xs font-medium
            {{ $user->is_approved ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                Approved: {{ $user->is_approved ? 'True' : 'False' }}
                            </span>
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Status Pengajuan</p>
                        <span
                            class="inline-block px-3 py-1 rounded-full text-xs font-medium
                        {{ $user->is_approved ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $user->is_approved ? 'Disetujui' : 'Menunggu Review' }}
                        </span>
                    </div>

                    {{-- KTP --}}
                    <div class="md:col-span-2">
                        <p class="text-xs text-gray-500 mb-2">Foto KTP</p>

                        @if ($user->ktp_path)
                            <a href="{{ route('admin.pengelola.ktp', $user->id) }}" target="_blank"
                                class="inline-flex items-center gap-2 text-sm text-green-600 hover:underline">
                                Lihat KTP
                            </a>
                        @else
                            <p class="text-sm text-gray-400">
                                Tidak ada file KTP
                            </p>
                        @endif
                    </div>

                </div>

                {{-- ACTION --}}
                @if (!$user->is_approved)
                    <div x-data="{ openReject: false, openApprove: false }"
                        class="px-6 py-6 border-t bg-gray-50 flex flex-col sm:flex-row justify-end gap-3">

                        {{-- REJECT --}}
                        <button @click="openReject = true"
                            class="px-5 py-2 rounded-xl text-sm font-medium
                           border border-red-300 text-red-600
                           hover:bg-red-50 transition">
                            Tolak Pengajuan
                        </button>

                        {{-- APPROVE --}}
                        <button type="button" @click="openApprove = true"
                            class="px-5 py-2 rounded-xl text-sm font-semibold
                           bg-green-500 hover:bg-green-600
                           text-white transition">
                            Setujui Pengajuan
                        </button>

                        {{-- MODAL APPROVE --}}
                        <div x-show="openApprove" x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

                            <div @click.outside="openApprove = false"
                                class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

                                <h3 class="text-lg font-semibold text-gray-800 text-center">
                                    Setujui Pengajuan?
                                </h3>

                                <p class="text-sm text-gray-500 text-center mt-2">
                                    Kamu akan menyetujui
                                    <span class="font-medium text-gray-700">
                                        {{ $user->name }}
                                    </span>
                                    sebagai pengelola campaign.
                                </p>

                                <div class="flex justify-center gap-3 mt-6">
                                    <button @click="openApprove = false"
                                        class="px-4 py-2 rounded-xl text-sm
                                       border border-gray-300 text-gray-600">
                                        Batal
                                    </button>

                                    <form method="POST" action="{{ route('admin.approve.pengelola', $user->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 rounded-xl text-sm font-semibold
                                           bg-green-500 hover:bg-green-600 text-white">
                                            Ya, Setujui
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL REJECT --}}
                        <div x-show="openReject" x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

                            <div @click.outside="openReject = false"
                                class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

                                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                    Tolak Pengajuan
                                </h3>

                                <form method="POST" action="{{ route('admin.reject.pengelola', $user->id) }}"
                                    class="space-y-4">
                                    @csrf

                                    <textarea name="reason" rows="4" required placeholder="Masukkan alasan penolakan"
                                        class="w-full border rounded-xl p-3 text-sm
                                       focus:ring-2 focus:ring-red-500 focus:outline-none"></textarea>

                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="openReject = false"
                                            class="px-4 py-2 rounded-xl text-sm border text-gray-600">
                                            Batal
                                        </button>

                                        <button type="submit"
                                            class="px-4 py-2 rounded-xl text-sm font-semibold
                                           bg-red-500 hover:bg-red-600 text-white">
                                            Tolak
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
