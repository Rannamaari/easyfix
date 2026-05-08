<x-public-layout :wide="true">
    <x-slot name="title">
        Verify Phone - {{ config('app.name') }}
    </x-slot>

    @php
        $isLogin = $mode === 'login';
    @endphp

    <section class="py-4 sm:py-10">
        <div class="grid items-center gap-10 md:grid-cols-[1.05fr_0.95fr] md:gap-12 lg:gap-16">
            <div class="hidden max-w-2xl md:block">
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-blue-600 dark:text-blue-300">
                    {{ $isLogin ? 'Secure Login' : 'Phone Verification' }}
                </p>

                <h1 class="mt-4 text-4xl font-bold leading-tight text-gray-900 dark:text-white sm:text-5xl lg:text-6xl">
                    Confirm your number and keep things moving.
                </h1>

                <p class="mt-5 max-w-xl text-base leading-8 text-gray-600 dark:text-slate-300 sm:text-lg">
                    Enter the code we sent to your phone so you can {{ $isLogin ? 'log in securely' : 'continue creating your EasyFix account' }} without delays.
                </p>

                <div class="mt-8 space-y-4">
                    <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                        <span>Fast code verification</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                        <span>Secure access to your jobs</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                        <span>Trusted updates from EasyFix</span>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-xl md:justify-self-end">
                <div class="rounded-[2rem] border border-gray-200 bg-white p-6 shadow-xl shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white sm:text-3xl">
                        Verify your phone number
                    </h2>
                    <p class="mt-3 text-sm leading-7 text-gray-600 dark:text-slate-300 sm:text-base">
                        Enter the 6-digit code sent to <span class="font-semibold text-gray-900 dark:text-white">+960 {{ $signupVerification->phone }}</span>.
                    </p>

                    <x-auth-session-status class="mt-4" :status="session('status')" />

                    <form method="POST" action="{{ route('register.verify.store', $signupVerification) }}" class="mt-6 space-y-5">
                        @csrf
                        <input type="hidden" name="mode" value="{{ $mode }}">

                        <div>
                            <label for="otp" class="block text-sm font-medium text-gray-700 dark:text-slate-200">
                                Verification Code
                            </label>
                            <input
                                id="otp"
                                name="otp"
                                type="text"
                                inputmode="numeric"
                                maxlength="6"
                                minlength="6"
                                required
                                autofocus
                                placeholder="123456"
                                class="mt-2 block h-14 w-full rounded-2xl border border-gray-200 bg-white px-4 text-center text-2xl tracking-[0.35em] text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-500"
                            >
                            <p class="mt-2 text-xs text-gray-500 dark:text-slate-400">The code expires in 10 minutes.</p>
                            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
                        </div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-6 py-4 text-sm font-semibold uppercase tracking-[0.22em] text-white transition hover:bg-slate-800 dark:bg-blue-600 dark:hover:bg-blue-500"
                        >
                            {{ $isLogin ? 'Verify & Log In' : 'Verify & Continue' }}
                        </button>
                    </form>

                    <div class="mt-6 flex flex-col items-center gap-3 text-sm">
                        <form method="POST" action="{{ route('register.verify.resend', $signupVerification) }}">
                            @csrf
                            <button type="submit" class="font-semibold text-blue-600 hover:underline dark:text-blue-400">
                                Resend code
                            </button>
                        </form>

                        <a href="{{ $isLogin ? route('login') : route('register') }}" class="text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white">
                            Use a different phone number
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
