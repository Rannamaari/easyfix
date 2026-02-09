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

    {{-- Share --}}
    <div class="max-w-3xl mx-auto mt-12 pt-8 border-t border-gray-200 dark:border-slate-800">
        <p class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Share this article</p>
        <div class="flex flex-wrap gap-3">
            {{-- X / Twitter --}}
            <a href="https://x.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}"
               target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-sm font-medium hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                Post
            </a>

            {{-- Facebook --}}
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}"
               target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#1877F2] text-white text-sm font-medium hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                Share
            </a>

            {{-- WhatsApp --}}
            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . route('blog.show', $post->slug)) }}"
               target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#25D366] text-white text-sm font-medium hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp
            </a>

            {{-- Copy Link --}}
            <button onclick="navigator.clipboard.writeText('{{ route('blog.show', $post->slug) }}'); this.querySelector('span').textContent = 'Copied!'; setTimeout(() => this.querySelector('span').textContent = 'Copy link', 2000)"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-slate-300 text-sm font-medium hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors border border-gray-200 dark:border-slate-700">
                <x-heroicon-o-link class="w-4 h-4" />
                <span>Copy link</span>
            </button>
        </div>
    </div>

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
