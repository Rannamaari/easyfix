@props(['logoClass' => 'h-16 w-auto'])

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
        <script>
            (function () {
                const saved = localStorage.getItem('theme');
                if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
            })();
        </script>
    </head>
    <body class="font-sans text-gray-900 antialiased dark:text-slate-100 dark:bg-slate-950">
        <x-navbar />
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-10 bg-gray-100 dark:bg-slate-950">
            <div class="w-full sm:max-w-md px-6">
                <x-application-logo class="{{ $logoClass }} mx-auto" />
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg dark:bg-slate-900 dark:shadow-none dark:border dark:border-slate-800">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
