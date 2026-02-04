{{-- Lembur Admin Table Row Component --}}
@props(['item'])

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
    $config = $statusConfig[$item->status] ?? $statusConfig['pending'];

    $mulai = \Carbon\Carbon::parse($item->jam_mulai);
    $selesai = \Carbon\Carbon::parse($item->jam_selesai);
    $durasi = $mulai->diff($selesai);
@endphp

<tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
    {{-- User Info --}}
    <td class="py-3 px-4">
        <div class="flex items-center gap-3">
            <x-ui.user-avatar :user="$item->user" size="sm" />
            <div>
                <p class="text-sm font-medium text-gray-900">{{ $item->user->name }}</p>
                <p class="text-xs text-gray-500">{{ $item->user->jabatan ?? 'Pegawai' }}</p>
            </div>
        </div>
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
        <span
            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
            {{ $config['label'] }}
        </span>
    </td>

    {{-- Actions --}}
    <td class="py-3 px-4 text-center">
        @if ($item->status === 'pending')
            <div class="flex items-center justify-center gap-2">
                <form action="{{ route('lembur.approve', $item) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="p-2 bg-green-100 hover:bg-green-200 text-green-600 rounded-lg transition-colors"
                        title="Setujui">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </button>
                </form>
                <button type="button" onclick="openRejectModal({{ $item->id }})"
                    class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors" title="Tolak">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @else
            <span class="text-gray-400 text-sm">-</span>
        @endif
    </td>
</tr>
