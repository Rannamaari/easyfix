@php
    $cleaningRates = [
        ['name' => 'Toilet / Bathroom Cleaning', 'price' => 600, 'detail' => 'A focused clean for one bathroom or toilet.'],
        ['name' => 'Deep Toilet / Bathroom Cleaning', 'price' => 800, 'detail' => 'A deeper clean for built-up dirt and harder-to-reach areas.'],
        ['name' => '1 Bedroom Home Cleaning', 'price' => 750, 'detail' => 'General cleaning for a one-bedroom home.'],
        ['name' => '2 Bedroom Home Cleaning', 'price' => 1400, 'detail' => 'General cleaning for a two-bedroom home.'],
        ['name' => '3 Bedroom Home Cleaning', 'price' => 2500, 'detail' => 'General cleaning for a three-bedroom home.'],
        ['name' => '1 Bedroom Deep Cleaning', 'price' => 1100, 'detail' => 'A more detailed clean for a one-bedroom home.'],
        ['name' => '2 Bedroom Deep Cleaning', 'price' => 2200, 'detail' => 'A more detailed clean for a two-bedroom home.'],
        ['name' => '3 Bedroom Deep Cleaning', 'price' => 3500, 'detail' => 'A more detailed clean for a three-bedroom home.'],
    ];

    $quoteUrl = 'https://wa.me/9609996210?text='.urlencode('Hi EasyFix, I would like a quote for cleaning.');
@endphp

<section class="py-6 sm:py-10">
    <a href="{{ route('services.index') }}" class="text-sm font-semibold text-blue-700 hover:underline dark:text-blue-300">All services</a>

    <div class="mt-6 overflow-hidden rounded-3xl border border-emerald-200 bg-gradient-to-br from-emerald-50 via-white to-cyan-50 dark:border-emerald-900/70 dark:from-slate-900 dark:via-slate-900 dark:to-emerald-950/50">
        <div class="grid gap-8 p-6 sm:p-10 lg:grid-cols-[minmax(0,1.4fr)_0.6fr] lg:items-center lg:p-12">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-300">EasyFix Cleaning Services</p>
                <h1 class="mt-4 text-3xl font-bold leading-tight tracking-tight text-slate-950 sm:text-5xl dark:text-white">Reliable cleaning for homes, offices and shared spaces</h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600 dark:text-slate-300">Book home cleaning, deep cleaning and bathroom cleaning in Greater Malé. We also arrange recurring monthly cleaning for apartments, buildings and offices.</p>
                <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ $ctaUrl }}" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-emerald-600 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-emerald-500">{{ auth()->check() ? 'Request Cleaning' : 'Register' }}</a>
                    <a href="{{ $quoteUrl }}" target="_blank" rel="noopener" class="inline-flex min-h-12 items-center justify-center rounded-xl border border-emerald-300 bg-white px-6 py-3 font-semibold text-emerald-800 transition hover:bg-emerald-50 dark:border-emerald-700 dark:bg-slate-900 dark:text-emerald-200 dark:hover:bg-emerald-950/50">Request a quote</a>
                </div>
                @guest
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-400">Register once to request cleaning and track your booking updates.</p>
                @endguest
            </div>

            <aside class="rounded-2xl border border-emerald-200 bg-white/90 p-6 shadow-sm dark:border-emerald-800 dark:bg-slate-900/90">
                <x-heroicon-o-sparkles class="h-8 w-8 text-emerald-600 dark:text-emerald-300" />
                <h2 class="mt-4 text-xl font-bold text-slate-950 dark:text-white">Clear prices, including GST</h2>
                <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">Every listed cleaning price already includes GST. For offices, buildings, move-in, move-out or post-renovation work, ask us for a tailored quote.</p>
            </aside>
        </div>
    </div>
</section>

<section class="py-8 sm:py-12" aria-labelledby="cleaning-rates">
    <div class="max-w-2xl">
        <p class="text-sm font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-300">Services &amp; Rates</p>
        <h2 id="cleaning-rates" class="mt-3 text-3xl font-bold text-slate-950 dark:text-white">Cleaning prices</h2>
        <p class="mt-4 leading-7 text-slate-600 dark:text-slate-300">Choose a cleaning option that fits your space. All listed prices are inclusive of GST.</p>
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($cleaningRates as $rate)
            <article class="flex min-h-48 flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <h3 class="text-lg font-bold leading-6 text-slate-950 dark:text-white">{{ $rate['name'] }}</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-400">{{ $rate['detail'] }}</p>
                <p class="mt-auto pt-5 text-2xl font-bold tabular-nums text-emerald-700 dark:text-emerald-300"><span class="text-sm font-semibold">MVR</span> {{ number_format($rate['price']) }}</p>
                <p class="mt-1 text-xs font-medium text-slate-500 dark:text-slate-500">GST included</p>
            </article>
        @endforeach
    </div>
</section>

<section class="grid gap-5 py-8 sm:py-12 lg:grid-cols-3" aria-label="Cleaning quotes and recurring plans">
    @foreach([
        ['Monthly cleaning', 'Need scheduled cleaning for an apartment, building or office? Tell us the location, size and preferred frequency for a monthly quote.'],
        ['Office cleaning', 'Keep your workplace ready for staff and visitors. We can quote based on the space, schedule and cleaning requirements.'],
        ['Move-in, move-out or post-renovation', 'For larger, empty or newly renovated spaces, send photos and details on WhatsApp so we can prepare the right quote.'],
    ] as [$heading, $copy])
        <article class="flex flex-col rounded-2xl border border-emerald-100 bg-emerald-50/70 p-6 dark:border-emerald-900/70 dark:bg-emerald-950/25">
            <h2 class="text-xl font-bold text-slate-950 dark:text-white">{{ $heading }}</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $copy }}</p>
            <a href="{{ $quoteUrl }}" target="_blank" rel="noopener" class="mt-auto pt-5 text-sm font-bold text-emerald-700 underline underline-offset-4 dark:text-emerald-300">Request a quote on WhatsApp</a>
        </article>
    @endforeach
</section>

<section class="rounded-3xl bg-slate-950 px-6 py-10 text-center sm:px-10 sm:py-14">
    <h2 class="text-3xl font-bold text-white">Ready for a cleaner space?</h2>
    <p class="mx-auto mt-4 max-w-2xl text-slate-300">Book a listed home-cleaning service online, or contact us for monthly, office, building and larger cleaning requirements.</p>
    <div class="mt-7 flex flex-col justify-center gap-3 sm:flex-row">
        <a href="{{ $ctaUrl }}" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-emerald-500 px-6 py-3 font-semibold text-white transition hover:bg-emerald-400">{{ auth()->check() ? 'Request Cleaning' : 'Register' }}</a>
        <a href="{{ $quoteUrl }}" target="_blank" rel="noopener" class="inline-flex min-h-12 items-center justify-center rounded-xl border border-white/30 px-6 py-3 font-semibold text-white transition hover:bg-white/10">Request a quote</a>
    </div>
</section>
