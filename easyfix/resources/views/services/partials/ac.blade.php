<section class="py-6 sm:py-10">
    <a href="{{ route('services.index') }}" class="text-sm font-semibold text-blue-700 hover:underline dark:text-blue-300">All services</a>
    <div class="mt-6 overflow-hidden rounded-3xl border border-blue-200 bg-gradient-to-br from-blue-50 via-white to-cyan-50 dark:border-slate-700 dark:from-slate-900 dark:via-slate-900 dark:to-blue-950">
        <div class="grid gap-8 p-6 sm:p-10 lg:grid-cols-3 lg:items-center lg:p-12">
            <div class="lg:col-span-2">
                <p class="text-sm font-bold uppercase tracking-widest text-blue-700 dark:text-cyan-300">EasyFix Air Conditioning</p>
                <h1 class="mt-4 text-3xl font-bold leading-tight tracking-tight text-slate-950 sm:text-5xl dark:text-white">AC services in Malé &amp; Hulhumalé</h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600 dark:text-slate-300">Keep your space comfortable. Book aircon installation, servicing and repairs for your home, shop, office or guest house.</p>
                <p class="mt-5 font-semibold text-blue-800 dark:text-cyan-200">No extra area charge for Malé, Hulhumalé Phase 1 or Phase 2.</p>
                <a href="{{ $ctaUrl }}" class="mt-7 inline-flex min-h-12 items-center justify-center rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-blue-500">{{ auth()->check() ? 'Request AC Service' : 'Register' }}</a>
                @guest
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-400">Create an account to request a service and track your quotation.</p>
                @endguest
            </div>
            <aside class="rounded-2xl border border-blue-200 bg-white p-6 shadow-sm dark:border-slate-600 dark:bg-slate-800">
                <x-heroicon-o-phone class="h-7 w-7 text-blue-600 dark:text-cyan-300" />
                <h2 class="mt-4 text-xl font-bold text-slate-950 dark:text-white">Emergency breakdown?</h2>
                <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">AC stopped cooling or started leaking? Call with your location and symptoms. We will confirm the earliest available slot.</p>
                <a href="tel:+9607779493" class="mt-5 inline-flex min-h-12 w-full items-center justify-center rounded-xl bg-blue-600 px-4 py-3 text-lg font-bold text-white hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-blue-500">Call 7779493</a>
            </aside>
        </div>
    </div>
</section>

<section class="py-8 sm:py-12" aria-labelledby="ac-rates">
    <div class="max-w-2xl">
        <p class="text-sm font-bold uppercase tracking-widest text-blue-700 dark:text-blue-300">Services &amp; Rates</p>
        <h2 id="ac-rates" class="mt-3 text-3xl font-bold text-slate-950 dark:text-white">Choose the AC service you need</h2>
        <p class="mt-4 leading-7 text-slate-600 dark:text-slate-300">From a new installation to a water leak, get the right help. We confirm the scope and final quotation before work starts.</p>
    </div>
    <dl class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($service['rates'] as $rate)
            <div class="flex flex-col rounded-2xl border border-slate-200 bg-white p-6 dark:border-slate-700 dark:bg-slate-900">
                <dt class="text-lg font-bold text-slate-950 dark:text-white">{{ $rate['name'] }}</dt>
                <dd class="mt-2 flex flex-1 flex-col">
                    <p class="text-sm leading-6 text-slate-600 dark:text-slate-400">{{ $rate['detail'] }}</p>
                    <p class="mt-auto pt-5 text-2xl font-bold tabular-nums text-blue-700 dark:text-cyan-300"><span class="text-sm font-semibold">MVR</span> {{ number_format($rate['price']) }}</p>
                </dd>
            </div>
        @endforeach
    </dl>
    <p class="mt-5 text-sm leading-6 text-slate-600 dark:text-slate-400">Any additional parts, materials or work will be explained in your quotation for approval.</p>
</section>

<section class="py-8 sm:py-12" aria-labelledby="ac-difference">
    <h2 id="ac-difference" class="text-3xl font-bold text-slate-950 dark:text-white">Why choose EasyFix?</h2>
    <div class="mt-7 grid gap-6 md:grid-cols-3">
        @foreach([
            ['Same area rates', 'No extra area charge between Malé City, Hulhumalé Phase 1 and Phase 2.'],
            ['Approve before we proceed', 'Review your quotation and approve any additional work before it starts.'],
            ['Updates in one place', 'Request your service, check job updates and review quotations from your EasyFix dashboard.'],
        ] as [$heading, $copy])
            <div class="border-l-2 border-blue-500 pl-5">
                <h3 class="text-lg font-bold text-slate-950 dark:text-white">{{ $heading }}</h3>
                <p class="mt-2 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $copy }}</p>
            </div>
        @endforeach
    </div>
</section>

<section class="grid gap-5 py-8 sm:py-12 lg:grid-cols-3" aria-label="Specialist AC services and business enquiries">
    @foreach([
        ['Ceiling-mounted AC', 'Need installation, repairs or servicing for a ceiling-mounted air conditioner? Call us for a quotation.', 'Get a quotation'],
        ['Regular maintenance', 'Weekly or monthly servicing is available. Call to arrange a maintenance schedule for your guest house or office.', 'Discuss maintenance'],
        ['Selling air conditioners?', 'AC shops can contact us for special installation and service rates. Let us know your requirements.', 'Ask about shop rates'],
    ] as [$heading, $copy, $label])
        <article class="flex flex-col rounded-2xl border border-blue-100 bg-blue-50 p-6 dark:border-slate-700 dark:bg-slate-900">
            <h2 class="text-xl font-bold text-slate-950 dark:text-white">{{ $heading }}</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $copy }}</p>
            <a href="tel:+9607779493" class="mt-auto pt-5 text-sm font-bold text-blue-700 underline underline-offset-4 dark:text-cyan-300">{{ $label }}: 7779493</a>
        </article>
    @endforeach
</section>
