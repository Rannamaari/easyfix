<x-public-layout>
    <x-slot name="title">Work With EasyFix</x-slot>

    <div class="bg-white dark:bg-slate-900 shadow-sm sm:rounded-2xl border border-gray-100 dark:border-slate-800">
        <div class="p-6 sm:p-8 space-y-6">
            <div class="text-center">
                <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 dark:text-white">Work with EasyFix</h1>
                <p class="mt-2 text-sm sm:text-base text-gray-600 dark:text-slate-300">
                    Leave your phone number and we will contact you once you are onboarded.
                </p>
            </div>

            @if (session('status'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-900/40 dark:bg-green-900/20 dark:text-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('professionals.store') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="phone" :value="__('Phone Number')" />
                    <x-text-input id="phone" class="block mt-1 w-full h-11" type="tel" name="phone" :value="old('phone')" required placeholder="9996210" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <x-primary-button class="w-full justify-center">
                    {{ __('Submit') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-public-layout>
