@props([
    'id' => 'theme-toggle',
])

<button
    type="button"
    id="{{ $id }}"
    data-theme-toggle
    aria-label="Toggle theme"
    class="inline-flex items-center justify-center rounded-lg p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800 dark:focus-visible:ring-offset-slate-950"
>
    <svg data-theme-icon="sun" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2m0 14v2m9-9h-2M5 12H3m14.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-11.314 1.414 1.414m10.314 10.314 1.414 1.414M12 7a5 5 0 100 10 5 5 0 000-10z" />
    </svg>
    <svg data-theme-icon="moon" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
    </svg>
</button>
