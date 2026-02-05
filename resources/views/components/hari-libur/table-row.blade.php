{{-- Hari Libur Table Row Component --}}
@props(['item', 'editRoute', 'deleteRoute'])

@php
    $tipeMap = [
        'libur' => ['type' => 'danger', 'label' => 'Libur'],
        'hari_khusus' => ['type' => 'info', 'label' => 'Hari Khusus'],
    ];
    $tipeConfig = $tipeMap[$item->tipe] ?? [
        'type' => 'default',
        'label' => ucfirst(str_replace('_', ' ', $item->tipe)),
    ];
    $tanggal = \Carbon\Carbon::parse($item->tanggal);
@endphp

<x-ui.table-row class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
    {{-- Date --}}
    <x-ui.table-cell>
        <div>
            <span class="text-sm font-medium text-gray-900">{{ $tanggal->format('d M Y') }}</span>
            <span class="text-xs text-gray-500 block">{{ $tanggal->locale('id')->dayName }}</span>
        </div>
    </x-ui.table-cell>

    {{-- Type --}}
    <x-ui.table-cell>
        <x-ui.status-badge :type="$tipeConfig['type']" size="md">{{ $tipeConfig['label'] }}</x-ui.status-badge>
    </x-ui.table-cell>

    {{-- Name --}}
    <x-ui.table-cell>
        <span class="text-sm font-medium text-gray-900">{{ $item->nama }}</span>
        @if ($item->deskripsi)
            <span class="text-xs text-gray-500 block">{{ Str::limit($item->deskripsi, 40) }}</span>
        @endif
    </x-ui.table-cell>

    {{-- Detail --}}
    <x-ui.table-cell>
        @if ($item->tipe === 'hari_khusus' && $item->is_masuk)
            <span class="text-sm text-gray-600">
                {{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '-' }}
                -
                {{ $item->jam_keluar ? \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') : '-' }}
            </span>
        @else
            <span class="text-gray-400 text-sm">-</span>
        @endif
    </x-ui.table-cell>

    {{-- Status --}}
    <x-ui.table-cell align="center">
        @if ($item->is_recurring)
            <x-ui.status-badge type="purple" size="sm">Berulang</x-ui.status-badge>
        @else
            <span class="text-gray-400 text-sm">-</span>
        @endif
    </x-ui.table-cell>

    {{-- Actions --}}
    <x-ui.table-cell align="center">
        <div class="flex items-center justify-center gap-2">
            <x-ui.action-button type="link" :href="$editRoute" variant="icon-primary" title="Edit">
                <x-icons.pencil class="w-4 h-4" />
            </x-ui.action-button>
            <form action="{{ $deleteRoute }}" method="POST" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus hari libur ini?')">
                @csrf
                @method('DELETE')
                <x-ui.action-button type="submit" variant="icon-danger" title="Hapus">
                    <x-icons.trash class="w-4 h-4" />
                </x-ui.action-button>
            </form>
        </div>
    </x-ui.table-cell>
</x-ui.table-row>
