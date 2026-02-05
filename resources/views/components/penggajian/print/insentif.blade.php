@props(['penggajian', 'detail' => []])

@php
    $jabatan = $penggajian->user->jabatan;
@endphp

<div class="salary-section">
    <h4>
        <span style="color: #16a34a;">●</span> Insentif ({{ $jabatan }})
    </h4>

    <div class="insentif-detail">
        @if ($jabatan === 'Dokter')
            <x-ui.table variant="print">
                <x-ui.table-body>
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Total Transaksi</x-ui.table-cell>
                        <x-ui.table-cell variant="print" class="text-right">Rp
                            {{ number_format($detail['transaksi'] ?? 0, 0, ',', '.') }}</x-ui.table-cell>
                    </x-ui.table-row>
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Persentase Insentif</x-ui.table-cell>
                        <x-ui.table-cell variant="print"
                            class="text-right">{{ $detail['persenan'] ?? 0 }}%</x-ui.table-cell>
                    </x-ui.table-row>
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Pengurangan</x-ui.table-cell>
                        <x-ui.table-cell variant="print" class="text-right">- Rp
                            {{ number_format($detail['pengurangan'] ?? 0, 0, ',', '.') }}</x-ui.table-cell>
                    </x-ui.table-row>
                    @if (!empty($detail['keterangan_pengurangan']))
                        <x-ui.table-row>
                            <x-ui.table-cell variant="print" colspan="2"
                                class="text-gray-500 italic">{{ $detail['keterangan_pengurangan'] }}</x-ui.table-cell>
                        </x-ui.table-row>
                    @endif
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Penambahan</x-ui.table-cell>
                        <x-ui.table-cell variant="print" class="text-right">+ Rp
                            {{ number_format($detail['penambahan'] ?? 0, 0, ',', '.') }}</x-ui.table-cell>
                    </x-ui.table-row>
                    @if (!empty($detail['keterangan_penambahan']))
                        <x-ui.table-row>
                            <x-ui.table-cell variant="print" colspan="2"
                                class="text-gray-500 italic">{{ $detail['keterangan_penambahan'] }}</x-ui.table-cell>
                        </x-ui.table-row>
                    @endif
                    @if (isset($detail['lain_lain_items']) && is_array($detail['lain_lain_items']))
                        @foreach ($detail['lain_lain_items'] as $item)
                            <x-ui.table-row>
                                <x-ui.table-cell variant="print">{{ $item['nama'] ?? 'Item' }}</x-ui.table-cell>
                                <x-ui.table-cell variant="print" class="text-right">{{ $item['qty'] ?? 0 }} × Rp
                                    {{ number_format($item['harga'] ?? 0, 0, ',', '.') }} = Rp
                                    {{ number_format(($item['qty'] ?? 0) * ($item['harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                            </x-ui.table-row>
                        @endforeach
                    @endif
                </x-ui.table-body>
            </x-ui.table>
        @elseif($jabatan === 'Paramedis')
            <x-ui.table variant="print">
                <x-ui.table-body>
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Antar Jemput</x-ui.table-cell>
                        <x-ui.table-cell variant="print" class="text-right">{{ $detail['antar_jemput_qty'] ?? 0 }} × Rp
                            {{ number_format($detail['antar_jemput_harga'] ?? 0, 0, ',', '.') }} = Rp
                            {{ number_format(($detail['antar_jemput_qty'] ?? 0) * ($detail['antar_jemput_harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                    </x-ui.table-row>
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Rawat Inap</x-ui.table-cell>
                        <x-ui.table-cell variant="print" class="text-right">{{ $detail['rawat_inap_qty'] ?? 0 }} × Rp
                            {{ number_format($detail['rawat_inap_harga'] ?? 0, 0, ',', '.') }} = Rp
                            {{ number_format(($detail['rawat_inap_qty'] ?? 0) * ($detail['rawat_inap_harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                    </x-ui.table-row>
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Visit</x-ui.table-cell>
                        <x-ui.table-cell variant="print" class="text-right">{{ $detail['visit_qty'] ?? 0 }} × Rp
                            {{ number_format($detail['visit_harga'] ?? 0, 0, ',', '.') }} = Rp
                            {{ number_format(($detail['visit_qty'] ?? 0) * ($detail['visit_harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                    </x-ui.table-row>
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Grooming</x-ui.table-cell>
                        <x-ui.table-cell variant="print" class="text-right">{{ $detail['grooming_qty'] ?? 0 }} × Rp
                            {{ number_format($detail['grooming_harga'] ?? 0, 0, ',', '.') }} = Rp
                            {{ number_format(($detail['grooming_qty'] ?? 0) * ($detail['grooming_harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                    </x-ui.table-row>
                    @if (isset($detail['lain_lain_items']) && is_array($detail['lain_lain_items']))
                        @foreach ($detail['lain_lain_items'] as $item)
                            <x-ui.table-row>
                                <x-ui.table-cell variant="print">{{ $item['nama'] ?? 'Item' }}</x-ui.table-cell>
                                <x-ui.table-cell variant="print" class="text-right">{{ $item['qty'] ?? 0 }} × Rp
                                    {{ number_format($item['harga'] ?? 0, 0, ',', '.') }} = Rp
                                    {{ number_format(($item['qty'] ?? 0) * ($item['harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                            </x-ui.table-row>
                        @endforeach
                    @endif
                </x-ui.table-body>
            </x-ui.table>
        @elseif($jabatan === 'FO')
            <x-ui.table variant="print">
                <x-ui.table-body>
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Review</x-ui.table-cell>
                        <x-ui.table-cell variant="print" class="text-right">{{ $detail['review_qty'] ?? 0 }} × Rp
                            {{ number_format($detail['review_harga'] ?? 0, 0, ',', '.') }} = Rp
                            {{ number_format(($detail['review_qty'] ?? 0) * ($detail['review_harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                    </x-ui.table-row>
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Appointment</x-ui.table-cell>
                        <x-ui.table-cell variant="print" class="text-right">{{ $detail['appointment_qty'] ?? 0 }} × Rp
                            {{ number_format($detail['appointment_harga'] ?? 0, 0, ',', '.') }} = Rp
                            {{ number_format(($detail['appointment_qty'] ?? 0) * ($detail['appointment_harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                    </x-ui.table-row>
                    @if (isset($detail['lain_lain_items']) && is_array($detail['lain_lain_items']))
                        @foreach ($detail['lain_lain_items'] as $item)
                            <x-ui.table-row>
                                <x-ui.table-cell variant="print">{{ $item['nama'] ?? 'Item' }}</x-ui.table-cell>
                                <x-ui.table-cell variant="print" class="text-right">{{ $item['qty'] ?? 0 }} × Rp
                                    {{ number_format($item['harga'] ?? 0, 0, ',', '.') }} = Rp
                                    {{ number_format(($item['qty'] ?? 0) * ($item['harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                            </x-ui.table-row>
                        @endforeach
                    @endif
                </x-ui.table-body>
            </x-ui.table>
        @elseif($jabatan === 'Tech')
            <x-ui.table variant="print">
                <x-ui.table-body>
                    <x-ui.table-row>
                        <x-ui.table-cell variant="print">Antar Konten</x-ui.table-cell>
                        <x-ui.table-cell variant="print" class="text-right">{{ $detail['antar_konten_qty'] ?? 0 }} × Rp
                            {{ number_format($detail['antar_konten_harga'] ?? 0, 0, ',', '.') }} = Rp
                            {{ number_format(($detail['antar_konten_qty'] ?? 0) * ($detail['antar_konten_harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                    </x-ui.table-row>
                    @if (isset($detail['lain_lain_items']) && is_array($detail['lain_lain_items']))
                        @foreach ($detail['lain_lain_items'] as $item)
                            <x-ui.table-row>
                                <x-ui.table-cell variant="print">{{ $item['nama'] ?? 'Item' }}</x-ui.table-cell>
                                <x-ui.table-cell variant="print" class="text-right">{{ $item['qty'] ?? 0 }} × Rp
                                    {{ number_format($item['harga'] ?? 0, 0, ',', '.') }} = Rp
                                    {{ number_format(($item['qty'] ?? 0) * ($item['harga'] ?? 0), 0, ',', '.') }}</x-ui.table-cell>
                            </x-ui.table-row>
                        @endforeach
                    @endif
                </x-ui.table-body>
            </x-ui.table>
        @endif
    </div>

    <x-ui.table variant="print" class="salary-table">
        <x-ui.table-body>
            <x-ui.table-row>
                <x-ui.table-cell variant="print" class="label"><strong>Total Insentif</strong></x-ui.table-cell>
                <x-ui.table-cell variant="print" class="value positive"><strong>+ Rp
                        {{ number_format($penggajian->total_insentif, 0, ',', '.') }}</strong></x-ui.table-cell>
            </x-ui.table-row>
        </x-ui.table-body>
    </x-ui.table>
</div>
