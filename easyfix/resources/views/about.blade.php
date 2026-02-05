<!DOCTYPE html>
<html lang="en-MV">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>About Us | Easy Fix - Trusted Handyman Services in Malé, Maldives</title>

    <meta name="description" content="Learn about Easy Fix - Malé's trusted handyman service. Fast response, transparent pricing, and a vetted team for plumbing, electrical, AC repair, and more in Malé City and Hulhumalé.">

    <meta name="keywords" content="about Easy Fix, handyman Malé, home repair Maldives, Micro Cool AC, Micronet services">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://easyfix.mv/about">
    <meta property="og:title" content="About Easy Fix | Handyman Services in Malé">
    <meta property="og:description" content="Malé's trusted handyman service. Fast response, transparent pricing, vetted team.">

    <link rel="canonical" href="https://easyfix.mv/about">
    <link rel="icon" type="image/png" href="/favicon.ico">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

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
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
    </style>
</head>
<body class="antialiased bg-white text-gray-900 dark:bg-slate-950 dark:text-slate-100">

    {{-- Navigation --}}
    <x-navbar />



    <main>
        {{-- HERO SECTION --}}
        <section class="relative bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-950">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 px-3 py-1.5 rounded-full text-sm font-medium mb-6">
                        <x-heroicon-s-building-office-2 class="w-4 h-4" />
                        About Easy Fix
                    </div>

                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white leading-tight">
                        Malé's Trusted Handyman Service
                    </h1>

                    <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-slate-300 max-w-xl">
                        We started Easy Fix because finding reliable help for small repairs in Malé shouldn't be a headache. Whether it's a leaky tap at 8 PM or an AC that won't cool before guests arrive, we've got you covered.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="https://wa.me/9609996210?text=Hi,%20I%20need%20help%20with%20a%20repair" target="_blank" class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            WhatsApp Us
                        </a>
                        @auth
                            <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                <x-heroicon-o-calendar-days class="w-5 h-5" />
                                Book a Job
                            </a>
                        @else
                            <a href="{{ route('guest.create') }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                <x-heroicon-o-calendar-days class="w-5 h-5" />
                                Book a Job
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        {{-- TRUST SECTION --}}
        <section class="py-16 sm:py-20 bg-white dark:bg-slate-950">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                        Why People Trust Us
                    </h2>
                    <p class="mt-3 text-gray-600 dark:text-slate-400 max-w-xl mx-auto">
                        We built Easy Fix on simple principles that matter to every homeowner in Malé.
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Fast Response --}}
                    <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center mb-4">
                            <x-heroicon-o-bolt class="w-6 h-6 text-green-600 dark:text-green-400" />
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Fast Response</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-400">
                            Same-day service for most requests. We know a broken AC in Malé's heat can't wait until tomorrow.
                        </p>
                    </div>

                    {{-- Transparent Pricing --}}
                    <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-4">
                            <x-heroicon-o-banknotes class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Transparent Pricing</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-400">
                            You'll know the cost before we start. No hidden fees, no surprises when the job is done.
                        </p>
                    </div>

                    {{-- Vetted Team --}}
                    <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-4">
                            <x-heroicon-o-shield-check class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Vetted Team</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-400">
                            Our technicians are trained, background-checked, and equipped with the right tools for the job.
                        </p>
                    </div>

                    {{-- Local Expertise --}}
                    <div class="bg-gray-50 dark:bg-slate-900 rounded-2xl p-6 border border-gray-100 dark:border-slate-800">
                        <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mb-4">
                            <x-heroicon-o-map-pin class="w-6 h-6 text-amber-600 dark:text-amber-400" />
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Malé Expertise</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-400">
                            We know Malé's buildings, common issues, and can navigate the city quickly to reach you.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- SERVICES SNAPSHOT --}}
        <section class="py-16 sm:py-20 bg-gray-50 dark:bg-slate-900">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                        What We Fix
                    </h2>
                    <p class="mt-3 text-gray-600 dark:text-slate-400 max-w-xl mx-auto">
                        From quick repairs to appliance troubleshooting, we handle the everyday fixes that keep your home running.
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                    @php
                        $services = [
                            ['icon' => 'wrench-screwdriver', 'name' => 'Plumbing', 'desc' => 'Leaks, taps, pipes'],
                            ['icon' => 'bolt', 'name' => 'Electrical', 'desc' => 'Switches, outlets, lights'],
                            ['icon' => 'key', 'name' => 'Door & Locks', 'desc' => 'Hinges, handles, locks'],
                            ['icon' => 'sun', 'name' => 'AC Repair', 'desc' => 'Quick troubleshooting'],
                            ['icon' => 'cube-transparent', 'name' => 'Fridge Repair', 'desc' => 'Cooling issues'],
                            ['icon' => 'sparkles', 'name' => 'Cleaning', 'desc' => 'Deep clean, move-out'],
                        ];
                    @endphp

                    @foreach($services as $service)
                        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 text-center border border-gray-100 dark:border-slate-700">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <x-dynamic-component :component="'heroicon-o-' . $service['icon']" class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                            </div>
                            <h3 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $service['name'] }}</h3>
                            <p class="text-xs text-gray-500 dark:text-slate-400 mt-1">{{ $service['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- WHY EASY FIX - STORY --}}
        <section class="py-16 sm:py-20 bg-white dark:bg-slate-950">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                            Why We Started Easy Fix
                        </h2>
                        <div class="space-y-4 text-gray-600 dark:text-slate-300">
                            <p>
                                Living in Malé, we've all been there. The kitchen tap starts dripping at 9 PM. The door handle breaks when you have guests coming. The AC stops cooling in the middle of a hot afternoon.
                            </p>
                            <p>
                                Finding someone reliable to fix these small problems used to mean calling five different people, negotiating prices, and hoping they actually show up. We wanted to change that.
                            </p>
                            <p>
                                Easy Fix brings together skilled technicians under one service. One call, one team, one fair price. Whether it's a 15-minute fix or a half-day job, we treat your home with respect and get it done right.
                            </p>
                        </div>

                        <div class="mt-8 grid grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">500+</div>
                                <div class="text-sm text-gray-500 dark:text-slate-400">Jobs Done</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">Same Day</div>
                                <div class="text-sm text-gray-500 dark:text-slate-400">Response</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">4.8/5</div>
                                <div class="text-sm text-gray-500 dark:text-slate-400">Rating</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-slate-800 dark:to-slate-900 rounded-3xl p-8 lg:p-12">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Our Values</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <x-heroicon-s-check-circle class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" />
                                <div>
                                    <span class="font-medium text-gray-900 dark:text-white">Show Up On Time</span>
                                    <p class="text-sm text-gray-600 dark:text-slate-400">We respect your schedule. When we say 2 PM, we mean it.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-s-check-circle class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" />
                                <div>
                                    <span class="font-medium text-gray-900 dark:text-white">Be Honest About Costs</span>
                                    <p class="text-sm text-gray-600 dark:text-slate-400">No hidden charges. The quote is the price.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-s-check-circle class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" />
                                <div>
                                    <span class="font-medium text-gray-900 dark:text-white">Clean Up After</span>
                                    <p class="text-sm text-gray-600 dark:text-slate-400">We leave your space as clean as we found it.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-s-check-circle class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" />
                                <div>
                                    <span class="font-medium text-gray-900 dark:text-white">Stand Behind Our Work</span>
                                    <p class="text-sm text-gray-600 dark:text-slate-400">If something's not right, we'll come back and fix it.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- MICRO COOL SECTION --}}
        <section class="py-16 sm:py-20 bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-slate-900 dark:to-slate-800">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="order-2 lg:order-1">
                        <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-lg border border-cyan-100 dark:border-slate-700">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 bg-cyan-500 rounded-xl flex items-center justify-center">
                                    <x-heroicon-o-sun class="w-6 h-6 text-white" />
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Micro Cool</h3>
                                    <p class="text-sm text-cyan-600 dark:text-cyan-400">AC Installation & Service</p>
                                </div>
                            </div>

                            <ul class="space-y-3 mb-6">
                                <li class="flex items-center gap-2 text-gray-600 dark:text-slate-300">
                                    <x-heroicon-s-check class="w-5 h-5 text-cyan-500" />
                                    New AC installation (split & cassette)
                                </li>
                                <li class="flex items-center gap-2 text-gray-600 dark:text-slate-300">
                                    <x-heroicon-s-check class="w-5 h-5 text-cyan-500" />
                                    AC gas refill & servicing
                                </li>
                                <li class="flex items-center gap-2 text-gray-600 dark:text-slate-300">
                                    <x-heroicon-s-check class="w-5 h-5 text-cyan-500" />
                                    Compressor & PCB repairs
                                </li>
                                <li class="flex items-center gap-2 text-gray-600 dark:text-slate-300">
                                    <x-heroicon-s-check class="w-5 h-5 text-cyan-500" />
                                    Annual maintenance contracts
                                </li>
                            </ul>

                            <a href="https://cool.micronet.mv" target="_blank" class="inline-flex items-center gap-2 text-cyan-600 dark:text-cyan-400 font-medium hover:underline">
                                Visit cool.micronet.mv
                                <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4" />
                            </a>
                        </div>
                    </div>

                    <div class="order-1 lg:order-2">
                        <div class="inline-flex items-center gap-2 bg-cyan-100 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-300 px-3 py-1.5 rounded-full text-sm font-medium mb-4">
                            <x-heroicon-s-sparkles class="w-4 h-4" />
                            Sister Brand
                        </div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                            Need AC Installation or Major Service?
                        </h2>
                        <p class="text-gray-600 dark:text-slate-300 mb-4">
                            For quick AC troubleshooting, Easy Fix has you covered. But for full installations, major repairs, or maintenance contracts, our sister brand <strong>Micro Cool</strong> specializes in exactly that.
                        </p>
                        <p class="text-gray-600 dark:text-slate-300">
                            Micro Cool handles everything from installing new split ACs in apartments to servicing commercial cassette units in offices across Malé. Same trusted service, specialized for air conditioning.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- PART OF MICRONET --}}
        <section class="py-8 bg-gray-100 dark:bg-slate-800/50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-900 dark:bg-white rounded-lg flex items-center justify-center">
                            <span class="text-white dark:text-gray-900 font-bold text-sm">M</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Part of the Micronet Family</p>
                            <p class="text-xs text-gray-500 dark:text-slate-400">IT & Services company based in Malé</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6 text-sm text-gray-500 dark:text-slate-400">
                        <span>Easy Fix</span>
                        <span class="text-gray-300 dark:text-slate-600">|</span>
                        <a href="https://cool.micronet.mv" target="_blank" class="hover:text-gray-700 dark:hover:text-slate-300">Micro Cool</a>
                        <span class="text-gray-300 dark:text-slate-600">|</span>
                        <a href="https://garage.micronet.mv" target="_blank" class="hover:text-gray-700 dark:hover:text-slate-300">Micro Moto Garage</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ SECTION --}}
        <section class="py-16 sm:py-20 bg-white dark:bg-slate-950">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                        Common Questions
                    </h2>
                    <p class="mt-3 text-gray-600 dark:text-slate-400">
                        Things people often ask us before booking.
                    </p>
                </div>

                <div class="space-y-4">
                    <details class="bg-gray-50 dark:bg-slate-900 rounded-xl border border-gray-200 dark:border-slate-700 p-4" open>
                        <summary class="font-semibold text-gray-900 dark:text-white cursor-pointer">
                            How do you determine pricing?
                        </summary>
                        <p class="mt-3 text-gray-600 dark:text-slate-400 text-sm">
                            We provide a clear quote before starting any work. For standard jobs like fixing a leaky tap or replacing a door handle, we have fixed rates. For more complex issues, our technician will assess the problem and give you an upfront price. You only pay after you approve the quote - no surprises.
                        </p>
                    </details>

                    <details class="bg-gray-50 dark:bg-slate-900 rounded-xl border border-gray-200 dark:border-slate-700 p-4">
                        <summary class="font-semibold text-gray-900 dark:text-white cursor-pointer">
                            How fast can you come? Do you work on Fridays?
                        </summary>
                        <p class="mt-3 text-gray-600 dark:text-slate-400 text-sm">
                            For most requests in Malé City, we can send someone the same day - often within a few hours. We work 7 days a week, including Fridays (from 2 PM onwards) and Saturdays. For urgent issues like water leaks, we prioritize getting to you fast. Hulhumalé requests may take slightly longer depending on our schedule.
                        </p>
                    </details>

                    <details class="bg-gray-50 dark:bg-slate-900 rounded-xl border border-gray-200 dark:border-slate-700 p-4">
                        <summary class="font-semibold text-gray-900 dark:text-white cursor-pointer">
                            Do you cover Hulhumalé and Villingili?
                        </summary>
                        <p class="mt-3 text-gray-600 dark:text-slate-400 text-sm">
                            Yes! We serve all of Greater Malé Area including Malé City, Hulhumalé Phase 1 & 2, and Villingili. Response times may vary slightly for Hulhumalé depending on ferry schedules, but we're committed to same-day service whenever possible.
                        </p>
                    </details>
                </div>
            </div>
        </section>

        {{-- CONTACT PANEL --}}
        <section class="py-16 sm:py-20 bg-blue-600 dark:bg-blue-700">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    Ready to Get Something Fixed?
                </h2>
                <p class="text-blue-100 text-lg mb-8 max-w-xl mx-auto">
                    Call us, WhatsApp us, or book online. We'll take care of the rest.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                    <a href="tel:+9609996210" class="inline-flex items-center justify-center gap-2 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-colors">
                        <x-heroicon-o-phone class="w-5 h-5" />
                        Call 999 6210
                    </a>
                    <a href="https://wa.me/9609996210" target="_blank" class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-green-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp
                    </a>
                    @auth
                        <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center gap-2 bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-800 transition-colors border border-blue-500">
                            <x-heroicon-o-calendar-days class="w-5 h-5" />
                            Book Online
                        </a>
                    @else
                        <a href="{{ route('guest.create') }}" class="inline-flex items-center justify-center gap-2 bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-800 transition-colors border border-blue-500">
                            <x-heroicon-o-calendar-days class="w-5 h-5" />
                            Book Online
                        </a>
                    @endauth
                </div>

                {{-- Contact Details --}}
                <div class="grid sm:grid-cols-3 gap-6 text-left bg-blue-700/50 rounded-2xl p-6">
                    <div class="flex items-start gap-3">
                        <x-heroicon-o-phone class="w-5 h-5 text-blue-200 mt-0.5" />
                        <div>
                            <p class="text-sm text-blue-200">Phone</p>
                            <a href="tel:+9609996210" class="text-white font-medium hover:underline">+960 999 6210</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <x-heroicon-o-map-pin class="w-5 h-5 text-blue-200 mt-0.5" />
                        <div>
                            <p class="text-sm text-blue-200">Address</p>
                            <p class="text-white font-medium">Janavaree Hingun, near Dharubaarige, Malé</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <x-heroicon-o-globe-alt class="w-5 h-5 text-blue-200 mt-0.5" />
                        <div>
                            <p class="text-sm text-blue-200">Related Sites</p>
                            <div class="flex flex-col">
                                <a href="https://cool.micronet.mv" target="_blank" class="text-white font-medium hover:underline">cool.micronet.mv</a>
                                <a href="https://garage.micronet.mv" target="_blank" class="text-white/80 text-sm hover:underline">garage.micronet.mv</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 dark:bg-slate-950 text-gray-400 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-blue-600 rounded flex items-center justify-center">
                        <x-heroicon-o-wrench-screwdriver class="w-3 h-3 text-white" />
                    </div>
                    <span>&copy; {{ date('Y') }} Easy Fix by Micronet</span>
                </div>
                <div class="flex items-center gap-6">
                    <a href="/" class="hover:text-white">Home</a>
                    <a href="{{ route('about') }}" class="hover:text-white">About</a>
                    <a href="{{ route('terms') }}" class="hover:text-white">Terms</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
