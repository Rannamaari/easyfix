<x-public-layout :wide="true">
    <x-slot name="title">
        {{ $mode === 'login' ? 'Login - ' : 'Register - ' }}{{ config('app.name') }}
    </x-slot>

    @php
        $isLogin = $mode === 'login';
    @endphp

    <section class="py-4 sm:py-10">
        <div class="grid items-center gap-10 md:grid-cols-[1.05fr_0.95fr] md:gap-12 lg:gap-16">
            <div class="hidden max-w-2xl md:block">
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-blue-600 dark:text-blue-300">
                    {{ $isLogin ? 'Welcome Back' : 'EasyFix Maldives' }}
                </p>

                <h1 class="mt-4 text-4xl font-bold leading-tight text-gray-900 dark:text-white sm:text-5xl lg:text-6xl">
                    {{ $isLogin ? 'Get back to your jobs faster.' : 'Get home repairs done faster.' }}
                </h1>

                <p class="mt-5 max-w-xl text-base leading-8 text-gray-600 dark:text-slate-300 sm:text-lg">
                    {{ $isLogin
                        ? 'Sign in with your phone number to follow updates, review quotes, and manage your EasyFix jobs across Greater Malé.'
                        : 'Book AC repair, electrical, plumbing, appliance repair and more across Greater Malé.' }}
                </p>

                <div class="mt-8 space-y-4">
                    <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                        <span>Quick booking</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                        <span>Job updates</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                        <span>Trusted technicians</span>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-xl md:justify-self-end">
                <div class="rounded-[2rem] border border-gray-200 bg-white p-6 shadow-xl shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white sm:text-3xl">
                        Continue with your phone number
                    </h2>
                    <p class="mt-3 hidden text-sm leading-7 text-gray-600 dark:text-slate-300 sm:block sm:text-base">
                        {{ $isLogin
                            ? 'We’ll send a verification code so you can sign in securely.'
                            : 'We’ll send a verification code to confirm your booking.' }}
                    </p>

                    <x-auth-session-status class="mt-4" :status="session('status')" />

                    <form method="POST" action="{{ route('auth.phone.start') }}" class="mt-6 space-y-5">
                        @csrf
                        <input type="hidden" name="mode" value="{{ $mode }}">

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-slate-200">
                                {{ __('Phone Number') }}
                            </label>

                            <div class="mt-2 flex h-14 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-950">
                                <div class="flex items-center border-r border-gray-200 px-4 text-base font-semibold text-gray-500 dark:border-slate-700 dark:text-slate-300">
                                    +960
                                </div>
                                <input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    inputmode="numeric"
                                    autocomplete="tel"
                                    value="{{ old('phone') }}"
                                    required
                                    autofocus
                                    placeholder="Enter phone number"
                                    class="w-full border-0 bg-transparent px-4 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-0 dark:text-white dark:placeholder:text-slate-500"
                                >
                            </div>

                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-6 py-4 text-sm font-semibold uppercase tracking-[0.22em] text-white transition hover:bg-slate-800 dark:bg-blue-600 dark:hover:bg-blue-500"
                        >
                            Continue
                        </button>
                    </form>

                    <p class="mt-6 text-center text-sm text-gray-600 dark:text-slate-300">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:underline dark:text-blue-400">
                            Log in
                        </a>
                    </p>

                    <p class="mt-4 hidden text-center text-xs leading-6 text-gray-500 dark:text-slate-400 sm:block">
                        By continuing, you agree to our
                        <a href="{{ route('terms') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-400">T&amp;C</a>
                        and
                        <a href="{{ route('privacy') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-400">Privacy Policy</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
