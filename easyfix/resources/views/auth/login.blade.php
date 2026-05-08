<x-guest-layout logoClass="h-48 w-auto">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 dark:text-white">Use your password instead</h1>
        <p class="mt-2 text-sm sm:text-base text-gray-600 dark:text-slate-300">You can log in with your email, phone number, or username.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="login" :value="__('Email, Phone, or Username')" />
            <x-text-input id="login" class="mt-1 block h-11 w-full" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" placeholder="you@example.com / 9996210 / easyfix_user" />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block h-11 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900" name="remember">
                <span class="text-sm text-gray-600 dark:text-slate-300">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-end">
            <x-primary-button class="w-full justify-center sm:w-auto sm:ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 space-y-3 text-center text-sm text-gray-600 dark:text-slate-400">
        <p>
            Prefer OTP?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline dark:text-blue-400">Go back to phone verification</a>
        </p>
        <p>
            New here?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline dark:text-blue-400">Create an account</a>
        </p>
    </div>
</x-guest-layout>
