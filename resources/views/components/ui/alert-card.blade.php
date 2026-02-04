{{-- Universal Alert/Status Card Component --}}
@props([
    'type' => 'info', // info, success, warning, danger, primary
    'title' => null,
    'subtitle' => null,
    'iconName' => null, // check, sun, document, exclamation, clock, x-circle
    'actionHref' => null,
    'actionText' => null,
    'variant' => 'default', // default, horizontal, centered
])

@php
    $styles = [
        'info' => [
            'bg' => 'bg-gradient-to-r from-blue-50 to-indigo-50',
            'border' => 'border-blue-100',
            'iconBg' => 'bg-gradient-to-br from-blue-500 to-indigo-600',
            'title' => 'text-blue-700',
            'text' => 'text-blue-600',
            'badge' => 'bg-blue-100 text-blue-700',
        ],
        'success' => [
            'bg' => 'bg-gradient-to-r from-emerald-50 to-green-50',
            'border' => 'border-emerald-100',
            'iconBg' => 'bg-gradient-to-br from-emerald-500 to-green-600',
            'title' => 'text-emerald-700',
            'text' => 'text-emerald-600',
            'badge' => 'bg-emerald-100 text-emerald-700',
        ],
        'warning' => [
            'bg' => 'bg-gradient-to-r from-amber-50 to-yellow-50',
            'border' => 'border-amber-100',
            'iconBg' => 'bg-gradient-to-br from-amber-500 to-yellow-500',
            'title' => 'text-amber-700',
            'text' => 'text-amber-600',
            'badge' => 'bg-amber-100 text-amber-700',
        ],
        'danger' => [
            'bg' => 'bg-gradient-to-r from-red-50 to-rose-50',
            'border' => 'border-red-100',
            'iconBg' => 'bg-gradient-to-br from-red-500 to-rose-600',
            'title' => 'text-red-700',
            'text' => 'text-red-600',
            'badge' => 'bg-red-100 text-red-700',
        ],
        'primary' => [
            'bg' => 'bg-gradient-to-r from-primary/10 to-primaryDark/10',
            'border' => 'border-primary/20',
            'iconBg' => 'bg-gradient-to-br from-primary to-primaryDark',
            'title' => 'text-primary',
            'text' => 'text-primaryDark',
            'badge' => 'bg-primary/10 text-primary',
        ],
    ];

    $icons = [
        'check' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>',
        'sun' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>',
        'document' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>',
        'exclamation' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>',
        'clock' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'x-circle' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'login' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>',
        'logout' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>',
    ];

    $style = $styles[$type] ?? $styles['info'];
    $iconPath = $icons[$iconName] ?? $icons['check'];
@endphp

@if ($variant === 'centered')
    {{-- Centered variant (for belum absen, empty states with action) --}}
    <div
        {{ $attributes->merge(['class' => "text-center py-10 px-4 {$style['bg']} rounded-2xl border {$style['border']}"]) }}>
        <div
            class="w-24 h-24 {{ $style['iconBg'] }} rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg">
            @if (isset($icon))
                {{ $icon }}
            @else
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $iconPath !!}
                </svg>
            @endif
        </div>
        @if ($title)
            <h4 class="text-2xl font-bold {{ $style['title'] }} mb-2">{{ $title }}</h4>
        @endif
        @if ($subtitle)
            <p class="text-gray-600 mb-6">{{ $subtitle }}</p>
        @endif
        {{ $slot }}
        @if ($actionHref)
            <a href="{{ $actionHref }}"
                class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-primary to-primaryDark text-white font-bold rounded-xl hover:shadow-xl transition-all hover:scale-105">
                <x-icons.clock class="w-5 h-5" />
                {{ $actionText ?? 'Lanjutkan' }}
            </a>
        @endif
    </div>
@else
    {{-- Default/Horizontal variant --}}
    <div
        {{ $attributes->merge(['class' => "flex flex-col md:flex-row items-center gap-6 p-6 {$style['bg']} rounded-2xl border {$style['border']}"]) }}>
        <div class="w-20 h-20 rounded-2xl {{ $style['iconBg'] }} flex items-center justify-center shadow-lg shrink-0">
            @if (isset($icon))
                {{ $icon }}
            @else
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $iconPath !!}
                </svg>
            @endif
        </div>
        <div class="flex-1 text-center md:text-left">
            @if ($title)
                <h4 class="text-xl font-bold {{ $style['title'] }} mb-1">{{ $title }}</h4>
            @endif
            @if ($subtitle)
                <p class="text-gray-600">{{ $subtitle }}</p>
            @endif
            {{ $slot }}
        </div>
        @if (isset($extra))
            <div class="shrink-0">
                {{ $extra }}
            </div>
        @endif
    </div>
@endif
