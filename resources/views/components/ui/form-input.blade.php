{{-- Universal Form Input Component --}}
@props([
    'type' => 'text', // text, email, password, number, date, time, textarea
    'name' => 'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => null,
    'hint' => null,
    'prefix' => null,
    'prefixHtml' => null,
    'suffix' => null,
    'suffixHtml' => null,
    'xModel' => null,
    'min' => null,
    'max' => null,
    'step' => null,
    'rows' => 3, // for textarea
    'variant' => 'default', // default, rounded
])

@php
    $inputClasses = match ($variant) {
        'rounded'
            => 'w-full py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all',
        default
            => 'w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition-colors',
    };

    $paddingLeft =
        $prefix || $prefixHtml
            ? ($variant === 'rounded'
                ? 'pl-12'
                : 'pl-10')
            : ($variant === 'rounded'
                ? 'px-4'
                : 'px-3');
    $paddingRight =
        $suffix || $suffixHtml
            ? ($variant === 'rounded'
                ? 'pr-16'
                : 'pr-12')
            : ($variant === 'rounded'
                ? 'pr-4'
                : 'pr-3');
@endphp

<div class="space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        @if ($prefixHtml && $type !== 'textarea')
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">{!! $prefixHtml !!}</span>
        @elseif ($prefix && $type !== 'textarea')
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">{{ $prefix }}</span>
        @endif

        @if ($type === 'textarea')
            <textarea name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" rows="{{ $rows }}"
                @if ($xModel) x-model="{{ $xModel }}" @endif
                @if ($required) required @endif @if ($disabled) disabled @endif
                @if ($readonly) readonly @endif
                {{ $attributes->merge(['class' => "$inputClasses px-4 resize-none" . ($disabled || $readonly ? ' bg-gray-100 cursor-not-allowed' : '')]) }}>{{ old($name, $value) }}</textarea>
        @else
            <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
                value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
                @if ($xModel) x-model="{{ $xModel }}" @endif
                @if ($required) required @endif @if ($disabled) disabled @endif
                @if ($readonly) readonly @endif
                @if ($min !== null) min="{{ $min }}" @endif
                @if ($max !== null) max="{{ $max }}" @endif
                @if ($step !== null) step="{{ $step }}" @endif
                {{ $attributes->merge(['class' => "$inputClasses $paddingLeft $paddingRight" . ($disabled || $readonly ? ' bg-gray-100 cursor-not-allowed' : '')]) }}>
        @endif

        @if ($suffixHtml && $type !== 'textarea')
            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">{!! $suffixHtml !!}</span>
        @elseif ($suffix && $type !== 'textarea')
            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">{{ $suffix }}</span>
        @endif
    </div>

    @if ($hint)
        <p class="text-xs text-gray-500">{{ $hint }}</p>
    @endif

    @if ($error ?? $errors->first($name))
        <p class="text-red-500 text-sm">{{ $error ?? $errors->first($name) }}</p>
    @endif
</div>
