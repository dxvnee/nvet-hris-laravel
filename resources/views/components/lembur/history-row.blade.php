{{-- Lembur History Row Component --}}
@props(['lembur'])

@php
    $statusMap = [
        'disetujui' => 'success',
        'ditolak' => 'danger',
        'pending' => 'warning',
    ];
    $statusType = $statusMap[$lembur->status] ?? 'warning';
    $statusLabel = match ($lembur->status) {
        'disetujui' => 'Disetujui',
        'ditolak' => 'Ditolak',
        default => 'Pending',
    };

    $mulai = \Carbon\Carbon::parse($lembur->jam_mulai);
    $selesai = \Carbon\Carbon::parse($lembur->jam_selesai);
    $durasi = $mulai->diff($selesai);
@endphp

<x-ui.table-row class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
    <x-ui.table-cell>
        <span class="text-sm font-medium text-gray-900">
            {{ \Carbon\Carbon::parse($lembur->tanggal)->format('d M Y') }}
        </span>
    </x-ui.table-cell>
    <x-ui.table-cell>
        <span class="text-sm text-gray-600">
            {{ $mulai->format('H:i') }} - {{ $selesai->format('H:i') }}
        </span>
    </x-ui.table-cell>
    <x-ui.table-cell>
        <span class="text-sm font-medium text-gray-900">
            {{ $durasi->h }}j {{ $durasi->i }}m
        </span>
    </x-ui.table-cell>
    <x-ui.table-cell>
        <span class="text-sm text-gray-600">{{ $lembur->keterangan ?? '-' }}</span>
    </x-ui.table-cell>
    <x-ui.table-cell>
        <x-ui.status-badge :type="$statusType" size="md">{{ $statusLabel }}</x-ui.status-badge>
    </x-ui.table-cell>
</x-ui.table-row>
