<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $header ?? 'Dashboard' }} - MyNVet</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo3.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo3.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Chelsea+Market&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lexend:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <x-ui.error-message :message="session('success') ?? (session('error') ?? (session('warning') ?? session('info')))" :type="session('success')
        ? 'success'
        : (session('error')
            ? 'error'
            : (session('warning')
                ? 'warning'
                : (session('info')
                    ? 'info'
                    : null)))" />


    <div class="app-shell">
        <x-ui.background-pattern />
        <div class="flex h-full p-3 relative z-10">


            @include('layouts.sidebar')

            <div id="main-content" class="h-full flex flex-col w-full overflow-y-auto">


                @include('components.ui.main-topbar', ['title' => $header, 'subtle' => $subtle])

                {{-- Main Content Slot --}}
                <div class="flex-1">
                    {{ $slot }}
                </div>

                @include('components.ui.main-bottombar', ['title' => $header])
            </div>
        </div>

    </div>
    </div>

    <x-ui.loading-screen />

    @stack('scripts')

</body>

</html>
