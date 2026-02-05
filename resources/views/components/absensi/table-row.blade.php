{{-- Absensi Table Row Component --}}
@props(['absen', 'tanggal' => null, 'showActions' => true])

<tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
    {{-- User Info --}}
    <td class="py-3 px-4">
        <x-ui.user-avatar :user="$absen->user" size="md" :showInfo="true" />
    </td>

    {{-- Jam Masuk --}}
    <td class="text-center py-3 px-4">
        @if ($absen->jam_masuk)
            <div class="text-sm text-gray-900">{{ $absen->jam_masuk->format('H:i') }}</div>
            @if ($absen->status === 'telat')
                <div class="text-xs text-red-600">Terlambat {{ $absen->menit_telat }} menit</div>
            @endif
        @else
            <span class="text-gray-400">-</span>
        @endif
    </td>

    {{-- Jam Pulang --}}
    <td class="text-center py-3 px-4">
        @if ($absen->jam_pulang)
            <div class="text-sm text-gray-900">{{ $absen->jam_pulang->format('H:i') }}</div>
            @if ($absen->menit_kerja)
                <div class="text-xs text-green-600">{{ floor($absen->menit_kerja / 60) }}j
                    {{ $absen->menit_kerja % 60 }}m</div>
            @endif
        @else
            <span class="text-gray-400">-</span>
        @endif
    </td>

    {{-- Status --}}
    <td class="text-center py-3 px-4">
        @if ($absen->libur)
            <x-ui.status-badge type="info" size="md">Libur</x-ui.status-badge>
        @elseif($absen->tidak_hadir)
            <x-ui.status-badge type="default" size="md">Tidak Hadir</x-ui.status-badge>
        @elseif($absen->izin)
            <x-ui.status-badge type="warning" size="md">Izin</x-ui.status-badge>
        @elseif($absen->jam_masuk)
            @if ($absen->telat == 0)
                <x-ui.status-badge type="success" size="md">Tepat Waktu</x-ui.status-badge>
            @else
                <x-ui.status-badge type="danger" size="md">Terlambat</x-ui.status-badge>
            @endif
        @else
            <x-ui.status-badge type="default" size="md">Belum Absen</x-ui.status-badge>
        @endif
    </td>

    {{-- Lokasi --}}
    <td class="text-center py-3 px-4 text-gray-700">
        @if ($absen->lat_masuk && $absen->lng_masuk)
            <div class="text-xs">Masuk: {{ number_format($absen->lat_masuk, 6) }},
                {{ number_format($absen->lng_masuk, 6) }}</div>
        @endif
        @if ($absen->lat_pulang && $absen->lng_pulang)
            <div class="text-xs">Pulang: {{ number_format($absen->lat_pulang, 6) }},
                {{ number_format($absen->lng_pulang, 6) }}</div>
        @endif
        @if (!$absen->lat_masuk && !$absen->lat_pulang)
            <span class="text-gray-400">-</span>
        @endif
    </td>

    {{-- Foto --}}
    <td class="text-center py-3 px-4">
        <div class="flex flex-wrap gap-1 justify-center">
            @if ($absen->foto_masuk)
                <x-ui.action-button variant="icon-success" size="sm" :onclick="'openPhotoModal(' .
                    json_encode(asset('storage/' . $absen->foto_masuk)) .
                    ', ' .
                    json_encode($absen->user->name . ' - Foto Masuk') .
                    ', ' .
                    json_encode($absen->jam_masuk ? $absen->jam_masuk->format('d/m/Y H:i') : '') .
                    ', ' .
                    json_encode('photo-modal') .
                    ')'" title="Lihat Foto Masuk">
                    📷 Masuk
                </x-ui.action-button>
            @endif
            @if ($absen->foto_pulang)
                <x-ui.action-button variant="icon-info" size="sm" :onclick="'openPhotoModal(' .
                    json_encode(asset('storage/' . $absen->foto_pulang)) .
                    ', ' .
                    json_encode($absen->user->name . ' - Foto Pulang') .
                    ', ' .
                    json_encode($absen->jam_pulang ? $absen->jam_pulang->format('d/m/Y H:i') : '') .
                    ', ' .
                    json_encode('photo-modal') .
                    ')'" title="Lihat Foto Pulang">
                    📷 Pulang
                </x-ui.action-button>
            @endif
            @if ($absen->foto_izin)
                <x-ui.action-button variant="icon-warning" size="sm" :onclick="'openPhotoModal(' .
                    json_encode(asset('storage/' . $absen->foto_izin)) .
                    ', ' .
                    json_encode($absen->user->name . ' - Foto Izin') .
                    ', ' .
                    json_encode($absen->tanggal->format('d/m/Y')) .
                    ', ' .
                    json_encode('photo-modal') .
                    ')'" title="Lihat Foto Izin">
                    📷 Izin
                </x-ui.action-button>
            @endif
            @if (!$absen->foto_masuk && !$absen->foto_pulang && !$absen->foto_izin)
                <span class="text-xs text-gray-400">-</span>
            @endif
        </div>
    </td>

    {{-- Keterangan --}}
    <td class="text-center py-3 px-4 text-gray-700">
        {{ $absen->izin && $absen->izin_keterangan ? $absen->izin_keterangan : '-' }}
    </td>

    {{-- Actions --}}
    @if ($showActions)
        <td class="flex items-center justify-center py-3 px-4">
            <div class="flex items-center gap-2">
                @if ($absen->exists)
                    <x-ui.action-button type="link" :href="route('absen.edit', $absen)" variant="icon-info" title="Edit">
                        <x-icons.pencil class="w-5 h-5" />
                    </x-ui.action-button>
                    <form method="POST" action="{{ route('absen.destroy', $absen) }}"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus absensi {{ $absen->user->name }}? Tindakan ini tidak dapat dibatalkan.')"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <x-ui.action-button type="submit" variant="icon-danger" title="Hapus">
                            <x-icons.trash class="w-5 h-5" />
                        </x-ui.action-button>
                    </form>
                @else
                    <x-ui.action-button type="link" :href="route('absen.create', [
                        'tanggal' => $tanggal ?? now()->format('Y-m-d'),
                        'user' => $absen->user_id,
                    ])" variant="icon-success"
                        title="Tambah Absen Manual">
                        <x-icons.plus class="w-5 h-5" />
                    </x-ui.action-button>
                @endif
            </div>
        </td>
    @endif
</tr>
