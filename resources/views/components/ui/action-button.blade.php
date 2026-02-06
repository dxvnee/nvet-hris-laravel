{{-- Universal Action Button Component --}}
@props([
    'type' => 'button', // button, submit, link
    'variant' => 'primary', // primary, secondary, success, danger, warning, ghost, hadir, pulang, izin, lembur
    'size' => 'md', // sm, md, lg, xl
    'href' => null,
    'icon' => null,
    'iconName' => null, // check, logout, exclamation, clock, camera, etc
    'disabled' => false,
    'onclick' => null,
])

@php
    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-xs gap-1.5',
        'md' => 'px-4 py-2 text-sm gap-2',
        'lg' => 'px-6 py-3 text-base gap-3',
        'xl' => 'px-6 py-4 text-base gap-3 w-full', // Full width for absensi buttons
    ];

    $variantClasses = [
        // Standard variants
        'primary' =>
            'btn-primary',
        'secondary' =>
            'bg-white text-gray-700 border border-gray-200 hover:border-primary hover:text-primary shadow-sm hover:shadow-md',
        'success' =>
            'bg-gradient-to-r from-green-500 to-green-600 text-white hover:from-green-600 hover:to-green-700 shadow-lg hover:shadow-xl',
        'danger' =>
            'bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 shadow-lg hover:shadow-xl',
        'warning' =>
            'bg-gradient-to-r from-yellow-500 to-yellow-600 text-white hover:from-yellow-600 hover:to-yellow-700 shadow-lg hover:shadow-xl',
        'ghost' => 'bg-transparent text-gray-600 hover:text-primary hover:bg-gray-100',

        // Icon variants
        'icon-primary' => 'p-2 bg-primary/10 hover:bg-primary/20 text-primary rounded-lg',
        'icon-danger' => 'p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg',
        'icon-success' => 'p-2 bg-green-100 hover:bg-green-200 text-green-600 rounded-lg',
        'icon-info' => 'p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg',
        'icon-warning' => 'p-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 rounded-lg',

        // Absensi variants
        'hadir' =>
            'bg-gradient-to-r from-emerald-500 to-green-600 text-white hover:from-emerald-600 hover:to-green-700 shadow-lg hover:shadow-xl transform hover:scale-[1.02]',
        'pulang' =>
            'bg-gradient-to-r from-blue-500 to-indigo-600 text-white hover:from-blue-600 hover:to-indigo-700 shadow-lg hover:shadow-xl transform hover:scale-[1.02]',
        'izin' =>
            'bg-gradient-to-r from-amber-500 to-yellow-600 text-white hover:from-amber-600 hover:to-yellow-700 shadow-lg hover:shadow-xl transform hover:scale-[1.02]',
        'lembur' =>
            'bg-gradient-to-r from-orange-500 to-orange-600 text-white hover:from-orange-600 hover:to-orange-700 shadow-lg hover:shadow-xl transform hover:scale-[1.02]',
    ];

    $icons = [
        'check' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>',
        'logout' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>',
        'exclamation' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>',
        'clock' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'camera' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>',
        'plus' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>',
        'pencil' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>',
        'trash' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>',
    ];

    $baseClasses = 'inline-flex items-center justify-center font-bold rounded-2xl transition-all duration-300';
    $disabledClasses = 'bg-gray-300 cursor-not-allowed text-gray-500 shadow-none transform-none';

    $classes = $disabled
        ? "{$baseClasses} {$sizeClasses[$size]} {$disabledClasses}"
        : "{$baseClasses} {$sizeClasses[$size]} {$variantClasses[$variant]}";

    $iconPath = $iconName ? $icons[$iconName] ?? null : null;
@endphp

@if ($type === 'link' && $href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            {!! $icon !!}
        @elseif($iconPath)
            <div class="p-2 bg-white/20 rounded-xl">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $iconPath !!}</svg>
            </div>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" @if ($onclick) onclick="{{ $onclick }}" @endif
        {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            {!! $icon !!}
        @elseif($iconPath)
            <div class="p-2 bg-white/20 rounded-xl group-hover:scale-110 transition-transform">
                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">{!! $iconPath !!}</svg>
            </div>
        @endif
        {{ $slot }}
    </button>
@endif
