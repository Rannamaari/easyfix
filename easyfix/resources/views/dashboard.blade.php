<x-app-layout>
    <div class="min-h-screen flex flex-col bg-gray-50 dark:bg-slate-950">
        

        <main class="flex-1 py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="grid gap-6 lg:grid-cols-[1.2fr_1fr]">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:bg-slate-900 dark:border-slate-800">
                        <div class="p-6 sm:p-8">
                            <p class="text-sm text-blue-600 dark:text-blue-400 font-semibold">Welcome</p>
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mt-2">Hi {{ Auth::user()->name }}, let’s get your service request ready.</h3>
                            <p class="mt-3 text-gray-600 dark:text-slate-300">Pick a category, add details, and choose a time that works for you.</p>

                            @if(Auth::user()->isProvider())
                                <div class="mt-6">
                                    <a href="{{ route('provider.index') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700">
                                        View My Jobs
                                    </a>
                                </div>
                            @elseif(Auth::user()->isAdmin())
                                <div class="mt-6">
                                    <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700">
                                        Go to Admin Panel
                                    </a>
                                </div>
                            @else
                                <div class="mt-6 flex flex-wrap gap-3">
                                    <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700">
                                        Request a Service
                                    </a>
                                    <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 bg-white text-gray-700 px-5 py-2.5 rounded-lg border border-gray-200 hover:bg-gray-50">
                                        View My Jobs
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 dark:bg-slate-900 dark:border-slate-800">
                        <div class="p-6 sm:p-8">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white">How to Request a Service</h4>
                            <div class="mt-4 space-y-4 text-sm text-gray-600 dark:text-slate-300">
                                <div class="flex items-start gap-3">
                                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-blue-600 dark:bg-slate-800 dark:text-blue-400">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6l4 2" />
                                        </svg>
                                    </span>
                                    <div>Choose a service category and share the issue.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-blue-600 dark:bg-slate-800 dark:text-blue-400">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c0 2.5-1.5 4-4 4" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 10a8 8 0 11-16 0" />
                                        </svg>
                                    </span>
                                    <div>Select your preferred date and time.</div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-blue-600 dark:bg-slate-800 dark:text-blue-400">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                    <div>Submit and track updates from your dashboard.</div>
                                </div>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                    Start Request
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="border-t border-gray-200 bg-white dark:bg-slate-900 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-sm text-gray-600">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">Micronet</p>
                        <p>Janavaree Hingun, near Dharubaarige, Malé</p>
                    </div>
                    <div class="sm:text-right">
                        <p>Phone: 9996210</p>
                        <p>Email: hello@micronet.mv</p>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mt-1">&copy; {{ date('Y') }} Micronet. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>
