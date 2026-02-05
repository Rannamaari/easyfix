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
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-slate-950">
            <div class="w-full sm:max-w-md px-6">
                <div class="flex items-center justify-between">
                    <a href="/" class="inline-flex items-center">
                        <x-application-logo class="{{ $logoClass }}" />
                    </a>
                    <button type="button" data-theme-toggle class="relative z-10 inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white shadow hover:bg-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2m0 14v2m9-9h-2M5 12H3m14.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-11.314 1.414 1.414m10.314 10.314 1.414 1.414M12 7a5 5 0 100 10 5 5 0 000-10z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg dark:bg-slate-900 dark:shadow-none dark:border dark:border-slate-800">
                {{ $slot }}
            </div>
        </div>
        <script>
            (function () {
                document.addEventListener('click', (event) => {
                    const target = event.target.closest('[data-theme-toggle]');
                    if (!target) return;
                    event.preventDefault();
                    const isDark = document.documentElement.classList.toggle('dark');
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                });
            })();
        </script>
    </body>
</html>
