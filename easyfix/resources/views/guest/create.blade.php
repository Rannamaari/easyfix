<x-public-layout :wide="true">
    <x-slot name="title">Register to Request a Service - {{ config('app.name') }}</x-slot>

    <section class="py-8 sm:py-12">
        <div class="mx-auto max-w-5xl">
            @if (session('status'))
                <div class="mb-6 rounded-2xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-900 dark:border-blue-500/30 dark:bg-blue-500/10 dark:text-blue-100">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:gap-12">
                <div class="rounded-[2rem] border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-blue-600 dark:text-blue-300">
                        Account Required
                    </p>
                    <h1 class="mt-4 text-3xl font-bold leading-tight text-gray-900 dark:text-white sm:text-4xl">
                        Register before requesting a service.
                    </h1>
                    <p class="mt-4 text-base leading-8 text-gray-600 dark:text-slate-300">
                        EasyFix now requires an account for every service request so we can keep your quotes, updates, messages, and address details in one place.
                    </p>

                    <div class="mt-8 space-y-4">
                        <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                            <span>Track job progress from your dashboard</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                            <span>Approve quotes and view invoices securely</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                            <span>Save phone number, address, and service history</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        Continue to your account
                    </h2>
                    <p class="mt-3 text-sm leading-7 text-gray-600 dark:text-slate-300">
                        Sign up with your phone number or log in to continue with your service request.
                    </p>

                    <div class="mt-8 flex flex-col gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-4 text-sm font-semibold uppercase tracking-[0.22em] text-white transition hover:bg-blue-700">
                            Register Now
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl border border-gray-200 px-6 py-4 text-sm font-semibold uppercase tracking-[0.22em] text-gray-700 transition hover:bg-gray-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                            Log In
                        </a>
                    </div>

                    <p class="mt-6 text-sm text-gray-500 dark:text-slate-400">
                        Need urgent help first? Call <a href="tel:+9609996210" class="font-semibold text-blue-600 hover:underline dark:text-blue-400">999 6210</a> or message us on <a href="https://wa.me/9609996210" target="_blank" rel="noopener" class="font-semibold text-blue-600 hover:underline dark:text-blue-400">WhatsApp</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
