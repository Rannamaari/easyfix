<x-public-layout>
    <x-slot name="title">Privacy Policy - {{ config('app.name') }}</x-slot>

    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">
        <div class="max-w-3xl space-y-4">
            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-blue-600 dark:text-blue-300">Privacy Policy</p>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">How EasyFix handles your information</h1>
            <p class="text-base text-gray-600 dark:text-slate-300">
                We collect the contact details you share with us so we can verify your account, send service updates, and deliver the support you request.
            </p>

            <div class="space-y-4 text-sm leading-7 text-gray-600 dark:text-slate-300">
                <p>
                    Phone numbers are used for OTP verification, job updates, and urgent service communication. If you add an email address, we may use it for receipts, service follow-ups, and account support.
                </p>
                <p>
                    We do not sell your personal information. Access is limited to trusted EasyFix staff and providers who need it to fulfill your job request.
                </p>
                <p>
                    If you need your account details updated or removed, contact our team and we will help you through the request.
                </p>
            </div>
        </div>
    </div>
</x-public-layout>
