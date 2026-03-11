@extends('layouts.app')

@section('title', 'Detail Campaign')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-4xl mx-auto py-10 px-4">

            {{-- HEADER --}}
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ $campaign->title }}
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Penggalang: <span class="font-medium">{{ $campaign->user->name }}</span>
                    </p>
                </div>

                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                {{ $campaign->status === 'pending'
                    ? 'bg-yellow-100 text-yellow-700'
                    : ($campaign->status === 'approved'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-red-100 text-red-700') }}">
                    {{ strtoupper($campaign->status) }}
                </span>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-2xl shadow-sm border p-6 space-y-6">

                {{-- IMAGE --}}
                <div class="w-full aspect-video rounded-xl overflow-hidden border">
                    <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}"
                        class="w-full h-full object-cover">
                </div>

                {{-- INFO --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Target Dana</p>
                        <p class="text-lg font-semibold">
                            Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 mb-1">Dana Terkumpul</p>
                        <p class="text-lg font-semibold text-green-600">
                            Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <p class="text-xs text-gray-500 mb-1">Deskripsi Singkat</p>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        {{ $campaign->description }}
                    </p>
                </div>

                {{-- ARTIKEL --}}
                @if ($campaign->article)
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Artikel Campaign</p>
                        <div class="prose max-w-none text-sm">
                            {!! nl2br(e($campaign->article)) !!}
                        </div>
                    </div>
                @endif

                <p class="text-xs text-gray-400 mt-1">
                    Dibuat {{ $campaign->created_at->translatedFormat('d F Y') }}
                </p>


                {{-- ACTION --}}
                @if ($campaign->status === 'pending')
                    <div x-data="{ approve: false, reject: false }" class="pt-6 border-t flex justify-end gap-3">


                        {{-- APPROVE --}}
                        <button @click="approve=true"
                            class="px-5 py-2 rounded-xl bg-green-500 hover:bg-green-600 text-white text-sm font-semibold">
                            Approve
                        </button>

                        {{-- REJECT --}}
                        <button @click="reject=true"
                            class="px-5 py-2 rounded-xl border border-red-300 text-red-600 text-sm font-medium hover:bg-red-50">
                            Reject
                        </button>

                        {{-- MODAL APPROVE --}}
                        <div x-show="approve" x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
                            <div @click.outside="approve=false"
                                class="bg-white w-full max-w-md rounded-2xl p-6 text-center">

                                <h3 class="text-lg font-semibold text-gray-800">
                                    Setujui Campaign?
                                </h3>

                                <p class="text-sm text-gray-500 mt-2">
                                    Campaign <span class="font-medium text-gray-700">
                                        {{ $campaign->title }}
                                    </span> akan dipublikasikan dan bisa menerima donasi.
                                </p>

                                <div class="flex justify-center gap-3 mt-6">
                                    <button @click="approve=false"
                                        class="px-4 py-2 rounded-xl border text-sm text-gray-600">
                                        Batal
                                    </button>

                                    <form method="POST" action="{{ route('admin.approve.campaign', $campaign->id) }}">
                                        @csrf
                                        <button
                                            class="px-4 py-2 rounded-xl bg-green-500 hover:bg-green-600 text-white text-sm font-semibold">
                                            Ya, Approve
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('admin.payout', $campaign->id) }}">
                            @csrf

                            <input type="number" name="amount" placeholder="Jumlah payout" class="border p-2 rounded">

                            <button class="bg-green-500 text-white px-4 py-2 rounded">
                                Cairkan Dana
                            </button>

                        </form>

                        {{-- MODAL REJECT --}}
                        <div x-show="reject" x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
                            <div @click.outside="reject=false" class="bg-white w-full max-w-md rounded-2xl p-6">

                                <h3 class="text-lg font-semibold mb-3">
                                    Tolak Campaign
                                </h3>

                                <form method="POST" action="{{ route('admin.reject.campaign', $campaign->id) }}"
                                    class="space-y-4">
                                    @csrf

                                    <textarea name="reason" rows="4" required
                                        class="w-full border rounded-xl p-3 text-sm focus:ring-2 focus:ring-red-500"
                                        placeholder="Masukkan alasan penolakan"></textarea>

                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="reject=false"
                                            class="px-4 py-2 border rounded-xl text-sm">
                                            Batal
                                        </button>

                                        <button
                                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl text-sm font-semibold">
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
