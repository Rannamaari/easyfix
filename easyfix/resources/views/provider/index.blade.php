<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Provider Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded dark:bg-green-500/10 dark:border-green-500/40 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg p-6 border border-transparent dark:border-slate-800">
                    <p class="text-sm text-gray-500 dark:text-slate-400">Active Jobs</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['active'] }}</p>
                </div>
                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg p-6 border border-transparent dark:border-slate-800">
                    <p class="text-sm text-gray-500 dark:text-slate-400">Completed Today</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['completed_today'] }}</p>
                </div>
                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg p-6 border border-transparent dark:border-slate-800">
                    <p class="text-sm text-gray-500 dark:text-slate-400">Total Completed</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['completed_total'] }}</p>
                </div>
            </div>

            {{-- Active Jobs --}}
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
                <div class="p-6 border-b border-gray-200 dark:border-slate-800">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Active Jobs</h3>
                </div>

                @if($activeJobs->isEmpty())
                    <div class="p-12 text-center text-gray-500 dark:text-slate-400">
                        <p>No active jobs at the moment.</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-200 dark:divide-slate-800">
                        @foreach($activeJobs as $job)
                            <a href="{{ route('provider.show', $job) }}" class="block hover:bg-gray-50 dark:hover:bg-slate-800/60">
                                <div class="px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3">
                                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                                    #{{ $job->id }} - {{ $job->category->name }}
                                                </span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @switch($job->status->value)
                                                        @case('assigned') bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-200 @break
                                                        @case('en_route') bg-purple-100 text-purple-800 dark:bg-purple-500/20 dark:text-purple-200 @break
                                                        @case('in_progress') bg-indigo-100 text-indigo-800 dark:bg-indigo-500/20 dark:text-indigo-200 @break
                                                    @endswitch
                                                ">
                                                    {{ $job->status->label() }}
                                                </span>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-slate-300">
                                                {{ $job->contact_name }} &bull; {{ $job->address }}
                                            </p>
                                            @if($job->scheduled_time)
                                                <p class="mt-1 text-xs text-blue-600 dark:text-blue-300">
                                                    Scheduled: {{ $job->scheduled_time->format('M d, g:i A') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            @if($job->approvedQuote)
                                                <p class="text-lg font-semibold text-gray-900 dark:text-white">MVR {{ number_format($job->approvedQuote->amount, 2) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Recent Completed --}}
            @if($completedJobs->isNotEmpty())
                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
                    <div class="p-6 border-b border-gray-200 dark:border-slate-800">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Recently Completed</h3>
                    </div>
                    <div class="divide-y divide-gray-200 dark:divide-slate-800">
                        @foreach($completedJobs as $job)
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            #{{ $job->id }} - {{ $job->category->name }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-slate-400">
                                            {{ $job->contact_name }} &bull; {{ $job->completed_at?->format('M d, g:i A') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">MVR {{ number_format($job->payment?->amount ?? 0, 2) }}</p>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                            {{ $job->payment?->status === 'confirmed' ? 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-200' }}">
                                            {{ ucfirst($job->payment?->status ?? 'pending') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
