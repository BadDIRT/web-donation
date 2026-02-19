<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="min-h-screen bg-gradient-to-br from-green-50 to-white flex items-center justify-center">

    {{-- BACK BUTTON --}}
    <a href="{{ url()->previous() ?? '/' }}"
        class="absolute top-6 left-6 flex items-center gap-2 text-gray-600 hover:text-green-600 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span>Kembali</span>
    </a>

    {{-- CONTENT --}}
    <main class="w-full max-w-md px-4">
        @yield('content')
    </main>

</body>

</html>
