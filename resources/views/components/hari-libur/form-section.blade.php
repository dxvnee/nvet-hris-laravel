{{-- Hari Libur Form Section Component --}}
@props([
    'title' => null,
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'bg-gray-50/50 rounded-2xl p-6 border border-gray-100']) }}>
    @if ($title)
        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $title }}</h3>
    @endif
    @if ($description)
        <p class="text-sm text-gray-500 mb-4">{{ $description }}</p>
    @endif
    {{ $slot }}
</div>
