@props(['title' => config('app.name', 'Laravel'), 'description' => '', 'keywords' => '', 'canonicalUrl' => ''])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Dynamic SEO Tags -->
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <link rel="canonical" href="{{ $canonicalUrl ?: url()->current() }}">

    <!-- Open Graph Tags for Social Sharing -->
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('path-to-default-image.jpg') }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    {{-- Alert --}}
    <x-alert-notification />

    {{-- Content --}}
    <div class="min-h-screen bg-gray-100">
        {{-- Navigation --}}
        <x-navigation />
        <x-layouts.bottom-nav-bar/>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    
    {{-- Footer --}}
    <x-layouts.footer />

    <!-- Scripts -->
    <script src="{{ mix('resources/js/animations.js') }}"></script>
</body>
</html>
