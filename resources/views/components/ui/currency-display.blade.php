{{-- Reusable Currency Display Component --}}
@props([
    'amount' => 0,
    'type' => 'default', // default, positive, negative
    'showSign' => false,
    'size' => 'md', // sm, md, lg
])

@php
    $types = [
        'default' => 'text-gray-800',
        'positive' => 'text-green-600',
        'negative' => 'text-red-600',
    ];

    $sizes = [
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg font-bold',
    ];

    $sign = $showSign ? ($type === 'positive' ? '+ ' : ($type === 'negative' ? '- ' : '')) : '';
    $displayAmount = abs($amount);
@endphp

<span {{ $attributes->merge(['class' => "{$types[$type]} {$sizes[$size]}"]) }}>
    {{ $sign }}Rp {{ number_format($displayAmount, 0, ',', '.') }}
</span>
