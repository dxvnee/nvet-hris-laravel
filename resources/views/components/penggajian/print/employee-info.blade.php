@props(['penggajian'])

@php
    $jabatan = $penggajian->user->jabatan;
@endphp

<div class="employee-section">
    <img src="{{ $penggajian->user->avatar ? asset('storage/' . $penggajian->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($penggajian->user->name) . '&color=7F9CF5&background=EBF4FF&size=80' }}"
        alt="{{ $penggajian->user->name }}" class="employee-photo">
    <div class="employee-details">
        <h3>{{ $penggajian->user->name }}</h3>
        <x-ui.table variant="print" class="employee-table">
            <x-ui.table-body>
                <x-ui.table-row>
                    <x-ui.table-cell variant="print">Jabatan</x-ui.table-cell>
                    <x-ui.table-cell variant="print">
                        <span class="badge badge-{{ strtolower($jabatan) }}">{{ $jabatan }}</span>
                    </x-ui.table-cell>
                </x-ui.table-row>
                <x-ui.table-row>
                    <x-ui.table-cell variant="print">Email</x-ui.table-cell>
                    <x-ui.table-cell variant="print">{{ $penggajian->user->email }}</x-ui.table-cell>
                </x-ui.table-row>
                <x-ui.table-row>
                    <x-ui.table-cell variant="print">Jam Kerja</x-ui.table-cell>
                    <x-ui.table-cell variant="print">{{ $penggajian->user->jam_kerja ?? '-' }}
                        jam/minggu</x-ui.table-cell>
                </x-ui.table-row>
            </x-ui.table-body>
        </x-ui.table>
    </div>
</div>
