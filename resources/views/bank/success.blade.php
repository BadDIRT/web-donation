@extends('layouts.auth')

@section('title', 'Berhasil')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

        <div x-data="progressBar()" x-init="start()"
            class="bg-white rounded-3xl shadow-xl p-8 max-w-md w-full text-center space-y-6">

            {{-- ICON --}}
            <div class="w-16 h-16 mx-auto rounded-full bg-green-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            {{-- TITLE --}}
            <h2 class="text-xl font-bold text-gray-800">
                Rekening Berhasil Ditambahkan
            </h2>

            {{-- MESSAGE --}}
            <p class="text-gray-500 text-sm leading-relaxed">
                Rekening bank kamu berhasil ditambahkan dan siap digunakan untuk penarikan dana.
            </p>

            {{-- PROGRESS BAR --}}
            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                <div class="bg-green-500 h-2 rounded-full transition-all duration-100" :style="'width:' + progress + '%'">
                </div>
            </div>

            {{-- TIMER --}}
            <p class="text-xs text-gray-400">
                Mengalihkan ke dashboard dalam <span x-text="seconds"></span> detik...
            </p>

            {{-- LOADING --}}
            <div class="flex items-center justify-center gap-2 text-gray-400 text-sm">
                <svg class="animate-spin h-4 w-4 text-green-500" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                Selesai diproses...
            </div>

        </div>
    </div>

    <script>
        function progressBar() {
            return {
                progress: 0,
                seconds: 6,

                start() {
                    let duration = 6000;
                    let interval = 100;
                    let step = 100 / (duration / interval);

                    let timer = setInterval(() => {
                        this.progress += step;

                        if (this.progress >= 100) {
                            clearInterval(timer);
                            window.location.href = "{{ route('dashboard') }}";
                        }
                    }, interval);

                    let countdown = setInterval(() => {
                        this.seconds--;

                        if (this.seconds <= 0) {
                            clearInterval(countdown);
                        }
                    }, 1000);
                }
            }
        }
    </script>
@endsection
