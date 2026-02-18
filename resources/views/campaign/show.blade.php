@extends('layouts.app')

@section('title', $campaign->title)

@section('content')

    {{-- HERO FULL WIDTH --}}
    <div class="relative w-full h-screen -mt-[72px]">
        <img src="{{ asset('storage/' . $campaign->image) }}" class="w-full h-full object-cover">

        <div class="absolute inset-0 bg-black/40"></div>

        <div class="absolute inset-0 flex items-end">
            <div class="container mx-auto px-6 pb-20 text-white">
                <span class="inline-block mb-3 px-4 py-1 text-sm rounded-full bg-green-500">
                    {{ $campaign->category->name }}
                </span>

                <h1 class="text-4xl md:text-5xl font-extrabold max-w-3xl">
                    {{ $campaign->title }}
                </h1>
            </div>
        </div>
    </div>


    {{-- CONTENT --}}
    <div class="container mx-auto px-4 py-16">
        <div class="grid lg:grid-cols-3 gap-12">


            {{-- LEFT CONTENT / ARTICLE --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- DESCRIPTION --}}
                <p class="text-gray-700 leading-relaxed text-lg">
                    {{ $campaign->description }}
                </p>

                {{-- ARTICLE --}}
                @if ($campaign->article)
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($campaign->article)) !!}
                    </div>
                @endif

            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="lg:col-span-1">

                <div class="lg:sticky lg:top-28 space-y-6">

                    {{-- PROGRESS --}}
                    <div class="bg-white rounded-3xl shadow p-6">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-500">Terkumpul</span>
                            <span class="font-semibold text-gray-700">
                                Rp {{ number_format($campaign->current_amount) }}
                            </span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-green-500 h-full rounded-full" style="width: {{ $campaign->progress_percent }}%">
                            </div>
                        </div>

                        <p class="mt-2 text-sm text-gray-500">
                            {{ number_format($campaign->progress_percent, 1) }}% dari
                            Rp {{ number_format($campaign->target_amount) }}
                        </p>

                        @if ($campaign->deadline)
                            <p class="mt-3 text-sm text-red-500 font-medium">
                                ⏳ Berakhir dalam: <span id="countdown"></span>
                            </p>
                        @endif
                    </div>

                    {{-- DONATION FORM --}}
                    <div class="bg-white rounded-3xl shadow-lg p-6">
                        <h3 class="text-xl font-bold mb-4">💚 Donasi Sekarang</h3>

                        <form id="donation-form" class="space-y-4">
                            @csrf

                            <input type="number" name="amount" min="1000" required placeholder="Minimal Rp 1.000"
                                class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-green-500">

                            <input type="text" name="donor_name" placeholder="Nama Donatur (opsional)"
                                class="w-full px-4 py-3 rounded-xl border">

                            <label class="flex items-center gap-2 text-sm text-gray-600">
                                <input type="checkbox" name="anonymous" value="1">
                                Donasi sebagai anonim
                            </label>

                            <textarea name="message" rows="3" placeholder="Tulis doa / pesan" class="w-full px-4 py-3 rounded-xl border"></textarea>

                            <button id="donate-btn"
                                class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold">
                                Donasi Sekarang
                            </button>
                        </form>

                        <p class="text-xs text-gray-400 mt-4 text-center">
                            Transaksi aman & terenkripsi
                        </p>
                    </div>

                </div>
            </div>



        </div>

    </div>

    <div class="mt-20">
        <h2 class="text-2xl font-bold mb-6">💬 Doa & Dukungan</h2>

        <div class="space-y-4">
            @forelse ($campaign->donations()->latest()->take(5)->get() as $donation)
                <div class="bg-white rounded-xl p-4 shadow">
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

@endsection

@push('scripts')
    <script>
        const deadline = new Date("{{ $campaign->deadline }}").getTime();

        setInterval(() => {
            const now = new Date().getTime();
            const diff = deadline - now;

            if (diff <= 0) {
                document.getElementById('countdown').innerText = 'Campaign berakhir';
                return;
            }

            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
            const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
            const m = Math.floor((diff / (1000 * 60)) % 60);

            document.getElementById('countdown').innerText =
                `${d} hari ${h} jam ${m} menit`;
        }, 1000);
    </script>
@endpush

@push('scripts')
    <script>
        document.getElementById('donation-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const btn = document.getElementById('donate-btn');
            const form = e.target;

            const data = {
                amount: form.amount.value,
                donor_name: form.donor_name.value,
                anonymous: form.anonymous.checked,
                message: form.message.value
            };

            btn.disabled = true;
            btn.innerText = 'Memproses...';

            fetch("{{ route('donate', $campaign->id) }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(data => {
                    snap.pay(data.snap_token, {
                        onSuccess: () => {
                            alert('🎉 Donasi berhasil, terima kasih!');
                            location.reload();
                        },
                        onClose: () => {
                            btn.disabled = false;
                            btn.innerText = 'Donasi Sekarang';
                        }
                    });
                })
                .catch(() => {
                    alert('Terjadi kesalahan');
                    btn.disabled = false;
                    btn.innerText = 'Donasi Sekarang';
                });
        });
    </script>
@endpush


<div class="fixed bottom-0 left-0 right-0 bg-white shadow-lg p-4 lg:hidden">
    <button onclick="document.querySelector('#donation-form').scrollIntoView({behavior:'smooth'})"
        class="w-full bg-green-500 text-white py-3 rounded-xl font-semibold">
        💚 Donasi Sekarang
    </button>
</div>
