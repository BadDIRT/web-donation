@extends('layouts.app')

@section('title', $campaign->title)

@section('content')

    {{-- ================= HERO ================= --}}
    <section class="relative h-[85vh] -mt-[72px]">
        <img src="{{ asset('storage/' . $campaign->image) }}" class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

        <div class="relative h-full flex items-end">
            <div class="max-w-7xl mx-auto w-full px-8 pb-24 text-white">
                <span class="inline-block mb-4 px-5 py-2 text-sm rounded-full bg-green-500 shadow">
                    {{ $campaign->category->name }}
                </span>

                <h1 class="text-4xl md:text-5xl font-extrabold max-w-4xl leading-tight">
                    {{ $campaign->title }}
                </h1>
            </div>
        </div>
    </section>

    {{-- ================= PAGE WRAPPER ================= --}}
    <section class="bg-gradient-to-br from-green-50 via-white to-white">
        <div class="max-w-7xl mx-auto px-8 lg:px-12 py-20">

            <div class="grid lg:grid-cols-3 gap-16">

                {{-- ================= LEFT CONTENT ================= --}}
                <div class="lg:col-span-2 space-y-12">

                    {{-- DESCRIPTION CARD --}}
                    <div class="bg-white rounded-3xl shadow p-10">
                        <p class="text-gray-700 leading-relaxed text-lg">
                            {{ $campaign->description }}
                        </p>
                    </div>

                    {{-- ARTICLE CARD --}}
                    @if ($campaign->article)
                        <div class="bg-white rounded-3xl shadow p-10">
                            <article class="prose prose-lg lg:prose-xl max-w-none">
                                {!! $campaign->article !!}
                            </article>
                        </div>
                    @endif

                    {{-- DOA & DUKUNGAN --}}
                    <div class="bg-white rounded-3xl shadow p-10">
                        <h2 class="text-2xl font-bold mb-6">💬 Doa & Dukungan</h2>

                        <div class="space-y-4">
                            @forelse ($campaign->donations()->latest()->take(5)->get() as $donation)
                                <div class="bg-gray-50 rounded-xl p-4 border">
                                    <p class="font-semibold text-gray-700">
                                        {{ $donation->anonymous ? 'Anonim' : $donation->donor_name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Rp {{ number_format($donation->amount) }}
                                    </p>
                                    @if ($donation->message)
                                        <p class="mt-2 text-gray-600 italic">
                                            “{{ $donation->message }}”
                                        </p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-gray-500">Belum ada donasi</p>
                            @endforelse
                        </div>
                    </div>

                </div>

                {{-- ================= RIGHT SIDEBAR ================= --}}
                <aside class="lg:col-span-1">
                    <div class="lg:sticky lg:top-28 space-y-8">

                        {{-- PROGRESS --}}
                        <div class="bg-white rounded-3xl shadow-lg p-8 border-t-4 border-green-500">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-500">Terkumpul</span>
                                <span class="font-semibold text-gray-800">
                                    Rp {{ number_format($campaign->current_amount) }}
                                </span>
                            </div>

                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-green-500 h-full rounded-full transition-all"
                                    style="width: {{ $campaign->progress_percent }}%">
                                </div>
                            </div>

                            <p class="mt-3 text-sm text-gray-600">
                                {{ number_format($campaign->progress_percent, 1) }}% dari
                                Rp {{ number_format($campaign->target_amount) }}
                            </p>

                            @if ($campaign->deadline)
                                <p class="mt-4 text-sm text-red-500 font-medium">
                                    ⏳ Berakhir dalam: <span id="countdown"></span>
                                </p>
                            @endif
                        </div>

                        {{-- DONATION FORM --}}
                        <div class="bg-gradient-to-br from-green-50 to-white rounded-3xl shadow-lg p-8">
                            <h3 class="text-xl font-bold mb-6 text-green-700">💚 Donasi Sekarang</h3>

                            <form id="donation-form" class="space-y-4">
                                @csrf
                                @method('POST')

                                {{-- AMOUNT --}}
                                <div>
                                    <label class="text-sm text-gray-600 mb-2 block">
                                        Nominal Donasi
                                    </label>

                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                            Rp
                                        </span>

                                        <input type="text" id="amount_display" placeholder="10.000"
                                            class="w-full pl-12 pr-4 py-3 rounded-xl border
                      focus:ring-2 focus:ring-green-500">

                                        <input type="hidden" name="amount" id="amount" required>
                                    </div>

                                    <p class="text-xs text-gray-400 mt-1">
                                        Minimal donasi Rp 1.000
                                    </p>
                                </div>

                                <input type="text" name="donor_name" placeholder="Nama Donatur (opsional)"
                                    class="w-full px-4 py-3 rounded-xl border">

                                <label class="flex items-center gap-2 text-sm text-gray-600">
                                    <input type="checkbox" name="anonymous" value="1">
                                    Donasi sebagai anonim
                                </label>

                                <textarea name="message" rows="3" placeholder="Tulis doa / pesan" class="w-full px-4 py-3 rounded-xl border"></textarea>

                                <button id="donate-btn"
                                    class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold shadow">
                                    Donasi Sekarang
                                </button>
                            </form>

                            <p class="text-xs text-gray-400 mt-4 text-center">
                                Transaksi aman & terenkripsi
                            </p>
                        </div>

                    </div>
                </aside>

            </div>
        </div>
    </section>

    {{-- MOBILE DONATE BAR --}}
    <div class="fixed bottom-0 left-0 right-0 bg-white shadow-lg p-4 lg:hidden z-50">
        <button onclick="document.querySelector('#donation-form').scrollIntoView({behavior:'smooth'})"
            class="w-full bg-green-500 text-white py-3 rounded-xl font-semibold">
            💚 Donasi Sekarang
        </button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    @if (request('payment'))
        <div id="payment-alert"
            class="fixed top-6 right-6 z-50 px-6 py-4 rounded-xl shadow-lg text-white
        @if (request('payment') == 'success') bg-green-500
        @elseif(request('payment') == 'pending') bg-yellow-500
        @elseif(request('payment') == 'failed') bg-red-500
        @else bg-gray-600 @endif">

            @if (request('payment') == 'success')
                Pembayaran berhasil 🎉
            @elseif(request('payment') == 'pending')
                Menunggu pembayaran ⏳
            @elseif(request('payment') == 'failed')
                Pembayaran gagal ❌
            @else
                Transaksi dibatalkan
            @endif
        </div>

        <script>
            setTimeout(() => {
                const alertBox = document.getElementById('payment-alert');
                if (alertBox) alertBox.remove();
            }, 3000);
        </script>
    @endif
@endsection
@push('scripts')
    <script>
        const deadline = "{{ $campaign->deadline }}";
        if (deadline) {
            const el = document.getElementById('countdown');
            setInterval(() => {
                if (!el) return;
                const diff = new Date(deadline) - new Date();
                if (diff <= 0) {
                    el.innerText = 'Campaign berakhir';
                    return;
                }
                const d = Math.floor(diff / 86400000);
                const h = Math.floor((diff / 3600000) % 24);
                const m = Math.floor((diff / 60000) % 60);
                el.innerText = `${d} hari ${h} jam ${m} menit`;
            }, 1000);
        }
    </script>
@endpush
@push('scripts')
    <script>
        const displayInput = document.getElementById('amount_display');
        const realInput = document.getElementById('amount');

        displayInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');

            if (!value) {
                realInput.value = '';
                this.value = '';
                return;
            }

            realInput.value = value;

            this.value = new Intl.NumberFormat('id-ID').format(value);
        });
    </script>
@endpush
@push('scripts')
    <script>
        document.getElementById('donation-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const btn = document.getElementById('donate-btn');
            const amount = document.getElementById('amount').value;

            if (!amount || parseInt(amount) < 1000) {
                alert('Minimal donasi Rp 1.000');
                return;
            }

            btn.disabled = true;
            btn.innerText = 'Memproses...';

            fetch("{{ route('donate', $campaign->id) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        amount: amount,
                        donor_name: this.donor_name.value,
                        anonymous: this.anonymous.checked,
                        message: this.message.value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.snapToken) {
                        throw new Error('Snap token tidak ditemukan');
                    }

                    window.snap.pay(data.snapToken, {
                        onSuccess: function() {
                            window.location.href =
                                "{{ url('campaign/' . $campaign->id) }}?payment=success";
                        },
                        onPending: function() {
                            window.location.href =
                                "{{ url('campaign/' . $campaign->id) }}?payment=pending";
                        },
                        onError: function() {
                            window.location.href =
                                "{{ url('campaign/' . $campaign->id) }}?payment=failed";
                        },
                        onClose: function() {
                            window.location.href =
                                "{{ url('campaign/' . $campaign->id) }}?payment=cancel";
                        }
                    });
                })
                .catch(err => {
                    console.error(err);
                    alert('Terjadi kesalahan');
                    btn.disabled = false;
                    btn.innerText = 'Donasi Sekarang';
                });
        });
    </script>
@endpush
<div class="fixed bottom-0 left-0 right-0 bg-white shadow-lg p-4 lg:hidden"> <button
        onclick="document.querySelector('#donation-form').scrollIntoView({behavior:'smooth'})"
        class="w-full bg-green-500 text-white py-3 rounded-xl font-semibold"> 💚 Donasi Sekarang </button> </div>
