{{-- Hari Libur Index Page - Modular Version --}}
<x-app-layout>
    <x-slot name="header">Hari Libur & Hari Khusus</x-slot>
    <x-slot name="subtle">Kelola hari libur nasional, perusahaan, dan hari kerja khusus</x-slot>

    <div class="space-y-6">
        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row justify-between gap-4">
            {{-- Year Filter --}}
            <x-hari-libur.year-filter :currentYear="$tahun" routeName="hari-libur.index" />

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
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Tanggal</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Tipe</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Nama</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Detail</th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-600">Status</th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hariLiburs as $libur)
                                <x-hari-libur.table-row :item="$libur" :editRoute="route('hari-libur.edit', $libur)" :deleteRoute="route('hari-libur.destroy', $libur)" />
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-hari-libur.empty-state />
            @endif
        </x-ui.section-card>
    </div>
</x-app-layout>
