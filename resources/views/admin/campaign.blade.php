@extends('layouts.app')

@section('title','Campaign Pending')

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

        {{-- CONTAINER --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- TABLE HEADER (DESKTOP) --}}
            <div class="hidden md:grid grid-cols-12 px-6 py-4 bg-gray-50 text-sm font-medium text-gray-500">
                <div class="col-span-5">Campaign</div>
                <div class="col-span-3">Target Dana</div>
                <div class="col-span-4 text-right">Aksi</div>
            </div>

            {{-- BODY --}}
            @forelse($campaigns as $campaign)
                <div
                    x-data="{ openReject:false, openApprove:false }"
                    class="flex flex-col md:grid md:grid-cols-12
                           px-6 py-5 border-t gap-4
                           hover:bg-gray-50 transition">

                    {{-- CAMPAIGN INFO --}}
                    <div class="md:col-span-5">
                        <p class="font-medium text-gray-800">
                            {{ $campaign->title }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Penggalang: {{ $campaign->user->name }}
                        </p>
                    </div>

                    {{-- TARGET --}}
                    <div class="md:col-span-3 text-sm text-gray-600">
                        Rp {{ number_format($campaign->target_amount,0,',','.') }}
                    </div>

                    {{-- ACTION --}}
                    <div class="md:col-span-4 flex flex-col sm:flex-row md:justify-end gap-2">

                        {{-- DETAIL --}}
                        <a href="{{ route('admin.campaign.show',$campaign->id) }}"
                           class="px-4 py-3 rounded-xl text-sm font-medium
                                  border border-gray-300 text-gray-700
                                  hover:bg-gray-100 transition text-center">
                            Detail
                        </a>

                        {{-- REJECT --}}
                        <button @click="openReject=true"
                            class="px-4 py-2 rounded-xl text-sm font-medium
                                   border border-red-300 text-red-600
                                   hover:bg-red-50 transition">
                            Reject
                        </button>

                        {{-- APPROVE --}}
                        <button @click="openApprove=true"
                            class="px-4 py-2 rounded-xl text-sm font-semibold
                                   bg-green-500 hover:bg-green-600
                                   text-white transition">
                            Approve
                        </button>
                    </div>

                    {{-- MODAL APPROVE --}}
                    <div x-show="openApprove" x-cloak
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

                        <div @click.outside="openApprove=false"
                             class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

                            <h3 class="text-lg font-semibold text-gray-800 text-center">
                                Setujui Campaign?
                            </h3>

                            <p class="text-sm text-gray-500 text-center mt-2">
                                Campaign
                                <span class="font-medium text-gray-700">
                                    {{ $campaign->title }}
                                </span>
                                akan dipublikasikan.
                            </p>

                            <div class="flex justify-center gap-3 mt-6">
                                <button @click="openApprove=false"
                                    class="px-4 py-2 rounded-xl text-sm
                                           border border-gray-300 text-gray-600">
                                    Batal
                                </button>

                                <form method="POST"
                                      action="{{ route('admin.approve.campaign',$campaign->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 rounded-xl text-sm font-semibold
                                               bg-green-500 hover:bg-green-600
                                               text-white">
                                        Ya, Approve
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- MODAL REJECT --}}
                    <div x-show="openReject" x-cloak
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

                        <div @click.outside="openReject=false"
                             class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

                            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                Tolak Campaign
                            </h3>

                            <p class="text-sm text-gray-500 mb-4">
                                Berikan alasan penolakan agar penggalang memahami keputusan ini.
                            </p>

                            <form method="POST"
                                  action="{{ route('admin.reject.campaign',$campaign->id) }}"
                                  class="space-y-4">
                                @csrf

                                <textarea name="reason" rows="4" required
                                    placeholder="Contoh: Konten tidak jelas / target tidak realistis"
                                    class="w-full border rounded-xl p-3 text-sm
                                           focus:ring-2 focus:ring-red-500 focus:outline-none"></textarea>

                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="openReject=false"
                                        class="px-4 py-2 rounded-xl text-sm
                                               border border-gray-300 text-gray-600">
                                        Batal
                                    </button>

                                    <button type="submit"
                                        class="px-4 py-2 rounded-xl text-sm font-semibold
                                               bg-red-500 hover:bg-red-600
                                               text-white">
                                        Tolak
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            @empty
                <div class="px-6 py-16 text-center">
                    <p class="text-gray-500">
                        Tidak ada campaign pending
                    </p>
                </div>
            @endforelse

        </div>
    </div>
</div>
@endsection