{{-- Universal Empty State Component --}}
@props([
    'message' => 'Belum ada data',
    'description' => null,
    'icon' => 'clipboard', // clipboard, users, search, document, calendar, clock, folder
    'actionHref' => null,
    'actionLabel' => null,
    'size' => 'md', // sm, md, lg
])

@php
    $icons = [
        'clipboard' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>',
        'users' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>',
        'search' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>',
        'document' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>',
        'calendar' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>',
        'clock' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'folder' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>',
    ];

    $sizes = [
        'sm' => ['wrapper' => 'py-6', 'icon' => 'w-10 h-10', 'iconWrapper' => 'w-16 h-16', 'text' => 'text-sm'],
        'md' => ['wrapper' => 'py-10', 'icon' => 'w-10 h-10', 'iconWrapper' => 'w-20 h-20', 'text' => 'text-base'],
        'lg' => ['wrapper' => 'py-16', 'icon' => 'w-12 h-12', 'iconWrapper' => 'w-24 h-24', 'text' => 'text-lg'],
    ];
    $sizeConfig = $sizes[$size] ?? $sizes['md'];
@endphp

<div {{ $attributes->merge(['class' => "text-center {$sizeConfig['wrapper']}"]) }}>
    <div class="{{ $sizeConfig['iconWrapper'] }} mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
        <svg class="{{ $sizeConfig['icon'] }} text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {!! $icons[$icon] ?? $icons['clipboard'] !!}
        </svg>
    </div>
    <p class="text-gray-500 font-medium {{ $sizeConfig['text'] }}">{{ $message }}</p>
    @if ($description)
        <p class="text-sm text-gray-400 mt-1">{{ $description }}</p>
    @endif

    @if ($actionHref && $actionLabel)
        <a href="{{ $actionHref }}"
            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-primary text-white font-medium rounded-xl hover:bg-primaryDark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            {{ $actionLabel }}
        </a>
    @endif

    {{ $slot }}
</div>
