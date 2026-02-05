{{-- Rank Item Component - Universal ranking/leaderboard item --}}
@props([
    'rank' => 1,
    'user' => null,
    'title' => '',
    'subtitle' => '',
    'value' => '',
    'valueType' => 'danger', // danger, success, warning, info
    'showAvatar' => true,
    'hoverColor' => 'rose', // rose, emerald, blue, amber
])

@php
    $rankColors = [
        1 => 'bg-gradient-to-br from-rose-500 to-red-600 text-white',
        2 => 'bg-gradient-to-br from-orange-400 to-orange-500 text-white',
        3 => 'bg-gradient-to-br from-amber-400 to-yellow-500 text-white',
    ];
    $rankClass = $rankColors[$rank] ?? 'bg-gray-100 text-gray-600';

    $hoverColors = [
        'rose' => 'hover:border-rose-200',
        'emerald' => 'hover:border-emerald-200',
        'blue' => 'hover:border-blue-200',
        'amber' => 'hover:border-amber-200',
    ];
    $hoverClass = $hoverColors[$hoverColor] ?? 'hover:border-rose-200';
@endphp

<div
    {{ $attributes->merge(['class' => "flex items-center gap-3 p-3 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100 {$hoverClass} hover:shadow-sm transition-all group"]) }}>
    <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold shadow-sm {{ $rankClass }}">
        {{ $rank }}
    </span>

    @if ($showAvatar && $user)
        <x-ui.user-avatar :user="$user" size="sm" class="group-hover:scale-105 transition-transform" />
    @endif

    <div class="flex-1 min-w-0">
        <p class="text-sm font-semibold text-gray-800 truncate">{{ $title ?: $user->name ?? '' }}</p>
        @if ($subtitle)
            <p class="text-xs text-gray-500">{{ $subtitle }}</p>
        @endif
    </div>

    @if ($value)
        <x-ui.status-badge :type="$valueType" size="sm">{{ $value }}</x-ui.status-badge>
    @endif
</div>
