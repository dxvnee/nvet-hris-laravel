{{-- Lembur History Row Component --}}
@props(['lembur'])

@php
    $statusConfig = [
        'disetujui' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-700',
            'label' => 'Disetujui',
        ],
        'ditolak' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-700',
            'label' => 'Ditolak',
        ],
        'pending' => [
            'bg' => 'bg-yellow-100',
            'text' => 'text-yellow-700',
            'label' => 'Pending',
        ],
    ];
    $config = $statusConfig[$lembur->status] ?? $statusConfig['pending'];

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
        <span
            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
            {{ $config['label'] }}
        </span>
    </td>
</tr>
