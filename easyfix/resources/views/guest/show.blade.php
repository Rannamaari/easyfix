<x-public-layout>
    <x-slot name="title">Track Your Request - {{ config('app.name') }}</x-slot>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Bookmark Notice --}}
    <div class="mb-4 bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded text-sm">
        <strong>Bookmark this page!</strong> You'll need this link to check your request status.
    </div>

    {{-- Status Banner --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Request #{{ $job->id }}</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                        @switch($job->status->value)
                            @case('requested') bg-gray-100 text-gray-800 @break
                            @case('quoted') bg-blue-100 text-blue-800 @break
                            @case('approved') bg-green-100 text-green-800 @break
                            @case('assigned') bg-yellow-100 text-yellow-800 @break
                            @case('en_route') bg-purple-100 text-purple-800 @break
                            @case('in_progress') bg-indigo-100 text-indigo-800 @break
                            @case('completed') bg-green-100 text-green-800 @break
                            @case('cancelled') bg-red-100 text-red-800 @break
                        @endswitch
                    ">
                        {{ $job->status->label() }}
                    </span>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Submitted</p>
                    <p class="text-sm font-medium">{{ $job->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Quote Section --}}
    @if($job->latestQuote && $job->latestQuote->status === 'sent')
        <div class="bg-blue-50 border border-blue-200 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h3 class="text-lg font-medium text-blue-900 mb-2">Quote Received</h3>
                <div class="mb-4">
                    <p class="text-3xl font-bold text-blue-900">${{ number_format($job->latestQuote->amount, 2) }}</p>
                    @if($job->latestQuote->notes)
                        <p class="text-sm text-blue-700 mt-1">{{ $job->latestQuote->notes }}</p>
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
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Your Provider</h3>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                        <span class="text-xl font-medium text-gray-600">{{ substr($job->provider->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $job->provider->name }}</p>
                        @if($job->scheduled_time)
                            <p class="text-sm text-gray-500">Scheduled: {{ $job->scheduled_time->format('M d, Y g:i A') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Job Details --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Request Details</h3>
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Category</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $job->category->name }}</dd>
                </div>
                @if($job->service)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Service</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $job->service->name }}</dd>
                    </div>
                @endif
                <div>
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $job->description }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Address</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $job->address }}@if($job->city), {{ $job->city }}@endif</dd>
                </div>
                @if($job->preferred_time)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Preferred Time</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $job->preferred_time->format('M d, Y g:i A') }}</dd>
                    </div>
                @endif
            </dl>
        </div>
    </div>

    {{-- Attachments --}}
    @if($job->attachments->isNotEmpty())
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Photos</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($job->attachments as $attachment)
                        <a href="{{ Storage::url($attachment->file_path) }}" target="_blank" class="block">
                            @if(Str::startsWith($attachment->file_type, 'image/'))
                                <img src="{{ Storage::url($attachment->file_path) }}" alt="{{ $attachment->file_name }}" class="w-full h-24 object-cover rounded-lg">
                            @else
                                <div class="w-full h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <span class="text-xs text-gray-500">{{ $attachment->file_name }}</span>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Status History --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Status Updates</h3>
            <div class="flow-root">
                <ul class="-mb-8">
                    @foreach($job->statusUpdates as $update)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                    <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                @endif
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs">{{ $loop->remaining + 1 }}</span>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5">
                                        <p class="text-sm text-gray-900">
                                            {{ \App\Enums\JobStatus::from($update->status->value)->label() }}
                                        </p>
                                        @if($update->note)
                                            <p class="text-sm text-gray-500">{{ $update->note }}</p>
                                        @endif
                                        <p class="text-xs text-gray-400">{{ $update->created_at->format('M d, Y g:i A') }}</p>
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
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
        <h3 class="font-medium text-gray-900 mb-2">Want to track all your jobs easily?</h3>
        <p class="text-sm text-gray-600 mb-4">Create a free account to manage all your service requests in one place.</p>
        <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Create Free Account
        </a>
    </div>
</x-public-layout>
