@extends('layouts.auth')

@section('title', 'Menunggu Verifikasi')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50">

        <div x-data="{
            progress: 0
        }" x-init="let duration = 6000;
        let interval = 50;
        let step = 100 / (duration / interval);
        
        let timer = setInterval(() => {
            progress += step;
            if (progress >= 100) {
                progress = 100;
                clearInterval(timer);
            }
        }, interval);
        
        setTimeout(() => {
            window.location.href = '{{ route('dashboard') }}'
        }, duration);"
            class="bg-white rounded-3xl shadow-xl p-8 max-w-md w-full text-center space-y-6">

            {{-- ICON --}}
            <div class="w-16 h-16 mx-auto rounded-full bg-green-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            {{-- TITLE --}}
            <h2 class="text-xl font-bold text-gray-800">
                Pengajuan Berhasil Dikirim
            </h2>

            {{-- MESSAGE --}}
            <p class="text-gray-500 text-sm leading-relaxed">
                Pengajuan Anda sebagai <span class="font-semibold text-gray-700">pengelola</span>
                sedang dalam proses verifikasi oleh admin.<br><br>

                Estimasi proses maksimal
                <span class="font-semibold text-gray-700">3x24 jam</span>.
            </p>

            {{-- PROGRESS BAR --}}
            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                <div class="bg-green-500 h-2 rounded-full transition-all duration-100" :style="'width: ' + progress + '%'">
                </div>
            </div>

            {{-- LOADING TEXT --}}
            <div class="flex items-center justify-center gap-2 text-gray-400 text-sm">
                <svg class="animate-spin h-4 w-4 text-green-500" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                Mengalihkan...
            </div>

        </div>

    </div>
@endsection
