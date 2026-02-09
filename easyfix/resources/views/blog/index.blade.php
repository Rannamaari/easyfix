<x-public-layout>
    <x-slot name="title">Blog | {{ config('app.name', 'EasyFix') }} - Home Repair Tips & Updates</x-slot>
    <x-slot name="wide">true</x-slot>

    <x-slot name="head">
        <meta name="description" content="Tips, guides, and updates from Easy Fix - Malé's trusted handyman service. Learn about home maintenance, repairs, and more.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ route('blog.index') }}">
        <meta property="og:title" content="Blog | {{ config('app.name', 'EasyFix') }}">
        <meta property="og:description" content="Tips, guides, and updates from Easy Fix - Malé's trusted handyman service.">
        <link rel="canonical" href="{{ route('blog.index') }}">
    </x-slot>

    {{-- Header --}}
    <div class="pb-8 sm:pb-10">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">Blog</h1>
        <p class="mt-2 text-gray-600 dark:text-slate-400">Home maintenance tips, repair guides, and updates from Easy Fix.</p>
    </div>

    {{-- Search & Filters --}}
    <div class="mb-8 space-y-4">
        {{-- Search Bar --}}
        <form action="{{ route('blog.index') }}" method="GET" class="relative max-w-md">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <div class="relative">
                <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 dark:text-slate-500" />
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search articles..."
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
        </form>

        {{-- Category Chips --}}
        @if($categories->count())
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('blog.index', request('search') ? ['search' => request('search')] : []) }}"
                   class="inline-flex items-center px-3.5 py-1.5 rounded-full text-sm font-medium transition
                          {{ !request('category')
                              ? 'bg-blue-600 text-white'
                              : 'bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-700' }}">
                    All
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('blog.index', array_filter(['category' => $category->slug, 'search' => request('search')])) }}"
                       class="inline-flex items-center px-3.5 py-1.5 rounded-full text-sm font-medium transition
                              {{ request('category') === $category->slug
                                  ? 'bg-blue-600 text-white'
                                  : 'bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-700' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    @if($posts->count())
        @php $latest = $posts->first(); $rest = $posts->skip(1); @endphp

        {{-- Featured Latest Post --}}
        <a href="{{ route('blog.show', $latest->slug) }}"
           class="group block mb-10 rounded-2xl overflow-hidden border border-gray-200 dark:border-slate-800 hover:shadow-2xl hover:border-blue-300 dark:hover:border-slate-600 transition-all duration-300">
            <div class="grid lg:grid-cols-5">
                {{-- Image — takes 3/5 on large screens --}}
                <div class="lg:col-span-3 aspect-video lg:aspect-auto lg:min-h-[420px] overflow-hidden bg-gray-100 dark:bg-slate-800">
                    @if($latest->featured_image_url)
                        <img src="{{ $latest->featured_image_url }}"
                             alt="{{ $latest->title }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-50 via-blue-100 to-indigo-100 dark:from-slate-800 dark:via-slate-700 dark:to-slate-800 flex items-center justify-center">
                            <x-heroicon-o-newspaper class="w-24 h-24 text-blue-200 dark:text-slate-600" />
                        </div>
                    @endif
                </div>

                {{-- Content — takes 2/5 --}}
                <div class="lg:col-span-2 bg-white dark:bg-slate-900 p-8 sm:p-10 lg:p-12 flex flex-col justify-center">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="inline-flex items-center gap-1.5 bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide">
                            Latest Post
                        </div>
                        @if($latest->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-slate-400">
                                {{ $latest->category->name }}
                            </span>
                        @endif
                    </div>
                    <time datetime="{{ $latest->published_at->toDateString() }}"
                          class="text-sm text-gray-500 dark:text-slate-400">
                        {{ $latest->published_at->format('F d, Y') }}
                    </time>
                    <h2 class="mt-3 text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors leading-tight">
                        {{ $latest->title }}
                    </h2>
                    @if($latest->excerpt)
                        <p class="mt-4 text-gray-600 dark:text-slate-400 leading-relaxed line-clamp-4">
                            {{ $latest->excerpt }}
                        </p>
                    @endif
                    <span class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-blue-600 dark:text-blue-400 group-hover:gap-3 transition-all">
                        Read full article
                        <x-heroicon-o-arrow-right class="w-4 h-4" />
                    </span>
                </div>
            </div>
        </a>

        {{-- More Articles --}}
        @if($rest->count())
            <div class="border-t border-gray-200 dark:border-slate-800 pt-10 pb-4">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-8">More Articles</h3>

                <div class="grid md:grid-cols-2 gap-5">
                    @foreach($rest as $post)
                        <a href="{{ route('blog.show', $post->slug) }}"
                           class="group flex gap-5 bg-white dark:bg-slate-900 rounded-xl border border-gray-200 dark:border-slate-800 overflow-hidden hover:shadow-lg hover:border-blue-200 dark:hover:border-slate-700 transition-all duration-200">
                            {{-- Thumbnail --}}
                            <div class="w-36 sm:w-48 flex-shrink-0 overflow-hidden">
                                @if($post->featured_image_url)
                                    <img src="{{ $post->featured_image_url }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full min-h-[140px] bg-gradient-to-br from-blue-50 to-blue-100 dark:from-slate-800 dark:to-slate-700 flex items-center justify-center">
                                        <x-heroicon-o-newspaper class="w-10 h-10 text-blue-200 dark:text-slate-600" />
                                    </div>
                                @endif
                            </div>

                            {{-- Text --}}
                            <div class="flex-1 min-w-0 py-5 pr-5">
                                <div class="flex items-center gap-2">
                                    <time datetime="{{ $post->published_at->toDateString() }}"
                                          class="text-xs font-medium text-gray-400 dark:text-slate-500">
                                        {{ $post->published_at->format('M d, Y') }}
                                    </time>
                                    @if($post->category)
                                        <span class="text-xs font-medium text-gray-400 dark:text-slate-500">&middot;</span>
                                        <span class="text-xs font-medium text-blue-600 dark:text-blue-400">{{ $post->category->name }}</span>
                                    @endif
                                </div>
                                <h4 class="mt-1.5 text-base font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2 leading-snug">
                                    {{ $post->title }}
                                </h4>
                                @if($post->excerpt)
                                    <p class="mt-2 text-sm text-gray-500 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                        {{ $post->excerpt }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="py-10">
            {{ $posts->links() }}
        </div>
    @else
        <div class="text-center py-20">
            <x-heroicon-o-newspaper class="w-16 h-16 text-gray-300 dark:text-slate-600 mx-auto mb-4" />
            @if(request('search') || request('category'))
                <p class="text-gray-500 dark:text-slate-400 text-lg">No posts found matching your filters.</p>
                <a href="{{ route('blog.index') }}" class="mt-4 inline-flex items-center text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                    <x-heroicon-o-arrow-left class="w-4 h-4 mr-1" />
                    Clear filters
                </a>
            @else
                <p class="text-gray-500 dark:text-slate-400 text-lg">No posts yet. Check back soon!</p>
            @endif
        </div>
    @endif
</x-public-layout>
