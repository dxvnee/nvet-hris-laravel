{{-- Universal History/Timeline Card Component --}}
@props([
    'date' => null,
    'dayName' => null,
    'status' => 'default',
    'primaryTime' => null,
    'primaryLabel' => 'Masuk',
    'secondaryTime' => null,
    'secondaryLabel' => 'Pulang',
    'tertiaryValue' => null,
    'tertiaryLabel' => 'Total',
    'description' => null,
])

@php
    $statusConfig = [
        'hadir' => [
            'accent' => 'bg-emerald-500',
            'iconBg' => 'bg-emerald-50',
            'iconColor' => 'text-emerald-600',
            'icon' => 'check',
        ],
        'telat' => [
            'accent' => 'bg-rose-500',
            'iconBg' => 'bg-rose-50',
            'iconColor' => 'text-rose-600',
            'icon' => 'clock',
        ],
        'izin' => [
            'accent' => 'bg-amber-500',
            'iconBg' => 'bg-amber-50',
            'iconColor' => 'text-amber-600',
            'icon' => 'document-text',
        ],
        'libur' => [
            'accent' => 'bg-blue-500',
            'iconBg' => 'bg-blue-50',
            'iconColor' => 'text-blue-600',
            'icon' => 'sun',
        ],
        'tidak_hadir' => [
            'accent' => 'bg-gray-400',
            'iconBg' => 'bg-gray-100',
            'iconColor' => 'text-gray-500',
            'icon' => 'x-mark',
        ],
        'default' => [
            'accent' => 'bg-gray-300',
            'iconBg' => 'bg-gray-50',
            'iconColor' => 'text-gray-400',
            'icon' => 'chat-bubble',
        ],
    ];
    $c = $statusConfig[$status] ?? $statusConfig['default'];
@endphp

<div
    {{ $attributes->merge(['class' => 'relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden']) }}>
    {{-- Status accent bar --}}
    <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-2xl {{ $c['accent'] }}"></div>

    {{-- Desktop: single row | Mobile: stacked --}}
    <div class="pl-4 pr-4 py-3 lg:py-2.5">

        {{-- ===== DESKTOP LAYOUT (lg+) ===== --}}
        <div class="hidden lg:flex items-center gap-5">
            {{-- Icon + Date --}}
            <div class="flex items-center gap-3 min-w-0 w-[220px] flex-shrink-0">
                <div class="w-5 h-5 rounded-lg {{ $c['iconBg'] }} flex items-center justify-center flex-shrink-0">
                    @switch($c['icon'])
                        @case('check')
                            <x-icons.check class="w-4 h-4 {{ $c['iconColor'] }}" />
                        @break

                        @case('clock')
                            <x-icons.clock class="w-4 h-4 {{ $c['iconColor'] }}" />
                        @break

                        @case('document-text')
                            <x-icons.document-text class="w-4 h-4 {{ $c['iconColor'] }}" />
                        @break

                        @case('sun')
                            <x-icons.sun class="w-4 h-4 {{ $c['iconColor'] }}" />
                        @break

                        @case('x-mark')
                            <x-icons.x-mark class="w-4 h-4 {{ $c['iconColor'] }}" />
                        @break

                        @default
                            <x-icons.chat-bubble class="w-4 h-4 {{ $c['iconColor'] }}" />
                    @endswitch
                </div>
                <div class="min-w-0">
                    @if ($date)
                        <p class="text-md font-bold text-gray-800 truncate">{{ $date }}</p>
                    @endif
                    @if ($dayName)
                        <p class="text-xs text-gray-400 truncate">{{ $dayName }}</p>
                    @endif
                </div>
            </div>

            {{-- Time chips inline --}}
            <div class="flex items-center gap-2 flex-1 min-w-0">
                {{-- Masuk --}}
                <div class="flex items-center gap-2 bg-gray-50 rounded-lg px-3 py-1.5">
                    <x-icons.arrow-left-on-rectangle class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" />
                    <span class="text-xs text-gray-400">{{ $primaryLabel }}</span>
                    <span class="text-sm font-bold text-gray-800">{{ $primaryTime ?? '—' }}</span>
                </div>

                {{-- Pulang --}}
                <div class="flex items-center gap-2 bg-gray-50 rounded-lg px-3 py-1.5">
                    <x-icons.arrow-right-on-rectangle class="w-3.5 h-3.5 text-blue-500 flex-shrink-0" />
                    <span class="text-xs text-gray-400">{{ $secondaryLabel }}</span>
                    <span class="text-sm font-bold text-gray-800">{{ $secondaryTime ?? '—' }}</span>
                </div>

                {{-- Total --}}
                @if ($tertiaryValue !== null)
                    <div class="flex items-center gap-2 bg-primary/5 rounded-lg px-3 py-1.5 border border-primary/10">
                        <x-icons.clock class="w-3.5 h-3.5 text-primary flex-shrink-0" />
                        <span class="text-xs text-primary/60">{{ $tertiaryLabel }}</span>
                        <span class="text-sm font-bold text-primary">{{ $tertiaryValue }}</span>
                    </div>
                @endif

                {{-- Description inline --}}
                @if ($description)
                    <div class="flex items-center gap-1.5 ml-1 min-w-0">
                        <x-icons.chat-bubble class="w-3.5 h-3.5 text-amber-500 flex-shrink-0" />
                        <p class="text-xs text-amber-700 truncate">{{ $description }}</p>
                    </div>
                @endif
            </div>

            {{-- Badge --}}
            <div class="flex-shrink-0">
                @if (isset($badge))
                    {{ $badge }}
                @else
                    <x-ui.status-badge :type="$status" size="sm">
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </x-ui.status-badge>
                @endif
            </div>
        </div>

        {{-- ===== MOBILE LAYOUT (<lg) ===== --}}
        <div class="lg:hidden">
            {{-- Header --}}
            <div class="flex items-center justify-between gap-3 mb-3">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-5 h-5 rounded-xl {{ $c['iconBg'] }} flex items-center justify-center flex-shrink-0">
                        @switch($c['icon'])
                            @case('check')
                                <x-icons.check class="w-4.5 h-4.5 {{ $c['iconColor'] }}" />
                            @break

                            @case('clock')
                                <x-icons.clock class="w-4.5 h-4.5 {{ $c['iconColor'] }}" />
                            @break

                            @case('document-text')
                                <x-icons.document-text class="w-4.5 h-4.5 {{ $c['iconColor'] }}" />
                            @break

                            @case('sun')
                                <x-icons.sun class="w-4.5 h-4.5 {{ $c['iconColor'] }}" />
                            @break

                            @case('x-mark')
                                <x-icons.x-mark class="w-4.5 h-4.5 {{ $c['iconColor'] }}" />
                            @break

                            @default
                                <x-icons.chat-bubble class="w-4.5 h-4.5 {{ $c['iconColor'] }}" />
                        @endswitch
                    </div>
                    <div class="min-w-0">
                        @if ($date)
                            <p class="text-md font-bold text-gray-800 truncate">{{ $date }}</p>
                        @endif
                        @if ($dayName)
                            <p class="text-xs text-gray-400 truncate">{{ $dayName }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex-shrink-0">
                    @if (isset($badge))
                        {{ $badge }}
                    @else
                        <x-ui.status-badge :type="$status" size="sm">
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </x-ui.status-badge>
                    @endif
                </div>
            </div>

            {{-- Time cards --}}
            <div class="flex items-stretch gap-2 min-w-0">
                <div class="flex-1 bg-gray-50 rounded-xl px-3 py-2.5 min-w-0">
                    <div class="flex items-center justify-center gap-2">
                        <x-icons.arrow-left-on-rectangle class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" />
                        <div class="text-center min-w-0">
                            <p class="text-[11px] font-medium text-gray-400 leading-tight">{{ $primaryLabel }}</p>
                            <p class="text-sm font-bold text-gray-800 leading-tight">{{ $primaryTime ?? '—' }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex-1 bg-gray-50 rounded-xl px-3 py-2.5 min-w-0">
                    <div class="flex items-center justify-center gap-2">
                        <x-icons.arrow-right-on-rectangle class="w-3.5 h-3.5 text-blue-500 flex-shrink-0" />
                        <div class="text-center min-w-0">
                            <p class="text-[11px] font-medium text-gray-400 leading-tight">{{ $secondaryLabel }}</p>
                            <p class="text-sm font-bold text-gray-800 leading-tight">{{ $secondaryTime ?? '—' }}</p>
                        </div>
                    </div>
                </div>
                @if ($tertiaryValue !== null)
                    <div class="flex-1 bg-primary/5 rounded-xl px-3 py-2.5 border border-primary/10 min-w-0">
                        <div class="flex items-center justify-center gap-2">
                            <x-icons.clock class="w-3.5 h-3.5 text-primary flex-shrink-0" />
                            <div class="text-center min-w-0">
                                <p class="text-[11px] font-medium text-primary/60 leading-tight">{{ $tertiaryLabel }}
                                </p>
                                <p class="text-sm font-bold text-primary leading-tight">{{ $tertiaryValue }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Description --}}
            @if ($description)
                <div
                    class="mt-2.5 flex items-start gap-2 bg-amber-50/60 rounded-lg px-3 py-2 border border-amber-100/60">
                    <x-icons.chat-bubble class="w-3.5 h-3.5 text-amber-500 mt-0.5 flex-shrink-0" />
                    <p class="text-xs text-amber-700 leading-relaxed">{{ $description }}</p>
                </div>
            @endif
        </div>

    </div>

    {{-- Custom Slot --}}
    @if ($slot->isNotEmpty())
        <div class="px-4 pb-4">
            {{ $slot }}
        </div>
    @endif
</div>
