<x-guest-layout logoClass="h-48 w-auto">
    <div class="mb-6 text-center">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 dark:text-white">Confirm your password</h1>
        <p class="mt-2 text-sm sm:text-base text-gray-600 dark:text-slate-300">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </p>
    </div>

    <div class="mb-4 text-sm text-gray-600 dark:text-slate-300">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full h-11"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end">
            <x-primary-button class="w-full justify-center sm:w-auto">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
