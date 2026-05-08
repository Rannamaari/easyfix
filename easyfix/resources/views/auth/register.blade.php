<x-public-layout :wide="true">
    <x-slot name="title">
        Complete Sign Up - {{ config('app.name') }}
    </x-slot>

    <section class="py-4 sm:py-10">
        <div class="grid items-start gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:gap-16">
            <div class="hidden max-w-2xl lg:block">
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-blue-600 dark:text-blue-300">
                    Final Step
                </p>

                <h1 class="mt-4 text-4xl font-bold leading-tight text-gray-900 dark:text-white sm:text-5xl lg:text-6xl">
                    Finish your account and start managing repairs with ease.
                </h1>

                <p class="mt-5 max-w-xl text-base leading-8 text-gray-600 dark:text-slate-300 sm:text-lg">
                    Your phone is already verified. Add your details once so you can request services faster, track updates, and keep all your EasyFix jobs in one place.
                </p>

                <div class="mt-8 rounded-[2rem] border border-blue-100 bg-blue-50/80 p-5 text-sm text-blue-900 dark:border-blue-500/30 dark:bg-blue-500/10 dark:text-blue-100">
                    <p class="font-semibold">Verified phone number</p>
                    <p class="mt-2 text-lg font-bold">+960 {{ $signupVerification->phone }}</p>
                </div>

                <div class="mt-8 space-y-4">
                    <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                        <span>Save your details once</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                        <span>Track jobs and quotes easily</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-slate-200 sm:text-base">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">✓</span>
                        <span>Keep your address ready for the next booking</span>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-2xl lg:justify-self-end">
                <div class="rounded-[2rem] border border-gray-200 bg-white p-6 shadow-xl shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900 dark:shadow-black/20 sm:p-8">
                    <div class="mb-6 lg:hidden">
                        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white sm:text-3xl">Finish creating your account</h1>
                        <p class="mt-2 text-sm leading-7 text-gray-600 dark:text-slate-300">
                            Your phone number is verified. Add the rest of your details to complete your EasyFix profile.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register.complete.store', $signupVerification) }}" class="space-y-6">
                        @csrf

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="name" :value="__('Full Name')" />
                                <x-text-input id="name" class="mt-1 block h-11 w-full" type="text" name="name" :value="old('name', $signupVerification->name)" required autofocus autocomplete="name" placeholder="Your full name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="username" :value="__('Username')" />
                                <x-text-input id="username" class="mt-1 block h-11 w-full" type="text" name="username" :value="old('username', $signupVerification->username)" required autocomplete="nickname" placeholder="easyfix_user" />
                                <p class="mt-2 text-xs text-gray-500 dark:text-slate-400">Letters, numbers, and underscores only.</p>
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email Address (Optional)')" />
                            <x-text-input id="email" class="mt-1 block h-11 w-full" type="email" name="email" :value="old('email', $signupVerification->email)" autocomplete="email" placeholder="you@example.com" />
                            <p class="mt-2 text-xs text-gray-500 dark:text-slate-400">Optional if you prefer using only your phone number.</p>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="rounded-2xl border border-blue-100 bg-blue-50/80 px-4 py-4 text-sm text-blue-900 dark:border-blue-500/30 dark:bg-blue-500/10 dark:text-blue-100 lg:hidden">
                            Verified phone: <span class="font-semibold">+960 {{ $signupVerification->phone }}</span>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="address_type" :value="__('Address Type')" />
                                <select id="address_type" name="address_type" required class="mt-1 block h-11 w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                                    <option value="" disabled {{ old('address_type', $signupVerification->address_type) ? '' : 'selected' }}>Select address type</option>
                                    <option value="home" {{ old('address_type', $signupVerification->address_type) === 'home' ? 'selected' : '' }}>Home</option>
                                    <option value="work" {{ old('address_type', $signupVerification->address_type) === 'work' ? 'selected' : '' }}>Work</option>
                                    <option value="other" {{ old('address_type', $signupVerification->address_type) === 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <x-input-error :messages="$errors->get('address_type')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="address_line1" :value="__('Full Address')" />
                                <x-text-input id="address_line1" class="mt-1 block h-11 w-full" type="text" name="address_line1" :value="old('address_line1', $signupVerification->address_line1)" required autocomplete="address-line1" placeholder="House, road, island" />
                                <x-input-error :messages="$errors->get('address_line1')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="address_line2" :value="__('Additional Address Details (Optional)')" />
                            <x-text-input id="address_line2" class="mt-1 block h-11 w-full" type="text" name="address_line2" :value="old('address_line2', $signupVerification->address_line2)" autocomplete="address-line2" placeholder="Apartment, floor, landmark" />
                            <x-input-error :messages="$errors->get('address_line2')" class="mt-2" />
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="password" :value="__('Create Password')" />
                                <x-text-input id="password" class="mt-1 block h-11 w-full" type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="mt-1 block h-11 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <input id="terms" name="terms" type="checkbox" class="mt-1 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900" required>
                            <label for="terms" class="text-sm text-gray-600 dark:text-slate-300">
                                I agree to the <a href="{{ route('terms') }}" class="text-blue-600 hover:underline dark:text-blue-400">Terms & Conditions</a> and <a href="{{ route('privacy') }}" class="text-blue-600 hover:underline dark:text-blue-400">Privacy Policy</a>.
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('terms')" class="mt-2" />

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-6 py-4 text-sm font-semibold uppercase tracking-[0.22em] text-white transition hover:bg-slate-800 dark:bg-blue-600 dark:hover:bg-blue-500"
                        >
                            Create Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
