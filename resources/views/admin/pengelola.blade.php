@extends('layouts.app')

@section('title', 'Pengelola Pending')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- HEADER --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">
                    Pengelola Pending
                </h1>
                <p class="text-gray-500 mt-1">
                    Daftar pengguna yang mengajukan diri sebagai penggalang dana
                </p>
            </div>

            {{-- CONTAINER --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- TABLE HEADER (DESKTOP ONLY) --}}
                <div class="hidden md:grid grid-cols-12 px-6 py-4 bg-gray-50 text-sm font-medium text-gray-500">
                    <div class="col-span-5">Pengguna</div>
                    <div class="col-span-4">Email</div>
                    <div class="col-span-3 text-right">Aksi</div>
                </div>

                {{-- BODY --}}
                @forelse($users as $user)
                    <div
                        class="flex flex-col md:grid md:grid-cols-12
                           px-6 py-5 border-t
                           hover:bg-gray-50 transition gap-4">

                        {{-- USER --}}
                        <div class="md:col-span-5 flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-green-100
                                    flex items-center justify-center
                                    text-green-700 font-bold shrink-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">
                                    {{ $user->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    ID: {{ $user->id }}
                                </p>
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="md:col-span-4 text-sm text-gray-600">
                            {{ $user->email }}
                        </div>

                        {{-- ACTION --}}
                        <div
                            class="md:col-span-3 flex flex-col sm:flex-row
                                md:justify-end gap-2">

                            {{-- DETAIL --}}
                            <a href="{{ route('admin.pengelola.show', $user->id) }}"
                                class="px-4 py-2 rounded-xl text-sm font-medium
                                  border border-gray-300 text-gray-700
                                  hover:bg-gray-100 transition text-center">
                                Detail
                            </a>

                            {{-- REJECT --}}
                            <form method="POST" action="{{ route('admin.reject.pengelola', $user->id) }}">
                                @csrf
                                <button @click="openReject = true; selectedUser = {{ $user->id }}"
                                    class="w-full px-4 py-2 rounded-xl text-sm font-medium
           border border-red-300 text-red-600
           hover:bg-red-50 transition">
                                    Reject
                                </button>
                            </form>

                            {{-- APPROVE --}}
                            <form method="POST" action="{{ route('admin.approve.pengelola', $user->id) }}">
                                @csrf
                                <button
                                    class="w-full px-4 py-2 rounded-xl text-sm font-semibold
                                       bg-green-500 hover:bg-green-600
                                       text-white transition">
                                    Approve
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="px-6 py-16 text-center">
                        <p class="text-gray-500">
                            Tidak ada pengelola pending saat ini
                        </p>
                    </div>
                @endforelse

                {{-- MODAL REJECT --}}
                <div x-data="{ openReject: false, selectedUser: null }" x-show="openReject" x-cloak
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

                    <div @click.away="openReject = false" class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

                        <h2 class="text-lg font-bold text-gray-800 mb-2">
                            Tolak Pengajuan Pengelola
                        </h2>

                        <p class="text-sm text-gray-500 mb-4">
                            Mohon jelaskan alasan penolakan agar pengguna memahami keputusan ini.
                        </p>

                        <form :action="`/admin/pengelola/${selectedUser}/reject`" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium mb-1">
                                    Alasan Penolakan
                                </label>
                                <textarea name="reason" rows="4" required placeholder="Contoh: Data KTP tidak jelas / rekening tidak valid"
                                    class="w-full border rounded-xl p-3 text-sm
                           focus:ring-2 focus:ring-red-500 focus:outline-none"></textarea>
                            </div>

                            <div class="flex justify-end gap-2">
                                <button type="button" @click="openReject = false"
                                    class="px-4 py-2 rounded-xl text-sm
                           border border-gray-300 text-gray-700
                           hover:bg-gray-100 transition">
                                    Batal
                                </button>

                                <button type="submit"
                                    class="px-4 py-2 rounded-xl text-sm font-semibold
                           bg-red-500 hover:bg-red-600
                           text-white transition">
                                    Tolak Pengajuan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
