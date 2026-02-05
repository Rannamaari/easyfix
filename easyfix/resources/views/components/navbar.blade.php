@php
    $links = [
        ['label' => 'Home', 'href' => url('/'), 'active' => request()->is('/')],
        ['label' => 'Services', 'href' => url('/#services'), 'active' => false],
        ['label' => 'Pricing', 'href' => url('/#pricing'), 'active' => false],
        ['label' => 'About', 'href' => route('about'), 'active' => request()->routeIs('about')],
        ['label' => 'Contact', 'href' => url('/#contact'), 'active' => false],
    ];

    $ctaHref = auth()->check() ? route('jobs.create') : route('guest.create');
    $ctaLabel = 'Request a Service';
@endphp

<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-200 dark:bg-slate-950/95 dark:border-slate-800" aria-label="Main navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2">
                    <x-application-logo class="h-16 w-auto" />
                </a>
            </div>

            <div class="hidden md:flex items-center gap-8">
                @foreach ($links as $link)
                    <a href="{{ $link['href'] }}"
                       class="text-sm font-medium transition-colors {{ $link['active'] ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="hidden md:flex items-center gap-3">
                <x-theme-toggle />
                <a href="{{ $ctaHref }}"
                   class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-slate-950">
                    {{ $ctaLabel }}
                </a>
            </div>

            <div class="md:hidden flex items-center gap-2">
                <button type="button"
                        data-nav-toggle
                        aria-label="Toggle menu"
                        aria-controls="mobile-nav"
                        aria-expanded="false"
                        class="inline-flex items-center justify-center rounded-lg p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800 dark:focus-visible:ring-offset-slate-950">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-nav" data-nav-panel class="md:hidden hidden border-t border-gray-200 dark:border-slate-800">
        <div class="px-4 py-4 space-y-2">
            @foreach ($links as $link)
                <a href="{{ $link['href'] }}"
                   data-nav-link
                   class="block rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ $link['active'] ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300' : 'text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach

            @auth
                <a href="{{ url('/dashboard') }}" data-nav-link class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800">Dashboard</a>
            @else
                <a href="{{ route('login') }}" data-nav-link class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800">Login</a>
            @endauth

            <div class="flex items-center justify-between rounded-lg border border-gray-200 px-3 py-2 dark:border-slate-800">
                <span class="text-sm text-gray-700 dark:text-slate-300">Theme</span>
                <x-theme-toggle />
            </div>

            <a href="{{ $ctaHref }}"
               data-nav-link
               class="mt-2 inline-flex w-full items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                {{ $ctaLabel }}
            </a>
        </div>
    </div>
</nav>
