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

<tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
    <td class="py-3 px-4">
        <span class="text-sm font-medium text-gray-900">
            {{ \Carbon\Carbon::parse($lembur->tanggal)->format('d M Y') }}
        </span>
    </td>
    <td class="py-3 px-4">
        <span class="text-sm text-gray-600">
            {{ $mulai->format('H:i') }} - {{ $selesai->format('H:i') }}
        </span>
    </td>
    <td class="py-3 px-4">
        <span class="text-sm font-medium text-gray-900">
            {{ $durasi->h }}j {{ $durasi->i }}m
        </span>
    </td>
    <td class="py-3 px-4">
        <span class="text-sm text-gray-600">{{ $lembur->keterangan ?? '-' }}</span>
    </td>
    <td class="py-3 px-4">
        <x-ui.status-badge :type="$statusType" size="md">{{ $statusLabel }}</x-ui.status-badge>
    </td>
</tr>
