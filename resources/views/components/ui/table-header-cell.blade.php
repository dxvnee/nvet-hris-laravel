@props([
    'align' => 'left', // left, center, right
    'variant' => 'default', // default, print
])

@php
    $alignClass =
        [
            'left' => 'text-left',
            'center' => 'text-center',
            'right' => 'text-right',
        ][$align] ?? 'text-left';

    $variantClass =
        [
            'default' => 'py-3 px-4 font-semibold text-gray-600',
            'print' => 'p-0 font-semibold text-gray-900',
        ][$variant] ?? 'py-3 px-4 font-semibold text-gray-600';
@endphp

<th {{ $attributes->merge(['class' => "$alignClass $variantClass"]) }}>
    {{ $slot }}
</th>
