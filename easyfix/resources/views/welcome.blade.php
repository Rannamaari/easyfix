<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EasyFix') }} - Quality Home Services, On Demand</title>
    <meta name="description" content="Get trusted professionals for plumbing, electrical, AC repair, cleaning and more. Transparent pricing, verified experts, quality assured.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
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
        .service-card { transition: all 0.2s ease; }
        .service-card:hover { transform: translateY(-4px); }
    </style>
</head>
<body class="antialiased bg-white text-gray-900 dark:bg-slate-950 dark:text-slate-100">

    {{-- Navigation Bar --}}
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-200 dark:bg-gray-950 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="/" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-cog-6-tooth class="w-5 h-5 text-white" />
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">EasyFix</span>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('professionals.create') }}" class="text-sm text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors">
                        Register as a Professional
                    </a>
                    <a href="#how-it-works" class="text-sm text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors">
                        Help
                    </a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors">
                                Log Out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="text-sm bg-gray-900 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-800 transition-colors dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100">
                            Sign Up
                        </a>
                    @endauth
                    <button type="button" data-theme-toggle class="p-2 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <x-heroicon-s-sun class="w-5 h-5 hidden dark:block" />
                        <x-heroicon-s-moon class="w-5 h-5 block dark:hidden" />
                    </button>
                </div>

                {{-- Mobile Menu Button --}}
                <div class="md:hidden flex items-center gap-2">
                    <button type="button" data-theme-toggle class="p-2 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <x-heroicon-s-sun class="w-5 h-5 hidden dark:block" />
                        <x-heroicon-s-moon class="w-5 h-5 block dark:hidden" />
                    </button>
                    <details class="relative">
                        <summary class="list-none p-2 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white cursor-pointer rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                            <x-heroicon-o-bars-3 class="w-6 h-6" />
                        </summary>
                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 py-2 dark:bg-gray-900 dark:border-gray-800">
                            <a href="{{ route('professionals.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Register as Professional</a>
                            <a href="#how-it-works" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Help</a>
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Log Out</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Login</a>
                                <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Sign Up</a>
                            @endauth
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </nav>

    {{-- Beta Banner --}}
    <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white py-2 text-center text-sm font-medium">
        <span class="inline-flex items-center gap-2">
            <x-heroicon-s-exclamation-triangle class="w-4 h-4" />
            Beta Version - We're still building! Thank you for your patience.
        </span>
    </div>

    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-white dark:bg-gradient-to-br dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                {{-- Left Side - Service Cards --}}
                <div class="relative order-2 lg:order-1">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-indigo-500/10 dark:from-blue-500/20 dark:to-indigo-500/20 rounded-3xl transform rotate-3"></div>
                        <div class="relative bg-gradient-to-br from-gray-100 to-gray-200 dark:from-slate-800 dark:to-slate-900 rounded-3xl p-8 border border-gray-200 dark:border-slate-700/50">
                            <div class="grid grid-cols-2 gap-4">
                                {{-- Plumbing --}}
                                <div class="bg-white dark:bg-slate-800/50 rounded-2xl p-6 text-center border border-gray-200 dark:border-slate-700/50 hover:border-blue-300 dark:hover:border-slate-600 transition-colors shadow-sm">
                                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                        <x-heroicon-o-wrench-screwdriver class="w-7 h-7 text-blue-600 dark:text-blue-500" />
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Plumbing</p>
                                </div>
                                {{-- Electrical --}}
                                <div class="bg-white dark:bg-slate-800/50 rounded-2xl p-6 text-center border border-gray-200 dark:border-slate-700/50 hover:border-blue-300 dark:hover:border-slate-600 transition-colors shadow-sm">
                                    <div class="w-14 h-14 bg-yellow-100 dark:bg-yellow-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                        <x-heroicon-o-bolt class="w-7 h-7 text-yellow-600 dark:text-yellow-500" />
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Electrical</p>
                                </div>
                                {{-- AC Repair --}}
                                <div class="bg-white dark:bg-slate-800/50 rounded-2xl p-6 text-center border border-gray-200 dark:border-slate-700/50 hover:border-blue-300 dark:hover:border-slate-600 transition-colors shadow-sm">
                                    <div class="w-14 h-14 bg-cyan-100 dark:bg-cyan-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                        <x-heroicon-o-sun class="w-7 h-7 text-cyan-600 dark:text-cyan-500" />
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">AC Repair</p>
                                </div>
                                {{-- Cleaning --}}
                                <div class="bg-white dark:bg-slate-800/50 rounded-2xl p-6 text-center border border-gray-200 dark:border-slate-700/50 hover:border-blue-300 dark:hover:border-slate-600 transition-colors shadow-sm">
                                    <div class="w-14 h-14 bg-green-100 dark:bg-green-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                        <x-heroicon-o-sparkles class="w-7 h-7 text-green-600 dark:text-green-500" />
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Cleaning</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side - Content + Service Selector --}}
                <div class="order-1 lg:order-2">
                    <p class="text-sm font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-4">EASYFIX</p>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white leading-tight mb-6">
                        Quality home services, on demand
                    </h1>
                    <p class="text-lg text-gray-700 dark:text-slate-300 mb-8 max-w-lg">
                        Experienced, verified professionals at your doorstep. From repairs to maintenance, we've got you covered.
                    </p>

                    {{-- Service Selector Card --}}
                    <div class="bg-gray-50 dark:bg-slate-800 rounded-2xl p-6 shadow-xl border border-gray-200 dark:border-slate-700 max-w-md">
                        <p class="text-gray-900 dark:text-white font-semibold mb-4">What service do you need?</p>
                        <div class="space-y-3">
                            <select class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl text-gray-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Select a service category</option>
                                <option value="plumbing">Plumbing</option>
                                <option value="electrical">Electrical</option>
                                <option value="ac">AC & Cooling</option>
                                <option value="cleaning">Cleaning</option>
                                <option value="handyman">Handyman</option>
                                <option value="mechanic">Moto Mechanic</option>
                            </select>
                            @auth
                                <a href="{{ route('jobs.create') }}" class="block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                    Book Now
                                </a>
                            @else
                                <a href="{{ route('guest.create') }}" class="block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                    Book Now
                                </a>
                            @endauth
                        </div>
                        <p class="text-xs text-gray-600 dark:text-slate-400 mt-3 text-center">No account needed. Book in under 2 minutes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Grid Section --}}
    <section id="services" class="py-20 bg-gray-50 dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-sm font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-2">Our Services</p>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">Home services at your fingertips</h2>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 lg:gap-6">
                @php
                    $services = [
                        ['icon' => 'wrench-screwdriver', 'name' => 'Plumbing', 'desc' => 'Leaks, pipes & more'],
                        ['icon' => 'bolt', 'name' => 'Electrical', 'desc' => 'Wiring & repairs'],
                        ['icon' => 'sun', 'name' => 'AC & Cooling', 'desc' => 'Service & install'],
                        ['icon' => 'sparkles', 'name' => 'Cleaning', 'desc' => 'Deep & regular'],
                        ['icon' => 'cog-6-tooth', 'name' => 'Handyman', 'desc' => 'Odd jobs & fixes'],
                        ['icon' => 'wrench', 'name' => 'Moto Mechanic', 'desc' => 'Bike repairs'],
                    ];
                @endphp
                @foreach($services as $service)
                    <a href="{{ auth()->check() ? route('jobs.create') : route('guest.create') }}" class="service-card group">
                        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 text-center shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-lg hover:border-blue-200 dark:hover:border-blue-800 transition-all">
                            <div class="w-14 h-14 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/50 transition-colors">
                                <x-dynamic-component :component="'heroicon-o-' . $service['icon']" class="w-7 h-7 text-blue-600 dark:text-blue-400" />
                            </div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-1">{{ $service['name'] }}</h3>
                            <p class="text-xs text-gray-600 dark:text-slate-400">{{ $service['desc'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Choose EasyFix Section --}}
    <section class="py-20 bg-white dark:bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                {{-- Left Side - Features --}}
                <div>
                    <p class="text-sm font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-2">Why EasyFix?</p>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-10">Why Choose EasyFix?</h2>

                    <div class="space-y-8">
                        {{-- Feature 1 --}}
                        <div class="flex gap-5">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-2xl flex items-center justify-center">
                                <x-heroicon-o-check-circle class="w-6 h-6 text-green-600 dark:text-green-400" />
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Transparent Pricing</h3>
                                <p class="text-gray-700 dark:text-slate-400">See prices before you book. No hidden charges, no surprises. What you see is what you pay.</p>
                            </div>
                        </div>

                        {{-- Feature 2 --}}
                        <div class="flex gap-5">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center">
                                <x-heroicon-o-shield-check class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Verified Professionals</h3>
                                <p class="text-gray-700 dark:text-slate-400">Trained, background-checked experts you can trust. Every professional is vetted for quality.</p>
                            </div>
                        </div>

                        {{-- Feature 3 --}}
                        <div class="flex gap-5">
                            <div class="flex-shrink-0 w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center">
                                <x-heroicon-o-cube class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Fully Equipped</h3>
                                <p class="text-gray-700 dark:text-slate-400">Our professionals bring everything needed. Tools, parts, and expertise - all in one visit.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side - Quality Assured Card --}}
                <div class="lg:mt-16">
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl p-8 lg:p-10 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                        <div class="relative">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                                <x-heroicon-o-shield-check class="w-8 h-8 text-white" />
                            </div>
                            <h3 class="text-2xl lg:text-3xl font-bold mb-3">100% Quality Assured</h3>
                            <p class="text-blue-100 text-lg">If you don't love our service, we'll make it right. Your satisfaction is our top priority.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section id="how-it-works" class="py-20 bg-gray-50 dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-sm font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-2">How It Works</p>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">Book a service in 4 easy steps</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                @php
                    $steps = [
                        ['step' => '01', 'title' => 'Choose Service', 'desc' => 'Select the service you need from our categories', 'icon' => 'queue-list'],
                        ['step' => '02', 'title' => 'Get Quote', 'desc' => 'Receive a transparent price estimate upfront', 'icon' => 'calculator'],
                        ['step' => '03', 'title' => 'Confirm Booking', 'desc' => 'Pick a convenient time and confirm your booking', 'icon' => 'calendar-days'],
                        ['step' => '04', 'title' => 'Service Done', 'desc' => 'Our verified professional arrives and gets it done', 'icon' => 'check-circle'],
                    ];
                @endphp
                @foreach($steps as $index => $step)
                    <div class="relative">
                        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-700 h-full">
                            <div class="text-4xl font-bold text-blue-100 dark:text-slate-700 mb-4">{{ $step['step'] }}</div>
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-4">
                                <x-dynamic-component :component="'heroicon-o-' . $step['icon']" class="w-6 h-6 text-white" />
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $step['title'] }}</h3>
                            <p class="text-gray-700 dark:text-slate-400 text-sm">{{ $step['desc'] }}</p>
                        </div>
                        @if($index < 3)
                            <div class="hidden lg:block absolute top-1/2 -right-4 transform -translate-y-1/2 text-gray-300 dark:text-slate-600">
                                <x-heroicon-o-chevron-right class="w-8 h-8" />
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                @auth
                    <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/25">
                        Request a Service
                        <x-heroicon-o-arrow-right class="w-5 h-5" />
                    </a>
                @else
                    <a href="{{ route('guest.create') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/25">
                        Request a Service
                        <x-heroicon-o-arrow-right class="w-5 h-5" />
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- Join Us Section --}}
    <section class="py-20 bg-white dark:bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 dark:from-slate-800 dark:to-slate-900 rounded-3xl p-8 lg:p-12">
                <div class="grid lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <p class="text-sm font-semibold text-blue-400 uppercase tracking-wider mb-2">We're Just Getting Started</p>
                        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Join Our Growing Team of Professionals</h2>
                        <p class="text-slate-300 mb-6">We're a new startup on a mission to make home services better for everyone. We're looking for skilled professionals to join us and help serve our community.</p>
                        <p class="text-slate-300 mb-8">Whether you're a plumber, electrician, AC technician, or handyman — if you take pride in your work, we want you on our team.</p>
                        <a href="{{ route('professionals.create') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                            Register as a Professional
                            <x-heroicon-o-arrow-right class="w-5 h-5" />
                        </a>
                    </div>
                    <div class="space-y-4">
                        {{-- Benefits cards --}}
                        <div class="bg-white/10 backdrop-blur rounded-2xl p-5">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                                    <x-heroicon-o-currency-dollar class="w-5 h-5 text-green-400" />
                                </div>
                                <h3 class="text-white font-semibold">Earn More</h3>
                            </div>
                            <p class="text-slate-300 text-sm">Get connected with customers in your area and grow your income.</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur rounded-2xl p-5">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                                    <x-heroicon-o-clock class="w-5 h-5 text-blue-400" />
                                </div>
                                <h3 class="text-white font-semibold">Flexible Schedule</h3>
                            </div>
                            <p class="text-slate-300 text-sm">Work on your own terms. Accept jobs that fit your schedule.</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur rounded-2xl p-5">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center">
                                    <x-heroicon-o-bolt class="w-5 h-5 text-purple-400" />
                                </div>
                                <h3 class="text-white font-semibold">Grow With Us</h3>
                            </div>
                            <p class="text-slate-300 text-sm">Be part of something new. Help us build the future of home services.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @guest
        {{-- CTA Section --}}
        <section class="py-16 bg-blue-600">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to Get Started?</h2>
                <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">No account needed. Request a service in under 2 minutes and get connected with verified professionals.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('guest.create') }}" class="inline-flex items-center justify-center gap-2 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-colors">
                        Request a Service Now
                        <x-heroicon-o-arrow-right class="w-5 h-5" />
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-800 transition-colors border border-blue-500">
                        Create Free Account
                    </a>
                </div>
            </div>
        </section>
    @endguest

    {{-- Footer --}}
    <footer class="bg-gray-950 text-gray-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-8">
                {{-- Company Info --}}
                <div class="col-span-2 md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-cog-6-tooth class="w-5 h-5 text-white" />
                        </div>
                        <span class="text-xl font-bold text-white">EasyFix</span>
                    </div>
                    <p class="text-sm text-gray-500 mb-4">Quality home services, on demand. Trusted professionals at your doorstep.</p>
                    <p class="text-sm text-gray-500">By Micronet</p>
                </div>

                {{-- Services --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Services</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('guest.create') }}" class="hover:text-white transition-colors">Plumbing</a></li>
                        <li><a href="{{ route('guest.create') }}" class="hover:text-white transition-colors">Electrical</a></li>
                        <li><a href="{{ route('guest.create') }}" class="hover:text-white transition-colors">AC & Cooling</a></li>
                        <li><a href="{{ route('guest.create') }}" class="hover:text-white transition-colors">Cleaning</a></li>
                        <li><a href="{{ route('guest.create') }}" class="hover:text-white transition-colors">Handyman</a></li>
                    </ul>
                </div>

                {{-- Company --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#how-it-works" class="hover:text-white transition-colors">How It Works</a></li>
                        <li><a href="{{ route('professionals.create') }}" class="hover:text-white transition-colors">Become a Pro</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">
                            <x-heroicon-o-phone class="w-4 h-4" />
                            9996210
                        </li>
                        <li class="flex items-center gap-2">
                            <x-heroicon-o-envelope class="w-4 h-4" />
                            hello@micronet.mv
                        </li>
                        <li class="flex items-start gap-2">
                            <x-heroicon-o-map-pin class="w-4 h-4 mt-0.5" />
                            <span>Janavaree Hingun,<br>near Dharubaarige, Malé</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="pt-8 border-t border-gray-800 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} Micronet. All rights reserved.
                    <span class="text-amber-500 font-medium">Beta v1.0</span>
                </p>
                <div class="flex items-center gap-4 text-sm">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

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
