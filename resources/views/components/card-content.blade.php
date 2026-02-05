{{-- Card Content Component - Alias for ui/section-card --}}
@props([
    'animation' => 'animate-slide-up-delay-1',
])

<x-ui.section-card {{ $attributes->class([$animation]) }}>
    {{ $slot }}
</x-ui.section-card>
