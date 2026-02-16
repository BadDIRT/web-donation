@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ================= HERO SLIDER + PARALLAX (RESPONSIVE IMAGE) ================= --}}
<section
    x-data="{
        active: 0,
        scrollY: 0,
        isMobile: window.innerWidth < 768,

        slidesDesktop: [
            '{{ asset('storage/images/Hijau Putih Donasi Banner Lanskap - Desktop1.svg') }}',
            '{{ asset('storage/images/banner-desktop-2.svg') }}',
            '{{ asset('storage/images/banner-desktop-3.svg') }}'
        ],

        slidesMobile: [
            '{{ asset('storage/images/Hijau Putih Donasi Banner Lanskap - Mobile1.svg') }}',
            '{{ asset('storage/images/banner-mobile-2.svg') }}',
            '{{ asset('storage/images/banner-mobile-3.svg') }}'
        ],

        get slides() {
            return this.isMobile ? this.slidesMobile : this.slidesDesktop
        },

        start() {
            setInterval(() => {
                this.active = (this.active + 1) % this.slides.length
            }, 6000)
        }
    }"
    x-init="
        start();
        window.addEventListener('scroll', () => scrollY = window.scrollY);
        window.addEventListener('resize', () => isMobile = window.innerWidth < 768);
    "
    class="relative w-full overflow-hidden -mt-24"
>

    {{-- SLIDES --}}
    <div class="relative h-[420px] md:h-[520px]">

        <template x-for="(slide, index) in slides" :key="index">
            <img
                :src="slide"
                x-show="active === index"
                x-transition:enter="transition-opacity duration-700"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="absolute inset-0 w-full h-full object-cover will-change-transform"
                :style="`transform: translateY(${scrollY * 0.25}px)`"
            >
        </template>

        {{-- OVERLAY TEXT --}}
        <div
            class="absolute inset-0 flex items-center justify-center text-center px-4"
            :style="`transform: translateY(${scrollY * 0.1}px)`"
        >
            <div
                class="max-w-4xl transition-opacity duration-300"
                :style="`opacity: ${1 - scrollY / 500}`"
            >
                <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight drop-shadow-lg">
                    Donasi Hari Ini,<br>
                    <span class="text-green-300">Ubah Dunia Esok</span>
                </h1>

                <p class="mt-6 text-white/90 text-lg">
                    Platform donasi terpercaya, transparan, dan aman.
                </p>

                <div class="mt-8 flex justify-center gap-4">
                    <a href="{{ route('campaign.index') }}"
                       class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-xl shadow-lg">
                        Donasi Sekarang
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- CONTROLS --}}
    <button
        @click="active = (active - 1 + slides.length) % slides.length"
        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 p-3 rounded-full shadow"
    >
        ‹
    </button>

    <button
        @click="active = (active + 1) % slides.length"
        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 p-3 rounded-full shadow"
    >
        ›
    </button>

</section>




{{-- ================= CONTENT CONTAINER ================= --}}
<div class="container mx-auto px-4 py-16">

    {{-- VALUE SECTION --}}
    <section class="mb-24">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">
                Kenapa Donasi di Sini?
            </h2>
            <p class="text-gray-600 mt-3">
                Kami memastikan setiap donasi sampai ke tangan yang tepat
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow text-center">
                <div class="text-green-500 text-4xl mb-4">💳</div>
                <h3 class="font-bold text-lg">Pembayaran Aman</h3>
                <p class="text-gray-600 mt-2">
                    Transaksi menggunakan payment gateway terpercaya.
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow text-center">
                <div class="text-green-500 text-4xl mb-4">📊</div>
                <h3 class="font-bold text-lg">Transparan</h3>
                <p class="text-gray-600 mt-2">
                    Laporan donasi dapat dipantau secara real-time.
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow text-center">
                <div class="text-green-500 text-4xl mb-4">🤝</div>
                <h3 class="font-bold text-lg">Tepat Sasaran</h3>
                <p class="text-gray-600 mt-2">
                    Campaign diverifikasi oleh admin sebelum tayang.
                </p>
            </div>
        </div>
    </section>

    {{-- CAMPAIGN SECTION --}}
    <section class="mb-24">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Campaign Terbaru
            </h2>

            <a href="{{ route('campaign.index') }}"
               class="text-green-600 hover:underline">
                Lihat Semua →
            </a>
        </div>

        @if ($campaigns->count())
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($campaigns as $campaign)
                    @include('components.campaign-card')
                @endforeach
            </div>
        @else
            <p class="text-gray-500">
                Belum ada campaign tersedia.
            </p>
        @endif
    </section>

    {{-- CTA --}}
    <section class="bg-green-500 rounded-3xl p-10 text-center text-white">
        <h2 class="text-3xl font-bold">
            Ingin Menggalang Dana?
        </h2>

        <p class="mt-4 text-lg">
            Daftar sebagai pengelola dan mulai buat campaign kebaikanmu sekarang.
        </p>

        @auth
            @if (auth()->user()->role === 'donatur')
                <form action="{{ route('pengelola.request') }}" method="POST" class="mt-6">
                    @csrf
                    <button class="bg-white text-green-600 px-8 py-3 rounded-xl font-semibold">
                        Ajukan Jadi Pengelola
                    </button>
                </form>
            @endif
        @else
            <a href="{{ route('register') }}"
               class="inline-block mt-6 bg-white text-green-600 px-8 py-3 rounded-xl font-semibold">
                Daftar Sekarang
            </a>
        @endauth
    </section>

</div>

@endsection

