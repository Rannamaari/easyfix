<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Easy Fix - Quick Home & Office Repairs in Malé</title>
    <meta name="description" content="Fast, reliable repairs for your home and office in Malé City. AC, electrical, plumbing, cleaning and more. Our trained team is ready to help.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function () {
            const saved = localStorage.getItem('theme');
            if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
    </style>
</head>
<body class="antialiased bg-white text-gray-900 dark:bg-slate-950 dark:text-slate-100">

    {{-- Navigation --}}
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-100 dark:bg-slate-950/95 dark:border-slate-800">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-wrench-screwdriver class="w-5 h-5 text-white" />
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">Easy Fix</span>
                </a>

                <div class="flex items-center gap-4">
                    <button type="button" data-theme-toggle class="p-2 text-gray-600 hover:text-gray-900 dark:text-slate-400 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-slate-800">
                        <x-heroicon-s-sun class="w-5 h-5 hidden dark:block" />
                        <x-heroicon-s-moon class="w-5 h-5 block dark:hidden" />
                    </button>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- ========================================
         SECTION 1: HERO
         ======================================== --}}
    <section class="relative bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
            <div class="max-w-3xl">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 px-3 py-1.5 rounded-full text-sm font-medium mb-6">
                    <x-heroicon-s-map-pin class="w-4 h-4" />
                    Serving Greater Malé Area
                </div>

                {{-- Headline --}}
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
                    Small fixes.<br>
                    Done right.<br>
                    Done fast.
                </h1>

                {{-- Subheading --}}
                <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-slate-300 max-w-xl">
                    From AC repairs to door locks, we handle the little things that make your home or office work smoothly. Our trained team is just a call away.
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    @auth
                        <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                            <x-heroicon-o-calendar-days class="w-5 h-5" />
                            Book a Service
                        </a>
                    @else
                        <a href="{{ route('guest.create') }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                            <x-heroicon-o-calendar-days class="w-5 h-5" />
                            Book a Service
                        </a>
                    @endauth
                    <a href="tel:+9609996210" class="inline-flex items-center justify-center gap-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-white px-6 py-3.5 rounded-xl font-semibold border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                        <x-heroicon-o-phone class="w-5 h-5" />
                        Call Us
                    </a>
                    <a href="https://wa.me/9609996210" target="_blank" class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-green-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp
                    </a>
                </div>

                {{-- Trust Note --}}
                <p class="mt-6 text-sm text-gray-500 dark:text-slate-400">
                    No account needed. Same-day service available.
                </p>
            </div>
        </div>
    </section>

    {{-- ========================================
         SECTION 2: WHAT WE FIX
         ======================================== --}}
    <section id="services" class="py-16 sm:py-20 bg-white dark:bg-slate-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">What We Fix</h2>
                <p class="mt-3 text-gray-600 dark:text-slate-400 max-w-xl mx-auto">
                    Quick solutions for everyday problems at home or office.
                </p>
            </div>

            {{-- Services Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @php
                    $services = [
                        ['icon' => 'sun', 'name' => 'AC Repair', 'desc' => 'Cooling issues, servicing'],
                        ['icon' => 'bolt', 'name' => 'Electrical', 'desc' => 'Boards, switches, lights'],
                        ['icon' => 'wrench-screwdriver', 'name' => 'Plumbing', 'desc' => 'Leaks, taps, pipes'],
                        ['icon' => 'key', 'name' => 'Door & Locks', 'desc' => 'Handles, hinges, locks'],
                        ['icon' => 'sparkles', 'name' => 'Cleaning', 'desc' => 'Deep clean, move-out'],
                        ['icon' => 'cube', 'name' => 'Small Moving', 'desc' => 'Furniture, appliances'],
                    ];
                @endphp

                @foreach($services as $service)
                    <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-5 text-center border border-gray-100 dark:border-slate-800 hover:border-blue-200 dark:hover:border-slate-700 transition-colors">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <x-dynamic-component :component="'heroicon-o-' . $service['icon']" class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ $service['name'] }}</h3>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mt-1">{{ $service['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Additional Note --}}
            <p class="text-center mt-8 text-gray-600 dark:text-slate-400">
                Also: Kitchen cabinets, furniture assembly, wall mounting, and more small fixes.
            </p>
        </div>
    </section>

    {{-- ========================================
         SECTION 3: HOW EASY FIX WORKS
         ======================================== --}}
    <section id="how-it-works" class="py-16 sm:py-20 bg-gray-50 dark:bg-slate-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">How Easy Fix Works</h2>
                <p class="mt-3 text-gray-600 dark:text-slate-400">
                    Three simple steps to get your problem solved.
                </p>
            </div>

            {{-- Steps --}}
            <div class="grid sm:grid-cols-3 gap-8 max-w-4xl mx-auto">
                {{-- Step 1 --}}
                <div class="text-center">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-white">1</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Tell Us the Problem</h3>
                    <p class="text-gray-600 dark:text-slate-400 text-sm">
                        Call us or fill out a quick form. Describe what needs fixing.
                    </p>
                </div>

                {{-- Step 2 --}}
                <div class="text-center">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-white">2</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">We Send Our Team</h3>
                    <p class="text-gray-600 dark:text-slate-400 text-sm">
                        A trained technician from our team visits at your convenient time.
                    </p>
                </div>

                {{-- Step 3 --}}
                <div class="text-center">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-white">3</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Problem Fixed</h3>
                    <p class="text-gray-600 dark:text-slate-400 text-sm">
                        Job done. Pay after you're satisfied with the work.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================
         SECTION 4: WHY CHOOSE EASY FIX
         ======================================== --}}
    <section class="py-16 sm:py-20 bg-white dark:bg-slate-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">Why Choose Easy Fix</h2>
                <p class="mt-3 text-gray-600 dark:text-slate-400">
                    We're not just another repair service.
                </p>
            </div>

            {{-- Benefits Grid --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Benefit 1 --}}
                <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                    <div class="w-11 h-11 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center mb-4">
                        <x-heroicon-o-user-group class="w-6 h-6 text-green-600 dark:text-green-400" />
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Our Own Team</h3>
                    <p class="text-sm text-gray-600 dark:text-slate-400">
                        Trained in-house technicians. Not random workers. People we trust.
                    </p>
                </div>

                {{-- Benefit 2 --}}
                <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                    <div class="w-11 h-11 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-4">
                        <x-heroicon-o-clock class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Same-Day Service</h3>
                    <p class="text-sm text-gray-600 dark:text-slate-400">
                        Most jobs done the same day. We know you can't wait days for a broken AC.
                    </p>
                </div>

                {{-- Benefit 3 --}}
                <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                    <div class="w-11 h-11 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mb-4">
                        <x-heroicon-o-currency-dollar class="w-6 h-6 text-amber-600 dark:text-amber-400" />
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Fair Pricing</h3>
                    <p class="text-sm text-gray-600 dark:text-slate-400">
                        Clear quotes before work starts. No surprise charges at the end.
                    </p>
                </div>

                {{-- Benefit 4 --}}
                <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                    <div class="w-11 h-11 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-4">
                        <x-heroicon-o-map-pin class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Greater Malé Area</h3>
                    <p class="text-sm text-gray-600 dark:text-slate-400">
                        We cover Malé City, Hulhumalé Phase 1 & 2, and Villingili.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================
         SECTION 5: CALL TO ACTION
         ======================================== --}}
    <section class="py-16 sm:py-20 bg-blue-600 dark:bg-blue-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                Got something that needs fixing?
            </h2>
            <p class="text-blue-100 text-lg mb-8 max-w-xl mx-auto">
                Don't let small problems become big headaches. Reach out and we'll take care of it.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center gap-2 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-colors">
                        <x-heroicon-o-calendar-days class="w-5 h-5" />
                        Book a Service
                    </a>
                @else
                    <a href="{{ route('guest.create') }}" class="inline-flex items-center justify-center gap-2 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-colors">
                        <x-heroicon-o-calendar-days class="w-5 h-5" />
                        Book a Service
                    </a>
                @endauth
                <a href="tel:+9609996210" class="inline-flex items-center justify-center gap-2 bg-blue-700 dark:bg-blue-800 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-800 dark:hover:bg-blue-900 transition-colors border border-blue-500">
                    <x-heroicon-o-phone class="w-5 h-5" />
                    Call Us Now
                </a>
                <a href="https://wa.me/9609996210" target="_blank" class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </section>

    {{-- ========================================
         FOOTER
         ======================================== --}}
    <footer class="bg-gray-900 dark:bg-slate-950 text-gray-400">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Company Info --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-wrench-screwdriver class="w-4 h-4 text-white" />
                        </div>
                        <span class="text-lg font-bold text-white">Easy Fix</span>
                    </div>
                    <p class="text-sm text-gray-500 mb-4">
                        Quick, reliable repairs for homes and offices in the Greater Malé Area.
                    </p>
                    <p class="text-sm text-gray-500">
                        By Micronet
                    </p>
                </div>

                {{-- Services --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Services</h4>
                    <ul class="space-y-2 text-sm">
                        <li>AC Repair & Service</li>
                        <li>Electrical Work</li>
                        <li>Plumbing</li>
                        <li>Door & Lock Fixes</li>
                        <li>Cleaning</li>
                        <li>Small Moving</li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-2">
                            <x-heroicon-o-phone class="w-4 h-4 text-gray-500" />
                            <a href="tel:+9609996210" class="hover:text-white">+960 999 6210</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <a href="https://wa.me/9609996210" target="_blank" class="hover:text-white">WhatsApp</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <x-heroicon-o-envelope class="w-4 h-4 text-gray-500" />
                            <a href="mailto:hello@micronet.mv" class="hover:text-white">hello@micronet.mv</a>
                        </li>
                        <li class="flex items-start gap-2">
                            <x-heroicon-o-map-pin class="w-4 h-4 text-gray-500 mt-0.5" />
                            <span>Greater Malé Area, Maldives</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="pt-8 mt-8 border-t border-gray-800 text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Easy Fix by Micronet. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- Theme Toggle Script --}}
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
