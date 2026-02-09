<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'EasyFix') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
        <style>body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }</style>

        {{ $head ?? '' }}

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
        <div class="min-h-screen bg-gray-100 dark:bg-slate-950">
            <x-navbar />

            <main class="py-8">
                <div class="{{ ($wide ?? false) ? 'max-w-7xl' : 'max-w-2xl' }} mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>

            <footer class="py-8 text-center text-sm text-gray-500 dark:text-slate-400">
                &copy; {{ date('Y') }} {{ config('app.name', 'EasyFix') }}. All rights reserved.
            </footer>
        </div>
    </body>
</html>
