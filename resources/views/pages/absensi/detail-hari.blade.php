<x-app-layout>
    <x-slot name="header">Detail Absensi - {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</x-slot>
    <x-slot name="subtle">Rincian absensi pegawai pada tanggal tersebut</x-slot>

    <div class="space-y-6">
        {{-- Back Button --}}
        <x-ui.back-button label="Kembali" />

        {{-- Absensi List --}}
        <x-ui.section-card animation="animate-slide-up-delay-1">
            <x-slot:iconSlot>
                <x-icons.calendar class="h-6 w-6 text-white" />
            </x-slot:iconSlot>
            <x-slot:header>
                <h2 class="text-xl font-bold text-gray-800">Detail Absensi</h2>
            </x-slot:header>

            @if ($absensiHari->count() > 0)
                <div class="overflow-x-auto">
                    <x-ui.table>
                        <x-ui.table-head>
                            <x-ui.table-row class="border-b border-gray-200">
                                <x-ui.sortable-header column="name" label="Pegawai" :currentSort="request('sort_by')" :currentDirection="request('sort_direction')"
                                    align="center" />
                                <x-ui.sortable-header column="jam_masuk" label="Jam Masuk" :currentSort="request('sort_by')"
                                    :currentDirection="request('sort_direction')" align="center" />
                                <x-ui.sortable-header column="jam_pulang" label="Jam Pulang" :currentSort="request('sort_by')"
                                    :currentDirection="request('sort_direction')" align="center" />
                                <x-ui.sortable-header column="status" label="Status" :currentSort="request('sort_by')" :currentDirection="request('sort_direction')"
                                    align="center" />
                                <x-ui.table-header-cell align="center">Lokasi</x-ui.table-header-cell>
                                <x-ui.table-header-cell align="center">Foto</x-ui.table-header-cell>
                                <x-ui.table-header-cell align="center">Keterangan</x-ui.table-header-cell>
                                <x-ui.table-header-cell align="center">Aksi</x-ui.table-header-cell>
                            </x-ui.table-row>
                        </x-ui.table-head>
                        <x-ui.table-body>
                            @foreach ($absensiHari as $absen)
                                <x-absensi.table-row :absen="$absen" :tanggal="$tanggal" />
                            @endforeach
                        </x-ui.table-body>
                    </x-ui.table>
                </div>
            @else
                <x-ui.empty-state message="Belum ada data absensi" icon="calendar" size="lg" />
            @endif
        </x-ui.section-card>

        {{-- Photo Modal --}}
        <x-ui.photo-modal title="Foto Absensi" />
    </div>
</x-app-layout>
