{{-- Universal Badge/Status Component --}}
@props([
    'type' => 'default', // Status types: hadir, tepat_waktu, telat, izin, libur, tidak_hadir
    // Color variants: success, warning, danger, info, default, primary, purple, green, orange
    'size' => 'sm', // sm, md, lg
    'icon' => null,
])

@php
    $sizeClasses = [
        'sm' => 'px-2 py-0.5 text-[11px]',
        'md' => 'px-2.5 py-1 text-xs',
        'lg' => 'px-3 py-1.5 text-sm',
    ];

    $typeClasses = [
        // Status types
        'hadir' => 'bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200',
        'tepat_waktu' => 'bg-green-100 text-green-700',
        'telat' => 'bg-red-100 text-red-700',
        'izin' => 'bg-amber-50 text-amber-600 ring-1 ring-amber-200',
        'libur' => 'bg-blue-50 text-blue-600 ring-1 ring-blue-200',
        'tidak_hadir' => 'bg-gray-50 text-gray-600 ring-1 ring-gray-200',

        // Color variants (compatible with dashboard/badge)
        'success' => 'bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200',
        'warning' => 'bg-amber-50 text-amber-600 ring-1 ring-amber-200',
        'danger' => 'bg-rose-50 text-rose-600 ring-1 ring-rose-200',
        'info' => 'bg-blue-50 text-blue-600 ring-1 ring-blue-200',
        'default' => 'bg-gray-50 text-gray-600 ring-1 ring-gray-200',
        'primary' => 'bg-primary text-white shadow-sm',
        'purple' => 'bg-purple-50 text-purple-600 ring-1 ring-purple-200',
        'green' => 'bg-green-50 text-green-600 ring-1 ring-green-200',
        'orange' => 'bg-orange-50 text-orange-600 ring-1 ring-orange-200',
    ];

    $baseClasses = 'inline-flex items-center gap-1 rounded-full font-semibold whitespace-nowrap leading-tight';
@endphp

<span
    {{ $attributes->merge(['class' => "$baseClasses " . ($sizeClasses[$size] ?? $sizeClasses['sm']) . ' ' . ($typeClasses[$type] ?? $typeClasses['default'])]) }}>
    @if ($icon)
        {!! $icon !!}
    @endif
    {{ $slot }}
</span>
