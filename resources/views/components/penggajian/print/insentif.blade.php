@props([
    'penggajian',
    'detail' => [],
])

@php
    $jabatan = $penggajian->user->jabatan;
@endphp

<div class="salary-section">
    <h4>
        <span style="color: #16a34a;">●</span> Insentif ({{ $jabatan }})
    </h4>

    <div class="insentif-detail">
        @if($jabatan === 'Dokter')
            <table>
                <tr>
                    <td>Total Transaksi</td>
                    <td style="text-align: right;">Rp {{ number_format($detail['transaksi'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Persentase Insentif</td>
                    <td style="text-align: right;">{{ $detail['persenan'] ?? 0 }}%</td>
                </tr>
                <tr>
                    <td>Pengurangan</td>
                    <td style="text-align: right;">- Rp {{ number_format($detail['pengurangan'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                @if(!empty($detail['keterangan_pengurangan']))
                    <tr><td colspan="2" style="color: #888; font-style: italic;">{{ $detail['keterangan_pengurangan'] }}</td></tr>
                @endif
                <tr>
                    <td>Penambahan</td>
                    <td style="text-align: right;">+ Rp {{ number_format($detail['penambahan'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                @if(!empty($detail['keterangan_penambahan']))
                    <tr><td colspan="2" style="color: #888; font-style: italic;">{{ $detail['keterangan_penambahan'] }}</td></tr>
                @endif
                @if(isset($detail['lain_lain_items']) && is_array($detail['lain_lain_items']))
                    @foreach($detail['lain_lain_items'] as $item)
                        <tr>
                            <td>{{ $item['nama'] ?? 'Item' }}</td>
                            <td style="text-align: right;">{{ $item['qty'] ?? 0 }} × Rp {{ number_format($item['harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($item['qty'] ?? 0) * ($item['harga'] ?? 0), 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        @elseif($jabatan === 'Paramedis')
            <table>
                <tr>
                    <td>Antar Jemput</td>
                    <td style="text-align: right;">{{ $detail['antar_jemput_qty'] ?? 0 }} × Rp {{ number_format($detail['antar_jemput_harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($detail['antar_jemput_qty'] ?? 0) * ($detail['antar_jemput_harga'] ?? 0), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Rawat Inap</td>
                    <td style="text-align: right;">{{ $detail['rawat_inap_qty'] ?? 0 }} × Rp {{ number_format($detail['rawat_inap_harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($detail['rawat_inap_qty'] ?? 0) * ($detail['rawat_inap_harga'] ?? 0), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Visit</td>
                    <td style="text-align: right;">{{ $detail['visit_qty'] ?? 0 }} × Rp {{ number_format($detail['visit_harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($detail['visit_qty'] ?? 0) * ($detail['visit_harga'] ?? 0), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Grooming</td>
                    <td style="text-align: right;">{{ $detail['grooming_qty'] ?? 0 }} × Rp {{ number_format($detail['grooming_harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($detail['grooming_qty'] ?? 0) * ($detail['grooming_harga'] ?? 0), 0, ',', '.') }}</td>
                </tr>
                @if(isset($detail['lain_lain_items']) && is_array($detail['lain_lain_items']))
                    @foreach($detail['lain_lain_items'] as $item)
                        <tr>
                            <td>{{ $item['nama'] ?? 'Item' }}</td>
                            <td style="text-align: right;">{{ $item['qty'] ?? 0 }} × Rp {{ number_format($item['harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($item['qty'] ?? 0) * ($item['harga'] ?? 0), 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        @elseif($jabatan === 'FO')
            <table>
                <tr>
                    <td>Review</td>
                    <td style="text-align: right;">{{ $detail['review_qty'] ?? 0 }} × Rp {{ number_format($detail['review_harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($detail['review_qty'] ?? 0) * ($detail['review_harga'] ?? 0), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Appointment</td>
                    <td style="text-align: right;">{{ $detail['appointment_qty'] ?? 0 }} × Rp {{ number_format($detail['appointment_harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($detail['appointment_qty'] ?? 0) * ($detail['appointment_harga'] ?? 0), 0, ',', '.') }}</td>
                </tr>
                @if(isset($detail['lain_lain_items']) && is_array($detail['lain_lain_items']))
                    @foreach($detail['lain_lain_items'] as $item)
                        <tr>
                            <td>{{ $item['nama'] ?? 'Item' }}</td>
                            <td style="text-align: right;">{{ $item['qty'] ?? 0 }} × Rp {{ number_format($item['harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($item['qty'] ?? 0) * ($item['harga'] ?? 0), 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        @elseif($jabatan === 'Tech')
            <table>
                <tr>
                    <td>Antar Konten</td>
                    <td style="text-align: right;">{{ $detail['antar_konten_qty'] ?? 0 }} × Rp {{ number_format($detail['antar_konten_harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($detail['antar_konten_qty'] ?? 0) * ($detail['antar_konten_harga'] ?? 0), 0, ',', '.') }}</td>
                </tr>
                @if(isset($detail['lain_lain_items']) && is_array($detail['lain_lain_items']))
                    @foreach($detail['lain_lain_items'] as $item)
                        <tr>
                            <td>{{ $item['nama'] ?? 'Item' }}</td>
                            <td style="text-align: right;">{{ $item['qty'] ?? 0 }} × Rp {{ number_format($item['harga'] ?? 0, 0, ',', '.') }} = Rp {{ number_format(($item['qty'] ?? 0) * ($item['harga'] ?? 0), 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        @endif
    </div>

    <table class="salary-table">
        <tr>
            <td class="label"><strong>Total Insentif</strong></td>
            <td class="value positive"><strong>+ Rp {{ number_format($penggajian->total_insentif, 0, ',', '.') }}</strong></td>
        </tr>
    </table>
</div>
