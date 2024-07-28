<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <main class="m-auto mt-10 flex max-w-4xl flex-col items-center md:mt-28 md:flex-row">
        <div>
            <img src="{{ asset('storage/img/logo.jpg') }}" alt="Pizakoz" class="max-w-xs" />
        </div>

        <div class="w-full p-10">
            {{ $slot }}
        </div>
    </main>
</body>

</html>
