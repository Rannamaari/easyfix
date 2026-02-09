@php
    $links = [
        ['label' => 'Home', 'href' => url('/'), 'active' => request()->is('/'), 'icon' => 'home'],
        ['label' => 'Services', 'href' => url('/#services'), 'active' => false, 'icon' => 'squares-2x2'],
        ['label' => 'About', 'href' => route('about'), 'active' => request()->routeIs('about'), 'icon' => 'information-circle'],
        ['label' => 'Blog', 'href' => route('blog.index'), 'active' => request()->is('blog*'), 'icon' => 'newspaper'],
    ];

    $ctaHref = auth()->check() ? route('jobs.create') : route('guest.create');
    $ctaLabel = 'Request a Service';
    $user = auth()->user();
    $needsAddress = auth()->check() && !$user->addresses()->exists();
    $addressLink = route('profile.edit') . '#addresses';
@endphp

<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-200 dark:bg-slate-950/95 dark:border-slate-800" aria-label="Main navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 flex-shrink-0">
                <x-application-logo class="h-24 w-auto" />
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center gap-8">
                @foreach ($links as $link)
                    <a href="{{ $link['href'] }}"
                       class="text-sm font-medium transition-colors {{ $link['active'] ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Desktop Actions --}}
            <div class="hidden md:flex items-center gap-3">
                <a href="tel:+9609996210" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-slate-400 dark:hover:text-white">
                    <x-heroicon-o-phone class="w-4 h-4" />
                    999 6210
                </a>
                <x-theme-toggle />
                @guest
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800 dark:focus-visible:ring-offset-slate-950">
                        Login
                    </a>
                @else
                    @if($needsAddress)
                        <a href="{{ $addressLink }}"
                           class="inline-flex items-center gap-2 rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 hover:bg-amber-100 dark:border-amber-400/40 dark:bg-amber-400/10 dark:text-amber-200 dark:hover:bg-amber-400/20">
                            <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                            Add location
                        </a>
                    @endif
                    <div class="relative">
                        <button type="button"
                                data-user-menu-toggle="user-menu"
                                aria-label="Open user menu"
                                aria-controls="user-menu"
                                aria-expanded="false"
                                class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 dark:border-slate-800 dark:text-slate-100 dark:hover:bg-slate-800 dark:focus-visible:ring-offset-slate-950">
                            <x-heroicon-o-user-circle class="w-5 h-5 text-gray-500 dark:text-slate-400" />
                            <span class="max-w-[120px] truncate">{{ $user->name ?? 'Account' }}</span>
                            <x-heroicon-o-chevron-down class="w-4 h-4 text-gray-400 dark:text-slate-500" />
                        </button>
                        <div id="user-menu"
                             data-user-menu="user-menu"
                             class="hidden absolute right-0 mt-2 w-56 rounded-xl border border-gray-200 bg-white shadow-lg dark:border-slate-800 dark:bg-slate-900">
                            <div class="px-4 py-3 border-b border-gray-100 dark:border-slate-800">
                                <p class="text-xs font-semibold text-gray-500 dark:text-slate-400">Signed in as</p>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $user->email }}</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-slate-200 dark:hover:bg-slate-800/60">
                                    <x-heroicon-o-squares-2x2 class="w-4 h-4" />
                                    Dashboard
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-slate-200 dark:hover:bg-slate-800/60">
                                    <x-heroicon-o-user class="w-4 h-4" />
                                    Profile
                                </a>
                                <a href="{{ $addressLink }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-slate-200 dark:hover:bg-slate-800/60">
                                    <x-heroicon-o-map-pin class="w-4 h-4" />
                                    Addresses
                                </a>
                                <a href="{{ route('jobs.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-slate-200 dark:hover:bg-slate-800/60">
                                    <x-heroicon-o-clipboard-document-list class="w-4 h-4" />
                                    My Jobs
                                </a>
                            </div>
                            <div class="border-t border-gray-100 dark:border-slate-800">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">
                                        <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4" />
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
                <a href="{{ $ctaHref }}"
                   class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-slate-950">
                    {{ $ctaLabel }}
                </a>
            </div>

            {{-- Mobile Actions --}}
            <div class="md:hidden flex items-center gap-1">
                {{-- Quick Call Button --}}
                <a href="tel:+9609996210"
                   class="inline-flex items-center justify-center rounded-lg p-2 text-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-slate-800"
                   aria-label="Call us">
                    <x-heroicon-o-phone class="w-5 h-5" />
                </a>
                {{-- WhatsApp Button --}}
                <a href="https://wa.me/9609996210"
                   target="_blank"
                   class="inline-flex items-center justify-center rounded-lg p-2 text-green-600 hover:bg-green-50 dark:text-green-400 dark:hover:bg-slate-800"
                   aria-label="WhatsApp us">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
                {{-- Theme Toggle --}}
                <x-theme-toggle />
                {{-- Menu Toggle --}}
                <button type="button"
                        data-nav-toggle
                        aria-label="Toggle menu"
                        aria-controls="mobile-nav"
                        aria-expanded="false"
                        class="inline-flex items-center justify-center rounded-lg p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800">
                    <svg data-menu-icon="open" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg data-menu-icon="close" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Navigation Panel --}}
    <div id="mobile-nav" data-nav-panel class="md:hidden hidden border-t border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-950">
        <div class="px-4 py-4 space-y-1">
            @foreach ($links as $link)
                <a href="{{ $link['href'] }}"
                   data-nav-link
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium transition-colors {{ $link['active'] ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300' : 'text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800/50' }}">
                    <x-dynamic-component :component="'heroicon-o-' . $link['icon']" class="w-5 h-5 opacity-70" />
                    {{ $link['label'] }}
                </a>
            @endforeach

            <div class="border-t border-gray-100 dark:border-slate-800 my-2 pt-2">
                @auth
                    @if($needsAddress)
                        <a href="{{ $addressLink }}" data-nav-link class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-semibold text-amber-700 bg-amber-50 dark:text-amber-200 dark:bg-amber-400/10">
                            <x-heroicon-o-map-pin class="w-5 h-5" />
                            Add location
                        </a>
                    @endif
                    <a href="{{ url('/dashboard') }}" data-nav-link class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800/50">
                        <x-heroicon-o-squares-2x2 class="w-5 h-5 opacity-70" />
                        Dashboard
                    </a>
                    <a href="{{ route('profile.edit') }}" data-nav-link class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800/50">
                        <x-heroicon-o-user class="w-5 h-5 opacity-70" />
                        Profile
                    </a>
                    <a href="{{ $addressLink }}" data-nav-link class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800/50">
                        <x-heroicon-o-map-pin class="w-5 h-5 opacity-70" />
                        Addresses
                    </a>
                    <a href="{{ route('jobs.index') }}" data-nav-link class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800/50">
                        <x-heroicon-o-clipboard-document-list class="w-5 h-5 opacity-70" />
                        My Jobs
                    </a>
                @else
                    <a href="{{ route('login') }}" data-nav-link class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800/50">
                        <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5 opacity-70" />
                        Login
                    </a>
                    <a href="{{ route('register') }}" data-nav-link class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-700 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800/50">
                        <x-heroicon-o-user-plus class="w-5 h-5 opacity-70" />
                        Sign Up
                    </a>
                @endauth
            </div>

            {{-- CTA Button --}}
            <div class="pt-2">
                <a href="{{ $ctaHref }}"
                   data-nav-link
                   class="flex items-center justify-center gap-2 w-full rounded-xl bg-blue-600 px-4 py-3.5 text-base font-semibold text-white shadow-sm hover:bg-blue-700">
                    <x-heroicon-o-wrench-screwdriver class="w-5 h-5" />
                    {{ $ctaLabel }}
                </a>
            </div>

            {{-- Contact Strip --}}
            <div class="pt-3 flex items-center justify-center gap-4 text-sm text-gray-500 dark:text-slate-400">
                <a href="tel:+9609996210" class="inline-flex items-center gap-1 hover:text-blue-600">
                    <x-heroicon-o-phone class="w-4 h-4" />
                    999 6210
                </a>
                <span class="text-gray-300 dark:text-slate-700">|</span>
                <a href="https://wa.me/9609996210" target="_blank" class="inline-flex items-center gap-1 hover:text-green-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </div>
</nav>
