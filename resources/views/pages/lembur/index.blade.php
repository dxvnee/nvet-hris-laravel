{{-- Lembur Index Page - Modular Version --}}
<x-app-layout>
    <x-slot name="header">Lembur</x-slot>
    <x-slot name="subtle">Kelola jam lembur Anda</x-slot>

    <div class="space-y-6">
        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 animate-slide-up-delay-1">
            <x-ui.stat-card :value="floor($totalLemburBulanIni / 60) . 'j ' . $totalLemburBulanIni % 60 . 'm'" label="Total Lembur Bulan Ini" color="green" variant="gradient"
                iconName="chart" />

            <x-ui.stat-card :value="$menungguApproval" label="Menunggu Approval" color="yellow" variant="gradient"
                iconName="clock" />

            <x-ui.stat-card :value="$lemburDisetujui" label="Lembur Disetujui" color="blue" variant="gradient"
                iconName="check" />
        </div>

        {{-- Riwayat Lembur --}}
        <x-ui.section-card title="Riwayat Lembur" animation="animate-slide-up-delay-2">
            <x-slot name="iconSlot">
                <x-icons.clipboard-check class="h-6 w-6 text-white" />
            </x-slot>

            @if ($riwayatLembur->count() > 0)
                <div class="overflow-x-auto">
                    <x-ui.table>
                        <x-ui.table-head>
                            <x-ui.table-row class="border-b border-gray-200">
                                <x-ui.table-header-cell>Tanggal</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Waktu</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Durasi</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Keterangan</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Status</x-ui.table-header-cell>
                            </x-ui.table-row>
                        </x-ui.table-head>
                        <x-ui.table-body>
                            @foreach ($riwayatLembur as $lembur)
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
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($lembur->tanggal)->format('d M Y') }}</span>
                                    </x-ui.table-cell>
                                    <x-ui.table-cell>
                                        <span class="text-sm text-gray-600">{{ $mulai->format('H:i') }} -
                                            {{ $selesai->format('H:i') }}</span>
                                    </x-ui.table-cell>
                                    <x-ui.table-cell>
                                        <span class="text-sm font-medium text-gray-900">{{ $durasi->h }}j
                                            {{ $durasi->i }}m</span>
                                    </x-ui.table-cell>
                                    <x-ui.table-cell>
                                        <span class="text-sm text-gray-600">{{ $lembur->keterangan ?? '-' }}</span>
                                    </x-ui.table-cell>
                                    <x-ui.table-cell>
                                        <x-ui.status-badge :type="$statusType"
                                            size="md">{{ $statusLabel }}</x-ui.status-badge>
                                    </x-ui.table-cell>
                                </x-ui.table-row>
                            @endforeach
                        </x-ui.table-body>
                    </x-ui.table>
                </div>

                @if ($riwayatLembur->hasPages())
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        {{ $riwayatLembur->links() }}
                    </div>
                @endif
            @else
                <x-ui.empty-state message="Belum ada riwayat lembur" icon="clock" />
            @endif
        </x-ui.section-card>
    </div>
</x-app-layout>
