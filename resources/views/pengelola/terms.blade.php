@extends('layouts.auth')

@section('title','Syarat & Ketentuan Penggalangan Dana')

@section('content')

<div class="bg-white rounded-2xl shadow-xl
            p-6 sm:p-8
            mt-16 sm:mt-20">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">
            Syarat & Ketentuan
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Berlaku untuk seluruh campaign di <b>DonasiKita</b>
        </p>
    </div>

    {{-- CONTENT --}}
    <div class="space-y-6 text-sm text-gray-700 leading-relaxed">

        <section>
            <h3 class="font-semibold mb-2">A. Biaya Administrasi</h3>
            <ul class="list-disc pl-5 space-y-1">
                <li>Biaya administrasi platform sebesar <b>5%</b>.</li>
                <li>Kategori bencana alam dikenakan biaya <b>0%</b>.</li>
                <li>Digunakan untuk operasional dan keamanan platform.</li>
            </ul>
        </section>

        <section>
            <h3 class="font-semibold mb-2">B. Verifikasi Campaign</h3>
            <ul class="list-disc pl-5 space-y-1">
                <li>Proses verifikasi maksimal <b>3x24 jam</b>.</li>
                <li>Campaign belum terverifikasi tidak tampil ke publik.</li>
                <li>Admin dapat menghubungi penggalang untuk validasi data.</li>
            </ul>
        </section>

        <section>
            <h3 class="font-semibold mb-2">C. Campaign Aktif</h3>
            <ul class="list-disc pl-5 space-y-1">
                <li>Campaign dapat ditangguhkan bila terindikasi pelanggaran.</li>
                <li>Perubahan data campaign akan diverifikasi ulang.</li>
            </ul>
        </section>

        <section>
            <h3 class="font-semibold mb-2">D. Pencairan Dana</h3>
            <ul class="list-disc pl-5 space-y-1">
                <li>Pencairan dapat diajukan kapan saja.</li>
                <li>Proses maksimal <b>3x24 jam</b> setelah disetujui.</li>
            </ul>
        </section>

        <section>
            <h3 class="font-semibold mb-2">E. Ketentuan Lain</h3>
            <ul class="list-disc pl-5 space-y-1">
                <li>Campaign fiktif akan dikenakan sanksi.</li>
                <li>Data pengguna dijamin kerahasiaannya.</li>
            </ul>
        </section>

    </div>

    {{-- ACTION --}}
    <div class="mt-8">
        <a href="{{ route('pengelola.form') }}"
           class="block w-full text-center bg-green-500 hover:bg-green-600
                  text-white py-3 rounded-xl font-semibold transition">
            Saya Setuju & Lanjutkan
        </a>
    </div>

</div>

@endsection