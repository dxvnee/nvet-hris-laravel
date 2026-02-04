@props([
    'href',
    'label' => 'Kembali ke Daftar Penggajian',
])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors animate-slide-up']) }}>
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
    {{ $label }}
</a>
