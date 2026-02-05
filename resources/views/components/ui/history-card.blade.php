{{-- Universal History/Timeline Card Component --}}
@props([
    'date' => null,
    'dayName' => null,
    'status' => 'default', // hadir, telat, izin, libur, tidak_hadir, default
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
        'hadir' => ['bg' => 'from-emerald-100 to-green-100', 'icon' => 'check', 'iconColor' => 'text-emerald-600'],
        'telat' => ['bg' => 'from-rose-100 to-red-100', 'icon' => 'clock', 'iconColor' => 'text-rose-600'],
        'izin' => ['bg' => 'from-amber-100 to-yellow-100', 'icon' => 'document-text', 'iconColor' => 'text-amber-600'],
        'libur' => ['bg' => 'from-blue-100 to-indigo-100', 'icon' => 'sun', 'iconColor' => 'text-blue-600'],
        'tidak_hadir' => ['bg' => 'from-gray-100 to-gray-200', 'icon' => 'x-mark', 'iconColor' => 'text-gray-600'],
        'default' => ['bg' => 'from-gray-100 to-gray-200', 'icon' => 'chat-bubble', 'iconColor' => 'text-gray-400'],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['default'];
@endphp

<div
    {{ $attributes->merge(['class' => 'group bg-gradient-to-br from-white to-gray-50/50 rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 hover:border-primary/20 transition-all duration-300 p-5 hover:transform hover:scale-[1.01]']) }}>
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm bg-gradient-to-br {{ $config['bg'] }}">
                @switch($config['icon'])
                    @case('check')
                        <x-icons.check class="w-5 h-5 {{ $config['iconColor'] }}" />
                    @break

                    @case('clock')
                        <x-icons.clock class="w-5 h-5 {{ $config['iconColor'] }}" />
                    @break

                    @case('document-text')
                        <x-icons.document-text class="w-5 h-5 {{ $config['iconColor'] }}" />
                    @break

                    @case('sun')
                        <x-icons.sun class="w-5 h-5 {{ $config['iconColor'] }}" />
                    @break

                    @case('x-mark')
                        <x-icons.x-mark class="w-5 h-5 {{ $config['iconColor'] }}" />
                    @break

                    @default
                        <x-icons.chat-bubble class="w-5 h-5 {{ $config['iconColor'] }}" />
                @endswitch
            </div>
            <div>
                @if ($date)
                    <h3 class="font-bold text-gray-800 text-lg">{{ $date }}</h3>
                @endif
                @if ($dayName)
                    <p class="text-sm text-gray-500">{{ $dayName }}</p>
                @endif
            </div>
        </div>
        <div class="text-right">
            @if (isset($badge))
                {{ $badge }}
            @else
                <x-ui.status-badge :type="$status">
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                </x-ui.status-badge>
            @endif
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        {{-- Primary Time --}}
        <div class="flex items-center justify-between p-3 bg-white rounded-xl border border-gray-100">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                    <x-icons.arrow-left-on-rectangle class="w-4 h-4 text-emerald-600" />
                </div>
                <span class="text-sm font-medium text-gray-600">{{ $primaryLabel }}</span>
            </div>
            <span class="text-lg font-bold text-gray-800">{{ $primaryTime ?? '—' }}</span>
        </div>

        {{-- Secondary Time --}}
        <div class="flex items-center justify-between p-3 bg-white rounded-xl border border-gray-100">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                    <x-icons.arrow-right-on-rectangle class="w-4 h-4 text-blue-600" />
                </div>
                <span class="text-sm font-medium text-gray-600">{{ $secondaryLabel }}</span>
            </div>
            <span class="text-lg font-bold text-gray-800">{{ $secondaryTime ?? '—' }}</span>
        </div>

        {{-- Tertiary Value --}}
        <div class="flex items-center justify-between p-3 bg-white rounded-xl border border-gray-100">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                    <x-icons.clock class="w-4 h-4 text-purple-600" />
                </div>
                <span class="text-sm font-medium text-gray-600">{{ $tertiaryLabel }}</span>
            </div>
            <span class="text-lg font-bold text-gray-800">{{ $tertiaryValue ?? '—' }}</span>
        </div>
    </div>

    {{-- Description --}}
    @if ($description)
        <div class="mt-3 p-3 bg-amber-50 rounded-xl border border-amber-100">
            <div class="flex items-start gap-2">
                <x-icons.chat-bubble class="w-4 h-4 text-amber-600 mt-0.5 flex-shrink-0" />
                <div>
                    <p class="text-xs font-medium text-amber-700 uppercase tracking-wider mb-1">Keterangan</p>
                    <p class="text-sm text-amber-800">{{ $description }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Custom Slot --}}
    {{ $slot }}
</div>
