{{-- Time Range Input Component - Universal time range with badge --}}
@props([
    'badge' => null,
    'badgeType' => 'success', // success, orange, info, etc
    'startName' => 'jam_masuk',
    'endName' => 'jam_keluar',
    'startValue' => null,
    'endValue' => null,
    'startLabel' => 'Jam Masuk',
    'endLabel' => 'Jam Keluar',
])

<div {{ $attributes->merge(['class' => 'p-4 border border-gray-200 rounded-xl']) }}>
    @if ($badge)
        <div class="flex items-center gap-2 mb-3">
            <x-ui.status-badge :type="$badgeType" size="sm">{{ $badge }}</x-ui.status-badge>
        </div>
    @endif
    <div class="grid grid-cols-2 gap-4">
        <x-ui.form-input type="time" :name="$startName" :value="$startValue" :label="$startLabel" variant="rounded" />
        <x-ui.form-input type="time" :name="$endName" :value="$endValue" :label="$endLabel" variant="rounded" />
    </div>
</div>
