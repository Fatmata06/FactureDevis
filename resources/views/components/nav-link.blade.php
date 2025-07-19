@props([
    'active' => false,
])

@php
    $baseClasses = 'flex items-center gap-2 px-4 py-2 text-sm font-medium rounded transition-colors duration-200';
    $activeClasses = 'bg-blue-100 text-blue-700 dark:bg-gray-700 dark:text-white';
    $inactiveClasses = 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800';

    $classes = $active ? "$baseClasses $activeClasses" : "$baseClasses $inactiveClasses";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
