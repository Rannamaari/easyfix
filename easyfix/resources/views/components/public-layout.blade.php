<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'EasyFix') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

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
            {{-- Simple Header --}}
            <header class="bg-white shadow-sm dark:bg-slate-900 dark:border-b dark:border-slate-800">
                <div class="max-w-4xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <a href="/" class="inline-flex items-center">
                            <x-application-logo class="h-20 w-auto" />
                        </a>
                        <div class="flex items-center gap-3 text-sm">
                            <button type="button" data-theme-toggle class="relative z-10 inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white shadow hover:bg-blue-700">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2m0 14v2m9-9h-2M5 12H3m14.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-11.314 1.414 1.414m10.314 10.314 1.414 1.414M12 7a5 5 0 100 10 5 5 0 000-10z" />
                                </svg>
                            </button>
                            @auth
                                <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white">My Jobs</a>
                                <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white">
                                        Log Out
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white">Login</a>
                                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-3 py-1.5 rounded-md hover:bg-blue-700">Sign Up</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <main class="py-8">
                <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>

            <footer class="py-8 text-center text-sm text-gray-500 dark:text-slate-400">
                &copy; {{ date('Y') }} {{ config('app.name', 'EasyFix') }}. All rights reserved.
            </footer>
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
