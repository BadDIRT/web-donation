@extends('layouts.app')

@section('title', 'Syarat & Ketentuan Penggalangan Dana')

@section('content')
    <div class="bg-gradient-to-br from-slate-50 via-white to-emerald-50/20 pb-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- BACK LINK --}}
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>

            {{-- HEADER --}}
            <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden mb-6">
                <div class="relative px-6 py-8 sm:px-8 sm:py-10 bg-gradient-to-r from-emerald-500 to-teal-500">
                    <div
                        class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIDIwMCIgd2lkdGg9IjIwMCIgaGVpZ2h0PSIyMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdGggZD0iTTAgMGgyMDAgMjAwIDIwMEgwdi0yMDBIMHYyMDB6IiBmaWxsPSJub25lIi8+PHBhdGggZD0iTTQwIDBjMjIuMDkgMCA0MCAxNy45MSA0MGg0MGMxMC4wOSAwIDE3LjkxIDcuOTEgMTcuOTFWMGMwLTEwLjA5LTcuOTEtMTcuOTEtMTcuOTF6IiBmaWxsPSIjZmZmZmZmIiBvcGFjaXR5PSIwLjA1Ii8+PC9kZWZzPjwvc3ZnPg==')] opacity-10">
                    </div>
                    <div class="relative z-10 flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl sm:text-2xl font-extrabold text-white">Syarat & Ketentuan</h1>
                            <p class="text-emerald-100 text-sm mt-1">Berlaku untuk seluruh campaign di <b
                                    class="text-white">DonasiKita</b></p>
                        </div>
                    </div>
                </div>

                {{-- LAST UPDATED --}}
                <div class="px-6 py-3 sm:px-8 bg-emerald-50/50 border-t border-emerald-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-xs text-emerald-700 font-medium">Terakhir diperbarui: 1 Januari 2025</p>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="space-y-4">

                {{-- A. BIAYA ADMINISTRASI --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                    <button type="button"
                        onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.chevron').classList.toggle('rotate-180')"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Bagian A</span>
                                <h3 class="text-sm font-bold text-slate-800 mt-0.5">Biaya Administrasi</h3>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 chevron transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-6">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-amber-600">1</span>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Biaya administrasi platform sebesar <b
                                        class="text-slate-800">5%</b> dari total donasi yang berhasil dikumpulkan.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Kategori <b
                                        class="text-emerald-600">bencana alam</b> dikenakan biaya <b
                                        class="text-emerald-600">0%</b> (gratis).</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-slate-500">3</span>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Digunakan untuk operasional, keamanan, dan
                                    pengembangan platform.</p>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- B. VERIFIKASI CAMPAIGN --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                    <button type="button"
                        onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.chevron').classList.toggle('rotate-180')"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Bagian B</span>
                                <h3 class="text-sm font-bold text-slate-800 mt-0.5">Verifikasi Campaign</h3>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 chevron transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-6">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-blue-600">1</span>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Proses verifikasi maksimal <b
                                        class="text-slate-800">3x24 jam</b> sejak pengajuan.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-blue-600">2</span>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Campaign yang belum terverifikasi <b
                                        class="text-slate-800">tidak tampil ke publik</b>.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-blue-600">3</span>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Admin dapat menghubungi penggalang untuk
                                    validasi data tambahan.</p>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- C. CAMPAIGN AKTIF --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                    <button type="button"
                        onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.chevron').classList.toggle('rotate-180')"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <span class="text-xs font-bold text-violet-600 uppercase tracking-wider">Bagian C</span>
                                <h3 class="text-sm font-bold text-slate-800 mt-0.5">Campaign Aktif</h3>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 chevron transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-6">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-violet-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-violet-600">1</span>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Campaign dapat <b
                                        class="text-slate-800">ditangguhkan</b> bila
                                    terindikasi pelanggaran.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-violet-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-violet-600">2</span>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Perubahan data campaign akan <b
                                        class="text-slate-800">diverifikasi ulang</b>.</p>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- D. PENCAIRAN DANA --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                    <button type="button"
                        onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.chevron').classList.toggle('rotate-180')"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Bagian D</span>
                                <h3 class="text-sm font-bold text-slate-800 mt-0.5">Pencairan Dana</h3>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 chevron transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-6">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-emerald-600">1</span>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Pencairan dapat diajukan <b
                                        class="text-slate-800">kapan saja</b> selama
                                    campaign aktif.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-emerald-600">2</span>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Proses transfer maksimal <b
                                        class="text-slate-800">3x24 jam</b> setelah disetujui admin.</p>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- E. KETENTUAN LAIN --}}
                <div class="bg-white rounded-2xl shadow-sm shadow-black/5 border border-slate-100 overflow-hidden">
                    <button type="button"
                        onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.chevron').classList.toggle('rotate-180')"
                        class="w-full px-6 py-5 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Bagian E</span>
                                <h3 class="text-sm font-bold text-slate-800 mt-0.5">Ketentuan Lain</h3>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 chevron transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-6">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Campaign fiktif akan dikenakan <b
                                        class="text-red-600">sanksi permanen</b> berupa pemblokiran akun.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">Data pengguna <b
                                        class="text-slate-800">dijamin
                                        kerahasiaannya</b> sesuai kebijakan privasi.</p>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            {{-- CHECKBOX AGREEMENT --}}
            <div class="mt-6">
                <label
                    class="flex items-start gap-3 p-5 bg-white rounded-2xl shadow-sm shadow-black/5 border-2 border-slate-200 cursor-pointer group transition-all
                {{ old('agreed') ? 'border-emerald-200 bg-emerald-50/30' : 'hover:border-emerald-200' }}">
                    <input type="checkbox" id="agree" name="agreed" value="1"
                        @if (old('agreed')) checked @endif class="hidden peer agree-checkbox">
                    <div
                        class="w-6 h-6 rounded-lg border-2 border-slate-300 flex items-center justify-center flex-shrink-0 mt-0.5 peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-all">
                        <svg class="w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity"
                            fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition-colors">
                            Saya telah membaca dan menyetujui seluruh Syarat & Ketentuan
                        </p>
                        <p class="text-xs text-slate-400 mt-0.5">Dengan melanjutkan, Anda menyetujui ketentuan yang
                            berlaku.</p>
                    </div>
                </label>
            </div>

            {{-- ACTION BUTTON --}}
            <button type="button" id="submitBtn" disabled onclick="handleAgree()"
                class="mt-6 inline-flex items-center justify-center gap-2 w-full px-6 py-4 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span id="submitText">Centang S&K di atas untuk melanjutkan</span>
            </button>

            {{-- BACK ALTERNATIVE --}}
            <a href="{{ route('dashboard') }}"
                class="mt-3 inline-flex items-center justify-center gap-2 w-full px-6 py-3 rounded-xl text-sm font-medium border border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all">
                Kembali Nanti
            </a>

        </div>
    </div>

    @push('scripts')
        <script>
            const checkbox = document.getElementById('agree');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');

            checkbox.addEventListener('change', function() {
                const isChecked = this.checked;

                if (isChecked) {
                    submitBtn.disabled = false;
                    submitText.textContent = 'Saya Setuju & Lanjutkan';
                    submitBtn.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed',
                        'disabled:shadow-none');
                } else {
                    submitBtn.disabled = true;
                    submitText.textContent = 'Centang S&K di atas untuk melanjutkan';
                    submitBtn.classList.add('disabled:opacity-50', 'disabled:cursor-not-allowed',
                        'disabled:shadow-none');
                }
            });

            function handleAgree() {
                if (!checkbox.checked) return;
                window.location.href = '{{ route('pengelola.form') }}';
            }
        </script>
    @endpush
@endsection
