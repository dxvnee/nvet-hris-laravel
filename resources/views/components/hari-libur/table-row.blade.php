{{-- Hari Libur Table Row Component --}}
@props(['item', 'editRoute', 'deleteRoute'])

@php
    $tipeConfig = [
        'libur' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-700',
            'label' => 'Libur',
        ],
        'hari_khusus' => [
            'bg' => 'bg-blue-100',
            'text' => 'text-blue-700',
            'label' => 'Hari Khusus',
        ],
    ];
    $config = $tipeConfig[$item->tipe] ?? [
        'bg' => 'bg-gray-100',
        'text' => 'text-gray-700',
        'label' => ucfirst(str_replace('_', ' ', $item->tipe)),
    ];

    $tanggal = \Carbon\Carbon::parse($item->tanggal);
@endphp

<tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
    {{-- Date --}}
    <td class="py-3 px-4">
        <div>
            <span class="text-sm font-medium text-gray-900">
                {{ $tanggal->format('d M Y') }}
            </span>
            <span class="text-xs text-gray-500 block">
                {{ $tanggal->locale('id')->dayName }}
            </span>
        </div>
    </td>

    {{-- Type --}}
    <td class="py-3 px-4">
        <span
            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
            {{ $config['label'] }}
        </span>
    </td>

    {{-- Name --}}
    <td class="py-3 px-4">
        <span class="text-sm font-medium text-gray-900">{{ $item->nama }}</span>
        @if ($item->deskripsi)
            <span class="text-xs text-gray-500 block">{{ Str::limit($item->deskripsi, 40) }}</span>
        @endif
    </td>

    {{-- Detail --}}
    <td class="py-3 px-4">
        @if ($item->tipe === 'hari_khusus' && $item->is_masuk)
            <span class="text-sm text-gray-600">
                {{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '-' }}
                -
                {{ $item->jam_keluar ? \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') : '-' }}
            </span>
        @else
            <span class="text-gray-400 text-sm">-</span>
        @endif
    </td>

    {{-- Status --}}
    <td class="py-3 px-4 text-center">
        @if ($item->is_recurring)
            <span
                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                Berulang
            </span>
        @else
            <span class="text-gray-400 text-sm">-</span>
        @endif
    </td>

    {{-- Actions --}}
    <td class="py-3 px-4 text-center">
        <div class="flex items-center justify-center gap-2">
            <a href="{{ $editRoute }}"
                class="p-2 bg-primary/10 hover:bg-primary/20 text-primary rounded-lg transition-colors" title="Edit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
            </a>
            <form action="{{ $deleteRoute }}" method="POST" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus hari libur ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors"
                    title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
    </td>
</tr>
