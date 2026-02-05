{{-- User Avatar Component --}}
@props([
    'user',
    'size' => 'md', // sm, md, lg, xl
    'showInfo' => false,
    'borderColor' => null, // custom border color class
    'rounded' => 'full', // full, xl, lg
])

@php
    $sizeClasses = [
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-16 h-16',
        'xl' => 'w-20 h-20',
    ];

    $sizeParams = [
        'sm' => 32,
        'md' => 40,
        'lg' => 64,
        'xl' => 80,
    ];

    $roundedClasses = [
        'full' => 'rounded-full',
        'xl' => 'rounded-xl',
        'lg' => 'rounded-lg',
    ];

    $avatarUrl = $user->avatar
        ? asset('storage/' . $user->avatar)
        : 'https://ui-avatars.com/api/?name=' .
            urlencode($user->name) .
            '&color=7F9CF5&background=EBF4FF&size=' .
            $sizeParams[$size];

    $baseClasses = "{$sizeClasses[$size]} {$roundedClasses[$rounded]} object-cover";
    $borderClasses = $borderColor ? "border-2 {$borderColor} shadow-sm" : '';
@endphp

@if ($showInfo)
    <div class="flex items-center gap-3">
        <img src="{{ $avatarUrl }}" alt="{{ $user->name }}"
            {{ $attributes->merge(['class' => "{$baseClasses} {$borderClasses}"]) }}>
        <div>
            <p class="font-semibold text-gray-900">{{ $user->name }}</p>
            @if ($user->jabatan)
                <p class="text-sm text-gray-500">{{ $user->jabatan }}</p>
            @endif
        </div>
    </div>
@else
    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}"
        {{ $attributes->merge(['class' => "{$baseClasses} {$borderClasses}"]) }}>
@endif
