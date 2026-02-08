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
            'default' => 'py-3 px-6 text-gray-700',
            'print' => 'p-0 text-gray-900',
        ][$variant] ?? 'py-3 px-6 text-gray-700';
@endphp

<td {{ $attributes->merge(['class' => "$alignClass $variantClass"]) }}>
    {{ $slot }}
</td>
