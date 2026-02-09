<x-guest-layout logoClass="h-48 w-auto">
    <div class="mb-6 text-center">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 dark:text-white">Verify your email</h1>
        <p class="mt-2 text-sm sm:text-base text-gray-600 dark:text-slate-300">
            {{ __('We sent a verification link to') }}
            <strong class="text-gray-900 dark:text-white">{{ auth()->user()->email }}</strong>
        </p>
    </div>

    <div class="mb-4 text-sm text-gray-600 dark:text-slate-300">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    @if (session('status') == 'email-updated')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Your email has been updated and a new verification link has been sent.') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button class="w-full justify-center sm:w-auto">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-slate-300 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>

    {{-- Change Email --}}
    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-slate-700">
        <p class="text-sm text-gray-600 dark:text-slate-400 mb-3">Wrong email address? Update it below and we'll send a new verification link.</p>

        <form method="POST" action="{{ route('verification.update-email') }}" class="flex flex-col sm:flex-row gap-3">
            @csrf

            <div class="flex-1">
                <x-text-input
                    name="email"
                    type="email"
                    :value="old('email', auth()->user()->email)"
                    placeholder="Enter correct email"
                    class="w-full"
                    required
                />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gray-800 dark:bg-slate-700 text-white text-sm font-medium rounded-lg hover:bg-gray-700 dark:hover:bg-slate-600 transition-colors whitespace-nowrap">
                Update & Resend
            </button>
        </form>
    </div>
</x-guest-layout>
