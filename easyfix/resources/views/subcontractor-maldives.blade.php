<!DOCTYPE html>
<html lang="en-MV" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Subcontractor in Maldives | Project & Maintenance Support | EasyFix.mv</title>
    <meta name="description" content="Need a subcontractor in Maldives? EasyFix provides trusted technicians for AC, electrical, plumbing, maintenance, repairs, appliance installation, IT/networking, and small project works in Malé, Hulhumalé, and across Maldives.">
    <meta name="keywords" content="subcontractor in Maldives, project support Maldives, maintenance contractor Maldives, AC contractor Maldives, electrical and plumbing works Maldives, hotel maintenance Maldives, handyman services Maldives">

    <x-seo-meta
        title="Subcontractor in Maldives | Project & Maintenance Support | EasyFix.mv"
        description="Need a subcontractor in Maldives? EasyFix provides trusted technicians for AC, electrical, plumbing, maintenance, repairs, appliance installation, IT/networking, and small project works in Malé, Hulhumalé, and across Maldives."
        :image="url('/og-image.png')"
        :url="route('subcontractor')"
        type="website"
    />
    <meta property="og:locale" content="en_MV">

    <link rel="canonical" href="{{ route('subcontractor') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="shortcut icon" href="/favicon-32x32.png" type="image/png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (function () {
            const saved = localStorage.getItem('theme');
            if (saved === 'dark' || (! saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
    </style>
</head>
@php
    $projectEmail = 'munaad@micronet.mv';
    $emailSubject = rawurlencode('Project Support Inquiry - EasyFix');
    $emailBody = rawurlencode("Hello EasyFix,\r\n\r\nI would like to request project/subcontracting support.\r\n\r\nProject Location:\r\nType of Work:\r\nExpected Start Date:\r\nProject Details:\r\n\r\nThank you.");
    $emailLink = "mailto:{$projectEmail}?subject={$emailSubject}";
    $emailLinkWithBody = "mailto:{$projectEmail}?subject={$emailSubject}&body={$emailBody}";
@endphp
<body class="antialiased bg-white text-gray-900 dark:bg-slate-950 dark:text-slate-100">
    <x-navbar />

    <main>
        <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(59,130,246,0.18),transparent_36%),radial-gradient(circle_at_bottom_right,rgba(16,185,129,0.12),transparent_32%)]"></div>
            <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">
                <div class="grid gap-10 lg:grid-cols-[minmax(0,1.15fr)_24rem] lg:items-center">
                    <div class="max-w-3xl">
                        <div class="inline-flex items-center gap-2 rounded-full border border-blue-300/20 bg-blue-500/10 px-3 py-1.5 text-sm font-medium text-blue-100">
                            <x-heroicon-s-building-office-2 class="w-4 h-4" />
                            Project support Maldives
                        </div>

                        <h1 class="mt-6 text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl">
                            Have a project in Maldives? Hire EasyFix as your local subcontractor.
                        </h1>

                        <p class="mt-6 max-w-2xl text-lg text-slate-200 sm:text-xl">
                            EasyFix supports contractors, hotels, offices, property owners, and businesses with trusted local technicians across Maldives.
                        </p>

                        <div class="mt-6 flex flex-wrap gap-2 text-sm font-medium text-slate-100">
                            <span class="rounded-full border border-white/15 bg-white/5 px-3 py-1.5">AC</span>
                            <span class="rounded-full border border-white/15 bg-white/5 px-3 py-1.5">Electrical</span>
                            <span class="rounded-full border border-white/15 bg-white/5 px-3 py-1.5">Plumbing</span>
                            <span class="rounded-full border border-white/15 bg-white/5 px-3 py-1.5">Maintenance</span>
                            <span class="rounded-full border border-white/15 bg-white/5 px-3 py-1.5">IT & Networking</span>
                            <span class="rounded-full border border-white/15 bg-white/5 px-3 py-1.5">Handyman Works</span>
                        </div>

                        <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                            <a href="{{ $emailLink }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-blue-400/70 bg-blue-600 px-6 py-3.5 font-semibold text-white shadow-lg shadow-blue-950/30 transition hover:bg-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-950">
                                <x-heroicon-o-envelope class="w-5 h-5" />
                                Email
                            </a>
                            <a href="https://wa.me/9609996210" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-300/70 bg-emerald-50 px-6 py-3.5 font-semibold text-emerald-950 shadow-lg shadow-emerald-950/10 transition hover:bg-emerald-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-200 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-950">
                                <x-heroicon-o-phone class="w-5 h-5" />
                                Call Us
                            </a>
                        </div>
                    </div>

                    <aside class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/30 backdrop-blur-md">
                        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-blue-200">Why teams choose EasyFix</p>
                        <ul class="mt-5 space-y-4 text-sm text-slate-200">
                            <li class="flex items-start gap-3">
                                <x-heroicon-s-check-circle class="mt-0.5 h-5 w-5 flex-shrink-0 text-emerald-300" />
                                <span>Reliable local support for urgent and planned work.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-s-check-circle class="mt-0.5 h-5 w-5 flex-shrink-0 text-emerald-300" />
                                <span>Flexible support for hotels, offices, shops, and project sites.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <x-heroicon-s-check-circle class="mt-0.5 h-5 w-5 flex-shrink-0 text-emerald-300" />
                                <span>Simple local coordination with clear updates.</span>
                            </li>
                        </ul>
                    </aside>
                </div>
            </div>
        </section>

        <section class="bg-white py-16 dark:bg-slate-950">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                        Project &amp; Subcontracting Services We Support
                    </h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-slate-400">
                        We support both small jobs and larger project work across Maldives.
                    </p>
                </div>

                <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ([
                        'AC installation and servicing',
                        'Electrical works',
                        'Plumbing works',
                        'Appliance installation',
                        'CCTV, IT and networking',
                        'General handyman works',
                        'Small renovation support',
                        'Hotel, guest house and office maintenance',
                        'Emergency repair and maintenance jobs',
                    ] as $service)
                        <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 dark:border-slate-800 dark:bg-slate-900">
                            <div class="flex items-start gap-3">
                                <div class="mt-1 rounded-xl bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/30 dark:text-blue-300">
                                    <x-heroicon-o-wrench-screwdriver class="h-5 w-5" />
                                </div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $service }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-gray-50 py-16 dark:bg-slate-900">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                            Need Technicians in Maldives?
                        </h2>
                        <p class="mt-4 text-lg text-gray-600 dark:text-slate-400">
                            We provide trusted local manpower and technical support for projects, maintenance, and installations across Maldives.
                        </p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 lg:self-center">
                        @foreach ([
                            ['label' => 'Hotels & Resorts', 'icon' => 'building-office-2'],
                            ['label' => 'Construction Teams', 'icon' => 'wrench-screwdriver'],
                            ['label' => 'HVAC & Maintenance', 'icon' => 'sun'],
                            ['label' => 'Foreign Contractors', 'icon' => 'globe-alt'],
                            ['label' => 'Offices & Retail', 'icon' => 'building-storefront'],
                            ['label' => 'Property Managers', 'icon' => 'home-modern'],
                        ] as $group)
                            <div class="rounded-xl border border-gray-300 bg-white px-4 py-3 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:shadow-md dark:border-slate-700 dark:bg-slate-950 dark:hover:border-blue-700">
                                <div class="flex items-center gap-3">
                                    <div class="rounded-lg bg-emerald-100 p-2 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                                        <x-dynamic-component :component="'heroicon-o-' . $group['icon']" class="h-4 w-4" />
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $group['label'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-blue-600 py-16 dark:bg-blue-700">
            <div class="max-w-4xl mx-auto px-4 text-center sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-white sm:text-4xl">
                    Your Local Project Partner in Maldives
                </h2>
                <p class="mt-4 text-lg text-blue-100">
                    Email your project location, type of work, expected start date, and any photos or drawings to:
                </p>
                <p class="mt-6 text-2xl font-bold text-white">
                    <a href="mailto:{{ $projectEmail }}" class="hover:underline">{{ $projectEmail }}</a>
                </p>
                <div class="mt-8">
                    <a href="{{ $emailLinkWithBody }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-8 py-4 font-semibold text-blue-700 shadow-lg shadow-blue-950/20 transition hover:bg-blue-50">
                        <x-heroicon-o-envelope class="h-5 w-5" />
                        Email {{ $projectEmail }}
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-gray-400 dark:bg-slate-950">
        <div class="max-w-6xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-3">
                <div>
                    <p class="text-lg font-semibold text-white">Easy Fix by Micronet</p>
                    <p class="mt-3 text-sm text-gray-400 dark:text-slate-400">
                        Local subcontracting and project support across Maldives.
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-300">Contact</p>
                    <div class="mt-3 space-y-2 text-sm">
                        <p><a href="mailto:{{ $projectEmail }}" class="hover:text-white">{{ $projectEmail }}</a></p>
                        <p><a href="tel:+9609996210" class="hover:text-white">+960 999 6210</a></p>
                        <p><a href="https://wa.me/9609996210" target="_blank" rel="noopener" class="hover:text-white">WhatsApp EasyFix</a></p>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-300">Keywords</p>
                    <p class="mt-3 text-sm text-gray-400 dark:text-slate-400">
                        AC contractor Maldives, electrical and plumbing works Maldives, hotel maintenance Maldives, handyman services Maldives.
                    </p>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-800 pt-6 text-sm text-gray-500 dark:text-slate-500">
                &copy; {{ date('Y') }} Easy Fix by Micronet. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
