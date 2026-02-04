{{-- Hari Libur Shift Section Component --}}
@props([
    'shiftNumber' => 1,
    'jamMasukName' => 'jam_masuk',
    'jamKeluarName' => 'jam_keluar',
    'jamMasukValue' => null,
    'jamKeluarValue' => null,
])

@php
    $colors = [
        1 => ['bg' => 'bg-green-100', 'text' => 'text-green-800'],
        2 => ['bg' => 'bg-orange-100', 'text' => 'text-orange-800'],
    ];
    $color = $colors[$shiftNumber] ?? $colors[1];
@endphp

<div class="p-4 border border-gray-200 rounded-xl">
    <div class="flex items-center gap-2 mb-3">
        <span class="px-2 py-1 {{ $color['bg'] }} {{ $color['text'] }} text-xs font-semibold rounded">
            Shift {{ $shiftNumber }}
        </span>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jam Masuk</label>
            <input type="time" name="{{ $jamMasukName }}" value="{{ $jamMasukValue }}"
                class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jam Keluar</label>
            <input type="time" name="{{ $jamKeluarName }}" value="{{ $jamKeluarValue }}"
                class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
        </div>
    </div>
</div>
