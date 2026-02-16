<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs" defer></script>


    {{-- Midtrans Snap --}}
    <script 
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>
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
