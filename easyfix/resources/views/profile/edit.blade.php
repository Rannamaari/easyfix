<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-blue-600 dark:text-blue-300">Account</p>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-white leading-tight">
                    {{ __('Profile Settings') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-slate-300">
                    Manage your contact details, saved addresses, and account security.
                </p>
            </div>

            @if (auth()->user()->hasVerifiedEmail())
                <span class="inline-flex items-center gap-1 rounded-full bg-green-50 dark:bg-green-900/30 px-3 py-1 text-xs font-medium text-green-700 dark:text-green-400 ring-1 ring-inset ring-green-600/20 dark:ring-green-500/30">
                    <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.403 12.652a3 3 0 0 0 0-5.304 3 3 0 0 0-3.75-3.751 3 3 0 0 0-5.305 0 3 3 0 0 0-3.751 3.75 3 3 0 0 0 0 5.305 3 3 0 0 0 3.75 3.751 3 3 0 0 0 5.305 0 3 3 0 0 0 3.751-3.75Zm-2.546-4.46a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                    </svg>
                    Verified Account
                </span>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 xl:grid-cols-[0.92fr_1.08fr]">
                <div class="space-y-6">
                    <div class="overflow-hidden rounded-[2rem] border border-gray-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="border-b border-gray-100 px-6 py-5 dark:border-slate-800">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Account Overview</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-slate-300">A quick look at the details linked to your EasyFix account.</p>
                        </div>
                        <div class="grid gap-4 px-6 py-6 sm:grid-cols-2">
                            <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-4 dark:border-slate-800 dark:bg-slate-950/60">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-slate-400">Full Name</p>
                                <p class="mt-2 text-base font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                            </div>
                            <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-4 dark:border-slate-800 dark:bg-slate-950/60">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-slate-400">Username</p>
                                <p class="mt-2 text-base font-semibold text-gray-900 dark:text-white">{{ auth()->user()->username ?: 'Not set' }}</p>
                            </div>
                            <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-4 dark:border-slate-800 dark:bg-slate-950/60">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-slate-400">Phone</p>
                                <p class="mt-2 text-base font-semibold text-gray-900 dark:text-white">{{ auth()->user()->phone ? '+960 ' . auth()->user()->phone : 'Not set' }}</p>
                            </div>
                            <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-4 dark:border-slate-800 dark:bg-slate-950/60">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-slate-400">Saved Addresses</p>
                                <p class="mt-2 text-base font-semibold text-gray-900 dark:text-white">{{ $addresses->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-[2rem] border border-gray-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="px-6 py-6 sm:px-8">
                            @include('profile.partials.address-manager')
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="overflow-hidden rounded-[2rem] border border-gray-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="px-6 py-6 sm:px-8">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="overflow-hidden rounded-[2rem] border border-gray-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                            <div class="px-6 py-6 sm:px-8">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <div class="overflow-hidden rounded-[2rem] border border-red-100 bg-white shadow-sm dark:border-red-900/40 dark:bg-slate-900">
                            <div class="px-6 py-6 sm:px-8">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
