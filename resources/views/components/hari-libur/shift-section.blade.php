{{-- Hari Libur Shift Section Component --}}
@props([
    'shiftNumber' => 1,
    'jamMasukName' => 'jam_masuk',
    'jamKeluarName' => 'jam_keluar',
    'jamMasukValue' => null,
    'jamKeluarValue' => null,
])

@php
    $badgeType = $shiftNumber === 1 ? 'success' : 'orange';
@endphp

<div class="p-4 border border-gray-200 rounded-xl">
    <div class="flex items-center gap-2 mb-3">
        <x-ui.status-badge :type="$badgeType" size="sm">Shift {{ $shiftNumber }}</x-ui.status-badge>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <x-ui.form-input type="time" :name="$jamMasukName" :value="$jamMasukValue" label="Jam Masuk" variant="rounded" />
        <x-ui.form-input type="time" :name="$jamKeluarName" :value="$jamKeluarValue" label="Jam Keluar" variant="rounded" />
    </div>
</div>
