{{-- Card Content Component - alias for ui/section-card --}}
@props([
    'animation' => 'animate-slide-up-delay-1',
])

<div {{ $attributes->merge(['class' => "bg-white rounded-2xl shadow-lg p-6 border border-gray-100 {$animation}"]) }}>
    {{ $slot }}
</div>
