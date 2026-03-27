@extends('layouts.form')

@section('title', 'Ajukan Penarikan')

@section('content')
    <div class="max-w-xl mx-auto py-10">

        <div class="bg-white p-6 rounded-2xl shadow">

            <h1 class="text-xl font-bold mb-6">Ajukan Penarikan Dana</h1>

            <form action="{{ route('withdraw.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- CAMPAIGN --}}
                <div>
                    <label class="text-sm">Pilih Campaign</label>
                    <select name="campaign_id" class="w-full border rounded-xl p-3 mt-1">
                        @foreach ($campaigns as $campaign)
                            <option value="{{ $campaign->id }}">
                                {{ $campaign->title }} (Rp {{ number_format($campaign->current_amount, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- AMOUNT --}}
                <div>
                    <label class="text-sm">Jumlah Penarikan</label>
                    <input type="number" name="amount" class="w-full border rounded-xl p-3 mt-1"
                        placeholder="Minimal 10.000">
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="text-sm">Keterangan</label>
                    <textarea name="description" class="w-full border rounded-xl p-3 mt-1" placeholder="Contoh: untuk biaya operasional"></textarea>
                </div>

                <button class="w-full bg-green-500 text-white py-3 rounded-xl">
                    Ajukan Penarikan
                </button>

            </form>

        </div>

    </div>
@endsection
