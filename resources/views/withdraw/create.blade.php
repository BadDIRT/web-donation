@extends('layouts.auth')

@section('title', 'Ajukan Penarikan')

@section('content')
    <div class="max-w-xl mx-auto py-10">

        <div class="bg-white p-6 rounded-2xl shadow space-y-5">

            <h1 class="text-xl font-bold">Ajukan Penarikan Dana</h1>

            <form action="{{ route('withdraw.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- CAMPAIGN --}}
                <div x-data="{ selected: '{{ old('campaign_id') }}' }">

                    <label class="text-sm font-medium">Pilih Campaign</label>

                    {{-- hidden input untuk submit --}}
                    <input type="hidden" name="campaign_id" :value="selected">

                    <div class="grid gap-3 mt-2">

                        @forelse ($campaigns as $campaign)
                            <div @click="selected = '{{ $campaign->id }}'"
                                class="border rounded-xl p-4 cursor-pointer transition
                    hover:shadow-md
                    flex justify-between items-center"
                                :class="selected == '{{ $campaign->id }}' ?
                                    'border-green-500 bg-green-50 ring-2 ring-green-200' :
                                    'border-gray-200'">

                                <div>
                                    <p class="font-semibold text-gray-800">
                                        {{ $campaign->title }}
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Sisa saldo:
                                        <span class="font-medium text-green-600">
                                            Rp {{ number_format($campaign->current_amount_rd_pengelola, 0, ',', '.') }}
                                        </span>
                                    </p>
                                </div>

                                {{-- CHECK ICON --}}
                                <div x-show="selected == '{{ $campaign->id }}'">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            stroke-width="3" viewBox="0 0 24 24">
                                            <path d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <p class="text-sm text-gray-500 text-center py-4">
                                Tidak ada campaign tersedia
                            </p>
                        @endforelse

                    </div>

                    @error('campaign_id')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror

                </div>

                {{-- AMOUNT --}}
                <div x-data="rupiahInput()">
                    <label class="text-sm font-medium">Jumlah Penarikan</label>

                    <input type="text" x-model="display" @input="formatRupiah" placeholder="Rp 0"
                        class="w-full border rounded-xl p-3 mt-1">

                    {{-- hidden real value --}}
                    <input type="hidden" name="amount" :value="value">
                </div>

                {{-- BANK --}}
                <div>
                    <label class="text-sm font-medium">Pilih Rekening</label>

                    <select name="user_bank_id" required class="w-full border rounded-xl p-3 mt-1">

                        <option value="">-- Pilih Rekening --</option>

                        @foreach ($userBanks as $bank)
                            <option value="{{ $bank->id }}"
                                {{ old('user_bank_id', $bank->is_primary ? $bank->id : '') == $bank->id ? 'selected' : '' }}>
                                {{ $bank->bank->name }} - {{ $bank->account_number }}
                            </option>
                        @endforeach

                    </select>
                    @error('user_bank_id')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="text-sm font-medium">Keterangan</label>
                    <textarea name="description" class="w-full border rounded-xl p-3 mt-1" placeholder="Contoh: biaya operasional campaign"></textarea>
                </div>

                <button class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold">
                    Ajukan Penarikan
                </button>

            </form>

        </div>

    </div>

    {{-- 🔥 SCRIPT FORMAT RUPIAH --}}
    <script>
        function rupiahInput() {
            return {
                display: '',
                value: '',

                formatRupiah() {
                    let number = this.display.replace(/[^0-9]/g, '')

                    this.value = number

                    if (!number) {
                        this.display = ''
                        return
                    }

                    this.display = 'Rp ' + new Intl.NumberFormat('id-ID').format(number)
                }
            }
        }
    </script>
@endsection
