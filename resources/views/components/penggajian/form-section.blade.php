{{-- Penggajian Form Section - wrapper for ui/section-card --}}
@props(['title', 'subtitle' => null, 'icon' => null, 'iconColor' => 'blue', 'animationDelay' => 1])

<x-ui.section-card :title="$title" :subtitle="$subtitle" :icon="$icon" :iconColor="$iconColor" :animation="'animate-slide-up-delay-' . $animationDelay"
    {{ $attributes }}>
    @isset($headerAction)
        <x-slot name="headerAction">
            {{ $headerAction }}
        </x-slot>
    @endisset
    {{ $slot }}
</x-ui.section-card>
