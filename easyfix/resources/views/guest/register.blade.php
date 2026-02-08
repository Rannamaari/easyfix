<x-public-layout>
    <x-slot name="title">Create Account - {{ config('app.name') }}</x-slot>

    <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-slate-800">
        <div class="p-6">
            <div class="mb-6 space-y-3">
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-900 dark:border-green-500/40 dark:bg-green-500/10 dark:text-green-200">
                    Your request has been submitted! Create an account to track your jobs and get updates.
                </div>
                @if(session('success'))
                    <div class="rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-900 dark:border-blue-500/30 dark:bg-blue-500/10 dark:text-blue-200">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Create Your Account</h1>
            <p class="text-gray-600 dark:text-slate-300 mb-6">Set a password to manage your requests and get updates.</p>

            <form action="{{ route('guest.register.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $name) }}" readonly
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-50 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $email) }}" readonly
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-50 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Phone</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $phone) }}" readonly
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-50 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Password *</label>
                        <input type="password" name="password" id="password" required autocomplete="new-password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Confirm Password *</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <input id="terms" name="terms" type="checkbox" class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:border-slate-700 dark:bg-slate-900" required>
                    <label for="terms" class="text-sm text-gray-600 dark:text-slate-300">
                        I agree to the <a href="{{ route('terms') }}" class="text-blue-600 hover:underline dark:text-blue-400">Terms & Conditions</a>.
                    </label>
                </div>
                @error('terms')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror

                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                    Create Account
                </button>

                <p class="text-center text-sm text-gray-500 dark:text-slate-400">
                    <a href="{{ route('track.show', $token) }}" class="text-blue-600 hover:underline dark:text-blue-400">Skip</a>
                    &mdash; track your request without an account.
                </p>
            </form>
        </div>
    </div>
</x-public-layout>
