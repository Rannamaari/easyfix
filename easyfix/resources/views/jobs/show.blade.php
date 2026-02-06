<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                Job #{{ $job->id }} - {{ $job->category->name }}
            </h2>
            <a href="{{ route('jobs.index') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white">&larr; Back to My Jobs</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded dark:bg-green-500/10 dark:border-green-500/40 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Invoice (when approved) --}}
            @if($job->approvedQuote)
                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Invoice</h3>
                                @if($job->approvedQuote->invoice_number)
                                    <p class="text-sm text-gray-500 dark:text-slate-400">Invoice #{{ $job->approvedQuote->invoice_number }}</p>
                                @endif
                            </div>
                            @if($job->approvedQuote->invoiced_at)
                                <p class="text-sm text-gray-500 dark:text-slate-400">{{ $job->approvedQuote->invoiced_at->format('M d, Y g:i A') }}</p>
                            @endif
                        </div>
                        <div class="space-y-2">
                            @foreach($job->approvedQuote->items as $item)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-700 dark:text-slate-300">{{ $item->description }}</span>
                                    <span class="font-medium text-gray-900 dark:text-white">MVR {{ number_format($item->amount, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 border-t border-gray-200 dark:border-slate-800 pt-3 space-y-1 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 dark:text-slate-300">Subtotal</span>
                                <span class="font-medium text-gray-900 dark:text-white">MVR {{ number_format($job->approvedQuote->subtotal ?? $job->approvedQuote->amount, 2) }}</span>
                            </div>
                            @if($job->approvedQuote->tax_enabled)
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600 dark:text-slate-300">Tax ({{ number_format($job->approvedQuote->tax_rate ?? 8, 2) }}%)</span>
                                    <span class="font-medium text-gray-900 dark:text-white">MVR {{ number_format($job->approvedQuote->tax_amount ?? 0, 2) }}</span>
                                </div>
                            @endif
                            <div class="flex items-center justify-between text-base">
                                <span class="text-gray-900 dark:text-white font-semibold">Total</span>
                                <span class="text-gray-900 dark:text-white font-semibold">MVR {{ number_format($job->approvedQuote->total ?? $job->approvedQuote->amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded dark:bg-red-500/10 dark:border-red-500/40 dark:text-red-200">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Status Banner --}}
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-slate-400">Current Status</p>
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
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $job->created_at->format('M d, Y g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quote Section --}}
            @if($job->latestQuote)
                <div class="bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/30 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100">Quote Summary</h3>
                                <p class="text-sm text-blue-700 dark:text-blue-200">Job #{{ $job->id }} • {{ $job->category->name }}</p>
                            </div>
                            <div class="text-sm text-blue-700 dark:text-blue-200">
                                <span class="font-medium">Issued:</span>
                                {{ $job->latestQuote->created_at->format('M d, Y g:i A') }}
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($job->latestQuote->status === 'sent') bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-200
                                @elseif($job->latestQuote->status === 'approved') bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-200
                                @elseif($job->latestQuote->status === 'rejected') bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-200
                                @else bg-gray-100 text-gray-800 dark:bg-slate-800 dark:text-slate-200 @endif">
                                {{ ucfirst($job->latestQuote->status) }}
                            </span>
                        </div>
                        @if($job->latestQuote->items->isNotEmpty())
                            <div class="mt-4 space-y-2">
                                @foreach($job->latestQuote->items as $item)
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-blue-900 dark:text-blue-100">{{ $item->description }}</span>
                                        <span class="font-medium text-blue-900 dark:text-blue-100">MVR {{ number_format($item->amount, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4 border-t border-blue-200 dark:border-blue-500/30 pt-3 space-y-1 text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="text-blue-700 dark:text-blue-200">Subtotal</span>
                                    <span class="font-medium text-blue-900 dark:text-blue-100">MVR {{ number_format($job->latestQuote->subtotal ?? $job->latestQuote->amount, 2) }}</span>
                                </div>
                                @if($job->latestQuote->tax_enabled)
                                    <div class="flex items-center justify-between">
                                        <span class="text-blue-700 dark:text-blue-200">Tax ({{ number_format($job->latestQuote->tax_rate ?? 8, 2) }}%)</span>
                                        <span class="font-medium text-blue-900 dark:text-blue-100">MVR {{ number_format($job->latestQuote->tax_amount ?? 0, 2) }}</span>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between text-base">
                                    <span class="text-blue-900 dark:text-blue-100 font-semibold">Total</span>
                                    <span class="text-blue-900 dark:text-blue-100 font-semibold">MVR {{ number_format($job->latestQuote->total ?? $job->latestQuote->amount, 2) }}</span>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-3xl font-bold text-blue-900 dark:text-blue-100">MVR {{ number_format($job->latestQuote->total ?? $job->latestQuote->amount, 2) }}</p>
                                </div>
                            </div>
                        @endif
                        @if($job->latestQuote->notes)
                            <p class="text-sm text-blue-700 dark:text-blue-200 mt-3">{{ $job->latestQuote->notes }}</p>
                        @endif
                        @if($job->latestQuote->status === 'sent')
                            <div class="flex gap-3">
                                <form action="{{ route('jobs.approve-quote', $job) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                        Approve Quote
                                    </button>
                                </form>
                                <form action="{{ route('jobs.reject-quote', $job) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                        Reject Quote
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Provider Info (if assigned) --}}
            @if($job->provider)
                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Assigned Provider</h3>
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
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Job Details</h3>
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @php
                            $billAmount = $job->payment?->amount
                                ?? $job->approvedQuote?->total
                                ?? $job->approvedQuote?->amount
                                ?? $job->latestQuote?->total
                                ?? $job->latestQuote?->amount;
                            $billLabel = $job->payment
                                ? 'Final Bill'
                                : ($job->approvedQuote ? 'Approved Quote' : ($job->latestQuote ? 'Latest Quote' : null));
                        @endphp
                        @if($billAmount !== null && $billLabel)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">{{ $billLabel }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">MVR {{ number_format($billAmount, 2) }}</dd>
                            </div>
                        @endif
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
                        <div class="sm:col-span-2">
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
                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
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
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Status History</h3>
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

            {{-- Payment (if completed) --}}
            @if($job->payment)
                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Payment</h3>
                        <dl class="grid grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Amount</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">MVR {{ number_format($job->payment->amount, 2) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Method</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', $job->payment->method)) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Status</dt>
                                <dd class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $job->payment->status === 'confirmed' ? 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-200' }}">
                                        {{ ucfirst($job->payment->status) }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            @endif

            {{-- Chat --}}
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-transparent dark:border-slate-800">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Job Chat</h3>
                            <p class="text-sm text-gray-600 dark:text-slate-300">Ask for updates and chat with the provider or admin.</p>
                        </div>
                        @php
                            $openUpdateRequest = $job->updateRequests->firstWhere('status', 'open');
                        @endphp
                        <button type="button" id="request-update-btn"
                            class="px-3 py-1.5 text-sm border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 dark:text-blue-200 dark:hover:bg-blue-500/10"
                            {{ $openUpdateRequest ? 'disabled' : '' }}>
                            {{ $openUpdateRequest ? 'Update Requested' : 'Request Update' }}
                        </button>
                    </div>

                    <div class="mt-4">
                        @if($openUpdateRequest)
                            <div class="rounded-lg border border-blue-200 dark:border-blue-500/30 bg-blue-50 dark:bg-blue-500/10 px-4 py-3 text-sm text-blue-900 dark:text-blue-100">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium">Update request is pending</span>
                                    <span class="text-xs text-blue-700 dark:text-blue-200">{{ $openUpdateRequest->created_at->format('M d, Y g:i A') }}</span>
                                </div>
                                @if($openUpdateRequest->message)
                                    <p class="mt-2">{{ $openUpdateRequest->message }}</p>
                                @endif
                                @if($openUpdateRequest->response)
                                    <div class="mt-3 rounded-md bg-white dark:bg-slate-900 px-3 py-2 text-sm text-gray-700 dark:text-slate-200">
                                        <p class="text-xs text-gray-500 dark:text-slate-400">Response</p>
                                        <p class="mt-1">{{ $openUpdateRequest->response }}</p>
                                    </div>
                                @endif
                            </div>
                        @else
                            @php
                                $latestResponded = $job->updateRequests->firstWhere('status', 'responded');
                            @endphp
                            @if($latestResponded)
                                <div class="rounded-lg border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50 px-4 py-3 text-sm text-gray-700 dark:text-slate-200">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium">Last update response</span>
                                        <span class="text-xs text-gray-500 dark:text-slate-400">{{ $latestResponded->responded_at?->format('M d, Y g:i A') }}</span>
                                    </div>
                                    @if($latestResponded->response)
                                        <p class="mt-2">{{ $latestResponded->response }}</p>
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>

                    <form id="update-request-form" action="{{ route('jobs.update-requests.store', $job) }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="message" value="Please share a quick update.">
                    </form>

                    <div class="mt-5 space-y-4">
                        @forelse($job->messages as $msg)
                            @php
                                $isMe = $msg->user_id === auth()->id();
                                $bubbleClasses = $isMe ? 'bg-blue-600 text-white ml-auto' : 'bg-gray-100 text-gray-900 mr-auto dark:bg-slate-800 dark:text-slate-100';
                                $metaClasses = $isMe ? 'text-blue-100' : 'text-gray-500 dark:text-slate-400';
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
                                        <form action="{{ route('jobs.messages.update', [$job, $msg->id]) }}" method="POST" class="mt-2 hidden edit-message-form" data-message-id="{{ $msg->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <textarea name="message" rows="3" class="w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white shadow-sm" required>{{ $msg->message }}</textarea>
                                            <div class="mt-2 flex gap-2">
                                                <button type="submit" class="px-3 py-1.5 text-sm bg-gray-900 text-white rounded-md">Save</button>
                                                <button type="button" class="px-3 py-1.5 text-sm border border-gray-300 dark:border-slate-700 dark:text-slate-200 rounded-md cancel-edit-btn">Cancel</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-slate-400">No messages yet. Start the conversation.</p>
                        @endforelse
                    </div>

                    <form action="{{ route('jobs.messages.store', $job) }}" method="POST" class="mt-6 space-y-3">
                        @csrf
                        <textarea name="message" id="chat-message" rows="3" class="w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white shadow-sm" required
                            placeholder="Write a message...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
</x-app-layout>

<script>
    const requestUpdateBtn = document.getElementById('request-update-btn');
    const chatMessage = document.getElementById('chat-message');

    if (requestUpdateBtn && chatMessage) {
        requestUpdateBtn.addEventListener('click', () => {
            const form = document.getElementById('update-request-form');
            if (form && !requestUpdateBtn.disabled) {
                form.submit();
            }
        });
    }

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
