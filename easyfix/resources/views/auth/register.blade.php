<x-guest-layout logoClass="h-48 w-auto">
    <div class="mb-8 text-center">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 dark:text-white">Create your account</h1>
        <p class="mt-2 text-sm sm:text-base text-gray-600 dark:text-slate-300">Add your contact details and preferred address.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <x-input-label for="name" :value="__('Full Name')" />
                <x-text-input id="name" class="block mt-1 w-full h-11" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your full name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" class="block mt-1 w-full h-11" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" class="block mt-1 w-full h-11" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" placeholder="9996210" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="address_type" :value="__('Address Type')" />
                <select id="address_type" name="address_type" required class="block mt-1 w-full h-11 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white text-gray-900 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                    <option value="" disabled {{ old('address_type') ? '' : 'selected' }}>Select address type</option>
                    <option value="home" {{ old('address_type') === 'home' ? 'selected' : '' }}>Home</option>
                    <option value="work" {{ old('address_type') === 'work' ? 'selected' : '' }}>Work</option>
                    <option value="other" {{ old('address_type') === 'other' ? 'selected' : '' }}>Other</option>
                </select>
                <x-input-error :messages="$errors->get('address_type')" class="mt-2" />
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <x-input-label for="address_line1" :value="__('Address Line 1')" />
                <x-text-input id="address_line1" class="block mt-1 w-full h-11" type="text" name="address_line1" :value="old('address_line1')" required autocomplete="address-line1" placeholder="Street, building, house no." />
                <x-input-error :messages="$errors->get('address_line1')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="address_line2" :value="__('Address Line 2 (Apt, Suite, etc.)')" />
                <x-text-input id="address_line2" class="block mt-1 w-full h-11" type="text" name="address_line2" :value="old('address_line2')" autocomplete="address-line2" placeholder="Apartment, floor, landmark" />
                <x-input-error :messages="$errors->get('address_line2')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full h-11" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full h-11" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-start gap-3">
            <input id="terms" name="terms" type="checkbox" class="mt-1 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900" required>
            <label for="terms" class="text-sm text-gray-600 dark:text-slate-300">
                I agree to the <a href="{{ route('terms') }}" class="text-blue-600 hover:underline dark:text-blue-400">Terms & Conditions</a>.
            </label>
        </div>
        <x-input-error :messages="$errors->get('terms')" class="mt-2" />

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
