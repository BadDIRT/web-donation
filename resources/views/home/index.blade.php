@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    {{-- ================= CUSTOM STYLE UNTUK HALAMAN INI ================= --}}
    <style>
        /* 🔥 Membuat scroll menjadi smooth saat klik anchor (#) */
        html {
            scroll-behavior: smooth;
        }
    </style>


    {{-- ================= HERO SLIDER + PARALLAX ================= --}}
    <section x-data="{
        active: 0,
        scrollY: 0,
        isMobile: window.innerWidth < 768,
        slidesDesktop: [
            '{{ asset('storage/images/Hijau-Putih-Donasi-Banner-Lanskap-Desktop1.svg') }}',
            '{{ asset('storage/images/donasi-desktop-1.svg') }}',
            '{{ asset('storage/images/donasi-desktop-2.svg') }}'
        ],
        slidesMobile: [
            '{{ asset('storage/images/Hijau-Putih-Donasi-Banner-Lanskap-Mobile1.svg') }}',
            '{{ asset('storage/images/donasi-1-(mobile).svg') }}',
            '{{ asset('storage/images/donasi-2-(mobile).svg') }}'
        ],
        get slides() { return this.isMobile ? this.slidesMobile : this.slidesDesktop },
        start() { setInterval(() => { this.active = (this.active + 1) % this.slides.length }, 6000) }
    }" x-init="start();
    window.addEventListener('scroll', () => scrollY = window.scrollY);
    window.addEventListener('resize', () => isMobile = window.innerWidth < 768);" class="relative w-full overflow-hidden -mt-12">

        <div class="relative h-[420px] md:h-[520px]">
            <template x-for="(slide, index) in slides" :key="index">
                <img :src="slide" x-show="active === index" x-cloak
                    x-transition:enter="transition-opacity duration-700" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    class="absolute inset-0 w-full h-full object-cover will-change-transform"
                    :style="`transform: translateY(${scrollY * 0.25}px)`">
            </template>

            <div class="absolute inset-0 flex items-center justify-center text-center px-4"
                :style="`transform: translateY(${scrollY * 0.1}px)`">
                <div class="max-w-4xl transition-opacity duration-300" :style="`opacity: ${1 - scrollY / 500}`">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight drop-shadow-lg">
                        Donasi Hari Ini,<br><span class="text-green-300">Ubah Dunia Esok</span>
                    </h1>
                    <p class="mt-6 text-white/90 text-lg">Platform donasi terpercaya, transparan, dan aman untuk membantu
                        sesama.</p>
                    <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('campaign.index') }}"
                            class="bg-green-500 hover:bg-green-600 text-white px-8 py-3.5 rounded-xl shadow-lg font-semibold transition">
                            Donasi Sekarang
                        </a>
                        <a href="#cara-kerja"
                            class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-8 py-3.5 rounded-xl shadow-lg font-semibold transition border border-white/30">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <button @click="active = (active - 1 + slides.length) % slides.length"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-3 rounded-full shadow transition">‹</button>
        <button @click="active = (active + 1) % slides.length"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-3 rounded-full shadow transition">›</button>
    </section>

    {{-- ================= CONTENT CONTAINER ================= --}}
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 pb-20">

        {{-- ================= STATISTIK PLATFORM ================= --}}
        <section class="relative -mt-12 sm:-mt-16 mb-20 sm:mb-24 z-10 px-4 sm:px-0">
            <div
                class="bg-white rounded-2xl sm:rounded-3xl shadow-xl p-6 sm:p-8 md:p-10 grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 border">

                <div class="text-center">
                    <p class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-600">10K+</p>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1 font-medium">Donatur Aktif</p>
                </div>

                <div class="text-center">
                    <p class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-600">500+</p>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1 font-medium">Campaign Berhasil</p>
                </div>

                <div class="text-center">
                    <p class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-600">Rp 5M+</p>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1 font-medium">Dana Tersalurkan</p>
                </div>

                <div class="text-center">
                    <p class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-600">100%</p>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1 font-medium">Aman & Transparan</p>
                </div>

            </div>
        </section>

        {{-- ================= VALUE SECTION (Kenapa Donasi di Sini) ================= --}}
        <section class="mb-24">
            <div class="text-center mb-14">
                <span class="text-sm font-semibold text-green-600 bg-green-50 px-4 py-1.5 rounded-full">KEUNGGULAN
                    KAMI</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-4">Kenapa Harus Donasi di Sini?</h2>
                <p class="text-gray-500 mt-3 max-w-2xl mx-auto">Kami memastikan setiap rupiah yang Anda sumbangkan sampai ke
                    tangan yang tepat dengan pengawasan ketat.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="bg-white p-6 rounded-2xl border shadow-sm hover:shadow-lg transition duration-300 text-center group">
                    <div
                        class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-blue-50 flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Pembayaran Aman</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Terintegrasi Midtrans dengan enkripsi berlapis untuk
                        keamanan transaksi.</p>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl border shadow-sm hover:shadow-lg transition duration-300 text-center group">
                    <div
                        class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-green-50 flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Terverifikasi</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Setiap campaign melewati proses verifikasi ketat oleh
                        admin berpengalaman.</p>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl border shadow-sm hover:shadow-lg transition duration-300 text-center group">
                    <div
                        class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-purple-50 flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 13l3-3 4 4 5-5" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Transparan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Laporan penggunaan dana dapat dipantau secara real-time
                        oleh publik.</p>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl border shadow-sm hover:shadow-lg transition duration-300 text-center group">
                    <div
                        class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-yellow-50 flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Support 24/7</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Tim customer service siap membantu Anda kapan saja dan
                        di mana saja.</p>
                </div>
            </div>
        </section>

        {{-- ================= CARA KERJA ================= --}}
        <section id="cara-kerja" class="mb-24 bg-gray-50 rounded-[2.5rem] py-16 px-6 md:px-12 border">
            <div class="text-center mb-14">
                <span class="text-sm font-semibold text-green-600 bg-green-50 px-4 py-1.5 rounded-full">CARA KERJA</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-4">Semudah 3 Langkah Ini</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8 relative">
                {{-- Garis Penghubung (Desktop Only) --}}
                <div class="hidden md:block absolute top-16 left-1/4 right-1/4 h-0.5 bg-green-200"></div>

                <div class="text-center relative">
                    <div
                        class="w-16 h-16 mx-auto bg-green-500 text-white rounded-2xl flex items-center justify-center text-2xl font-bold shadow-lg relative z-10">
                        1</div>
                    <h3 class="font-bold text-lg text-gray-800 mt-6 mb-2">Pilih Campaign</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Temukan campaign kebaikan yang sesuai dengan hati Anda
                        dari daftar campaign terverifikasi.</p>
                </div>

                <div class="text-center relative">
                    <div
                        class="w-16 h-16 mx-auto bg-green-500 text-white rounded-2xl flex items-center justify-center text-2xl font-bold shadow-lg relative z-10">
                        2</div>
                    <h3 class="font-bold text-lg text-gray-800 mt-6 mb-2">Lakukan Donasi</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Masukkan nominal dan lakukan pembayaran secara aman
                        melalui berbagai metode pembayaran.</p>
                </div>

                <div class="text-center relative">
                    <div
                        class="w-16 h-16 mx-auto bg-green-500 text-white rounded-2xl flex items-center justify-center text-2xl font-bold shadow-lg relative z-10">
                        3</div>
                    <h3 class="font-bold text-lg text-gray-800 mt-6 mb-2">Dana Tersalurkan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Dana akan langsung diterima oleh pengelola campaign
                        dan dipantau hingga selesai.</p>
                </div>
            </div>
        </section>

        {{-- ================= CAMPAIGN TERBARU ================= --}}
        <section class="mb-24">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Campaign Terbaru</h2>
                    <p class="text-gray-500 mt-1">Ayo bantu mereka mencapai targetnya</p>
                </div>
                <a href="{{ route('campaign.index') }}"
                    class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-semibold transition">
                    Lihat Semua Campaign
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            @if ($campaigns->count())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($campaigns as $campaign)
                        @include('components.campaign-card')
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center border">
                    <p class="text-gray-500">Belum ada campaign tersedia saat ini.</p>
                </div>
            @endif
        </section>

        {{-- ================= TESTIMONI DONATUR ================= --}}
        <section class="mb-24">
            <div class="text-center mb-14">
                <span class="text-sm font-semibold text-green-600 bg-green-50 px-4 py-1.5 rounded-full">TESTIMONI</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-4">Apa Kata Mereka?</h2>
                <p class="text-gray-500 mt-3">Cerita nyata dari para donatur dan pengelola campaign.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl border shadow-sm hover:shadow-md transition">
                    <div class="flex gap-1 mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <p class="text-gray-600 text-sm italic leading-relaxed mb-6">"Proses donasinya sangat mudah dan cepat.
                        Saya bisa langsung melihat perkembangan dana yang sudah terkumpul secara real-time. Sangat
                        transparan!"</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold">
                            A</div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Andi Pratama</p>
                            <p class="text-xs text-gray-500">Donatur Aktif</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl border shadow-sm hover:shadow-md transition">
                    <div class="flex gap-1 mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <p class="text-gray-600 text-sm italic leading-relaxed mb-6">"Sebagai pengelola, fitur pencairan
                        dananya sangat membantu. Tidak ribet dan langsung cair ke rekening saya. Admin-nya juga fast
                        respon!"</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">
                            S</div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Siti Rahmawati</p>
                            <p class="text-xs text-gray-500">Pengelola Campaign</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl border shadow-sm hover:shadow-md transition">
                    <div class="flex gap-1 mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <p class="text-gray-600 text-sm italic leading-relaxed mb-6">"Saya merasa tenang berdonasi di sini
                        karena ada bukti pencairan dana yang transparan. Semoga platform ini terus berkembang membantu
                        banyak orang."</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold">
                            B</div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Budi Santoso</p>
                            <p class="text-xs text-gray-500">Donatur Setia</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= FAQ ================= --}}
        <section class="mb-24" x-data="{ open: null }">
            <div class="text-center mb-14">
                <span class="text-sm font-semibold text-green-600 bg-green-50 px-4 py-1.5 rounded-full">FAQ</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-4">Pertanyaan Umum</h2>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <div class="bg-white border rounded-2xl overflow-hidden">
                    <button @click="open = open === 1 ? null : 1"
                        class="w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:bg-gray-50 transition">
                        Apakah donasi saya aman?
                        <svg class="w-5 h-5 text-gray-400 transition-transform" :class="open === 1 ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 1" x-collapse>
                        <p class="px-5 pb-5 text-sm text-gray-600 leading-relaxed">Sangat aman. Kami menggunakan Midtrans
                            sebagai payment gateway yang sudah tersertifikasi PCI DSS. Seluruh transaksi dienkripsi dan
                            tidak ada pihak ketiga yang dapat mengakses data kartu pembayaran Anda.</p>
                    </div>
                </div>

                <div class="bg-white border rounded-2xl overflow-hidden">
                    <button @click="open = open === 2 ? null : 2"
                        class="w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:bg-gray-50 transition">
                        Bagaimana cara pencairan dana?
                        <svg class="w-5 h-5 text-gray-400 transition-transform" :class="open === 2 ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 2" x-collapse>
                        <p class="px-5 pb-5 text-sm text-gray-600 leading-relaxed">Pengelola campaign dapat mengajukan
                            pencairan dana melalui dashboard setiap saat. Tim admin akan melakukan review dan mentransfer
                            dana ke rekening pengelola yang sudah terverifikasi dalam waktu maksimal 3x24 jam.</p>
                    </div>
                </div>

                <div class="bg-white border rounded-2xl overflow-hidden">
                    <button @click="open = open === 3 ? null : 3"
                        class="w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 hover:bg-gray-50 transition">
                        Apakah bisa donasi secara anonim?
                        <svg class="w-5 h-5 text-gray-400 transition-transform" :class="open === 3 ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 3" x-collapse>
                        <p class="px-5 pb-5 text-sm text-gray-600 leading-relaxed">Tentu bisa. Saat melakukan donasi, Anda
                            cukup centang opsi "Donasi sebagai anonim" dan identitas Anda tidak akan ditampilkan di halaman
                            publik campaign.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= FINAL CTA ================= --}}
        <section
            class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-[2.5rem] px-8 sm:px-14 py-16 text-center text-white shadow-xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2">
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold">Ingin Menggalang Dana?</h2>
                <p class="mt-4 text-lg max-w-2xl mx-auto opacity-90">Bergabunglah sebagai pengelola dan mulai buat campaign
                    kebaikanmu sendiri. Proses verifikasi cepat dan mudah!</p>

                @auth
                    @if (auth()->user()->role === 'donatur')
                        <a href="{{ route('pengelola.terms') }}"
                            class="inline-block mt-8 bg-white text-green-600 px-8 py-3.5 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                            Ajukan Jadi Pengelola →
                        </a>
                    @else
                        <a href="{{ route('dashboard.pengelola') }}"
                            class="inline-block mt-8 bg-white text-green-600 px-8 py-3.5 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                            Ke Dashboard Pengelola →
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}"
                        class="inline-block mt-8 bg-white text-green-600 px-8 py-3.5 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                        Daftar & Mulai Sekarang →
                    </a>
                @endauth
            </div>
        </section>

    </div>
@endsection

@push('scripts')
    {{-- Plugin untuk animasi collapse di FAQ --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/collapse.min.js" defer></script>
@endpush
