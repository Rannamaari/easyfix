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
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-100 dark:bg-slate-950/95 dark:border-slate-800" aria-label="Main navigation">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2" aria-label="Easy Fix Home">
                    <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-wrench-screwdriver class="w-5 h-5 text-white" />
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">Easy Fix</span>
                </a>

                <div class="flex items-center gap-4">
                    <a href="tel:+9609996210" class="hidden sm:inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700">
                        <x-heroicon-o-phone class="w-4 h-4" />
                        +960 999 6210
                    </a>
                    <button type="button" data-theme-toggle class="p-2 text-gray-600 hover:text-gray-900 dark:text-slate-400 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-slate-800" aria-label="Toggle dark mode">
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

    <main>
        {{-- HERO SECTION --}}
        <section class="relative bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-950" aria-labelledby="hero-heading">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
                <div class="max-w-3xl">
                    {{-- Location Badge --}}
                    <div class="inline-flex items-center gap-2 bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 px-3 py-1.5 rounded-full text-sm font-medium mb-6">
                        <x-heroicon-s-map-pin class="w-4 h-4" />
                        <span>Plumber & Electrician in Malé City</span>
                    </div>

                    {{-- H1 - Primary Keyword --}}
                    <h1 id="hero-heading" class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
                        Handyman Services in Malé, Maldives
                    </h1>

                    {{-- Subheading with keywords --}}
                    <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-slate-300 max-w-xl">
                        <strong>Same-day repairs</strong> for your home and office. AC repair, plumbing, electrical work, door locks, cleaning & small moving in <strong>Malé City, Hulhumalé</strong> and <strong>Villingili</strong>.
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
                            Call: 999 6210
                        </a>
                        <a href="https://wa.me/9609996210?text=Hi,%20I%20need%20a%20repair%20service%20in%20Malé" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            WhatsApp
                        </a>
                    </div>

                    {{-- Trust Signals --}}
                    <p class="mt-6 text-sm text-gray-500 dark:text-slate-400">
                        ✓ Same-day service &nbsp; ✓ No hidden charges &nbsp; ✓ Trained team
                    </p>
                </div>
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
                            ['icon' => 'bolt', 'name' => 'Electrician', 'desc' => 'Switches, boards, wiring'],
                            ['icon' => 'wrench-screwdriver', 'name' => 'Plumber', 'desc' => 'Leaks, taps, blocked pipes'],
                            ['icon' => 'key', 'name' => 'Door & Locks', 'desc' => 'Handles, hinges, locks'],
                            ['icon' => 'cube-transparent', 'name' => 'Fridge Repair', 'desc' => 'Refrigerator not cooling?'],
                            ['icon' => 'arrow-path', 'name' => 'Washing Machine', 'desc' => 'Washer repairs & fixes'],
                            ['icon' => 'sparkles', 'name' => 'Cleaning', 'desc' => 'Deep clean, move-out'],
                            ['icon' => 'cube', 'name' => 'Small Moving', 'desc' => 'Furniture, appliances'],
                        ];
                    @endphp

                    @foreach($services as $service)
                        <article class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-5 text-center border border-gray-100 dark:border-slate-800 hover:border-blue-200 dark:hover:border-slate-700 transition-colors">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <x-dynamic-component :component="'heroicon-o-' . $service['icon']" class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                            </div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $service['name'] }}</h3>
                            <p class="text-xs text-gray-500 dark:text-slate-400 mt-1">{{ $service['desc'] }}</p>
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
                        Three simple steps. Most repairs done same day.
                    </p>
                </div>

                <div class="grid sm:grid-cols-3 gap-8 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-xl font-bold text-white">1</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Call or WhatsApp</h3>
                        <p class="text-gray-600 dark:text-slate-400 text-sm">
                            Tell us what needs fixing. Call <a href="tel:+9609996210" class="text-blue-600 hover:underline">999 6210</a> or <a href="https://wa.me/9609996210" class="text-green-600 hover:underline">WhatsApp us</a>.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-xl font-bold text-white">2</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">We Send Our Team</h3>
                        <p class="text-gray-600 dark:text-slate-400 text-sm">
                            A trained technician visits your location in Malé, Hulhumalé or Villingili.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-xl font-bold text-white">3</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Problem Fixed</h3>
                        <p class="text-gray-600 dark:text-slate-400 text-sm">
                            Job done. Pay only after you're satisfied with the work.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- WHY CHOOSE US --}}
        <section class="py-16 sm:py-20 bg-white dark:bg-slate-950" aria-labelledby="why-heading">
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
                        <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center gap-2 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-colors">
                            <x-heroicon-o-calendar-days class="w-5 h-5" />
                            Book Online
                        </a>
                    @else
                        <a href="{{ route('guest.create') }}" class="inline-flex items-center justify-center gap-2 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-colors">
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
    <footer class="bg-gray-900 dark:bg-slate-950 text-gray-400">
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
                    <p class="text-sm text-gray-500 mb-4">
                        Your trusted handyman, plumber and electrician in Malé City, Maldives. Same-day home repairs.
                    </p>
                    <p class="text-sm text-gray-500">
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
            <div class="pt-8 mt-8 border-t border-gray-800 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Easy Fix by Micronet. All rights reserved.</p>
                <p>Handyman Services in Malé, Maldives</p>
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
