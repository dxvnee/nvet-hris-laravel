{{-- Display Field Component - Read-only display with optional status badge --}}
@props([
    'label',
    'value' => '',
    'status' => null, // 'danger', 'success', 'warning', 'info', null
    'statusText' => null,
    'hint' => null,
])

@php
    $statusClasses = match ($status) {
        'danger' => 'bg-red-100 text-red-700',
        'success' => 'bg-green-100 text-green-700',
        'warning' => 'bg-yellow-100 text-yellow-700',
        'info' => 'bg-blue-100 text-blue-700',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp

<div {{ $attributes }}>
    <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
    <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
        <div class="flex items-center justify-between">
            <span class="text-gray-700">{{ $value }}</span>
            @if ($status && $statusText)
                <span class="px-2 py-1 text-xs rounded-full font-medium {{ $statusClasses }}">
                    {{ $statusText }}
                </span>
            @endif
        </div>
        {{ $slot }}
    </div>
    @if ($hint)
        <p class="mt-1 text-xs text-gray-500">{{ $hint }}</p>
    @endif
</div>
