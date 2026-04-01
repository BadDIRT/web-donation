@extends('layouts.auth')

@section('title', 'Menunggu Persetujuan')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-white">

        <div x-data="{
            progress: 0,
            duration: 6000,
            start() {
                let interval = 50;
                let step = 100 / (this.duration / interval);
        
                let timer = setInterval(() => {
                    this.progress += step;
                    if (this.progress >= 100) {
                        this.progress = 100;
                        clearInterval(timer);
                        window.location.href = '{{ route('dashboard') }}';
                    }
                }, interval);
            }
        }" x-init="start()" x-cloak
            class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full text-center space-y-6 transform transition-all duration-500 scale-100">

            {{-- ICON --}}
            <div class="w-20 h-20 mx-auto rounded-full bg-green-100 flex items-center justify-center shadow-inner">
                <svg class="w-10 h-10 text-green-600 animate-bounce" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            {{-- TITLE --}}
            <h2 class="text-2xl font-bold text-gray-800">
                Campaign Berhasil Diajukan 🎉
            </h2>

            {{-- MESSAGE --}}
            <p class="text-gray-500 text-sm leading-relaxed">
                Campaign kamu sedang dalam proses review oleh admin. <br>
                Proses persetujuan membutuhkan waktu maksimal
                <span class="font-semibold text-gray-700">3x24 jam</span>.
            </p>

            {{-- PROGRESS BAR --}}
            <div class="w-full">
                <div class="flex justify-between text-xs text-gray-400 mb-1">
                    <span>Memproses...</span>
                    <span x-text="Math.round(progress) + '%'"></span>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-400 to-emerald-500 h-2 rounded-full transition-all duration-75"
                        :style="`width: ${progress}%`"></div>
                </div>
            </div>

            {{-- COUNTDOWN --}}
            <div class="text-xs text-gray-400">
                Mengalihkan ke dashboard dalam
                <span class="font-semibold text-gray-600" x-text="Math.ceil((100 - progress) / (100 / 6))">
                </span> detik...
            </div>

        </div>

    </div>
@endsection
