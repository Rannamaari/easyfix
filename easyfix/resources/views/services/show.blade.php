<x-public-layout :wide="true">
    <x-slot name="title">{{ $service['title'] }}</x-slot>

    <x-slot name="head">
        <x-seo-meta
            :title="$service['title']"
            :description="$service['description']"
            :image="url('/og-image.png')"
            :url="route('services.show', $slug, absolute: true)"
            type="website"
        />
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $service['name'],
            'description' => $service['description'],
            'url' => route('services.show', $slug, absolute: true),
            'provider' => [
                '@type' => 'HomeAndConstructionBusiness',
                'name' => 'EasyFix',
                'url' => url('/'),
            ],
            'areaServed' => ['Malé City', 'Hulhumalé', 'Villingili'],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($service['faqs'])->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ])->values()->all(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    </x-slot>

    @php
        $ctaUrl = auth()->check() ? route('jobs.create') : route('register');
        $ctaLabel = auth()->check() ? 'Request This Service' : 'Register to Request Service';
    @endphp

    <section class="py-6 sm:py-12">
        <div class="mx-auto grid max-w-6xl gap-10 lg:grid-cols-[minmax(0,1.2fr)_0.8fr] lg:items-center">
            <div>
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-300 dark:hover:text-blue-200"><x-heroicon-o-arrow-left class="h-4 w-4" /> All services</a>
                <div class="mt-7 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                    <x-dynamic-component :component="'heroicon-o-' . $service['icon']" class="h-7 w-7" />
                </div>
                <h1 class="mt-6 text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">{{ $service['name'] }} in Malé, Hulhumalé &amp; Villingili</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-gray-600 dark:text-slate-300">{{ $service['intro'] }}</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ $ctaUrl }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-slate-950">{{ $ctaLabel }}</a>
                    <a href="tel:+9609996210" class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-6 py-3.5 text-sm font-semibold text-gray-800 transition hover:bg-gray-50 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:hover:bg-slate-800">Call 999 6210</a>
                </div>
            </div>

            <aside class="rounded-3xl border border-blue-100 bg-blue-50/70 p-7 dark:border-blue-500/20 dark:bg-blue-500/10">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">How we can help</h2>
                <ul class="mt-5 space-y-4">
                    @foreach($service['items'] as $item)
                        <li class="flex items-start gap-3 text-sm leading-6 text-gray-700 dark:text-slate-300"><x-heroicon-s-check-circle class="mt-0.5 h-5 w-5 flex-none text-blue-600 dark:text-blue-300" />{{ $item }}</li>
                    @endforeach
                </ul>
                <p class="mt-6 border-t border-blue-100 pt-5 text-sm leading-6 text-gray-600 dark:border-blue-500/20 dark:text-slate-400">A site visit or diagnosis may be needed before a final quotation. We explain any additional work, parts, or materials and get your approval before proceeding.</p>
            </aside>
        </div>
    </section>

    <section class="border-y border-gray-200 bg-white py-14 dark:border-slate-800 dark:bg-slate-900/50">
        <div class="mx-auto max-w-4xl">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $service['name'] }} FAQ</h2>
            <div class="mt-7 space-y-4">
                @foreach($service['faqs'] as $faq)
                    <details class="rounded-2xl border border-gray-200 bg-gray-50 p-5 dark:border-slate-800 dark:bg-slate-900">
                        <summary class="cursor-pointer list-none font-semibold text-gray-900 dark:text-white">{{ $faq['question'] }}</summary>
                        <p class="mt-3 text-sm leading-7 text-gray-600 dark:text-slate-400">{{ $faq['answer'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-14 text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Need {{ strtolower($service['name']) }} support?</h2>
        <p class="mx-auto mt-4 max-w-2xl text-gray-600 dark:text-slate-400">Register with your phone number, send your request, and keep every update and quotation in one place.</p>
        <a href="{{ $ctaUrl }}" class="mt-7 inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">{{ $ctaLabel }}</a>
    </section>
</x-public-layout>
