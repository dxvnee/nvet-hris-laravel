@props([
    'title',
    'subtitle' => null,
    'icon' => null,
    'iconColor' => 'blue',
    'animationDelay' => 1,
])

@php
    $gradientClass = match($iconColor) {
        'blue' => 'from-blue-500 to-blue-600',
        'green' => 'from-green-500 to-green-600',
        'yellow' => 'from-yellow-500 to-yellow-600',
        'orange' => 'from-orange-500 to-orange-600',
        'purple' => 'from-purple-500 to-purple-600',
        'red' => 'from-red-500 to-red-600',
        'primary' => 'from-primary to-primaryDark',
        default => 'from-blue-500 to-blue-600',
    };
@endphp

<div {{ $attributes->merge(['class' => "bg-white rounded-2xl shadow-xl p-8 animate-slide-up-delay-{$animationDelay}"]) }}>
    <div class="flex items-center gap-3 mb-6">
        @if($icon)
            <div class="p-3 bg-gradient-to-br {{ $gradientClass }} rounded-xl shadow-lg">
                {!! $icon !!}
            </div>
        @endif
        <div>
            <h2 class="text-xl font-bold text-gray-800">{{ $title }}</h2>
            @if($subtitle)
                <p class="text-gray-500 text-sm">{{ $subtitle }}</p>
            @endif
        </div>
        @isset($headerAction)
            <div class="ml-auto">
                {{ $headerAction }}
            </div>
        @endisset
    </div>

    {{ $slot }}
</div>
