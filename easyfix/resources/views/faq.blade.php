<x-public-layout>
    <x-slot name="title">EasyFix FAQ</x-slot>
    <x-slot name="wide">true</x-slot>

    <x-slot name="head">
        <x-seo-meta
            title="EasyFix FAQ"
            description="Answers about EasyFix site visits, diagnosis charges, urgent requests, payments, approvals, and rescheduling."
            :image="url('/og-image.png')"
            :url="route('faq', absolute: true)"
            type="website"
        />
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($faqItems)->map(fn ($item) => [
                '@type' => 'Question',
                'name' => $item['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $item['answer'],
                ],
            ])->values()->all(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    </x-slot>

    <section class="py-4 sm:py-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-10 text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600 dark:text-blue-400">Support & Pricing</p>
                <h1 class="mt-3 text-4xl font-bold text-gray-900 dark:text-white">Frequently Asked Questions</h1>
                <p class="mt-4 text-base text-gray-600 dark:text-slate-400 max-w-2xl mx-auto">
                    Everything you need to know about EasyFix visit charges, urgent attendance, approvals, materials, cancellations, and rescheduling.
                </p>
            </div>

            <div class="space-y-4">
                @foreach($faqItems as $item)
                    <details class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                        <summary class="cursor-pointer list-none pr-8 text-lg font-semibold text-gray-900 dark:text-white marker:hidden">
                            {{ $item['question'] }}
                        </summary>
                        <p class="mt-4 text-sm leading-7 text-gray-600 dark:text-slate-400">
                            {{ $item['answer'] }}
                        </p>
                    </details>
                @endforeach
            </div>

            <div class="mt-12 rounded-2xl border border-blue-100 bg-blue-50 px-6 py-6 text-center dark:border-blue-500/20 dark:bg-blue-500/10">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Still need help?</h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-slate-400">
                    If your question is urgent, call us on <a href="tel:+9609996210" class="font-semibold text-blue-600 hover:underline dark:text-blue-300">999 6210</a> or send us a WhatsApp message.
                </p>
                <div class="mt-5 flex flex-col justify-center gap-3 sm:flex-row">
                    <a href="tel:+9609996210" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                        Call 999 6210
                    </a>
                    <a href="https://wa.me/9609996210" target="_blank" rel="noopener" class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-900 hover:bg-gray-50 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:hover:bg-slate-700">
                        WhatsApp Us
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
