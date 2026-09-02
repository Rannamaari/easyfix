<x-public-layout :wide="true">
    <x-slot name="title">Home Repair Services in Malé & Hulhumalé | EasyFix</x-slot>

    <x-slot name="head">
        <x-seo-meta
            title="Home Repair Services in Malé & Hulhumalé | EasyFix"
            description="Explore EasyFix services for AC repair, appliance and oven repair, washing machines, plumbing, electrical, carpentry, cleaning, door locks, and small moving in Greater Malé."
            :image="url('/og-image.png')"
            :url="route('services.index', absolute: true)"
            type="website"
        />
    </x-slot>

    <section class="py-6 sm:py-12">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600 dark:text-blue-400">EasyFix Services</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">Home repair services across Greater Malé</h1>
            <p class="mt-5 text-lg leading-8 text-gray-600 dark:text-slate-300">Choose a service to learn how EasyFix can help in Malé City, Hulhumalé, and Villingili. Register once, request support, and track your service updates from your dashboard.</p>
        </div>

        <div class="mx-auto mt-12 grid max-w-6xl gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $slug => $service)
                <a href="{{ route('services.show', $slug) }}" class="group rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900 dark:hover:border-blue-500/40">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-300">
                        <x-dynamic-component :component="'heroicon-o-' . $service['icon']" class="h-6 w-6" />
                    </div>
                    <h2 class="mt-5 text-xl font-bold text-gray-900 transition group-hover:text-blue-600 dark:text-white dark:group-hover:text-blue-300">{{ $service['name'] }}</h2>
                    <p class="mt-3 text-sm leading-6 text-gray-600 dark:text-slate-400">{{ $service['description'] }}</p>
                    <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-blue-600 dark:text-blue-300">Learn more <x-heroicon-o-arrow-right class="h-4 w-4 transition group-hover:translate-x-1" /></span>
                </a>
            @endforeach
        </div>
    </section>
</x-public-layout>
