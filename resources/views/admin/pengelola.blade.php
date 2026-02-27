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

            {{-- SEARCH --}}
<form method="GET" class="mb-6">
    <div class="relative max-w-md flex items-center gap-2">

        {{-- INPUT --}}
        <div class="relative flex-1">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari nama, email, atau ID..."
                class="w-full rounded-xl border border-gray-300 pl-11 pr-10 py-2.5 text-sm
                       focus:ring-2 focus:ring-green-500 focus:border-green-500">

            {{-- SVG SEARCH ICON --}}
            <div class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                </svg>
            </div>

            {{-- CLEAR BUTTON --}}
            @if (request('q'))
                <a href="{{ route('admin.pengelola') }}"
                   class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600"
                   title="Reset">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-4 w-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            @endif
        </div>

        {{-- SUBMIT BUTTON --}}
        <button
            type="submit"
            class="px-4 py-2.5 rounded-xl text-sm font-medium
                   bg-green-500 hover:bg-green-600
                   text-white transition">
            Cari
        </button>
    </div>
</form>

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
                        <div x-data="{ openReject: false, openApprove: false }" class="md:col-span-3 flex flex-col sm:flex-row md:justify-end gap-2">

                            {{-- DETAIL --}}
                            <a href="{{ route('admin.pengelola.show', $user->id) }}"
                                class="px-4 py-2 rounded-xl text-sm font-medium
              border border-gray-300 text-gray-700
              hover:bg-gray-100 transition text-center">
                                Detail
                            </a>

                            {{-- REJECT --}}
                            <button @click="openReject = true"
                                class="px-4 py-2 rounded-xl text-sm font-medium
               border border-red-300 text-red-600
               hover:bg-red-50 transition">
                                Reject
                            </button>

                            {{-- APPROVE (TRIGGER MODAL) --}}
                            <button type="button" @click="openApprove = true"
                                class="w-full px-4 py-2 rounded-xl text-sm font-semibold
           bg-green-500 hover:bg-green-600
           text-white transition">
                                Approve
                            </button>

                            {{-- MODAL --}}
                            <div x-show="openReject" x-cloak
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

                                <div @click.outside="openReject = false"
                                    class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

                                    <h3 class="text-lg font-semibold text-gray-800 mb-1">
                                        Tolak Pengajuan
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-4">
                                        Berikan alasan penolakan untuk {{ $user->name }}
                                    </p>

                                    <form method="POST" action="{{ route('admin.reject.pengelola', $user->id) }}"
                                        class="space-y-4">
                                        @csrf

                                        <textarea name="reason" rows="4" required placeholder="Contoh: Data tidak lengkap / foto KTP tidak jelas"
                                            class="w-full border rounded-xl p-3 text-sm
                           focus:ring-2 focus:ring-red-500 focus:outline-none"></textarea>

                                        <div class="flex justify-end gap-2">
                                            <button type="button" @click="openReject = false"
                                                class="px-4 py-2 rounded-xl text-sm
                               border border-gray-300 text-gray-600">
                                                Batal
                                            </button>

                                            <button type="submit"
                                                class="px-4 py-2 rounded-xl text-sm font-semibold
                               bg-red-500 hover:bg-red-600 text-white">
                                                Tolak Pengajuan
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            {{-- MODAL APPROVE --}}
                            <div x-show="openApprove" x-cloak
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

                                <div @click.outside="openApprove = false"
                                    class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

                                    {{-- ICON --}}
                                    <div class="flex justify-center mb-4">
                                        <div
                                            class="w-12 h-12 rounded-full bg-green-100
                        flex items-center justify-center text-green-600">
                                            ✓
                                        </div>
                                    </div>

                                    <h3 class="text-lg font-semibold text-gray-800 text-center">
                                        Setujui Pengajuan?
                                    </h3>

                                    <p class="text-sm text-gray-500 text-center mt-2">
                                        Apakah kamu yakin ingin menyetujui
                                        <span class="font-medium text-gray-700">
                                            {{ $user->name }}
                                        </span>
                                        sebagai pengelola campaign?
                                    </p>

                                    <div class="flex justify-center gap-3 mt-6">

                                        <button @click="openApprove = false"
                                            class="px-4 py-2 rounded-xl text-sm
                       border border-gray-300 text-gray-600
                       hover:bg-gray-100 transition">
                                            Batal
                                        </button>

                                        <form method="POST" action="{{ route('admin.approve.pengelola', $user->id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 rounded-xl text-sm font-semibold
                           bg-green-500 hover:bg-green-600
                           text-white transition">
                                                Ya, Approve
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                @empty
                    <div class="px-6 py-16 text-center">
                        <p class="text-gray-500">
                            @if (request('q'))
                                Tidak ditemukan pengelola dengan kata kunci
                                <span class="font-medium text-gray-700">
                                    "{{ request('q') }}"
                                </span>
                            @else
                                Tidak ada pengelola pending saat ini
                            @endif
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
