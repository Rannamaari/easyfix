<x-public-layout>
    <x-slot name="title">{{ $post->meta_title ?: $post->title }} | {{ config('app.name', 'EasyFix') }}</x-slot>
    <x-slot name="wide">true</x-slot>

    <x-slot name="head">
        <meta name="description" content="{{ $post->meta_description ?: $post->excerpt ?: Str::limit(strip_tags($post->content), 160) }}">

        {{-- Open Graph --}}
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ route('blog.show', $post->slug) }}">
        <meta property="og:title" content="{{ $post->meta_title ?: $post->title }}">
        <meta property="og:description" content="{{ $post->meta_description ?: $post->excerpt ?: Str::limit(strip_tags($post->content), 160) }}">
        @if($post->featured_image_url)
            <meta property="og:image" content="{{ $post->featured_image_url }}">
        @endif
        <meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
        <meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">

        {{-- Twitter Card --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $post->meta_title ?: $post->title }}">
        <meta name="twitter:description" content="{{ $post->meta_description ?: $post->excerpt ?: Str::limit(strip_tags($post->content), 160) }}">
        @if($post->featured_image_url)
            <meta name="twitter:image" content="{{ $post->featured_image_url }}">
        @endif

        <link rel="canonical" href="{{ route('blog.show', $post->slug) }}">

        {{-- JSON-LD --}}
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => $post->meta_description ?: $post->excerpt ?: Str::limit(strip_tags($post->content), 160),
            'image' => $post->featured_image_url,
            'datePublished' => $post->published_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => 'Easy Fix',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Easy Fix',
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('blog.show', $post->slug),
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
    </x-slot>

    {{-- Back Link --}}
    <a href="{{ route('blog.index') }}"
       class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 dark:text-slate-400 hover:text-gray-900 dark:hover:text-white transition-colors mb-8">
        <x-heroicon-o-arrow-left class="w-4 h-4" />
        Back to Blog
    </a>

    {{-- Featured Image — full width --}}
    @if($post->featured_image_url)
        <div class="aspect-[21/9] rounded-2xl overflow-hidden mb-10">
            <img src="{{ $post->featured_image_url }}"
                 alt="{{ $post->title }}"
                 class="w-full h-full object-cover">
        </div>
    @endif

    {{-- Article — centered readable column --}}
    <article class="max-w-3xl mx-auto">
        {{-- Meta --}}
        <time datetime="{{ $post->published_at->toDateString() }}"
              class="text-sm text-gray-500 dark:text-slate-400">
            {{ $post->published_at->format('F d, Y') }}
        </time>

        {{-- Title --}}
        <h1 class="mt-3 text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white leading-tight mb-10">
            {{ $post->title }}
        </h1>

        {{-- Content --}}
        <div class="prose prose-lg dark:prose-invert max-w-none
                    prose-headings:font-bold prose-headings:text-gray-900 dark:prose-headings:text-white
                    prose-a:text-blue-600 dark:prose-a:text-blue-400
                    prose-img:rounded-xl">
            {!! $post->content !!}
        </div>
    </article>

    {{-- CTA --}}
    <div class="max-w-3xl mx-auto mt-16 bg-blue-50 dark:bg-slate-900 rounded-2xl border border-blue-100 dark:border-slate-800 p-8 sm:p-10 text-center">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
            Need help with a repair?
        </h2>
        <p class="text-gray-600 dark:text-slate-400 mb-6">
            Easy Fix provides fast, reliable handyman services across Malé.
        </p>
        <a href="{{ auth()->check() ? route('jobs.create') : route('guest.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
            <x-heroicon-o-wrench-screwdriver class="w-5 h-5" />
            Request a Service
        </a>
    </div>
</x-public-layout>
