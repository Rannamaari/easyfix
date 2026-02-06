<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">My Jobs</h2>
            <a href="{{ route('jobs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                New Request
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded dark:bg-green-500/10 dark:border-green-500/40 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
                @if($jobs->isEmpty())
                    <div class="p-12 text-center text-gray-500 dark:text-slate-400">
                        <p class="mb-4">You haven't made any job requests yet.</p>
                        <a href="{{ route('jobs.create') }}" class="text-blue-600 hover:underline dark:text-blue-300">Create your first request</a>
                    </div>
                @else
                    <div class="divide-y divide-gray-200 dark:divide-slate-800">
                        @foreach($jobs as $job)
                            <a href="{{ route('jobs.show', $job) }}" class="block hover:bg-gray-50 dark:hover:bg-slate-800/60">
                                <div class="px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3">
                                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                                    #{{ $job->id }} - {{ $job->category->name }}
                                                </span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @switch($job->status->value)
                                                        @case('requested') bg-gray-100 text-gray-800 dark:bg-slate-800 dark:text-slate-200 @break
                                                        @case('quoted') bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-200 @break
                                                        @case('approved') bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-200 @break
                                                        @case('assigned') bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-200 @break
                                                        @case('en_route') bg-purple-100 text-purple-800 dark:bg-purple-500/20 dark:text-purple-200 @break
                                                        @case('in_progress') bg-indigo-100 text-indigo-800 dark:bg-indigo-500/20 dark:text-indigo-200 @break
                                                        @case('completed') bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-200 @break
                                                        @case('cancelled') bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-200 @break
                                                    @endswitch
                                                ">
                                                    {{ $job->status->label() }}
                                                </span>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-slate-400 truncate">{{ Str::limit($job->description, 80) }}</p>
                                            <p class="mt-1 text-xs text-gray-400 dark:text-slate-500">{{ $job->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="ml-4 text-right">
                                            @if($job->latestQuote)
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">MVR {{ number_format($job->latestQuote->total ?? $job->latestQuote->amount, 2) }}</p>
                                                <p class="text-xs text-gray-500 dark:text-slate-400">Quote</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-800">
                        {{ $jobs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
