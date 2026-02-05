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

<x-ui.table-row class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
    {{-- User Info --}}
    <x-ui.table-cell>
        <x-ui.user-avatar :user="$item->user" size="sm" :showInfo="true" />
    </x-ui.table-cell>

    {{-- Date --}}
    <x-ui.table-cell>
        <span class="text-sm text-gray-900">
            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
        </span>
    </x-ui.table-cell>

    {{-- Time --}}
    <x-ui.table-cell>
        <span class="text-sm text-gray-600">
            {{ $mulai->format('H:i') }} - {{ $selesai->format('H:i') }}
        </span>
    </x-ui.table-cell>

    {{-- Duration --}}
    <x-ui.table-cell>
        <span class="text-sm font-medium text-gray-900">
            {{ $durasi->h }}j {{ $durasi->i }}m
        </span>
    </x-ui.table-cell>

    {{-- Status --}}
    <x-ui.table-cell>
        <x-ui.status-badge :type="$statusType" size="md">{{ $statusLabel }}</x-ui.status-badge>
    </x-ui.table-cell>

    {{-- Actions --}}
    <x-ui.table-cell align="center">
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
    </x-ui.table-cell>
</x-ui.table-row>
