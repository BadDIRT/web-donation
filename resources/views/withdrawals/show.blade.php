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
            <form method="POST" action="{{ route('admin.withdrawals.approve', $withdraw->id) }}">
                @csrf

                <div>
                    <label class="text-sm font-medium">Pilih Bank Admin</label>

                    <div class="grid gap-3 mt-2">

                        @foreach ($adminBanks as $bank)
                            <label
                                class="border rounded-xl p-4 cursor-pointer flex justify-between items-center hover:shadow">

                                <input type="radio" name="admin_bank_id" value="{{ $bank->id }}" class="hidden peer"
                                    required>

                                <div>
                                    <p class="font-semibold">{{ $bank->bank->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $bank->account_number }}</p>
                                    <p class="text-green-600 font-medium">
                                        Rp {{ number_format($bank->balance, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="hidden peer-checked:block text-green-500 text-xl">
                                    ✔
                                </div>

                            </label>
                        @endforeach

                    </div>
                </div>

                <button class="w-full mt-6 bg-green-500 text-white py-3 rounded-xl font-semibold">
                    Approve Sekarang
                </button>

                {{-- REJECT SECTION --}}
                <div x-data="{ openReject: false }" class="mt-4">

                    <button type="button" @click="openReject = !openReject"
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

            </form>

        </div>

    </div>
@endsection
