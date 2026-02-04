{{-- Lembur Stat Card Component --}}
@props([
    'value' => '0',
    'label' => '',
    'gradient' => 'from-blue-50 to-indigo-100',
    'iconBg' => 'bg-blue-500',
    'textColor' => 'text-blue-800',
    'iconSlot' => null,
])

<div class="bg-gradient-to-br {{ $gradient }} rounded-2xl p-6 shadow-sm border border-white/50">
    <div class="flex items-center gap-4">
        <div class="p-3 {{ $iconBg }} rounded-xl shadow-lg">
            @if ($iconSlot)
                {{ $iconSlot }}
            @else
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            @endif
        </div>
        <div>
            <p class="text-sm font-medium text-gray-600">{{ $label }}</p>
            <p class="text-2xl font-bold {{ $textColor }}">{{ $value }}</p>
        </div>
    </div>
</div>
