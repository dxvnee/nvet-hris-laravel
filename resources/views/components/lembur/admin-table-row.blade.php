{{-- Lembur Admin Table Row Component --}}
@props(['item'])

@php
    $statusMap = [
        'disetujui' => 'success',
        'ditolak' => 'danger',
        'pending' => 'warning',
    ];
    $statusType = $statusMap[$item->status] ?? 'warning';
    $statusLabel = match ($item->status) {
        'disetujui' => 'Disetujui',
        'ditolak' => 'Ditolak',
        default => 'Pending',
    };

    $mulai = \Carbon\Carbon::parse($item->jam_mulai);
    $selesai = \Carbon\Carbon::parse($item->jam_selesai);
    $durasi = $mulai->diff($selesai);
@endphp

<tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
    {{-- User Info --}}
    <td class="py-3 px-4">
        <x-ui.user-avatar :user="$item->user" size="sm" :showInfo="true" />
    </td>

    {{-- Date --}}
    <td class="py-3 px-4">
        <span class="text-sm text-gray-900">
            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
        </span>
    </td>

    {{-- Time --}}
    <td class="py-3 px-4">
        <span class="text-sm text-gray-600">
            {{ $mulai->format('H:i') }} - {{ $selesai->format('H:i') }}
        </span>
    </td>

    {{-- Duration --}}
    <td class="py-3 px-4">
        <span class="text-sm font-medium text-gray-900">
            {{ $durasi->h }}j {{ $durasi->i }}m
        </span>
    </td>

    {{-- Status --}}
    <td class="py-3 px-4">
        <x-ui.status-badge :type="$statusType" size="md">{{ $statusLabel }}</x-ui.status-badge>
    </td>

    {{-- Actions --}}
    <td class="py-3 px-4 text-center">
        @if ($item->status === 'pending')
            <div class="flex items-center justify-center gap-2">
                <form action="{{ route('lembur.approve', $item) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <x-ui.action-button type="submit" variant="icon-success" title="Setujui">
                        <x-icons.check class="w-4 h-4" />
                    </x-ui.action-button>
                </form>
                <x-ui.action-button variant="icon-danger" onclick="openRejectModal({{ $item->id }})" title="Tolak">
                    <x-icons.x-mark class="w-4 h-4" />
                </x-ui.action-button>
            </div>
        @else
            <span class="text-gray-400 text-sm">-</span>
        @endif
    </td>
</tr>
