<!DOCTYPE html>
<html lang="en-MV">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO Optimized Title --}}
    <title>Easy Fix | Plumber, Electrician & Handyman Services in Malé, Maldives</title>

    {{-- SEO Meta Description --}}
    <meta name="description" content="Need a plumber, electrician or handyman in Malé? Easy Fix provides same-day AC repair, fridge repair, washing machine repair, plumbing, electrical & cleaning services in Malé City, Hulhumalé & Villingili. Call +960 999 6210.">

    {{-- SEO Keywords --}}
    <meta name="keywords" content="plumber Malé, electrician Malé, handyman Maldives, AC repair Malé, fridge repair Malé, washing machine repair Maldives, refrigerator repair Hulhumalé, appliance repair Malé, plumbing Hulhumalé, home repair Maldives">

    {{-- Geo Tags for Local SEO --}}
    <meta name="geo.region" content="MV-MLE">
    <meta name="geo.placename" content="Malé City, Maldives">
    <meta name="geo.position" content="4.1755;73.5093">
    <meta name="ICBM" content="4.1755, 73.5093">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://easyfix.mv/">
    <meta property="og:title" content="Easy Fix | Plumber, Electrician & Handyman in Malé">
    <meta property="og:description" content="Same-day home repairs in Malé City. AC repair, plumbing, electrical, door locks & more. Trusted team. Call +960 999 6210.">
    <meta property="og:image" content="https://easyfix.mv/images/easyfix-og.jpg">
    <meta property="og:locale" content="en_MV">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Easy Fix | Handyman Services in Malé, Maldives">
    <meta name="twitter:description" content="Same-day plumbing, electrical & AC repair in Malé. Call +960 999 6210.">

    {{-- Canonical URL --}}
    <link rel="canonical" href="https://easyfix.mv/">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="/favicon.ico">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Theme Script --}}
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

    {{-- LocalBusiness Schema Markup - wrapped in verbatim to prevent Blade parsing @ symbols --}}
    @verbatim
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "HomeAndConstructionBusiness",
        "@id": "https://easyfix.mv/#business",
        "name": "Easy Fix",
        "alternateName": "Easy Fix Maldives",
        "description": "Professional handyman, plumber, electrician and home repair services in Malé City, Hulhumalé and Villingili, Maldives. Same-day service available.",
        "url": "https://easyfix.mv",
        "telephone": "+960-999-6210",
        "email": "hello@micronet.mv",
        "image": "https://easyfix.mv/images/easyfix-logo.png",
        "logo": "https://easyfix.mv/images/easyfix-logo.png",
        "priceRange": "MVR",
        "currenciesAccepted": "MVR",
        "paymentAccepted": "Cash, Bank Transfer",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Malé City",
            "addressRegion": "Malé",
            "addressCountry": "MV"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "4.1755",
            "longitude": "73.5093"
        },
        "areaServed": [
            {
                "@type": "City",
                "name": "Malé City",
                "containedInPlace": {
                    "@type": "Country",
                    "name": "Maldives"
                }
            },
            {
                "@type": "City",
                "name": "Hulhumalé"
            },
            {
                "@type": "City",
                "name": "Villingili"
            }
        ],
        "openingHoursSpecification": [
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Sunday"],
                "opens": "08:00",
                "closes": "22:00"
            },
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Friday", "Saturday"],
                "opens": "14:00",
                "closes": "22:00"
            }
        ],
        "sameAs": [
            "https://www.facebook.com/easyfixmv",
            "https://www.instagram.com/easyfixmv"
        ]
    }
    </script>
    @endverbatim

    {{-- FAQ Schema --}}
    @verbatim
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "How fast can you come for repairs in Malé?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We offer same-day service for most repairs in Malé City, Hulhumalé, and Villingili. For urgent issues like water leaks or AC problems, we try to arrive within 1-2 hours."
                }
            },
            {
                "@type": "Question",
                "name": "Do you provide plumbing services in Hulhumalé?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, we provide plumbing, electrical, AC repair and all handyman services in Hulhumalé Phase 1 and Phase 2, as well as Malé City and Villingili."
                }
            },
            {
                "@type": "Question",
                "name": "What is the cost of AC repair in Malé?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "AC repair costs vary depending on the issue. We provide a clear quote before starting any work. There are no hidden charges. Call us at +960 999 6210 for a free estimate."
                }
            }
        ]
    }
    </script>
    @endverbatim
</head>
<body class="antialiased bg-white text-gray-900 dark:bg-slate-950 dark:text-slate-100">

    {{-- Navigation --}}
    <x-navbar />

    {{-- Beta Announcement Banner --}}
    <div class="border-b border-gray-200 bg-gray-50 dark:border-slate-800 dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-center gap-3 sm:gap-4">
                {{-- Beta Badge + Headline --}}
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 bg-blue-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
                        BETA
                    </span>
                    <span class="text-gray-900 dark:text-white text-sm font-semibold">
                        We're just getting started!
                    </span>
                </div>

                {{-- Service Pills --}}
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 text-xs font-medium px-2.5 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                        Available: AC Repair & Installation · Appliance Repair · On-Site Motorcycle Mechanic
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-gray-200 text-gray-600 dark:bg-slate-700 dark:text-slate-300 text-xs font-medium px-2.5 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 bg-gray-400 dark:bg-slate-500 rounded-full"></span>
                        More services & features coming soon
                    </span>
                </div>
            </div>
        </div>
    </div>

    <main>
        {{-- HERO SECTION --}}
        <section class="relative bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-950" aria-labelledby="hero-heading">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
                @auth
                {{-- Personalized Hero for Logged-in Users --}}
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 px-3 py-1.5 rounded-full text-sm font-medium mb-6">
                        <x-heroicon-s-hand-raised class="w-4 h-4" />
                        <span>Welcome back</span>
                    </div>

                    <h1 id="hero-heading" class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
                        Hi, {{ auth()->user()->name }}!
                    </h1>

                    <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-slate-300 max-w-xl">
                        Need something fixed? We're here to help with <strong>same-day repairs</strong> across Malé City, Hulhumalé and Villingili.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                            <x-heroicon-o-wrench-screwdriver class="w-5 h-5" />
                            Request a Service
                        </a>
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center justify-center gap-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-white px-6 py-3.5 rounded-xl font-semibold border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                            <x-heroicon-o-clipboard-document-list class="w-5 h-5" />
                            View My Jobs
                        </a>
                        <a href="tel:+9609996210" class="inline-flex items-center justify-center gap-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-white px-6 py-3.5 rounded-xl font-semibold border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                            <x-heroicon-o-phone class="w-5 h-5" />
                            Call: 999 6210
                        </a>
                    </div>

                    <p class="mt-6 text-sm text-gray-500 dark:text-slate-400">
                        ✓ Same-day service &nbsp; ✓ No hidden charges &nbsp; ✓ Trained team
                    </p>
                </div>
                @else
                {{-- Default Hero for Guests --}}
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 px-3 py-1.5 rounded-full text-sm font-medium mb-6">
                        <x-heroicon-s-map-pin class="w-4 h-4" />
                        <span>Plumber & Electrician in Malé City</span>
                    </div>

                    <h1 id="hero-heading" class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
                        Handyman Services in Malé, Maldives
                    </h1>

                    <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-slate-300 max-w-xl">
                        <strong>Same-day repairs</strong> for your home and office. AC repair, plumbing, electrical work, door locks, cleaning & small moving in <strong>Malé City, Hulhumalé</strong> and <strong>Villingili</strong>.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('guest.create') }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                            <x-heroicon-o-calendar-days class="w-5 h-5" />
                            Book a Service
                        </a>
                        <a href="tel:+9609996210" class="inline-flex items-center justify-center gap-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-white px-6 py-3.5 rounded-xl font-semibold border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                            <x-heroicon-o-phone class="w-5 h-5" />
                            Call: 999 6210
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 bg-white dark:bg-slate-800 text-blue-600 dark:text-blue-400 px-6 py-3.5 rounded-xl font-semibold border border-blue-200 dark:border-slate-700 hover:bg-blue-50 dark:hover:bg-slate-700 transition-colors">
                            <x-heroicon-o-user-plus class="w-5 h-5" />
                            Sign Up Free
                        </a>
                    </div>

                    <p class="mt-6 text-sm text-gray-500 dark:text-slate-400">
                        ✓ Same-day service &nbsp; ✓ No hidden charges &nbsp; ✓ Trained team
                    </p>
                </div>
                @endauth
            </div>
        </section>

        {{-- SERVICES SECTION --}}
        <section id="services" class="py-16 sm:py-20 bg-white dark:bg-slate-950" aria-labelledby="services-heading">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Section Header --}}
                <div class="text-center mb-12">
                    <h2 id="services-heading" class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                        Home Repair Services in Malé
                    </h2>
                    <p class="mt-3 text-gray-600 dark:text-slate-400 max-w-xl mx-auto">
                        Quick fixes for everyday problems. We serve Malé City, Hulhumalé Phase 1 & 2, and Villingili.
                    </p>
                </div>

                {{-- Services Grid --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-4 gap-4">
                    @php
                        $services = [
                            ['icon' => 'sun', 'name' => 'AC Repair', 'desc' => 'AC not cooling? We fix it'],
                            ['icon' => 'bolt', 'name' => 'Electrician', 'desc' => 'Switches, boards, wiring', 'coming_soon' => true],
                            ['icon' => 'wrench-screwdriver', 'name' => 'Plumber', 'desc' => 'Leaks, taps, blocked pipes', 'coming_soon' => true],
                            ['icon' => 'key', 'name' => 'Door & Locks', 'desc' => 'Handles, hinges, locks', 'coming_soon' => true],
                            ['icon' => 'cube-transparent', 'name' => 'Fridge Repair', 'desc' => 'Refrigerator not cooling?'],
                            ['icon' => 'arrow-path', 'name' => 'Washing Machine', 'desc' => 'Washer repairs & fixes'],
                            ['icon' => 'sparkles', 'name' => 'Cleaning', 'desc' => 'Deep clean, move-out', 'coming_soon' => true],
                            ['icon' => 'cube', 'name' => 'Small Moving', 'desc' => 'Furniture, appliances', 'coming_soon' => true],
                        ];
                    @endphp

                    @foreach($services as $service)
                        @php $comingSoon = !empty($service['coming_soon']); @endphp
                        <article class="relative rounded-2xl p-5 text-center border transition-colors
                            {{ $comingSoon
                                ? 'bg-gray-100 dark:bg-slate-900/60 border-gray-200 dark:border-slate-800 opacity-60 cursor-not-allowed'
                                : 'bg-gray-50 dark:bg-slate-900 border-gray-100 dark:border-slate-800 hover:border-blue-200 dark:hover:border-slate-700' }}">
                            @if($comingSoon)
                                <span class="absolute top-2 right-2 inline-flex items-center bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300 text-[10px] font-semibold px-1.5 py-0.5 rounded-full">
                                    Coming Soon
                                </span>
                            @endif
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3
                                {{ $comingSoon ? 'bg-gray-200 dark:bg-slate-800' : 'bg-blue-100 dark:bg-blue-900/30' }}">
                                <x-dynamic-component :component="'heroicon-o-' . $service['icon']"
                                    class="w-6 h-6 {{ $comingSoon ? 'text-gray-400 dark:text-slate-500' : 'text-blue-600 dark:text-blue-400' }}" />
                            </div>
                            <h3 class="font-semibold {{ $comingSoon ? 'text-gray-400 dark:text-slate-500' : 'text-gray-900 dark:text-white' }}">{{ $service['name'] }}</h3>
                            <p class="text-xs mt-1 {{ $comingSoon ? 'text-gray-400 dark:text-slate-600' : 'text-gray-500 dark:text-slate-400' }}">{{ $service['desc'] }}</p>
                        </article>
                    @endforeach
                </div>

                {{-- Additional Services --}}
                <p class="text-center mt-8 text-gray-600 dark:text-slate-400">
                    Also: Kitchen cabinet repairs, furniture assembly, wall mounting, curtain installation, and more appliance & handyman services.
                </p>
            </div>
        </section>

        {{-- HOW IT WORKS --}}
        <section id="how-it-works" class="py-16 sm:py-20 bg-gray-50 dark:bg-slate-900" aria-labelledby="how-heading">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 id="how-heading" class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                        How to Book a Handyman in Malé
                    </h2>
                    <p class="mt-3 text-gray-600 dark:text-slate-400">
                        Multiple ways to book. Choose what works for you.
                    </p>
                </div>

                <div class="grid sm:grid-cols-3 gap-6 max-w-5xl mx-auto mb-12">
                    {{-- Option 1: Book Online --}}
                    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-200 dark:border-slate-700 text-center">
                        <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <x-heroicon-o-device-phone-mobile class="w-7 h-7 text-white" />
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Book Online</h3>
                        <p class="text-gray-600 dark:text-slate-400 text-sm mb-4">
                            Sign up for an account to book services, track jobs, and manage your requests easily.
                        </p>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition-colors text-sm">
                            <x-heroicon-o-user-plus class="w-4 h-4" />
                            Sign Up Free
                        </a>
                    </div>

                    {{-- Option 2: Quick Book as Guest --}}
                    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-200 dark:border-slate-700 text-center">
                        <div class="w-14 h-14 bg-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <x-heroicon-o-bolt class="w-7 h-7 text-white" />
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Quick Book (No Account)</h3>
                        <p class="text-gray-600 dark:text-slate-400 text-sm mb-4">
                            In a hurry? Book as a guest - no signup required. Just fill the form and we'll call you.
                        </p>
                        <a href="{{ route('guest.create') }}" class="inline-flex items-center justify-center gap-2 bg-purple-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-purple-700 transition-colors text-sm">
                            <x-heroicon-o-calendar-days class="w-4 h-4" />
                            Book as Guest
                        </a>
                    </div>

                    {{-- Option 3: Call/WhatsApp --}}
                    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-200 dark:border-slate-700 text-center">
                        <div class="w-14 h-14 bg-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <x-heroicon-o-phone class="w-7 h-7 text-white" />
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Call or WhatsApp</h3>
                        <p class="text-gray-600 dark:text-slate-400 text-sm mb-4">
                            Prefer to talk? Call us directly or send a WhatsApp message anytime.
                        </p>
                        <div class="flex flex-col gap-2">
                            <a href="tel:+9609996210" class="inline-flex items-center justify-center gap-2 bg-gray-100 dark:bg-slate-700 text-gray-900 dark:text-white px-5 py-2.5 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors text-sm">
                                <x-heroicon-o-phone class="w-4 h-4" />
                                999 6210
                            </a>
                            <a href="https://wa.me/9609996210" target="_blank" class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-green-700 transition-colors text-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                {{-- What happens next --}}
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-200 dark:border-slate-700 max-w-3xl mx-auto">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 text-center">What Happens Next?</h3>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 text-sm text-gray-600 dark:text-slate-400">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                            <span>We confirm your booking</span>
                        </div>
                        <x-heroicon-o-arrow-right class="w-4 h-4 text-gray-400 hidden sm:block" />
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                            <span>Technician arrives same day</span>
                        </div>
                        <x-heroicon-o-arrow-right class="w-4 h-4 text-gray-400 hidden sm:block" />
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 rounded-full flex items-center justify-center text-xs font-bold">3</span>
                            <span>Problem fixed!</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- WHY CHOOSE US --}}
        <section id="pricing" class="py-16 sm:py-20 bg-white dark:bg-slate-950" aria-labelledby="why-heading">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 id="why-heading" class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                        Why Malé Residents Choose Easy Fix
                    </h2>
                    <p class="mt-3 text-gray-600 dark:text-slate-400">
                        Trusted by homes and offices across Greater Malé Area.
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                        <div class="w-11 h-11 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center mb-4">
                            <x-heroicon-o-user-group class="w-6 h-6 text-green-600 dark:text-green-400" />
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Trained Team</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-400">
                            Our own in-house technicians. Not random workers. People we trust and train.
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                        <div class="w-11 h-11 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-4">
                            <x-heroicon-o-clock class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Same-Day Service</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-400">
                            Most jobs done the same day. Urgent AC or plumbing issues? We come fast.
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                        <div class="w-11 h-11 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mb-4">
                            <x-heroicon-o-currency-dollar class="w-6 h-6 text-amber-600 dark:text-amber-400" />
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Fair & Clear Pricing</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-400">
                            We tell you the cost before starting. No surprise charges at the end.
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                        <div class="w-11 h-11 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-4">
                            <x-heroicon-o-map-pin class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">All of Greater Malé</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-400">
                            Malé City, Hulhumalé Phase 1 & 2, and Villingili. We know the area.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ SECTION --}}
        <section id="faq" class="py-16 sm:py-20 bg-gray-50 dark:bg-slate-900" aria-labelledby="faq-heading">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 id="faq-heading" class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                        Frequently Asked Questions
                    </h2>
                    <p class="mt-3 text-gray-600 dark:text-slate-400">
                        Common questions about our services in Malé.
                    </p>
                </div>

                <div class="space-y-4">
                    <details class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 p-4">
                        <summary class="font-semibold text-gray-900 dark:text-white cursor-pointer">
                            How fast can you come for repairs in Malé?
                        </summary>
                        <p class="mt-3 text-gray-600 dark:text-slate-400 text-sm">
                            We offer same-day service for most repairs in Malé City, Hulhumalé, and Villingili. For urgent issues like water leaks or AC problems, we try to arrive within 1-2 hours depending on availability.
                        </p>
                    </details>

                    <details class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 p-4">
                        <summary class="font-semibold text-gray-900 dark:text-white cursor-pointer">
                            Do you provide plumbing services in Hulhumalé?
                        </summary>
                        <p class="mt-3 text-gray-600 dark:text-slate-400 text-sm">
                            Yes, we provide plumbing, electrical, AC repair and all handyman services in Hulhumalé Phase 1 and Phase 2, as well as Malé City and Villingili. Same-day service available.
                        </p>
                    </details>

                    <details class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 p-4">
                        <summary class="font-semibold text-gray-900 dark:text-white cursor-pointer">
                            What is the cost of AC repair in Malé?
                        </summary>
                        <p class="mt-3 text-gray-600 dark:text-slate-400 text-sm">
                            AC repair costs vary depending on the issue. We provide a clear quote before starting any work, and there are no hidden charges. Call us at <a href="tel:+9609996210" class="text-blue-600 hover:underline">+960 999 6210</a> for a free estimate.
                        </p>
                    </details>

                    <details class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 p-4">
                        <summary class="font-semibold text-gray-900 dark:text-white cursor-pointer">
                            Do you work on Fridays and weekends?
                        </summary>
                        <p class="mt-3 text-gray-600 dark:text-slate-400 text-sm">
                            Yes, we work 7 days a week. On Fridays and Saturdays, we are available from 2 PM to 10 PM. Other days we work from 8 AM to 10 PM. For emergencies, reach us on WhatsApp.
                        </p>
                    </details>

                    <details class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 p-4">
                        <summary class="font-semibold text-gray-900 dark:text-white cursor-pointer">
                            Can I book a handyman for small jobs?
                        </summary>
                        <p class="mt-3 text-gray-600 dark:text-slate-400 text-sm">
                            Yes! We specialize in small, quick fixes. Door handles, leaky taps, electrical switches, wall mounting, furniture assembly - no job is too small.
                        </p>
                    </details>
                </div>
            </div>
        </section>

        {{-- CTA SECTION --}}
        <section class="py-16 sm:py-20 bg-blue-600 dark:bg-blue-700" aria-labelledby="cta-heading">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 id="cta-heading" class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    Need a Plumber or Electrician in Malé?
                </h2>
                <p class="text-blue-100 text-lg mb-8 max-w-xl mx-auto">
                    Don't let small problems become big headaches. Call Easy Fix for same-day repairs in Malé City, Hulhumalé and Villingili.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center gap-2 bg-white dark:bg-slate-900 text-blue-600 dark:text-blue-300 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 dark:hover:bg-slate-800 transition-colors">
                            <x-heroicon-o-calendar-days class="w-5 h-5" />
                            Book Online
                        </a>
                    @else
                        <a href="{{ route('guest.create') }}" class="inline-flex items-center justify-center gap-2 bg-white dark:bg-slate-900 text-blue-600 dark:text-blue-300 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 dark:hover:bg-slate-800 transition-colors">
                            <x-heroicon-o-calendar-days class="w-5 h-5" />
                            Book Online
                        </a>
                    @endauth
                    <a href="tel:+9609996210" class="inline-flex items-center justify-center gap-2 bg-blue-700 dark:bg-blue-800 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-800 dark:hover:bg-blue-900 transition-colors border border-blue-500">
                        <x-heroicon-o-phone class="w-5 h-5" />
                        Call: 999 6210
                    </a>
                    <a href="https://wa.me/9609996210?text=Hi,%20I%20need%20a%20repair%20service" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-green-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    <footer id="contact" class="bg-gray-900 dark:bg-slate-950 text-gray-400">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Company Info --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-wrench-screwdriver class="w-4 h-4 text-white" />
                        </div>
                        <span class="text-lg font-bold text-white">Easy Fix</span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-slate-400 mb-4">
                        Your trusted handyman, plumber and electrician in Malé City, Maldives. Same-day home repairs.
                    </p>
                    <p class="text-sm text-gray-500 dark:text-slate-400">
                        A service by Micronet
                    </p>
                </div>

                {{-- Services --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Our Services</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#services" class="hover:text-white">AC Repair</a></li>
                        <li><a href="#services" class="hover:text-white">Fridge Repair</a></li>
                        <li><a href="#services" class="hover:text-white">Washing Machine Repair</a></li>
                        <li><a href="#services" class="hover:text-white">Electrician</a></li>
                        <li><a href="#services" class="hover:text-white">Plumber</a></li>
                        <li><a href="#services" class="hover:text-white">Door & Lock Repair</a></li>
                        <li><a href="#services" class="hover:text-white">Cleaning Services</a></li>
                        <li><a href="#services" class="hover:text-white">Small Moving</a></li>
                    </ul>
                </div>

                {{-- Areas Served --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Areas We Serve</h4>
                    <ul class="space-y-2 text-sm">
                        <li>Malé City</li>
                        <li>Hulhumalé Phase 1</li>
                        <li>Hulhumalé Phase 2</li>
                        <li>Villingili</li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-2">
                        <x-heroicon-o-phone class="w-4 h-4 text-gray-500 dark:text-slate-400" />
                            <a href="tel:+9609996210" class="hover:text-white">+960 999 6210</a>
                        </li>
                        <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <a href="https://wa.me/9609996210" target="_blank" class="hover:text-white">WhatsApp</a>
                        </li>
                        <li class="flex items-center gap-2">
                        <x-heroicon-o-envelope class="w-4 h-4 text-gray-500 dark:text-slate-400" />
                            <a href="mailto:hello@micronet.mv" class="hover:text-white">hello@micronet.mv</a>
                        </li>
                        <li class="flex items-start gap-2">
                        <x-heroicon-o-map-pin class="w-4 h-4 text-gray-500 dark:text-slate-400 mt-0.5" />
                            <span>Greater Malé Area, Maldives</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="pt-8 mt-8 border-t border-gray-800 dark:border-slate-700 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-gray-500 dark:text-slate-400">
                <p>&copy; {{ date('Y') }} Easy Fix by Micronet. All rights reserved.</p>
                <p>Handyman Services in Malé, Maldives</p>
            </div>
        </div>
    </footer>

</body>
</html>
