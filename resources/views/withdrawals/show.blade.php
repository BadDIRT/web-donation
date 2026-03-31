@extends('layouts.app')

@section('title', 'Approve Withdraw')

@section('content')
    <div class="max-w-3xl mx-auto py-10">

        <div class="bg-white p-6 rounded-2xl shadow space-y-6">

            <h1 class="text-xl font-bold">Approve Penarikan</h1>

            {{-- INFO --}}
            <div class="space-y-2 text-sm">
                <p><b>User:</b> {{ $withdraw->user->name }}</p>
                <p><b>Campaign:</b> {{ $withdraw->campaign->title }}</p>
                <p><b>Jumlah:</b> Rp {{ number_format($withdraw->amount, 0, ',', '.') }}</p>
                <p><b>Keterangan:</b> {{ $withdraw->description }}</p>
            </div>

            {{-- PILIH BANK ADMIN --}}
            <div x-data="{
                mode: null, // 'approve' | 'reject'
                selectedBank: null
            }" class="space-y-6">

                {{-- FORM APPROVE --}}
                <form method="POST" action="{{ route('admin.withdrawals.approve', $withdraw->id) }}">
                    @csrf

                    {{-- PILIH BANK (HANYA MUNCUL SAAT APPROVE) --}}
                    <div x-show="mode !== 'reject'">

                        <label class="text-sm font-medium">Pilih Bank Admin</label>

                        <div class="grid gap-3 mt-2">

                            @foreach ($adminBanks as $bank)
                                <div @click="
                            if(selectedBank == '{{ $bank->id }}'){
                                selectedBank = null
                                mode = null
                            } else {
                                selectedBank = '{{ $bank->id }}'
                                mode = 'approve'
                            }
                        "
                                    class="border rounded-xl p-4 cursor-pointer flex justify-between items-center hover:shadow transition"
                                    :class="selectedBank == '{{ $bank->id }}' ?
                                        'border-green-500 bg-green-50 ring-2 ring-green-200' :
                                        'border-gray-200'">

                                    <input type="hidden" name="admin_bank_id" :value="selectedBank">

                                    <div>
                                        <p class="font-semibold">{{ $bank->bank->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $bank->account_number }}</p>
                                        <p class="text-green-600 font-medium">
                                            Rp {{ number_format($bank->balance, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <div x-show="selectedBank == '{{ $bank->id }}'" class="text-green-500 text-xl">
                                        ✔
                                    </div>

                                </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- BUTTON APPROVE --}}
                    <button x-show="mode !== 'reject'" :disabled="!selectedBank"
                        class="w-full mt-6 bg-green-500 disabled:bg-gray-300 text-white py-3 rounded-xl font-semibold">
                        Approve Sekarang
                    </button>

                </form>

                {{-- REJECT SECTION --}}
                <div x-show="mode !== 'approve'" x-data="{ openReject: false }">

                    <button type="button" @click="mode = 'reject'; openReject = !openReject; selectedBank = null"
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-semibold">
                        Tolak Pengajuan
                    </button>

                    {{-- FORM REJECT --}}
                    <div x-show="openReject" x-transition class="mt-4">

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
