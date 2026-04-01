@extends('layouts.app')

@section('title', $campaign->title)

@section('content')

    {{-- ================= HERO ================= --}}
    <section class="relative h-[60vh] sm:h-[75vh] lg:h-[85vh] -mt-[72px]">
        <img src="{{ asset('storage/' . $campaign->image) }}" class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

        <div class="relative h-full flex items-end">
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pb-16 sm:pb-20 lg:pb-24 text-white">
                <span
                    class="inline-block mb-3 sm:mb-4 px-4 sm:px-5 py-1.5 sm:py-2 text-xs sm:text-sm rounded-full bg-green-500 shadow">
                    {{ $campaign->category->name }}
                </span>

                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold max-w-4xl leading-tight">
                    {{ $campaign->title }}
                </h1>
            </div>
        </div>
    </section>

    {{-- ================= PAGE WRAPPER ================= --}}
    <section class="bg-gradient-to-br from-green-50 via-white to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">

            <div class="grid lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-12">

                {{-- ================= LEFT CONTENT ================= --}}
                <div class="lg:col-span-2 space-y-6 sm:space-y-8 lg:space-y-12">

                    {{-- DESCRIPTION CARD --}}
                    <div class="bg-white rounded-2xl lg:rounded-3xl shadow p-5 sm:p-6 lg:p-10">
                        <p class="text-gray-700 leading-relaxed text-sm sm:text-base lg:text-lg">
                            {{ $campaign->description }}
                        </p>
                    </div>

                    {{-- ARTICLE CARD --}}
                    @if ($campaign->article)
                        <div class="bg-white rounded-2xl lg:rounded-3xl shadow p-5 sm:p-6 lg:p-10">
                            <article
                                class="prose prose-sm sm:prose-base lg:prose-lg max-w-none
                                prose-img:rounded-xl prose-a:text-green-600">
                                {!! $campaign->article !!}
                            </article>
                        </div>
                    @endif

                    {{-- DOA & DUKUNGAN --}}
                    <div class="bg-white rounded-2xl lg:rounded-3xl shadow p-5 sm:p-6 lg:p-10">
                        <h2 class="text-lg sm:text-xl lg:text-2xl font-bold mb-4 sm:mb-6">💬 Doa & Dukungan</h2>

                        <div class="space-y-3 sm:space-y-4">
                            @forelse ($campaign->donations()
                                            ->where('status','success')
                                            ->latest()
                                            ->take(5)
                                            ->get() as $donation)
                                <div class="bg-gray-50 rounded-xl p-3 sm:p-4 border">
                                    <p class="font-semibold text-gray-700 text-sm sm:text-base">
                                        {{ $donation->anonymous ? 'Anonim' : $donation->donor_name }}
                                    </p>
                                    <p class="text-xs sm:text-sm text-gray-500">
                                        Rp {{ number_format($donation->amount) }}
                                    </p>
                                    @if ($donation->message)
                                        <p class="mt-1.5 sm:mt-2 text-gray-600 italic text-sm">
                                            "{{ $donation->message }}"
                                        </p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm">Belum ada donasi</p>
                            @endforelse
                        </div>
                    </div>

                </div>

                {{-- ================= RIGHT SIDEBAR ================= --}}
                <aside class="lg:col-span-1">
                    <div class="lg:sticky lg:top-28 space-y-4 sm:space-y-6 lg:space-y-8">

                        {{-- PROGRESS --}}
                        <div class="bg-white rounded-2xl shadow-lg p-5 sm:p-6 lg:p-8 border-t-4 border-green-500">
                            <div class="flex justify-between text-xs sm:text-sm mb-2">
                                <span class="text-gray-500">Terkumpul</span>
                                <span class="font-semibold text-gray-800">
                                    Rp {{ number_format($campaign->current_amount) }}
                                </span>
                            </div>

                            <div class="w-full bg-gray-200 rounded-full h-2.5 sm:h-3 overflow-hidden">
                                <div id="progress-bar"
                                    class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 h-full rounded-full transition-all duration-1000 ease-out"
                                    style="width:0%">
                                </div>
                            </div>

                            <p class="mt-2 sm:mt-3 text-xs sm:text-sm text-gray-600">
                                {{ number_format($campaign->progress_percent, 1) }}% dari
                                Rp {{ number_format($campaign->target_amount) }}
                            </p>

                            @if ($campaign->deadline)
                                <p class="mt-3 sm:mt-4 text-xs sm:text-sm text-red-500 font-medium">
                                    ⏳ Berakhir dalam: <span id="countdown"></span>
                                </p>
                            @endif

                            @if ($campaign->current_amount >= $campaign->target_amount)
                                <p class="mt-3 sm:mt-4 text-green-600 font-semibold text-sm">
                                    🎉 Target campaign sudah tercapai
                                </p>
                            @endif
                        </div>

                        {{-- TOP DONORS --}}
                        <div class="bg-white rounded-2xl shadow-lg p-5 sm:p-6 lg:p-8">
                            <h3 class="font-bold text-base sm:text-lg mb-4 sm:mb-6">🏆 Top Donatur</h3>

                            <div class="space-y-2 sm:space-y-3">
                                @foreach ($topDonors as $index => $donor)
                                    <div
                                        class="flex items-center justify-between bg-gray-50 p-2.5 sm:p-3 lg:p-4 rounded-xl">
                                        <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                                            <div
                                                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex-shrink-0 flex items-center justify-center text-xs sm:text-sm font-bold
                                                @if ($index == 0) bg-yellow-400
                                                @elseif($index == 1) bg-gray-300
                                                @elseif($index == 2) bg-orange-400
                                                @else bg-green-100 @endif">
                                                {{ $index + 1 }}
                                            </div>
                                            <p class="font-semibold text-gray-700 truncate text-sm sm:text-base">
                                                {{ $donor->donor_name ?? 'Anonim' }}
                                            </p>
                                        </div>
                                        <p
                                            class="text-xs sm:text-sm font-semibold text-green-600 flex-shrink-0 ml-2 sm:ml-3">
                                            Rp {{ number_format($donor->total) }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- DONATION FORM --}}
                        <div id="donation-form"
                            class="bg-gradient-to-br from-green-50 to-white rounded-2xl shadow-lg p-5 sm:p-6 lg:p-8">
                            <h3 class="text-lg sm:text-xl font-bold mb-4 sm:mb-6 text-green-700">💚 Donasi Sekarang</h3>

                            <form id="donation-form-inner" class="space-y-3 sm:space-y-4">
                                @csrf
                                @method('POST')

                                {{-- AMOUNT --}}
                                <div>
                                    <label class="text-xs sm:text-sm text-gray-600 mb-1.5 sm:mb-2 block">
                                        Nominal Donasi
                                    </label>

                                    <div class="relative">
                                        <span
                                            class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm sm:text-base">
                                            Rp
                                        </span>
                                        <input id="amount_display" placeholder="10.000"
                                            class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 rounded-xl border text-sm sm:text-base lg:text-lg font-semibold focus:ring-2 focus:ring-green-500">
                                        <input type="hidden" name="amount" id="amount" required>
                                    </div>

                                    <div class="grid grid-cols-3 gap-1.5 sm:gap-2 mt-2 sm:mt-3">
                                        <button type="button"
                                            class="quick-amount px-1 sm:px-2 py-1.5 sm:py-2 rounded-lg border text-xs sm:text-sm hover:bg-green-50 transition-colors"
                                            data-amount="10000">
                                            10rb
                                        </button>
                                        <button type="button"
                                            class="quick-amount px-1 sm:px-2 py-1.5 sm:py-2 rounded-lg border text-xs sm:text-sm hover:bg-green-50 transition-colors"
                                            data-amount="20000">
                                            20rb
                                        </button>
                                        <button type="button"
                                            class="quick-amount px-1 sm:px-2 py-1.5 sm:py-2 rounded-lg border text-xs sm:text-sm hover:bg-green-50 transition-colors"
                                            data-amount="50000">
                                            50rb
                                        </button>
                                        <button type="button"
                                            class="quick-amount px-1 sm:px-2 py-1.5 sm:py-2 rounded-lg border text-xs sm:text-sm hover:bg-green-50 transition-colors"
                                            data-amount="100000">
                                            100rb
                                        </button>
                                        <button type="button"
                                            class="quick-amount px-1 sm:px-2 py-1.5 sm:py-2 rounded-lg border text-xs sm:text-sm hover:bg-green-50 transition-colors"
                                            data-amount="200000">
                                            200rb
                                        </button>
                                        <button type="button"
                                            class="quick-amount px-1 sm:px-2 py-1.5 sm:py-2 rounded-lg border text-xs sm:text-sm hover:bg-green-50 transition-colors"
                                            data-amount="500000">
                                            500rb
                                        </button>
                                    </div>
                                </div>

                                <input type="text" name="donor_name" placeholder="Nama Donatur (opsional)"
                                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border text-sm sm:text-base focus:ring-2 focus:ring-green-500 focus:border-green-500">

                                <label class="flex items-center gap-2 text-xs sm:text-sm text-gray-600 cursor-pointer">
                                    <input type="checkbox" name="anonymous" value="1" class="rounded">
                                    Donasi sebagai anonim
                                </label>

                                <textarea name="message" rows="2" placeholder="Tulis doa / pesan"
                                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border text-sm sm:text-base focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>

                                <button id="donate-btn"
                                    class="w-full bg-green-500 hover:bg-green-600 text-white py-2.5 sm:py-3 rounded-xl font-semibold shadow transition-colors text-sm sm:text-base">
                                    Donasi Sekarang
                                </button>
                            </form>

                            <p class="text-[10px] sm:text-xs text-gray-400 mt-3 sm:mt-4 text-center">
                                Transaksi aman & terenkripsi
                            </p>
                        </div>

                    </div>
                </aside>

            </div>
        </div>

        {{-- ✅ Spacer agar konten tidak tertutup mobile bar --}}
        <div class="h-20 lg:hidden"></div>
    </section>

    {{-- ================= MOBILE DONATE BAR ================= --}}
    <div id="mobile-donate-bar"
        class="fixed bottom-0 left-0 right-0 bg-white shadow-[0_-4px_20px_rgba(0,0,0,0.1)] p-3 sm:p-4 lg:hidden z-50">
        <button onclick="document.querySelector('#donation-form').scrollIntoView({behavior:'smooth'})"
            class="w-full bg-green-500 hover:bg-green-600 active:bg-green-700 text-white py-2.5 sm:py-3 rounded-xl font-semibold transition-colors text-sm sm:text-base">
            💚 Donasi Sekarang
        </button>
    </div>

    {{-- ================= SNAP JS ================= --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    {{-- ================= PAYMENT STATUS TOAST ================= --}}
    @if (request('payment'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2500)" x-show="show" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed top-20 sm:top-24 left-3 right-3 sm:left-auto sm:right-6 sm:w-full sm:max-w-sm z-[9999]">
            <div
                class="relative overflow-hidden rounded-xl sm:rounded-2xl bg-white shadow-xl
                @if (request('payment') == 'success') border border-green-100
                @elseif(request('payment') == 'pending') border border-yellow-100
                @elseif(request('payment') == 'failed') border border-red-100
                @else border border-gray-200 @endif">
                <div class="flex items-start gap-3 sm:gap-4 p-4 sm:p-5">
                    <div class="flex-shrink-0">
                        @if (request('payment') == 'success')
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        @elseif(request('payment') == 'pending')
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-yellow-100 flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2 2" />
                                </svg>
                            </div>
                        @elseif(request('payment') == 'failed')
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-red-100 flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        @else
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 text-xs sm:text-sm text-gray-700 leading-relaxed">
                        @if (request('payment') == 'success')
                            Pembayaran berhasil 🎉 Terima kasih atas donasi Anda.
                        @elseif(request('payment') == 'pending')
                            Pembayaran dalam keadaan pending ⏳
                        @elseif(request('payment') == 'failed')
                            Pembayaran gagal ❌ Silakan coba lagi.
                        @else
                            Transaksi dibatalkan.
                        @endif
                    </div>
                    <button @click="show=false" class="text-gray-400 hover:text-gray-600 flex-shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
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

    {{-- ================= ERROR POPUP ================= --}}
    <div id="error-popup" class="fixed inset-0 z-[9999] flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
            onclick="document.getElementById('error-popup').classList.add('hidden')"></div>
        <div class="relative bg-white rounded-2xl shadow-xl p-5 sm:p-6 w-[calc(100%-2rem)] max-w-md text-center">
            <div
                class="w-10 h-10 sm:w-12 sm:h-12 mx-auto mb-3 sm:mb-4 rounded-full bg-red-100 flex items-center justify-center">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-1.5 sm:mb-2">Gagal Donasi</h3>
            <p id="error-popup-message" class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4">Terjadi kesalahan</p>
            <div class="h-1.5 sm:h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                <div id="error-popup-bar" class="h-1.5 sm:h-2 bg-red-500 rounded-full" style="width:100%"></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                function showErrorPopup(message) {
                    const popup = document.getElementById('error-popup');
                    const bar = document.getElementById('error-popup-bar');
                    const text = document.getElementById('error-popup-message');

                    if (!popup) return;

                    text.innerText = message || 'Terjadi kesalahan';
                    popup.classList.remove('hidden');

                    bar.style.transition = 'none';
                    bar.style.width = '100%';
                    bar.offsetHeight;
                    bar.style.transition = 'width 6s linear';
                    bar.style.width = '0%';

                    setTimeout(() => {
                        popup.classList.add('hidden');
                        bar.style.transition = 'none';
                        bar.style.width = '100%';
                    }, 6000);
                }

                const isFull = {{ $campaign->current_amount >= $campaign->target_amount ? 'true' : 'false' }};

                if (isFull) {
                    const btn = document.getElementById('donate-btn');
                    const mobileBtn = document.querySelector('#mobile-donate-bar button');

                    if (btn) {
                        btn.disabled = true;
                        btn.innerText = 'Target Tercapai';
                        btn.classList.replace('bg-green-500', 'bg-gray-400');
                        btn.classList.add('cursor-not-allowed');
                        btn.classList.remove('hover:bg-green-600');
                    }

                    if (mobileBtn) {
                        mobileBtn.disabled = true;
                        mobileBtn.innerText = 'Target Tercapai';
                        mobileBtn.classList.replace('bg-green-500', 'bg-gray-400');
                        mobileBtn.classList.add('cursor-not-allowed');
                        mobileBtn.classList.remove('hover:bg-green-600');
                    }
                }

                // ================= PROGRESS BAR =================
                const percent = {{ $campaign->progress_percent }};
                const progressBar = document.getElementById("progress-bar");

                if (progressBar) {
                    setTimeout(() => {
                        progressBar.style.width = Math.min(percent, 100) + "%";
                    }, 300);
                }

                // ================= COUNTDOWN =================
                const deadline = "{{ $campaign->deadline }}";
                if (deadline) {
                    const countdownEl = document.getElementById('countdown');

                    setInterval(() => {
                        if (!countdownEl) return;

                        const diff = new Date(deadline) - new Date();

                        if (diff <= 0) {
                            countdownEl.innerText = 'Campaign berakhir';
                            return;
                        }

                        const d = Math.floor(diff / 86400000);
                        const h = Math.floor((diff / 3600000) % 24);
                        const m = Math.floor((diff / 60000) % 60);

                        countdownEl.innerText = `${d} hari ${h} jam ${m} menit`;
                    }, 1000);
                }

                // ================= FORMAT INPUT =================
                const displayInput = document.getElementById('amount_display');
                const realInput = document.getElementById('amount');

                if (displayInput) {
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
                }

                // ================= QUICK AMOUNT =================
                document.querySelectorAll('.quick-amount').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const value = this.dataset.amount;

                        realInput.value = value;
                        displayInput.value = new Intl.NumberFormat('id-ID').format(value);

                        document.querySelectorAll('.quick-amount').forEach(b => {
                            b.classList.remove('bg-green-500', 'text-white',
                                'border-green-500');
                        });

                        this.classList.add('bg-green-500', 'text-white', 'border-green-500');
                    });
                });

                // ================= SUBMIT DONATION =================
                const form = document.getElementById('donation-form-inner');
                const maxAmount = {{ $campaign->target_amount - $campaign->current_amount }};

                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const btn = document.getElementById('donate-btn');
                        const amount = realInput.value;

                        if (!amount || parseInt(amount) < 1000) {
                            showErrorPopup('Minimal donasi Rp 1.000');
                            return;
                        }

                        if (parseInt(amount) > maxAmount) {
                            showErrorPopup('Donasi melebihi sisa target campaign');
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
                                    donor_name: form.donor_name.value,
                                    anonymous: form.anonymous.checked,
                                    message: form.message.value
                                })
                            })
                            .then(async res => {
                                const data = await res.json();

                                if (!res.ok) {
                                    showErrorPopup(data.error || 'Terjadi kesalahan');
                                    throw new Error(data.error);
                                }

                                return data;
                            })
                            .then(data => {
                                if (!data.snapToken) {
                                    throw new Error('Snap token tidak ditemukan');
                                }

                                window.snap.pay(data.snapToken, {
                                    onPending: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=pending",
                                    onError: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=failed",
                                    onClose: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=cancel",
                                    onSuccess: function(result) {
                                        // Hitung apakah donasi ini membuat target PAS tercapai
                                        const currentAmount = {{ $campaign->current_amount }};
                                        const targetAmount = {{ $campaign->target_amount }};
                                        const donatedAmount = parseInt(amount);

                                        const isTargetReached = (currentAmount +
                                            donatedAmount) >= targetAmount;

                                        if (isTargetReached) {
                                            // Redirect ke halaman daftar campaign dengan pesan khusus
                                            window.location.href =
                                                "{{ route('campaign.index') }}?target_reached=1";
                                        } else {
                                            // Kalau belum mencapai target, redirect ke halaman campaign seperti biasa
                                            window.location.href =
                                                "{{ route('campaign.show', $campaign->slug) }}?payment=success";
                                        }
                                    },
                                    onPending: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=pending",
                                    onError: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=failed",
                                    onClose: () => window.location.href =
                                        "{{ route('campaign.show', $campaign->slug) }}?payment=cancel"
                                });
                            })
                            .catch(err => {
                                console.error(err);
                                btn.disabled = false;
                                btn.innerText = 'Donasi Sekarang';
                            });
                    });
                }

            });
        </script>
    @endpush

@endsection
