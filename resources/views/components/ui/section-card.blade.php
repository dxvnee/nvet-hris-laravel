{{-- Universal Section Card Component --}}
@props([
    'title' => null,
    'subtitle' => null,
    'description' => null,
    'icon' => null,
    'iconColor' => 'primary', // primary, blue, green, yellow, orange, purple, red
    'animation' => '',
    'variant' => 'default', // default, simple, bordered
])

@php
    $gradients = [
        'primary' => 'from-primary to-primaryDark',
        'blue' => 'from-blue-500 to-blue-600',
        'green' => 'from-green-500 to-green-600',
        'yellow' => 'from-yellow-500 to-yellow-600',
        'orange' => 'from-orange-500 to-orange-600',
        'purple' => 'from-purple-500 to-purple-600',
        'red' => 'from-red-500 to-red-600',
    ];
    $gradientClass = $gradients[$iconColor] ?? $gradients['primary'];
@endphp

@if ($variant === 'simple')
    {{-- Simple variant (like hari-libur/form-section) --}}
    <div {{ $attributes->merge(['class' => "bg-gray-50/50 rounded-2xl p-6 border border-gray-100 {$animation}"]) }}>
        @if ($title)
            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $title }}</h3>
        @endif
        @if ($description)
            <p class="text-sm text-gray-500 mb-4">{{ $description }}</p>
        @endif
        {{ $slot }}
    </div>
@elseif($variant === 'bordered')
    {{-- Bordered variant (like ui/form-section) --}}
    <div {{ $attributes->merge(['class' => "border-t pt-6 {$animation}"]) }}>
        <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
            @if ($icon)
                {!! $icon !!}
            @endif
            {{ $title }}
        </h4>
        {{ $slot }}
    </div>
@else
    {{-- Default variant (card with shadow) --}}
    <div
        {{ $attributes->merge(['class' => "bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100/80 {$animation}"]) }}>
        @if ($title || isset($header))
            <div class="flex items-center gap-3 mb-6">
                @if ($icon)
                    <div class="p-3 bg-gradient-to-br {{ $gradientClass }} rounded-xl shadow-lg">
                        {!! $icon !!}
                    </div>
                @elseif(isset($iconSlot))
                    <div class="p-3 bg-gradient-to-br {{ $gradientClass }} rounded-xl shadow-lg">
                        {{ $iconSlot }}
                    </div>
                @endif
                @if (isset($header))
                    {{ $header }}
                @else
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $title }}</h2>
                        @if ($subtitle)
                            <p class="text-gray-500 text-sm">{{ $subtitle }}</p>
                        @endif
                    </div>
                @endif
                @isset($headerAction)
                    <div class="ml-auto">
                        {{ $headerAction }}
                    </div>
                @endisset
            </div>
        @endif
        {{ $slot }}
    </div>
@endif
