{{-- Hari Libur Index Page - Modular Version --}}
<x-app-layout>
    <x-slot name="header">Hari Libur & Hari Khusus</x-slot>
    <x-slot name="subtle">Kelola hari libur nasional, perusahaan, dan hari kerja khusus</x-slot>

    <div class="space-y-6">
        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row justify-between gap-4">
            {{-- Year Filter --}}
            @php
                $startYear = 2024;
                $endYear = date('Y') + 1;
                $yearOptions = [];
                for ($y = $startYear; $y <= $endYear; $y++) {
                    $yearOptions[$y] = (string) $y;
                }
            @endphp
            <form method="GET" action="{{ route('hari-libur.index') }}" class="flex items-center gap-3">
                <x-ui.form-select name="tahun" label="Tahun:" :options="$yearOptions" :selected="$tahun" variant="inline"
                    onchange="this.form.submit()" />
            </form>

            {{-- Add Button --}}
            <a href="{{ route('hari-libur.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primaryDark text-white font-semibold rounded-lg transition-all">
                <x-icons.plus class="w-5 h-5" />
                Tambah Hari Libur / Hari Khusus
            </a>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <x-ui.info-box type="success">
                {{ session('success') }}
            </x-ui.info-box>
        @endif

        {{-- Table --}}
        <x-ui.section-card title="Daftar Hari Libur & Hari Khusus {{ $tahun }}">
            <x-slot name="iconSlot">
                <x-icons.calendar class="h-6 w-6 text-white" />
            </x-slot>

            @if ($hariLiburs->count() > 0)
                <div class="overflow-x-auto">
                    <x-ui.table>
                        <x-ui.table-head>
                            <x-ui.table-row class="border-b border-gray-200">
                                <x-ui.table-header-cell>Tanggal</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Tipe</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Nama</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Detail</x-ui.table-header-cell>
                                <x-ui.table-header-cell align="center">Status</x-ui.table-header-cell>
                                <x-ui.table-header-cell align="center">Aksi</x-ui.table-header-cell>
                            </x-ui.table-row>
                        </x-ui.table-head>
                        <x-ui.table-body>
                            @foreach ($hariLiburs as $libur)
                                <x-hari-libur.table-row :item="$libur" :editRoute="route('hari-libur.edit', $libur)" :deleteRoute="route('hari-libur.destroy', $libur)" />
                            @endforeach
                        </x-ui.table-body>
                    </x-ui.table>
                </div>
            @else
                <x-ui.empty-state message="Tidak ada data hari libur" icon="calendar" size="lg" :actionHref="route('hari-libur.create')"
                    actionLabel="Tambah Hari Libur" />
            @endif
        </x-ui.section-card>
    </div>
</x-app-layout>
