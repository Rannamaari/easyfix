@props(['class' => 'h-16 w-auto'])

@php
    $logoPath = public_path('images/easyfix-logo.png');
    $logoUrl = file_exists($logoPath)
        ? asset('images/easyfix-logo.png') . '?v=' . filemtime($logoPath)
        : null;
@endphp

@if($logoUrl)
    <img src="{{ $logoUrl }}" alt="EasyFix" loading="eager" decoding="async" {{ $attributes->merge(['class' => $class]) }}>
@else
    <span {{ $attributes->merge(['class' => 'text-lg font-semibold text-gray-900 dark:text-white']) }}>
        EasyFix
    </span>
@endif
