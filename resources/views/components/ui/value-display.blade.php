{{-- Value Display Component - Display formatted value with variant styling --}}
@props([
    'label' => null,
    'value' => null,
    'xText' => null,
    'variant' => 'default', // default, red, green, yellow, blue
    'showSign' => false,
    'size' => 'lg', // sm, md, lg
])

@php
    $variantClasses = [
        'default' => 'bg-gray-50 border-gray-200 text-gray-700',
        'red' => 'bg-red-50 border-red-200 text-red-700',
        'green' => 'bg-green-50 border-green-200 text-green-700',
        'yellow' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
        'blue' => 'bg-blue-50 border-blue-200 text-blue-700',
    ];
    $classes = $variantClasses[$variant] ?? $variantClasses['default'];

    $prefix = '';
    if ($showSign) {
        $prefix = match ($variant) {
            'red' => '-',
            'green', 'yellow' => '+',
            default => '',
        };
    }

    $sizeClasses = match ($size) {
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg',
        default => 'text-lg',
    };
@endphp

<div {{ $attributes }}>
    @if ($label)
        <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
    @endif
    <div class="rounded-xl px-4 py-3 border {{ $classes }}">
        <p class="font-bold {{ $sizeClasses }}">
            {{ $prefix }} Rp
            @if ($xText)
                <span x-text="{{ $xText }}"></span>
            @else
                {{ number_format($value, 0, ',', '.') }}
            @endif
        </p>
    </div>
    {{ $slot }}
</div>
