<x-public-layout>
    <x-slot name="title">Page Not Found - {{ config('app.name') }}</x-slot>

    <div class="flex flex-col items-center justify-center py-16 sm:py-24 text-center">
        {{-- Animated wrench icon --}}
        <div class="relative mb-8">
            <div class="w-28 h-28 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center animate-bounce" style="animation-duration: 2s;">
                <x-heroicon-o-wrench-screwdriver class="w-14 h-14 text-blue-600 dark:text-blue-400" />
            </div>
            <span class="absolute -top-2 -right-2 text-4xl">?</span>
        </div>

        {{-- 404 number --}}
        <h1 class="text-8xl sm:text-9xl font-extrabold text-gray-200 dark:text-slate-800 select-none">404</h1>

        {{-- Funny message --}}
        <h2 class="mt-4 text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">
            We looked everywhere. Even behind the fridge.
        </h2>
        <p class="mt-3 text-gray-600 dark:text-slate-400 max-w-md">
            This page must have called another handyman. Don't worry, we won't take it personally.
        </p>

        {{-- Action buttons --}}
        <div class="mt-8 flex flex-col sm:flex-row gap-3">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                <x-heroicon-o-home class="w-5 h-5" />
                Back to Home
            </a>
            <a href="tel:+9609996210" class="inline-flex items-center justify-center gap-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-white px-6 py-3 rounded-xl font-semibold border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                <x-heroicon-o-phone class="w-5 h-5" />
                Call: 999 6210
            </a>
        </div>

        {{-- Subtle footer joke --}}
        <p class="mt-12 text-sm text-gray-400 dark:text-slate-600 italic">
            Error 404: Our handyman is great at fixing things, but even he can't find this page.
        </p>
    </div>
</x-public-layout>
