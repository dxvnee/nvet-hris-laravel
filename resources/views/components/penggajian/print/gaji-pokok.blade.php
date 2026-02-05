@props(['penggajian'])

<div class="salary-section">
    <h4>
        <span style="color: #0D9488;">●</span> Gaji Pokok
    </h4>
    <x-ui.table variant="print" class="salary-table">
        <x-ui.table-body>
            <x-ui.table-row>
                <x-ui.table-cell variant="print" class="label">Gaji Pokok</x-ui.table-cell>
                <x-ui.table-cell variant="print" class="value positive">Rp
                    {{ number_format($penggajian->gaji_pokok, 0, ',', '.') }}</x-ui.table-cell>
            </x-ui.table-row>
        </x-ui.table-body>
    </x-ui.table>
</div>
