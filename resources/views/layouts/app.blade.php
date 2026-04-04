<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><rect width='24' height='24' rx='7' fill='%2322C55E'/><g transform='translate(12,12) scale(0.65) translate(-12,-12)'><path fill='none' stroke='%23FFFFFF' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round' d='M12 21s-6.5-4.35-9-8.5C1.5 9.5 3.5 6 7 6c2 0 3.5 1.5 5 3.5C13.5 7.5 15 6 17 6c3.5 0 5.5 3.5 4 6.5-2.5 4.15-9 8.5-9 8.5z'/></g></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-3mFZL4m3OBRI3IuX"></script>

    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- NAVBAR FIXED --}}
    @include('components.navbar')

    {{-- ALERT (OFFSET NAVBAR) --}}
    <div class="pt-24">
        @include('components.alert')

        {{-- PAGE CONTENT --}}
        @yield('content')
    </div>

    @include('components.footer')

    @stack('scripts')

</body>

</html>
