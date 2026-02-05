<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-100 shadow-sm dark:bg-slate-900/95 dark:border-slate-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between min-h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center">
                        <x-application-logo class="h-20 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user()->isProvider())
                        <x-nav-link :href="route('provider.index')" :active="request()->routeIs('provider.*')">
                            <span class="inline-flex items-center gap-2">
                                {{ __('My Jobs') }}
                                @if(Auth::user()->unreadMessageCount() > 0)
                                    <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 text-xs font-semibold rounded-full bg-red-600 text-white">
                                        {{ Auth::user()->unreadMessageCount() }}
                                    </span>
                                @endif
                            </span>
                        </x-nav-link>
                    @elseif(Auth::user()->isAdmin())
                        <x-nav-link :href="url('/admin')" :active="false">
                            <span class="inline-flex items-center gap-2">
                                {{ __('Admin Panel') }}
                                @if(Auth::user()->unreadMessageCount() > 0)
                                    <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 text-xs font-semibold rounded-full bg-red-600 text-white">
                                        {{ Auth::user()->unreadMessageCount() }}
                                    </span>
                                @endif
                            </span>
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.*')">
                            <span class="inline-flex items-center gap-2">
                                {{ __('My Jobs') }}
                                @if(Auth::user()->unreadMessageCount() > 0)
                                    <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 text-xs font-semibold rounded-full bg-red-600 text-white">
                                        {{ Auth::user()->unreadMessageCount() }}
                                    </span>
                                @endif
                            </span>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex items-center gap-3">
                    <button type="button" data-theme-toggle onclick="const isDark = document.documentElement.classList.toggle('dark'); localStorage.setItem('theme', isDark ? 'dark' : 'light');" class="relative z-10 inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white shadow hover:bg-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2m0 14v2m9-9h-2M5 12H3m14.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-11.314 1.414 1.414m10.314 10.314 1.414 1.414M12 7a5 5 0 100 10 5 5 0 000-10z" />
                        </svg>
                    </button>
                    <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 dark:bg-slate-900 dark:text-slate-300 dark:hover:text-white">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800 dark:focus:bg-slate-800">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100 dark:border-slate-800">
        <div class="pt-3 pb-4 space-y-1">
            @if(Auth::user()->isProvider())
                <x-responsive-nav-link :href="route('provider.index')" :active="request()->routeIs('provider.*')">
                    <span class="inline-flex items-center gap-2">
                        {{ __('My Jobs') }}
                        @if(Auth::user()->unreadMessageCount() > 0)
                            <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 text-xs font-semibold rounded-full bg-red-600 text-white">
                                {{ Auth::user()->unreadMessageCount() }}
                            </span>
                        @endif
                    </span>
                </x-responsive-nav-link>
            @elseif(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="url('/admin')" :active="false">
                    <span class="inline-flex items-center gap-2">
                        {{ __('Admin Panel') }}
                        @if(Auth::user()->unreadMessageCount() > 0)
                            <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 text-xs font-semibold rounded-full bg-red-600 text-white">
                                {{ Auth::user()->unreadMessageCount() }}
                            </span>
                        @endif
                    </span>
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.*')">
                    <span class="inline-flex items-center gap-2">
                        {{ __('My Jobs') }}
                        @if(Auth::user()->unreadMessageCount() > 0)
                            <span class="inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 text-xs font-semibold rounded-full bg-red-600 text-white">
                                {{ Auth::user()->unreadMessageCount() }}
                            </span>
                        @endif
                    </span>
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t border-gray-200 dark:border-slate-800">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-slate-100">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            <div class="mt-3 px-4">
                <button type="button" data-theme-toggle onclick="const isDark = document.documentElement.classList.toggle('dark'); localStorage.setItem('theme', isDark ? 'dark' : 'light');" class="relative z-10 w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-md bg-blue-600 text-sm text-white shadow hover:bg-blue-700">
                    <span>Toggle Theme</span>
                </button>
            </div>
        </div>
    </div>
</nav>
