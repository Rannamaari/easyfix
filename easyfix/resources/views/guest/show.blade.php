<x-public-layout>
    <x-slot name="title">Track Your Request - {{ config('app.name') }}</x-slot>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded dark:bg-green-500/10 dark:border-green-500/40 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded dark:bg-red-500/10 dark:border-red-500/40 dark:text-red-200">
            {{ session('error') }}
        </div>
    @endif

    {{-- Bookmark Notice --}}
    <div class="mb-4 bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded text-sm dark:bg-yellow-500/10 dark:border-yellow-500/30 dark:text-yellow-200">
        <strong>Bookmark this page!</strong> You'll need this link to check your request status.
    </div>

    {{-- Status Banner --}}
    <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-transparent dark:border-slate-800">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-slate-400">Request #{{ $job->id }}</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
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
                <div class="text-right">
                    <p class="text-sm text-gray-500 dark:text-slate-400">Submitted</p>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $job->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Quote Section --}}
    @if($job->latestQuote && $job->latestQuote->status === 'sent')
        <div class="bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/30 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-2">Quote Received</h3>
                <div class="mb-4">
                    <p class="text-3xl font-bold text-blue-900 dark:text-blue-100">MVR {{ number_format($job->latestQuote->amount, 2) }}</p>
                    @if($job->latestQuote->notes)
                        <p class="text-sm text-blue-700 dark:text-blue-200 mt-1">{{ $job->latestQuote->notes }}</p>
                    @endif
                </div>
                <div class="flex gap-3">
                    <form action="{{ route('track.approve-quote', $token) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Approve Quote
                        </button>
                    </form>
                    <form action="{{ route('track.reject-quote', $token) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Reject Quote
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- Provider Info --}}
    @if($job->provider)
        <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-transparent dark:border-slate-800">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Your Provider</h3>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-200 dark:bg-slate-800 rounded-full flex items-center justify-center">
                        <span class="text-xl font-medium text-gray-600 dark:text-slate-200">{{ substr($job->provider->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $job->provider->name }}</p>
                        @if($job->scheduled_time)
                            <p class="text-sm text-gray-500 dark:text-slate-400">Scheduled: {{ $job->scheduled_time->format('M d, Y g:i A') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Job Details --}}
    <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-transparent dark:border-slate-800">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Request Details</h3>
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Category</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $job->category->name }}</dd>
                </div>
                @if($job->service)
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Service</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $job->service->name }}</dd>
                    </div>
                @endif
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $job->description }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Address</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $job->address }}@if($job->city), {{ $job->city }}@endif</dd>
                </div>
                @if($job->preferred_time)
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Preferred Time</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $job->preferred_time->format('M d, Y g:i A') }}</dd>
                    </div>
                @endif
            </dl>
        </div>
    </div>

    {{-- Attachments --}}
    @if($job->attachments->isNotEmpty())
        <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-transparent dark:border-slate-800">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Photos</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($job->attachments as $attachment)
                        <a href="{{ Storage::url($attachment->file_path) }}" target="_blank" class="block">
                            @if(Str::startsWith($attachment->file_type, 'image/'))
                                <img src="{{ Storage::url($attachment->file_path) }}" alt="{{ $attachment->file_name }}" class="w-full h-24 object-cover rounded-lg">
                            @else
                                <div class="w-full h-24 bg-gray-100 dark:bg-slate-800 rounded-lg flex items-center justify-center">
                                    <span class="text-xs text-gray-500 dark:text-slate-300">{{ $attachment->file_name }}</span>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Status History --}}
    <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-transparent dark:border-slate-800">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Status Updates</h3>
            <div class="flow-root">
                <ul class="-mb-8">
                    @foreach($job->statusUpdates as $update)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                    <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-slate-700"></span>
                                @endif
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-gray-200 dark:bg-slate-800 flex items-center justify-center">
                                            <span class="text-xs text-gray-700 dark:text-slate-200">{{ $loop->remaining + 1 }}</span>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5">
                                        <p class="text-sm text-gray-900 dark:text-white">
                                            {{ \App\Enums\JobStatus::from($update->status->value)->label() }}
                                        </p>
                                        @if($update->note)
                                            <p class="text-sm text-gray-500 dark:text-slate-400">{{ $update->note }}</p>
                                        @endif
                                        <p class="text-xs text-gray-400 dark:text-slate-500">{{ $update->created_at->format('M d, Y g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Create Account CTA --}}
    <div class="bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-lg p-6 text-center">
        <h3 class="font-medium text-gray-900 dark:text-white mb-2">Want to track all your jobs easily?</h3>
        <p class="text-sm text-gray-600 dark:text-slate-300 mb-4">Create a free account to manage all your service requests in one place.</p>
        <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Create Free Account
        </a>
    </div>
</x-public-layout>
