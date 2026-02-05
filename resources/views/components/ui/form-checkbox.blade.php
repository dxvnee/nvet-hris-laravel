{{-- Universal Form Checkbox Component --}}
@props([
    'name',
    'label',
    'value' => '1',
    'checked' => false,
    'color' => 'primary', // primary, red, blue, green, gray
    'description' => null,
    'xModel' => null,
    'size' => 'md', // sm, md, lg
    'variant' => 'inline', // inline, stacked
])

@php
    $colorClasses = [
        'primary' => 'text-primary focus:ring-primary/20',
        'red' => 'text-red-500 focus:ring-red-500/20',
        'blue' => 'text-blue-500 focus:ring-blue-500/20',
        'green' => 'text-green-500 focus:ring-green-500/20',
        'gray' => 'text-gray-500 focus:ring-gray-500/20',
    ];

    $sizeClasses = [
        'sm' => 'h-4 w-4',
        'md' => 'h-4 w-4',
        'lg' => 'h-5 w-5',
    ];
@endphp

@if ($variant === 'stacked')
    <label class="flex items-start gap-3 cursor-pointer">
        <div class="flex-shrink-0 pt-0.5">
            <input type="checkbox" name="{{ $name }}" value="{{ $value }}"
                @if ($xModel) x-model="{{ $xModel }}" @endif
                {{ $checked || old($name) ? 'checked' : '' }}
                {{ $attributes->merge(['class' => "{$sizeClasses[$size]} border-gray-300 rounded {$colorClasses[$color]} transition-all"]) }}>
        </div>
        <div>
            <p class="font-medium text-gray-800">{{ $label }}</p>
            @if ($description)
                <p class="text-sm text-gray-500 mt-0.5">{{ $description }}</p>
            @endif
        </div>
    </label>
@else
    <div class="space-y-1">
        <div class="flex items-center">
            <input type="hidden" name="{{ $name }}" value="0">
            <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}"
                @if ($xModel) x-model="{{ $xModel }}" @endif
                {{ $checked || old($name) ? 'checked' : '' }}
                {{ $attributes->merge(['class' => "{$sizeClasses[$size]} border-gray-300 rounded {$colorClasses[$color]}"]) }}>
            <label for="{{ $name }}" class="ml-2 block text-sm text-gray-900">
                {{ $label }}
            </label>
        </div>
        @if ($description)
            <p class="text-xs text-gray-500 ml-6">{{ $description }}</p>
        @endif
    </div>
@endif
