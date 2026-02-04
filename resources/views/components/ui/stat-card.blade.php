{{-- Universal Stat Card Component --}}
@props([
    'value',
    'label' => null,
    'title' => null, // alias for label (backward compatible)
    'color' => 'primary', // primary, blue, green, orange, purple, red, yellow
    'icon' => null, // SVG path string
    'iconName' => 'chart', // chart, calendar, clock, briefcase, users, wallet
    'variant' => 'default', // default, gradient, compact
    'animation' => null, // animate-slide-up-delay-1, etc.
    'delay' => null, // 1-5 for animate-slide-up-delay-X
    'gradient' => null, // custom gradient override
    'hoverBorder' => null, // custom hover border
    'valueColor' => null, // custom value color
    'pulse' => false, // pulse animation
])

@php
    $colorConfig = [
        'primary' => [
            'gradient' => 'from-primary to-primaryDark',
            'bg' => 'from-primary/5 to-primary/10',
            'border' => 'border-primary/20',
            'text' => 'text-primary',
            'value' => 'bg-gradient-to-r from-primary to-primaryDark bg-clip-text text-transparent',
        ],
        'blue' => [
            'gradient' => 'from-blue-500 to-blue-600',
            'bg' => 'from-blue-50 to-blue-100',
            'border' => 'border-blue-200',
            'text' => 'text-blue-700',
            'value' => 'text-blue-800',
        ],
        'green' => [
            'gradient' => 'from-green-500 to-green-600',
            'bg' => 'from-green-50 to-green-100',
            'border' => 'border-green-200',
            'text' => 'text-green-700',
            'value' => 'text-green-800',
        ],
        'orange' => [
            'gradient' => 'from-orange-500 to-orange-600',
            'bg' => 'from-orange-50 to-orange-100',
            'border' => 'border-orange-200',
            'text' => 'text-orange-700',
            'value' => 'text-orange-800',
        ],
        'purple' => [
            'gradient' => 'from-purple-500 to-purple-600',
            'bg' => 'from-purple-50 to-purple-100',
            'border' => 'border-purple-200',
            'text' => 'text-purple-700',
            'value' => 'text-purple-800',
        ],
        'red' => [
            'gradient' => 'from-red-500 to-red-600',
            'bg' => 'from-red-50 to-red-100',
            'border' => 'border-red-200',
            'text' => 'text-red-700',
            'value' => 'text-red-800',
        ],
        'yellow' => [
            'gradient' => 'from-yellow-500 to-yellow-600',
            'bg' => 'from-yellow-50 to-yellow-100',
            'border' => 'border-yellow-200',
            'text' => 'text-yellow-700',
            'value' => 'text-yellow-800',
        ],
    ];

    $icons = [
        'chart' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>',
        'calendar' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>',
        'clock' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'briefcase' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>',
        'users' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>',
        'wallet' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>',
        'check' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
    ];

    $config = $colorConfig[$color] ?? $colorConfig['primary'];
    $iconPath = $icon ?? ($icons[$iconName] ?? $icons['chart']);

    // Handle aliases and overrides
    $displayLabel = $label ?? ($title ?? 'Stat');
    $animationClass = $animation ?? ($delay ? "animate-slide-up-delay-{$delay}" : '');
    $customGradient = $gradient ?? $config['gradient'];
    $customHoverBorder = $hoverBorder ?? 'hover:border-primary/20';
    $customValueColor = $valueColor ?? $config['value'];
@endphp

@if ($variant === 'gradient')
    {{-- Gradient variant (like lembur/stat-card) --}}
    <div
        {{ $attributes->merge(['class' => "bg-gradient-to-br {$config['bg']} rounded-2xl p-6 shadow-sm border border-white/50 {$animationClass}"]) }}>
        <div class="flex items-center gap-4">
            <div
                class="p-3 bg-gradient-to-br {{ $customGradient }} rounded-xl shadow-lg {{ $pulse ? 'animate-pulse' : '' }}">
                @if (isset($iconSlot))
                    {{ $iconSlot }}
                @else
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $iconPath !!}
                    </svg>
                @endif
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">{{ $displayLabel }}</p>
                <p class="text-2xl font-bold {{ $customValueColor }}">{{ $value }}</p>
            </div>
        </div>
    </div>
@elseif($variant === 'compact')
    {{-- Compact variant (like profile/stat-card) --}}
    <div
        {{ $attributes->merge(['class' => "bg-gradient-to-r {$config['bg']} rounded-xl p-4 border {$config['border']} {$animationClass}"]) }}>
        <div class="flex items-center gap-3">
            <div class="p-2 bg-gradient-to-br {{ $customGradient }} rounded-lg {{ $pulse ? 'animate-pulse' : '' }}">
                @if (isset($iconSlot))
                    {{ $iconSlot }}
                @else
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $iconPath !!}
                    </svg>
                @endif
            </div>
            <div>
                <p class="text-sm font-medium {{ $config['text'] }}">{{ $displayLabel }}</p>
                <p class="text-2xl font-bold {{ $customValueColor }}">{{ $value }}</p>
            </div>
        </div>
    </div>
@else
    {{-- Default variant (like dashboard/stat-card) --}}
    <div
        {{ $attributes->merge(['class' => "group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 p-5 lg:p-6 border border-gray-100 {$customHoverBorder} {$animationClass}"]) }}>
        <div class="flex items-center justify-between mb-4">
            <div
                class="p-3 bg-gradient-to-br {{ $customGradient }} rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300 {{ $pulse ? 'animate-pulse' : '' }}">
                @if (isset($iconSlot))
                    {{ $iconSlot }}
                @else
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $iconPath !!}
                    </svg>
                @endif
            </div>
            <div class="text-right">
                <span class="text-3xl lg:text-4xl font-bold {{ $customValueColor }}">{{ $value }}</span>
            </div>
        </div>
        <h3 class="text-xs lg:text-sm font-semibold text-gray-500 uppercase tracking-wider">{{ $displayLabel }}</h3>
        @if (isset($footer))
            <div class="mt-3">{{ $footer }}</div>
        @endif
    </div>
@endif
