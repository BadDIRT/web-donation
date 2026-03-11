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
                            @forelse ($campaign->donations()
                                                                                                        ->where('status','success')
                                                                                                        ->latest()
                                                                                                        ->take(5)
                                                                                                        ->get() as $donation)
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
                                <div id="progress-bar"
                                    class="bg-gradient-to-r from-green-400 via-green-500 to-green-600
h-full rounded-full transition-all duration-1000 ease-out
relative overflow-hidden"
                                    style="width:0%">
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

                        <div class="bg-white rounded-3xl shadow-lg p-8">

                            <h3 class="font-bold text-lg mb-6">
                                🏆 Top Donatur
                            </h3>

                            <div class="space-y-4">

                                @foreach ($topDonors as $index => $donor)
                                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-8 h-8 rounded-full
@if ($index == 0) bg-yellow-400
@elseif($index == 1) bg-gray-300
@elseif($index == 2) bg-orange-400
@else bg-green-100 @endif
flex items-center justify-center text-sm font-bold">

                                                {{ $index + 1 }}

                                            </div>

                                            <div>

                                                <p class="font-semibold text-gray-700">
                                                    {{ $donor->donor_name ?? 'Anonim' }}
                                                </p>

                                            </div>

                                        </div>

                                        <p class="text-sm font-semibold text-green-600">

                                            Rp {{ number_format($donor->total) }}

                                        </p>

                                    </div>
                                @endforeach

                            </div>

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

                                        <input id="amount_display" placeholder="10.000"
                                            class="w-full pl-12 pr-4 py-3 rounded-xl border
focus:ring-2 focus:ring-green-500
text-lg font-semibold">

                                        <input type="hidden" name="amount" id="amount" required>
                                    </div>

                                    <div class="grid lg:grid-cols-3 md:grid-cols-6 gap-2 mt-3">

                                        <button type="button"
                                            class="quick-amount px-3 py-2 rounded-lg border text-sm hover:bg-green-50"
                                            data-amount="10000">
                                            10rb
                                        </button>

                                        <button type="button"
                                            class="quick-amount px-3 py-2 rounded-lg border text-sm hover:bg-green-50"
                                            data-amount="20000">
                                            20rb
                                        </button>

                                        <button type="button"
                                            class="quick-amount px-3 py-2 rounded-lg border text-sm hover:bg-green-50"
                                            data-amount="50000">
                                            50rb
                                        </button>

                                        <button type="button"
                                            class="quick-amount px-3 py-2 rounded-lg border text-sm hover:bg-green-50"
                                            data-amount="100000">
                                            100rb
                                        </button>

                                        <button type="button"
                                            class="quick-amount px-3 py-2 rounded-lg border text-sm hover:bg-green-50"
                                            data-amount="200000">
                                            200rb
                                        </button>

                                        <button type="button"
                                            class="quick-amount px-3 py-2 rounded-lg border text-sm hover:bg-green-50"
                                            data-amount="500000">
                                            500rb
                                        </button>

                                    </div>

                                    <div id="donation-alert" class="hidden fixed top-24 right-6 z-[9999] w-full max-w-sm">

                                        <div class="bg-white border border-red-100 rounded-2xl shadow-xl p-5 flex gap-4">

                                            <div class="w-9 h-9 rounded-full bg-red-100 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>

                                            <div class="text-sm text-gray-700">
                                                Minimal donasi Rp 1.000
                                            </div>

                                        </div>
                                    </div>
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

        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2500)" x-show="show" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed top-24 right-6 z-[9999] w-full max-w-sm">

            <div
                class="relative overflow-hidden rounded-2xl bg-white shadow-xl
@if (request('payment') == 'success') border border-green-100
@elseif(request('payment') == 'pending') border border-yellow-100
@elseif(request('payment') == 'failed') border border-red-100
@else border border-gray-200 @endif">

                <div class="flex items-start gap-4 p-5">

                    {{-- ICON --}}
                    <div class="flex-shrink-0">

                        @if (request('payment') == 'success')
                            <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        @elseif(request('payment') == 'pending')
                            <div class="w-9 h-9 rounded-full bg-yellow-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2 2" />
                                </svg>
                            </div>
                        @elseif(request('payment') == 'failed')
                            <div class="w-9 h-9 rounded-full bg-red-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        @else
                            <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        @endif

                    </div>

                    {{-- MESSAGE --}}
                    <div class="flex-1 text-sm text-gray-700 leading-relaxed">

                        @if (request('payment') == 'success')
                            Pembayaran berhasil 🎉 Terima kasih atas donasi Anda.
                        @elseif(request('payment') == 'pending')
                            Pembayaran Dalam keadaan pending ⏳
                        @elseif(request('payment') == 'failed')
                            Pembayaran gagal ❌ Silakan coba lagi.
                        @else
                            Transaksi dibatalkan.
                        @endif

                    </div>

                    {{-- CLOSE --}}
                    <button @click="show=false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                </div>
                <div
                    class="absolute bottom-0 left-0 h-1
@if (request('payment') == 'success') bg-green-500
@elseif(request('payment') == 'pending') bg-yellow-500
@elseif(request('payment') == 'failed') bg-red-500
@else bg-gray-500 @endif
animate-[shrink_2.5s_linear_forwards]">
                </div>

            </div>

        </div>

    @endif

    <script>
        setTimeout(() => {
            const el = document.getElementById('payment-alert');
            if (el) el.remove();
        }, 3000);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const percent = {{ $campaign->progress_percent }};
            const bar = document.getElementById("progress-bar");

            setTimeout(() => {

                bar.style.width = percent + "%";

            }, 300);

        });
    </script>

    <script>
        setTimeout(() => {
            const alertBox = document.getElementById('payment-alert');
            if (alertBox) alertBox.remove();
        }, 3000);
    </script>
    <script>
        function showDonationAlert() {
            const alertBox = document.getElementById('donation-alert');

            alertBox.classList.remove('hidden');

            setTimeout(() => {
                alertBox.classList.add('hidden');
            }, 3000);
        }
    </script>
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
        document.querySelectorAll('.quick-amount').forEach(btn => {

            btn.addEventListener('click', function() {

                const value = this.dataset.amount;

                realInput.value = value;
                displayInput.value = new Intl.NumberFormat('id-ID').format(value);

                document.querySelectorAll('.quick-amount').forEach(b => {
                    b.classList.remove('bg-green-500', 'text-white', 'border-green-500');
                });

                this.classList.add('bg-green-500', 'text-white', 'border-green-500');

            });

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
                showDonationAlert();
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

                    const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
                    const userRole = "{{ auth()->user()->role ?? '' }}";

                    window.snap.pay(data.snapToken, {
                        onSuccess: function() {

                            if (!isAuthenticated) {
                                window.location.href =
                                    "{{ route('campaign.show', $campaign->slug) }}?payment=success";
                                return;
                            }

                            if (userRole === 'admin') {
                                window.location.href =
                                    "{{ route('campaign.show', $campaign->slug) }}?payment=success";
                            } else if (userRole === 'pengelola') {
                                window.location.href = "{{ route('campaign.show', $campaign->slug) }}?payment=success";
                            } else {
                                window.location.href = "{{ route('campaign.show', $campaign->slug) }}?payment=success";
                            }
                        },

                        onPending: function() {
                            window.location.href =
                                "{{ route('campaign.show', $campaign->slug) }}?payment=pending";
                        },

                        onError: function() {
                            window.location.href =
                                "{{ route('campaign.show', $campaign->slug) }}?payment=failed";
                        },

                        onClose: function() {
                            window.location.href =
                                "{{ route('campaign.show', $campaign->slug) }}?payment=cancel";
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
