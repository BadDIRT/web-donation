@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    {{-- ================= CUSTOM STYLE ================= --}}
    <style>
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
            '{{ asset('storage/images/Hijau-Putih-Donasi-Banner-Lanskap-Desktop.png') }}',
            '{{ asset('storage/images/donasi-desktop-1.svg') }}',
            '{{ asset('storage/images/donasi-desktop-2.svg') }}'
        ],
        slidesMobile: [
            '{{ asset('storage/images/Hijau-Putih-Donasi-Banner-Lanskap-Mobile.png') }}',
            '{{ asset('storage/images/donasi-1-(mobile).svg') }}',
            '{{ asset('storage/images/donasi-2-(mobile).svg') }}'
        ],
        get slides() { return this.isMobile ? this.slidesMobile : this.slidesDesktop },
        start() { setInterval(() => { this.active = (this.active + 1) % this.slides.length }, 6000) }
    }" x-init="start();
    window.addEventListener('scroll', () => scrollY = window.scrollY);
    window.addEventListener('resize', () => isMobile = window.innerWidth < 768);" class="relative w-full overflow-hidden -mt-12">

        <div class="relative h-[420px] md:h-[520px] lg:h-[580px]">
            <template x-for="(slide, index) in slides" :key="index">
                <img :src="slide" x-show="active === index" x-cloak
                    x-transition:enter="transition-opacity duration-700" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    class="absolute inset-0 w-full h-full object-cover will-change-transform"
                    :style="`transform: translateY(${scrollY * 0.25}px)`">
            </template>

            {{-- Overlay Gradient --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

            <div class="absolute inset-0 flex items-center justify-center text-center px-4"
                :style="`transform: translateY(${scrollY * 0.1}px)`">
                <div class="max-w-4xl transition-opacity duration-300" :style="`opacity: ${1 - scrollY / 500}`">
                    <span
                        class="inline-block px-4 py-1.5 text-[10px] sm:text-xs font-bold uppercase tracking-widest text-emerald-300 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-4 sm:mb-6">
                        Platform Donasi Terpercaya
                    </span>
                    <h1 class="text-3xl sm:text-4xl md:text-6xl font-extrabold text-white leading-tight drop-shadow-lg">
                        Donasi Hari Ini,<br><span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Ubah Dunia
                            Esok</span>
                    </h1>
                    <p class="mt-4 sm:mt-6 text-sm sm:text-lg text-white/80 max-w-2xl mx-auto">Transparan, aman, dan
                        langsung tersalurkan
                        kepada mereka yang membutuhkan.</p>
                    <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
                        <a href="{{ route('campaign.index') }}"
                            class="group bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-5 py-2.5 sm:px-8 sm:py-4 rounded-xl shadow-lg shadow-emerald-500/30 font-bold text-sm sm:text-base transition-all duration-200 flex items-center justify-center gap-2">
                            Donasi Sekarang
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#cara-kerja"
                            class="bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white px-5 py-2.5 sm:px-8 sm:py-4 rounded-xl font-bold text-sm sm:text-base transition border border-white/20 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modern Navigation Arrows --}}
        <button @click="active = (active - 1 + slides.length) % slides.length"
            class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md hover:bg-white/20 text-white p-2 sm:p-3 rounded-full transition border border-white/10">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button @click="active = (active + 1) % slides.length"
            class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md hover:bg-white/20 text-white p-2 sm:p-3 rounded-full transition border border-white/10">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </section>

    {{-- ================= CONTENT CONTAINER ================= --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">

        {{-- ================= STATISTIK PLATFORM ================= --}}
        <section class="relative -mt-12 sm:-mt-16 mb-20 sm:mb-28 z-10 px-4 sm:px-0">
            <div
                class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-xl shadow-black/5 p-6 sm:p-10 grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 border border-white/50">
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-extrabold text-emerald-600">10K+</p>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 font-medium">Donatur Aktif</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-extrabold text-emerald-600">500+</p>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 font-medium">Campaign Berhasil</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-extrabold text-emerald-600">Rp 5M+</p>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 font-medium">Dana Tersalurkan</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-extrabold text-emerald-600">100%</p>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 font-medium">Aman & Transparan</p>
                </div>
            </div>
        </section>

        {{-- ================= VALUE SECTION ================= --}}
        <section class="mb-24">
            <div class="text-center mb-14">
                <span
                    class="text-xs font-bold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-4 py-1.5 rounded-full">KEUNGGULAN
                    KAMI</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800 mt-5">Kenapa Harus Donasi di Sini?</h2>
                <p class="text-slate-500 mt-3 max-w-2xl mx-auto leading-relaxed">Kami memastikan setiap rupiah yang Anda
                    sumbangkan sampai ke tangan yang tepat dengan pengawasan ketat.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="group bg-white p-7 rounded-2xl border border-slate-100 shadow-sm shadow-black/5 hover:shadow-lg hover:border-blue-200 transition-all duration-300 text-center">
                    <div
                        class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-blue-50 flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-100 transition duration-300">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-2">Pembayaran Aman</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Terintegrasi Midtrans dengan enkripsi berlapis untuk
                        keamanan transaksi.</p>
                </div>

                <div
                    class="group bg-white p-7 rounded-2xl border border-slate-100 shadow-sm shadow-black/5 hover:shadow-lg hover:border-emerald-200 transition-all duration-300 text-center">
                    <div
                        class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-emerald-50 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-100 transition duration-300">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-2">Terverifikasi</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Setiap campaign melewati proses verifikasi ketat oleh
                        admin berpengalaman.</p>
                </div>

                <div
                    class="group bg-white p-7 rounded-2xl border border-slate-100 shadow-sm shadow-black/5 hover:shadow-lg hover:border-violet-200 transition-all duration-300 text-center">
                    <div
                        class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-violet-50 flex items-center justify-center group-hover:scale-110 group-hover:bg-violet-100 transition duration-300">
                        <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 13l3-3 4 4 5-5" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-2">Transparan</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Laporan penggunaan dana dapat dipantau secara
                        real-time oleh publik.</p>
                </div>

                <div
                    class="group bg-white p-7 rounded-2xl border border-slate-100 shadow-sm shadow-black/5 hover:shadow-lg hover:border-amber-200 transition-all duration-300 text-center">
                    <div
                        class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-amber-50 flex items-center justify-center group-hover:scale-110 group-hover:bg-amber-100 transition duration-300">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-2">Support 24/7</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Tim customer service siap membantu Anda kapan saja
                        dan di mana saja.</p>
                </div>
            </div>
        </section>

        {{-- ================= CARA KERJA ================= --}}
        <section id="cara-kerja" class="mb-24 bg-slate-50 rounded-[2rem] py-16 px-6 md:px-12 border border-slate-100">
            <div class="text-center mb-16">
                <span
                    class="text-xs font-bold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-4 py-1.5 rounded-full">CARA
                    KERJA</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800 mt-5">Semudah 3 Langkah Ini</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-12 relative max-w-4xl mx-auto">
                {{-- Garis Penghubung --}}
                <div
                    class="hidden md:block absolute top-12 left-[20%] right-[20%] h-0.5 bg-gradient-to-r from-emerald-200 via-teal-200 to-emerald-200">
                </div>

                <div class="text-center relative">
                    <div
                        class="w-24 h-24 mx-auto bg-gradient-to-br from-emerald-500 to-teal-500 text-white rounded-3xl flex items-center justify-center text-3xl font-extrabold shadow-lg shadow-emerald-500/20 relative z-10">
                        1</div>
                    <h3 class="font-bold text-xl text-slate-800 mt-8 mb-3">Pilih Campaign</h3>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-xs mx-auto">Temukan campaign kebaikan yang
                        sesuai dengan hati Anda dari daftar campaign terverifikasi.</p>
                </div>

                <div class="text-center relative">
                    <div
                        class="w-24 h-24 mx-auto bg-gradient-to-br from-emerald-500 to-teal-500 text-white rounded-3xl flex items-center justify-center text-3xl font-extrabold shadow-lg shadow-emerald-500/20 relative z-10">
                        2</div>
                    <h3 class="font-bold text-xl text-slate-800 mt-8 mb-3">Lakukan Donasi</h3>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-xs mx-auto">Masukkan nominal dan lakukan
                        pembayaran secara aman melalui berbagai metode pembayaran.</p>
                </div>

                <div class="text-center relative">
                    <div
                        class="w-24 h-24 mx-auto bg-gradient-to-br from-emerald-500 to-teal-500 text-white rounded-3xl flex items-center justify-center text-3xl font-extrabold shadow-lg shadow-emerald-500/20 relative z-10">
                        3</div>
                    <h3 class="font-bold text-xl text-slate-800 mt-8 mb-3">Dana Tersalurkan</h3>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-xs mx-auto">Dana akan langsung diterima oleh
                        pengelola campaign dan dipantau hingga selesai.</p>
                </div>
            </div>
        </section>

        {{-- ================= CAMPAIGN TERBARU ================= --}}
        <section class="mb-24">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800">Campaign Terbaru</h2>
                    <p class="text-slate-500 mt-2">Ayo bantu mereka mencapai targetnya</p>
                </div>
                <a href="{{ route('campaign.index') }}"
                    class="group inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-bold transition text-sm">
                    Lihat Semua Campaign
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
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
                <div class="bg-white rounded-2xl p-16 text-center border border-slate-100 shadow-sm">
                    <div class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <p class="text-slate-500 font-medium">Belum ada campaign tersedia saat ini.</p>
                </div>
            @endif
        </section>

        {{-- ================= KABAR TERBARU ================= --}}
        <section class="mb-24">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <span
                        class="text-xs font-bold uppercase tracking-widest text-teal-600 bg-teal-50 px-4 py-1.5 rounded-full inline-block mb-4">
                        <svg class="w-3.5 h-3.5 inline -mt-0.5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2zM9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        KABAR TERBARU
                    </span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-800">Update dari Pengelola</h2>
                    <p class="text-slate-500 mt-2">Perkembangan terbaru dari campaign yang sedang berlangsung</p>
                </div>
            </div>

            @if ($updates->count())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                    @foreach ($updates as $update)
                        <a href="{{ route('campaign.updates.show', [$update->campaign->slug, $update->id]) }}"
                            class="group bg-white rounded-2xl border border-slate-100 shadow-sm shadow-black/5 hover:shadow-lg hover:border-teal-200 transition-all duration-300 overflow-hidden flex flex-col">
                            {{-- IMAGE --}}
                            @if ($update->image)
                                <div class="aspect-[16/10] sm:aspect-video bg-slate-100 overflow-hidden">
                                    <img src="{{ Storage::url($update->image) }}" alt="{{ $update->title }}"
                                        class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500">
                                </div>
                            @else
                                <div
                                    class="aspect-[16/10] sm:aspect-video bg-gradient-to-br from-teal-100 to-emerald-100 flex items-center justify-center">
                                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-teal-400" fill="none"
                                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2zM9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-4 sm:p-5 flex flex-1 flex-col">
                                {{-- CAMPAIGN TAG --}}
                                <div class="flex items-center gap-2 mb-3">
                                    @if ($update->campaign->category)
                                        <span
                                            class="text-[10px] font-semibold uppercase tracking-wider text-teal-600 bg-teal-50 px-2 py-0.5 rounded-full">
                                            {{ $update->campaign->category->name }}
                                        </span>
                                    @endif
                                </div>

                                {{-- TITLE --}}
                                <h3
                                    class="font-bold text-slate-800 text-sm leading-snug line-clamp-2 group-hover:text-teal-700 transition-colors flex-1">
                                    {{ $update->title }}
                                </h3>

                                {{-- PREVIEW CONTENT --}}
                                @if ($update->content)
                                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed line-clamp-2 mt-2 flex-1">
                                        {{ Str::limit($update->content, 120) }}...
                                    </p>
                                @endif

                                {{-- FOOTER: Pengelola + Time --}}
                                <div class="mt-auto pt-3 border-t border-slate-100 flex items-center gap-2">
                                    @if ($update->campaign->user)
                                        @if ($update->campaign->user->profile_photo_path)
                                            <img src="{{ $update->campaign->user->profile_photo_url }}"
                                                class="w-6 h-6 rounded-full object-cover flex-shrink-0">
                                        @else
                                            <div
                                                class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                                <span
                                                    class="text-[9px] font-bold text-emerald-700">{{ $update->campaign->user->initial }}</span>
                                            </div>
                                        @endif
                                        <span
                                            class="text-[10px] text-slate-400 truncate">{{ $update->campaign->user->name }}</span>
                                    @endif
                                    <span class="text-[10px] text-slate-300">•</span>
                                    <span
                                        class="text-[10px] text-slate-400">{{ $update->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 sm:p-16 text-center border border-slate-100 shadow-sm">
                    <div class="w-14 h-14 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2zM9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="text-slate-500 font-medium">Belum ada kabar terbaru</p>
                    <p class="text-slate-400 text-xs mt-1">Update dari pengelola akan muncul di sini</p>
                </div>
            @endif
        </section>

        {{-- ================= TESTIMONI DONATUR ================= --}}
        <section class="mb-24">
            <div class="text-center mb-14">
                <span
                    class="text-xs font-bold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-4 py-1.5 rounded-full">TESTIMONI</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800 mt-5">Apa Kata Mereka?</h2>
                <p class="text-slate-500 mt-3">Cerita nyata dari para donatur dan pengelola campaign.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Testimony 1 --}}
                <div
                    class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm shadow-black/5 hover:shadow-lg transition duration-300 flex flex-col">
                    <div class="flex gap-1 mb-5">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-600 text-sm italic leading-relaxed mb-8 flex-1">"Proses donasinya sangat mudah dan
                        cepat. Saya bisa langsung melihat perkembangan dana yang sudah terkumpul secara real-time. Sangat
                        transparan!"</p>
                    <div class="flex items-center gap-3 pt-6 border-t border-slate-100">
                        <div
                            class="w-11 h-11 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-700 font-bold shadow-sm">
                            A</div>
                        <div>
                            <p class="font-bold text-slate-800 text-sm">Andi Pratama</p>
                            <p class="text-xs text-slate-400">Donatur Aktif</p>
                        </div>
                    </div>
                </div>

                {{-- Testimony 2 --}}
                <div
                    class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm shadow-black/5 hover:shadow-lg transition duration-300 flex flex-col">
                    <div class="flex gap-1 mb-5">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-600 text-sm italic leading-relaxed mb-8 flex-1">"Sebagai pengelola, fitur
                        pencairan dananya sangat membantu. Tidak ribet dan langsung cair ke rekening saya. Admin-nya juga
                        fast respon!"</p>
                    <div class="flex items-center gap-3 pt-6 border-t border-slate-100">
                        <div
                            class="w-11 h-11 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold shadow-sm">
                            S</div>
                        <div>
                            <p class="font-bold text-slate-800 text-sm">Siti Rahmawati</p>
                            <p class="text-xs text-slate-400">Pengelola Campaign</p>
                        </div>
                    </div>
                </div>

                {{-- Testimony 3 --}}
                <div
                    class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm shadow-black/5 hover:shadow-lg transition duration-300 flex flex-col">
                    <div class="flex gap-1 mb-5">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-600 text-sm italic leading-relaxed mb-8 flex-1">"Saya merasa tenang berdonasi di
                        sini karena ada bukti pencairan dana yang transparan. Semoga platform ini terus berkembang membantu
                        banyak orang."</p>
                    <div class="flex items-center gap-3 pt-6 border-t border-slate-100">
                        <div
                            class="w-11 h-11 bg-violet-100 rounded-full flex items-center justify-center text-violet-700 font-bold shadow-sm">
                            B</div>
                        <div>
                            <p class="font-bold text-slate-800 text-sm">Budi Santoso</p>
                            <p class="text-xs text-slate-400">Donatur Setia</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= FAQ ================= --}}
        <section class="mb-24" x-data="{ open: null }">
            <div class="text-center mb-14">
                <span
                    class="text-xs font-bold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-4 py-1.5 rounded-full">FAQ</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800 mt-5">Pertanyaan Umum</h2>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm shadow-black/5 transition-all duration-200"
                    :class="open === 1 ? 'border-emerald-300 shadow-emerald-100' : ''">
                    <button @click="open = open === 1 ? null : 1"
                        class="w-full flex justify-between items-center p-6 text-left font-bold text-slate-800 hover:bg-slate-50/50 transition">
                        Apakah donasi saya aman?
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 ml-4 transition-colors"
                            :class="open === 1 ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400'">
                            <svg class="w-4 h-4 transition-transform duration-300" :class="open === 1 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>
                    <div x-show="open === 1" x-collapse>
                        <p class="px-6 pb-6 text-sm text-slate-500 leading-relaxed">Sangat aman. Kami menggunakan Midtrans
                            sebagai payment gateway yang sudah tersertifikasi PCI DSS. Seluruh transaksi dienkripsi dan
                            tidak ada pihak ketiga yang dapat mengakses data kartu pembayaran Anda.</p>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm shadow-black/5 transition-all duration-200"
                    :class="open === 2 ? 'border-emerald-300 shadow-emerald-100' : ''">
                    <button @click="open = open === 2 ? null : 2"
                        class="w-full flex justify-between items-center p-6 text-left font-bold text-slate-800 hover:bg-slate-50/50 transition">
                        Bagaimana cara pencairan dana?
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 ml-4 transition-colors"
                            :class="open === 2 ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400'">
                            <svg class="w-4 h-4 transition-transform duration-300" :class="open === 2 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>
                    <div x-show="open === 2" x-collapse>
                        <p class="px-6 pb-6 text-sm text-slate-500 leading-relaxed">Pengelola campaign dapat mengajukan
                            pencairan dana melalui dashboard setiap saat. Tim admin akan melakukan review dan mentransfer
                            dana ke rekening pengelola yang sudah terverifikasi dalam waktu maksimal 3x24 jam.</p>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm shadow-black/5 transition-all duration-200"
                    :class="open === 3 ? 'border-emerald-300 shadow-emerald-100' : ''">
                    <button @click="open = open === 3 ? null : 3"
                        class="w-full flex justify-between items-center p-6 text-left font-bold text-slate-800 hover:bg-slate-50/50 transition">
                        Apakah bisa donasi secara anonim?
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 ml-4 transition-colors"
                            :class="open === 3 ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400'">
                            <svg class="w-4 h-4 transition-transform duration-300" :class="open === 3 ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>
                    <div x-show="open === 3" x-collapse>
                        <p class="px-6 pb-6 text-sm text-slate-500 leading-relaxed">Tentu bisa. Saat melakukan donasi, Anda
                            cukup centang opsi "Donasi sebagai anonim" dan identitas Anda tidak akan ditampilkan di halaman
                            publik campaign.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= FINAL CTA ================= --}}
        <section
            class="bg-gradient-to-br from-emerald-500 via-emerald-600 to-teal-600 rounded-[2.5rem] px-8 sm:px-14 py-20 text-center text-white shadow-2xl shadow-emerald-500/20 relative overflow-hidden border border-emerald-400/20">
            <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-56 h-56 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/3">
            </div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/5 rounded-full blur-3xl">
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl md:text-5xl font-extrabold leading-tight">Ingin Menggalang Dana?</h2>
                <p class="mt-6 text-lg max-w-2xl mx-auto text-emerald-100 leading-relaxed">Bergabunglah sebagai pengelola
                    dan mulai buat campaign kebaikanmu sendiri. Proses verifikasi cepat dan mudah!</p>

                @auth
                    @if (auth()->user()->role === 'donatur')
                        <a href="{{ route('pengelola.terms') }}"
                            class="group inline-flex items-center gap-3 mt-10 bg-white text-emerald-700 px-10 py-4 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all duration-200">
                            Ajukan Jadi Pengelola
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('dashboard.pengelola') }}"
                            class="group inline-flex items-center gap-3 mt-10 bg-white text-emerald-700 px-10 py-4 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all duration-200">
                            Ke Dashboard Pengelola
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-3 mt-10 bg-white text-emerald-700 px-10 py-4 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all duration-200">
                        Daftar & Mulai Sekarang
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                @endauth
            </div>
        </section>
    </div>
    {{-- AKUN TERHAPUS - FLASH MESSAGE --}}
    @if (session('account_deleted'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="fixed bottom-6 right-6 z-[100] max-w-sm bg-white rounded-2xl shadow-xl shadow-black/10 border border-slate-200/80 overflow-hidden">

            <div class="p-4">
                <div class="flex gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-slate-800">Akun Berhasil Dihapus</p>
                        <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">{{ session('account_deleted') }}</p>
                    </div>
                    <button @click="show = false" class="text-slate-400 hover:text-slate-600 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/collapse.min.js" defer></script>
@endpush
