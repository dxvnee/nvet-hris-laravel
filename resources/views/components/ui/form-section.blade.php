{{-- Form Section Component - wrapper for section-card --}}
@props(['title', 'icon' => null, 'bordered' => false])

<x-ui.section-card :title="$title" :icon="$icon" :variant="$bordered ? 'bordered' : 'simple'" {{ $attributes }}>
    {{ $slot }}
</x-ui.section-card>
