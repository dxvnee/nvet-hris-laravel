{{-- Activity Item Component - Universal activity/timeline item --}}
@props([
    'user' => null,
    'title' => '',
    'subtitle' => '',
    'time' => '',
    'timeLabel' => '',
    'status' => 'default', // hadir, telat, izin, libur, default
    'showAvatar' => true,
])

@php
    $statusConfig = [
        'hadir' => ['border' => 'border-emerald-300', 'badge' => 'bg-emerald-100 text-emerald-600', 'icon' => '✓'],
        'telat' => ['border' => 'border-rose-300', 'badge' => 'bg-rose-100 text-rose-600', 'icon' => '⚠'],
        'izin' => ['border' => 'border-blue-300', 'badge' => 'bg-blue-100 text-blue-600', 'icon' => '📝'],
        'libur' => ['border' => 'border-indigo-300', 'badge' => 'bg-indigo-100 text-indigo-600', 'icon' => '🌴'],
        'default' => ['border' => 'border-gray-300', 'badge' => 'bg-gray-100 text-gray-600', 'icon' => '•'],
    ];
    $config = $statusConfig[$status] ?? $statusConfig['default'];
@endphp

<div
    {{ $attributes->merge(['class' => 'flex items-center gap-4 p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100 hover:border-primary/30 hover:shadow-md transition-all group']) }}>
    @if ($showAvatar && $user)
        <div class="relative">
            <x-ui.user-avatar :user="$user" size="md" :borderColor="$config['border']"
                class="group-hover:scale-105 transition-transform" />
            <span
                class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full flex items-center justify-center text-[10px] shadow-sm {{ $config['badge'] }}">
                {{ $config['icon'] }}
            </span>
        </div>
    @endif

    <div class="flex-1 min-w-0">
        <p class="text-sm font-semibold text-gray-800 truncate">{{ $title ?: $user->name ?? '' }}</p>
        <p class="text-xs text-gray-500">
            @if ($subtitle)
                {!! $subtitle !!}
            @else
                {{ $slot }}
            @endif
        </p>
    </div>

    <div class="text-right">
        <p class="text-sm font-bold text-gray-800">{{ $time }}</p>
        @if ($timeLabel)
            <p class="text-[10px] text-gray-400 uppercase tracking-wider">{{ $timeLabel }}</p>
        @endif
    </div>
</div>
