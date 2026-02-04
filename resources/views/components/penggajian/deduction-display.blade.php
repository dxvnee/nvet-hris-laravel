@props([
    'label',
    'xText' => null,
    'value' => null,
    'variant' => 'red', // red, green, yellow
])

@php
    $classes = match($variant) {
        'red' => 'bg-red-50 border-red-200 text-red-700',
        'green' => 'bg-green-50 border-green-200 text-green-700',
        'yellow' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
        default => 'bg-gray-50 border-gray-200 text-gray-700',
    };
    $prefix = match($variant) {
        'red' => '-',
        'green' => '+',
        'yellow' => '+',
        default => '',
    };
@endphp

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
    <div class="rounded-xl px-4 py-3 border {{ $classes }}">
        <p class="font-bold text-lg">
            {{ $prefix }} Rp 
            @if($xText)
                <span x-text="{{ $xText }}"></span>
            @else
                {{ number_format($value, 0, ',', '.') }}
            @endif
        </p>
    </div>
    {{ $slot }}
</div>
