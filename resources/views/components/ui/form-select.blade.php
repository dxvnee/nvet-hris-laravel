{{-- Universal Form Select Component --}}
@props([
    'name',
    'label' => null,
    'value' => null,
    'selected' => null, // alias for value
    'options' => [],
    'placeholder' => '-- Pilih --',
    'required' => false,
    'disabled' => false,
    'error' => null,
    'variant' => 'default', // default, inline, rounded
    'onchange' => null,
])

@php
    $selectedValue = $value ?? $selected;

    $selectClasses = match ($variant) {
        'inline'
            => 'px-4 py-2 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all bg-white',
        'rounded'
            => 'w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all bg-white',
        default
            => 'w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition-colors',
    };
@endphp

@if ($variant === 'inline')
    <div class="flex items-center gap-2">
        @if ($label)
            <label for="{{ $name }}"
                class="text-sm font-medium text-gray-700 whitespace-nowrap">{{ $label }}</label>
        @endif
        <select name="{{ $name }}" id="{{ $name }}" {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }} @if ($onchange) onchange="{{ $onchange }}" @endif
            {{ $attributes->merge(['class' => $selectClasses . ($disabled ? ' bg-gray-100 cursor-not-allowed' : '')]) }}>
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" {{ old($name, $selectedValue) == $optionValue ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
            {{ $slot }}
        </select>
    </div>
@else
    <div class="space-y-2">
        @if ($label)
            <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
                {{ $label }}
                @if ($required)
                    <span class="text-red-500">*</span>
                @endif
            </label>
        @endif

        <select name="{{ $name }}" id="{{ $name }}" {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }} @if ($onchange) onchange="{{ $onchange }}" @endif
            {{ $attributes->merge(['class' => $selectClasses . ($disabled ? ' bg-gray-100 cursor-not-allowed' : '')]) }}>
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}"
                    {{ old($name, $selectedValue) == $optionValue ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
            {{ $slot }}
        </select>

        @if ($error ?? $errors->first($name))
            <p class="text-red-500 text-sm">{{ $error ?? $errors->first($name) }}</p>
        @endif
    </div>
@endif
