{{-- Universal Quick Action Component --}}
@props([
    'href',
    'title',
    'subtitle',
    'gradient' => 'from-primary to-primaryDark',
    'hoverBorder' => 'hover:border-primary/30',
    'hoverText' => 'group-hover:text-primary',
    'bgGradient' => 'from-primary/10',
])

<a href="{{ $href }}"
    class="group relative overflow-hidden bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border border-gray-100 {{ $hoverBorder }} hover:-translate-y-0.5">
    <div
        class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br {{ $bgGradient }} to-transparent rounded-bl-full opacity-60 group-hover:opacity-100 transition-opacity duration-300">
    </div>
    <div class="relative">
        @if (isset($iconSlot))
            <div
                class="p-3 bg-gradient-to-br {{ $gradient }} rounded-xl w-fit mb-4 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                {{ $iconSlot }}
            </div>
        @elseif (isset($icon))
            <div
                class="p-3 bg-gradient-to-br {{ $gradient }} rounded-xl w-fit mb-4 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                {{ $icon }}
            </div>
        @endif
        <h4 class="font-bold text-gray-800 {{ $hoverText }} transition-colors">{{ $title }}</h4>
        <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
    </div>
</a>
