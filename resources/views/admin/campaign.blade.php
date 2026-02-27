@extends('layouts.app')

@section('title', 'Campaign Pending')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">
                Campaign Pending
            </h1>
            <p class="text-gray-500 mt-1">
                Daftar campaign yang menunggu persetujuan admin
            </p>
        </div>

        {{-- SEARCH --}}
        <form method="GET" class="mb-4">
            <div class="relative max-w-md flex items-center gap-2">

                <div class="relative flex-1">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari judul, ID, atau penggalang..."
                        class="w-full rounded-xl border border-gray-300
                               pl-11 pr-10 py-2.5 text-sm
                               focus:ring-2 focus:ring-green-500
                               focus:border-green-500">

                    {{-- SEARCH ICON --}}
                    <div class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                        </svg>
                    </div>

                    {{-- CLEAR --}}
                    @if(request('q'))
                        <a href="{{ route('admin.campaign') }}"
                           class="absolute inset-y-0 right-3 flex items-center
                                  text-gray-400 hover:text-gray-600"
                           title="Reset">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </div>

                <button type="submit"
                        class="px-4 py-2.5 rounded-xl text-sm font-medium
                               bg-green-500 hover:bg-green-600
                               text-white transition">
                    Cari
                </button>
            </div>
        </form>

        {{-- STATUS PENCARIAN --}}
        @if(request('q'))
            <p class="text-sm text-gray-500 mb-4">
                Hasil pencarian untuk:
                <span class="font-medium text-gray-700">
                    "{{ request('q') }}"
                </span>
            </p>
        @endif

        {{-- LIST --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- HEADER DESKTOP --}}
            <div class="hidden md:grid grid-cols-12 px-6 py-4
                        bg-gray-50 text-sm font-medium text-gray-500">
                <div class="col-span-5">Campaign</div>
                <div class="col-span-4">Penggalang</div>
                <div class="col-span-3 text-right">Aksi</div>
            </div>

            {{-- BODY --}}
            @forelse($campaigns as $campaign)
                <div
                    x-data="{ openReject:false, openApprove:false }"
                    class="flex flex-col md:grid md:grid-cols-12
                           px-6 py-5 border-t
                           hover:bg-gray-50 transition gap-4">

                    {{-- CAMPAIGN --}}
                    <div class="md:col-span-5">
                        <p class="font-medium text-gray-800">
                            {{ $campaign->title }}
                        </p>
                        <p class="text-xs text-gray-500">
                            ID: {{ $campaign->id }} •
                            Target: Rp {{ number_format($campaign->target_amount,0,',','.') }}
                        </p>
                    </div>

                    {{-- USER --}}
                    <div class="md:col-span-4 text-sm text-gray-600">
                        {{ $campaign->user->name }}
                        <div class="text-xs text-gray-400">
                            {{ $campaign->user->email }}
                        </div>
                    </div>

                    {{-- ACTION --}}
                    <div class="md:col-span-3 flex flex-col sm:flex-row md:justify-end gap-2">

                        <a href="{{ route('admin.campaign.show',$campaign->id) }}"
                           class="px-4 py-2 rounded-xl text-sm font-medium
                                  border border-gray-300 text-gray-700
                                  hover:bg-gray-100 transition text-center">
                            Detail
                        </a>

                        <button @click="openReject=true"
                                class="px-4 py-2 rounded-xl text-sm font-medium
                                       border border-red-300 text-red-600
                                       hover:bg-red-50 transition">
                            Reject
                        </button>

                        <button @click="openApprove=true"
                                class="px-4 py-2 rounded-xl text-sm font-semibold
                                       bg-green-500 hover:bg-green-600
                                       text-white transition">
                            Approve
                        </button>

                        {{-- MODAL REJECT --}}
                        <div x-show="openReject" x-cloak
                             class="fixed inset-0 z-50 flex items-center
                                    justify-center bg-black/40">

                            <div @click.outside="openReject=false"
                                 class="bg-white w-full max-w-md
                                        rounded-2xl shadow-xl p-6">

                                <h3 class="text-lg font-semibold mb-2">
                                    Tolak Campaign
                                </h3>

                                <form method="POST"
                                      action="{{ route('admin.reject.campaign',$campaign->id) }}"
                                      class="space-y-4">
                                    @csrf

                                    <textarea name="reason" rows="4" required
                                              class="w-full border rounded-xl p-3 text-sm"
                                              placeholder="Masukkan alasan penolakan"></textarea>

                                    <div class="flex justify-end gap-2">
                                        <button type="button"
                                                @click="openReject=false"
                                                class="px-4 py-2 border rounded-xl text-sm">
                                            Batal
                                        </button>
                                        <button
                                            class="px-4 py-2 bg-red-500
                                                   hover:bg-red-600
                                                   text-white rounded-xl text-sm">
                                            Tolak
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- MODAL APPROVE --}}
                        <div x-show="openApprove" x-cloak
                             class="fixed inset-0 z-50 flex items-center
                                    justify-center bg-black/40">

                            <div @click.outside="openApprove=false"
                                 class="bg-white w-full max-w-md
                                        rounded-2xl shadow-xl p-6 text-center">

                                <div class="w-12 h-12 mx-auto mb-4
                                            rounded-full bg-green-100
                                            flex items-center justify-center
                                            text-green-600 text-xl">
                                    ✓
                                </div>

                                <h3 class="text-lg font-semibold">
                                    Setujui Campaign?
                                </h3>

                                <p class="text-sm text-gray-500 mt-2">
                                    Campaign
                                    <span class="font-medium text-gray-700">
                                        {{ $campaign->title }}
                                    </span>
                                    akan dipublikasikan.
                                </p>

                                <div class="flex justify-center gap-3 mt-6">
                                    <button @click="openApprove=false"
                                            class="px-4 py-2 rounded-xl text-sm
                                                   border border-gray-300">
                                        Batal
                                    </button>

                                    <form method="POST"
                                          action="{{ route('admin.approve.campaign',$campaign->id) }}">
                                        @csrf
                                        <button
                                            class="px-4 py-2 rounded-xl text-sm
                                                   font-semibold
                                                   bg-green-500 hover:bg-green-600
                                                   text-white">
                                            Ya, Approve
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="px-6 py-16 text-center text-gray-500">
                    @if(request('q'))
                        Tidak ditemukan campaign dengan kata kunci
                        <span class="font-medium text-gray-700">
                            "{{ request('q') }}"
                        </span>
                    @else
                        Tidak ada campaign pending
                    @endif
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection