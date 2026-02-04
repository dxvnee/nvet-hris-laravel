{{-- Jabatan Badge - wrapper for ui/status-badge --}}
@props(['jabatan'])

@php
    $typeMap = [
        'Dokter' => 'purple',
        'Paramedis' => 'info',
        'Tech' => 'green',
        'FO' => 'orange',
    ];
    $badgeType = $typeMap[$jabatan] ?? 'default';
@endphp

<x-ui.status-badge :type="$badgeType" {{ $attributes }}>
    {{ $jabatan }}
</x-ui.status-badge>
