@props([
    'variant' => 'default', // default, print
])

@php
    $variantClasses = [
        'default' => 'w-full border-collapse',
        'print' => 'w-full text-sm',
    ];

    $classes = trim(
        ($variantClasses[$variant] ?? $variantClasses['default']) . ' ' . ($attributes->get('class') ?? ''),
    );
@endphp

<table {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</table>
