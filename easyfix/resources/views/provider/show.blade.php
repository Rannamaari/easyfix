<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Job #{{ $job->id }}
            </h2>
            <a href="{{ route('provider.index') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Back to Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Status & Actions --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Current Status</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                                @switch($job->status->value)
                                    @case('assigned') bg-yellow-100 text-yellow-800 @break
                                    @case('en_route') bg-purple-100 text-purple-800 @break
                                    @case('in_progress') bg-indigo-100 text-indigo-800 @break
                                    @case('completed') bg-green-100 text-green-800 @break
                                @endswitch
                            ">
                                {{ $job->status->label() }}
                            </span>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-wrap gap-2">
                            @if($job->status === \App\Enums\JobStatus::Assigned)
                                <form action="{{ route('provider.en-route', $job) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 text-sm font-medium">
                                        Start - On My Way
                                    </button>
                                </form>
                            @endif

                            @if($job->status === \App\Enums\JobStatus::EnRoute)
                                <form action="{{ route('provider.in-progress', $job) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-medium">
                                        Arrived - Start Work
                                    </button>
                                </form>
                            @endif

                            @if($job->status === \App\Enums\JobStatus::InProgress)
                                <button onclick="document.getElementById('complete-modal').classList.remove('hidden')"
                                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm font-medium">
                                    Complete Job
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Customer & Location --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Customer & Location</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Customer</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $job->contact_name }}</dd>
                        </div>
                        @if($job->contact_phone)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="mt-1">
                                    <a href="tel:{{ $job->contact_phone }}" class="text-sm text-blue-600 hover:underline">
                                        {{ $job->contact_phone }}
                                    </a>
                                </dd>
                            </div>
                        @endif
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Address</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $job->address }}@if($job->city), {{ $job->city }}@endif
                            </dd>
                        </div>
                        @if($job->scheduled_time)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Scheduled Time</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $job->scheduled_time->format('M d, Y g:i A') }}</dd>
                            </div>
                        @endif
                    </dl>

                    {{-- Map Link --}}
                    <div class="mt-4">
                        <a href="https://maps.google.com/?q={{ urlencode($job->address . ', ' . $job->city) }}" target="_blank"
                            class="inline-flex items-center text-sm text-blue-600 hover:underline">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Open in Maps
                        </a>
                    </div>
                </div>
            </div>

            {{-- Job Details --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Job Details</h3>
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
                        @if($job->approvedQuote)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Quoted Amount</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-900">MVR {{ number_format($job->approvedQuote->total ?? $job->approvedQuote->amount, 2) }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            {{-- Photos --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Photos</h3>

                    {{-- Customer Photos --}}
                    @if($job->attachments->where('type', 'photo')->isNotEmpty())
                        <div class="mb-6">
                            <p class="text-sm text-gray-500 mb-2">Customer Photos</p>
                            <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                                @foreach($job->attachments->where('type', 'photo') as $attachment)
                                    <a href="{{ Storage::url($attachment->file_path) }}" target="_blank">
                                        <img src="{{ Storage::url($attachment->file_path) }}" class="w-full h-20 object-cover rounded">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Before/After Photos --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Before --}}
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Before Photos</p>
                            @if($job->attachments->where('type', 'before')->isNotEmpty())
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    @foreach($job->attachments->where('type', 'before') as $attachment)
                                        <a href="{{ Storage::url($attachment->file_path) }}" target="_blank">
                                            <img src="{{ Storage::url($attachment->file_path) }}" class="w-full h-20 object-cover rounded">
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            @if($job->status !== \App\Enums\JobStatus::Completed)
                                <form action="{{ route('provider.upload-photo', $job) }}" method="POST" enctype="multipart/form-data" class="flex gap-2">
                                    @csrf
                                    <input type="hidden" name="type" value="before">
                                    <input type="file" name="photo" accept="image/*" required class="text-xs flex-1">
                                    <button type="submit" class="px-2 py-1 bg-gray-200 text-gray-700 rounded text-xs hover:bg-gray-300">Upload</button>
                                </form>
                            @endif
                        </div>

                        {{-- After --}}
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">After Photos</p>
                            @if($job->attachments->where('type', 'after')->isNotEmpty())
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    @foreach($job->attachments->where('type', 'after') as $attachment)
                                        <a href="{{ Storage::url($attachment->file_path) }}" target="_blank">
                                            <img src="{{ Storage::url($attachment->file_path) }}" class="w-full h-20 object-cover rounded">
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            @if($job->status !== \App\Enums\JobStatus::Completed)
                                <form action="{{ route('provider.upload-photo', $job) }}" method="POST" enctype="multipart/form-data" class="flex gap-2">
                                    @csrf
                                    <input type="hidden" name="type" value="after">
                                    <input type="file" name="photo" accept="image/*" required class="text-xs flex-1">
                                    <button type="submit" class="px-2 py-1 bg-gray-200 text-gray-700 rounded text-xs hover:bg-gray-300">Upload</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status History --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Status History</h3>
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
                                                <p class="text-sm text-gray-900">{{ $update->status->label() }}</p>
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

            {{-- Chat --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Job Chat</h3>
                            <p class="text-sm text-gray-600">Chat with the customer and provide updates.</p>
                        </div>
                        @php
                            $openUpdateRequest = $job->updateRequests->firstWhere('status', 'open');
                        @endphp
                        <div class="text-xs text-gray-500">
                            @if($openUpdateRequest)
                                Update requested {{ $openUpdateRequest->created_at->format('M d, Y g:i A') }}
                            @endif
                        </div>
                    </div>

                    @if($openUpdateRequest)
                        <div class="mt-4 rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-900">
                            <div class="flex items-center justify-between">
                                <span class="font-medium">Update request from customer</span>
                                <span class="text-xs text-blue-700">{{ $openUpdateRequest->created_at->format('M d, Y g:i A') }}</span>
                            </div>
                            @if($openUpdateRequest->message)
                                <p class="mt-2">{{ $openUpdateRequest->message }}</p>
                            @endif
                            <form action="{{ route('provider.jobs.update-requests.respond', [$job, $openUpdateRequest]) }}" method="POST" class="mt-3 space-y-2">
                                @csrf
                                <textarea name="response" rows="3" class="w-full rounded-md border-gray-300 shadow-sm" required
                                    placeholder="Write a response..."></textarea>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Send Response
                                </button>
                            </form>
                        </div>
                    @endif

                    <div class="mt-5 space-y-4">
                        @forelse($job->messages as $msg)
                            @php
                                $isMe = $msg->user_id === auth()->id();
                                $bubbleClasses = $isMe ? 'bg-blue-600 text-white ml-auto' : 'bg-gray-100 text-gray-900 mr-auto';
                                $metaClasses = $isMe ? 'text-blue-100' : 'text-gray-500';
                            @endphp
                            <div class="flex">
                                <div class="max-w-[80%]">
                                    <div class="rounded-2xl px-4 py-3 {{ $bubbleClasses }}">
                                        <p class="text-sm whitespace-pre-line">{{ $msg->message }}</p>
                                    </div>
                                    <div class="mt-1 flex items-center gap-2 text-xs {{ $metaClasses }}">
                                        <span>{{ ucfirst($msg->sender_role) }}</span>
                                        <span>•</span>
                                        <span>{{ $msg->created_at->format('M d, Y g:i A') }}</span>
                                        @if($msg->edited_at)
                                            <span>• Edited</span>
                                        @endif
                                        @if($isMe)
                                            <button type="button" class="ml-2 underline text-xs edit-message-btn" data-message-id="{{ $msg->id }}">
                                                Edit
                                            </button>
                                        @endif
                                    </div>

                                    @if($isMe)
                                        <form action="{{ route('provider.jobs.messages.update', [$job, $msg->id]) }}" method="POST" class="mt-2 hidden edit-message-form" data-message-id="{{ $msg->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <textarea name="message" rows="3" class="w-full rounded-md border-gray-300 shadow-sm" required>{{ $msg->message }}</textarea>
                                            <div class="mt-2 flex gap-2">
                                                <button type="submit" class="px-3 py-1.5 text-sm bg-gray-900 text-white rounded-md">Save</button>
                                                <button type="button" class="px-3 py-1.5 text-sm border border-gray-300 rounded-md cancel-edit-btn">Cancel</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No messages yet. Start the conversation.</p>
                        @endforelse
                    </div>

                    <form action="{{ route('provider.jobs.messages.store', $job) }}" method="POST" class="mt-6 space-y-3">
                        @csrf
                        <textarea name="message" id="chat-message" rows="3" class="w-full rounded-md border-gray-300 shadow-sm" required
                            placeholder="Write a message..."></textarea>
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Complete Job Modal --}}
    <div id="complete-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Complete Job</h3>
                <form action="{{ route('provider.complete', $job) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="cash" required class="mr-2">
                                <span class="text-sm">Cash</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="bank_transfer" class="mr-2">
                                <span class="text-sm">Bank Transfer (customer will upload slip)</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes (optional)</label>
                        <textarea name="notes" id="notes" rows="2" class="w-full rounded-md border-gray-300 shadow-sm text-sm"></textarea>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" onclick="document.getElementById('complete-modal').classList.add('hidden')"
                            class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                            Complete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.querySelectorAll('.edit-message-btn').forEach((btn) => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.messageId;
            const form = document.querySelector(`.edit-message-form[data-message-id="${id}"]`);
            if (form) {
                form.classList.remove('hidden');
            }
        });
    });

    document.querySelectorAll('.cancel-edit-btn').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const form = e.target.closest('.edit-message-form');
            if (form) {
                form.classList.add('hidden');
            }
        });
    });
</script>
