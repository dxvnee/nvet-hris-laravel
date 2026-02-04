{{-- Profile Stat Card Component --}}
@props([
    'value' => '0',
    'label' => '',
    'color' => 'blue', // blue, green, orange, purple
    'icon' => 'calendar', // calendar, clock, briefcase
])

@php
    $colorConfig = [
        'blue' => [
            'gradient' => 'from-blue-50 to-blue-100',
            'border' => 'border-blue-200',
            'bg' => 'bg-blue-500',
            'text' => 'text-blue-700',
            'value' => 'text-blue-800',
        ],
        'green' => [
            'gradient' => 'from-green-50 to-green-100',
            'border' => 'border-green-200',
            'bg' => 'bg-green-500',
            'text' => 'text-green-700',
            'value' => 'text-green-800',
        ],
        'orange' => [
            'gradient' => 'from-orange-50 to-orange-100',
            'border' => 'border-orange-200',
            'bg' => 'bg-orange-500',
            'text' => 'text-orange-700',
            'value' => 'text-orange-800',
        ],
        'purple' => [
            'gradient' => 'from-purple-50 to-purple-100',
            'border' => 'border-purple-200',
            'bg' => 'bg-purple-500',
            'text' => 'text-purple-700',
            'value' => 'text-purple-800',
        ],
    ];
    $config = $colorConfig[$color] ?? $colorConfig['blue'];

    $icons = [
        'calendar' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>',
        'clock' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'briefcase' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>',
    ];
@endphp

<div class="bg-gradient-to-r {{ $config['gradient'] }} rounded-xl p-4 border {{ $config['border'] }}">
    <div class="flex items-center gap-3">
        <div class="p-2 {{ $config['bg'] }} rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icons[$icon] ?? $icons['calendar'] !!}
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium {{ $config['text'] }}">{{ $label }}</p>
            <p class="text-2xl font-bold {{ $config['value'] }}">{{ $value }}</p>
        </div>
    </div>
</div>
