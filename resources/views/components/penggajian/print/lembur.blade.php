@props(['penggajian'])

@if ($penggajian->total_menit_lembur ?? 0 > 0)
    <div class="salary-section">
        <h4>
            <span style="color: #8b5cf6;">●</span> Lembur
        </h4>
        <x-ui.table variant="print" class="salary-table">
            <x-ui.table-body>
                <x-ui.table-row>
                    <x-ui.table-cell variant="print" class="label">Total Menit Lembur</x-ui.table-cell>
                    <x-ui.table-cell variant="print" class="value">{{ $penggajian->total_menit_lembur ?? 0 }}
                        menit</x-ui.table-cell>
                </x-ui.table-row>
                <x-ui.table-row>
                    <x-ui.table-cell variant="print"
                        class="sub-label">{{ floor(($penggajian->total_menit_lembur ?? 0) / 60) }} jam
                        {{ ($penggajian->total_menit_lembur ?? 0) % 60 }} menit</x-ui.table-cell>
                    <x-ui.table-cell variant="print"></x-ui.table-cell>
                </x-ui.table-row>
                <x-ui.table-row>
                    <x-ui.table-cell variant="print" class="label">Upah Lembur per Menit</x-ui.table-cell>
                    <x-ui.table-cell variant="print" class="value">Rp
                        {{ number_format($penggajian->upah_lembur_per_menit ?? 0, 0, ',', '.') }}</x-ui.table-cell>
                </x-ui.table-row>
                <x-ui.table-row>
                    <x-ui.table-cell variant="print" class="label"><strong>Total Upah Lembur</strong></x-ui.table-cell>
                    <x-ui.table-cell variant="print" class="value positive"><strong>+ Rp
                            {{ number_format($penggajian->total_upah_lembur ?? 0, 0, ',', '.') }}</strong></x-ui.table-cell>
                </x-ui.table-row>
            </x-ui.table-body>
        </x-ui.table>
    </div>
@endif
