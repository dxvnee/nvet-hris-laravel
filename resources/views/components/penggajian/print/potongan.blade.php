@props(['penggajian'])

<div class="salary-section">
    <h4>
        <span style="color: #dc2626;">●</span> Potongan
    </h4>
    <x-ui.table variant="print" class="salary-table">
        <x-ui.table-body>
            <x-ui.table-row>
                <x-ui.table-cell variant="print" class="label">Potongan Keterlambatan</x-ui.table-cell>
                <x-ui.table-cell variant="print" class="value negative">- Rp
                    {{ number_format($penggajian->total_potongan_telat, 0, ',', '.') }}</x-ui.table-cell>
            </x-ui.table-row>
            <x-ui.table-row>
                <x-ui.table-cell variant="print" class="sub-label">{{ $penggajian->total_menit_telat }} menit × Rp
                    {{ number_format($penggajian->potongan_per_menit, 0, ',', '.') }}/menit</x-ui.table-cell>
                <x-ui.table-cell variant="print"></x-ui.table-cell>
            </x-ui.table-row>
            @if (($penggajian->total_lupa_pulang ?? 0) > 0)
                <x-ui.table-row>
                    <x-ui.table-cell variant="print" class="label">Potongan Lupa Absen Pulang</x-ui.table-cell>
                    <x-ui.table-cell variant="print" class="value negative">- Rp
                        {{ number_format($penggajian->potongan_lupa_pulang ?? 0, 0, ',', '.') }}</x-ui.table-cell>
                </x-ui.table-row>
                <x-ui.table-row>
                    <x-ui.table-cell variant="print" class="sub-label">{{ $penggajian->total_lupa_pulang }} kali (potong
                        1 jam jika > 3x)</x-ui.table-cell>
                    <x-ui.table-cell variant="print"></x-ui.table-cell>
                </x-ui.table-row>
            @endif
            @if (($penggajian->total_tidak_hadir ?? 0) > 0)
                <x-ui.table-row>
                    <x-ui.table-cell variant="print" class="label">Potongan Tidak Hadir</x-ui.table-cell>
                    <x-ui.table-cell variant="print" class="value negative">- Rp
                        {{ number_format($penggajian->total_potongan_tidak_hadir ?? 0, 0, ',', '.') }}</x-ui.table-cell>
                </x-ui.table-row>
                <x-ui.table-row>
                    <x-ui.table-cell variant="print" class="sub-label">{{ $penggajian->total_tidak_hadir }} hari × Rp
                        {{ number_format($penggajian->potongan_per_tidak_hadir ?? 0, 0, ',', '.') }}/hari</x-ui.table-cell>
                    <x-ui.table-cell variant="print"></x-ui.table-cell>
                </x-ui.table-row>
            @endif
        </x-ui.table-body>
    </x-ui.table>
</div>
