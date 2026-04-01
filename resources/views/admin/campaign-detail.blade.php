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

                {{-- FINANCIAL SUMMARY --}}
                @php
                    $withdrawn = $campaign->current_amount - $campaign->current_amount_rd;
                @endphp

                <div class="space-y-4">

                    {{-- TARGET FULL --}}
                    <div class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white rounded-2xl p-6 shadow-sm">
                        <p class="text-sm opacity-80">Target Dana</p>
                        <p class="text-2xl font-bold mt-1">
                            Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- 3 CARD --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                        {{-- TERKUMPUL --}}
                        <div class="bg-white rounded-2xl p-5 shadow-sm">
                            <p class="text-xs text-gray-400">Dana Terkumpul</p>
                            <p class="text-lg font-semibold text-gray-800 mt-1">
                                Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- SALDO --}}
                        <div class="bg-green-50 rounded-2xl p-5 shadow-sm">
                            <p class="text-xs text-green-700">Saldo Tersedia</p>
                            <p class="text-lg font-semibold text-green-600 mt-1">
                                Rp {{ number_format($campaign->current_amount_rd, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- WITHDRAW --}}
                        <div class="bg-blue-50 rounded-2xl p-5 shadow-sm">
                            <p class="text-xs text-blue-700">Sudah Ditarik</p>
                            <p class="text-lg font-semibold text-blue-600 mt-1">
                                Rp {{ number_format($withdrawn, 0, ',', '.') }}
                            </p>
                        </div>

                    </div>

                </div>

                @php
                    $progress =
                        $campaign->target_amount > 0 ? ($campaign->current_amount / $campaign->target_amount) * 100 : 0;
                @endphp

                <div class="mt-4">
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Progress Campaign</span>
                        <span>{{ number_format($progress, 0) }}%</span>
                    </div>

                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full transition-all" style="width: {{ $progress }}%">
                        </div>
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

                @if ($campaign->status === 'approved')
                    <div x-data="{ withdraw: false }" class="pt-6 border-t flex justify-end">

                        <a href="https://dashboard.midtrans.com/settings/withdrawal" target="_blank"
                            class="px-5 py-2 rounded-xl bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold shadow-sm inline-block">
                            Tarik Dana
                        </a>

                        {{-- MODAL --}}
                        <div x-show="withdraw" x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

                            <div @click.outside="withdraw=false" class="bg-white w-full max-w-md rounded-2xl p-6">

                                <h3 class="text-lg font-semibold mb-4">
                                    Tarik Dana Campaign
                                </h3>

                                <form method="POST" action="{{ route('admin.withdraw', $campaign->id) }}"
                                    class="space-y-4">
                                    @csrf

                                    {{-- SALDO --}}
                                    <div class="text-sm text-gray-500">
                                        Saldo tersedia:
                                        <span class="font-semibold text-green-600">
                                            Rp {{ number_format($campaign->current_amount_rd, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    {{-- AMOUNT --}}
                                    <input type="number" name="amount" required placeholder="Jumlah penarikan"
                                        class="w-full border rounded-xl p-3 text-sm">

                                    {{-- BANK --}}
                                    <select name="user_bank_id" required class="w-full border rounded-xl p-3 text-sm">

                                        @forelse (auth()->user()->userBanks as $bank)
                                            <option value="{{ $bank->id }}">
                                                {{ $bank->bank->name ?? '-' }} - {{ $bank->account_number }}
                                            </option>
                                        @empty
                                            <option disabled>Tidak ada rekening</option>
                                        @endforelse

                                    </select>



                                    {{-- ACTION --}}
                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="withdraw=false"
                                            class="px-4 py-2 border rounded-xl text-sm">
                                            Batal
                                        </button>

                                        <button
                                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl text-sm font-semibold">
                                            Tarik
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                @endif


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
                @if (in_array($campaign->status, ['approved', 'closed', 'ended']))
                    <div x-data="{ openStatus: false }" class="pt-6 border-t flex justify-end">

                        <button @click="openStatus=true"
                            class="px-5 py-2 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold">
                            Ubah Status
                        </button>

                        {{-- MODAL --}}
                        <div x-show="openStatus" x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

                            <div @click.outside="openStatus=false"
                                class="bg-white w-full max-w-md rounded-2xl p-6 space-y-4">

                                <h3 class="text-lg font-semibold">
                                    Ubah Status Campaign
                                </h3>

                                <form method="POST" action="{{ route('admin.campaign.changeStatus', $campaign->id) }}"
                                    class="space-y-4">
                                    @csrf

                                    {{-- STATUS BARU --}}
                                    <select name="status" required class="w-full border rounded-xl p-3 text-sm">

                                        <option value="">Pilih Status</option>
                                        <option value="approved">Approved</option>
                                        <option value="closed">Closed</option>
                                        <option value="ended">Ended</option>
                                    </select>

                                    {{-- ALASAN --}}
                                    <textarea name="reason" required rows="4" class="w-full border rounded-xl p-3 text-sm"
                                        placeholder="Masukkan alasan perubahan status..."></textarea>

                                    {{-- ACTION --}}
                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="openStatus=false"
                                            class="px-4 py-2 border rounded-xl text-sm">
                                            Batal
                                        </button>

                                        <button
                                            class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl text-sm font-semibold">
                                            Simpan Perubahan
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
