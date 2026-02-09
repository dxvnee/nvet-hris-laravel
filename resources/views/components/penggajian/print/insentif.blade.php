@props(['penggajian', 'detail' => []])

@php
    $jabatan = $penggajian->user->jabatan;
    $insentifLainLain = $detail['lain_lain_items'] ?? [];
    $hasLembur = ($penggajian->total_menit_lembur ?? 0) > 0;
    $subtotalInsentif = ($penggajian->total_insentif ?? 0) + ($penggajian->total_upah_lembur ?? 0);
@endphp

<div class="section-card">
    {{-- Card Header --}}
    <div class="section-card-header">
        <div class="card-icon insentif">⭐</div>
        <h3>Insentif & Lembur</h3>
    </div>

    <div class="section-card-body">
        {{-- Insentif Jabatan --}}
        <div class="subsection">
            <div class="subsection-title">
                <span class="dot dot-purple"></span>
                Insentif {{ $jabatan }}
            </div>

            {{-- Detail Box per Jabatan --}}
            <div class="detail-box">
                <table>
                    @if ($jabatan === 'Dokter')
                        <tr>
                            <td>Total Transaksi</td>
                            <td>Rp {{ number_format($detail['transaksi'] ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Persentase Insentif</td>
                            <td>{{ $detail['persenan'] ?? 0 }}%</td>
                        </tr>
                        @if (($detail['pengurangan'] ?? 0) > 0)
                            <tr>
                                <td>Pengurangan</td>
                                <td style="color: var(--negative);">- Rp
                                    {{ number_format($detail['pengurangan'] ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            @if (!empty($detail['keterangan_pengurangan']))
                                <tr>
                                    <td colspan="2" class="detail-note">{{ $detail['keterangan_pengurangan'] }}</td>
                                </tr>
                            @endif
                        @endif
                        @if (($detail['penambahan'] ?? 0) > 0)
                            <tr>
                                <td>Penambahan</td>
                                <td style="color: var(--positive);">+ Rp
                                    {{ number_format($detail['penambahan'] ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            @if (!empty($detail['keterangan_penambahan']))
                                <tr>
                                    <td colspan="2" class="detail-note">{{ $detail['keterangan_penambahan'] }}</td>
                                </tr>
                            @endif
                        @endif
                    @elseif($jabatan === 'Paramedis')
                        <tr>
                            <td>Antar Jemput</td>
                            <td>{{ $detail['antar_jemput_qty'] ?? 0 }} &times; Rp
                                {{ number_format($detail['antar_jemput_harga'] ?? 0, 0, ',', '.') }} = Rp
                                {{ number_format(($detail['antar_jemput_qty'] ?? 0) * ($detail['antar_jemput_harga'] ?? 0), 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Rawat Inap</td>
                            <td>{{ $detail['rawat_inap_qty'] ?? 0 }} &times; Rp
                                {{ number_format($detail['rawat_inap_harga'] ?? 0, 0, ',', '.') }} = Rp
                                {{ number_format(($detail['rawat_inap_qty'] ?? 0) * ($detail['rawat_inap_harga'] ?? 0), 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Visit</td>
                            <td>{{ $detail['visit_qty'] ?? 0 }} &times; Rp
                                {{ number_format($detail['visit_harga'] ?? 0, 0, ',', '.') }} = Rp
                                {{ number_format(($detail['visit_qty'] ?? 0) * ($detail['visit_harga'] ?? 0), 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Grooming</td>
                            <td>{{ $detail['grooming_qty'] ?? 0 }} &times; Rp
                                {{ number_format($detail['grooming_harga'] ?? 0, 0, ',', '.') }} = Rp
                                {{ number_format(($detail['grooming_qty'] ?? 0) * ($detail['grooming_harga'] ?? 0), 0, ',', '.') }}
                            </td>
                        </tr>
                    @elseif($jabatan === 'FO')
                        <tr>
                            <td>Review</td>
                            <td>{{ $detail['review_qty'] ?? 0 }} &times; Rp
                                {{ number_format($detail['review_harga'] ?? 0, 0, ',', '.') }} = Rp
                                {{ number_format(($detail['review_qty'] ?? 0) * ($detail['review_harga'] ?? 0), 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Appointment</td>
                            <td>{{ $detail['appointment_qty'] ?? 0 }} &times; Rp
                                {{ number_format($detail['appointment_harga'] ?? 0, 0, ',', '.') }} = Rp
                                {{ number_format(($detail['appointment_qty'] ?? 0) * ($detail['appointment_harga'] ?? 0), 0, ',', '.') }}
                            </td>
                        </tr>
                    @elseif($jabatan === 'Tech')
                        <tr>
                            <td>Antar Konten</td>
                            <td>{{ $detail['antar_konten_qty'] ?? 0 }} &times; Rp
                                {{ number_format($detail['antar_konten_harga'] ?? 0, 0, ',', '.') }} = Rp
                                {{ number_format(($detail['antar_konten_qty'] ?? 0) * ($detail['antar_konten_harga'] ?? 0), 0, ',', '.') }}
                            </td>
                        </tr>
                    @endif

                    {{-- Insentif Lain-lain Items (nilai format) --}}
                    @if (count($insentifLainLain) > 0)
                        @foreach ($insentifLainLain as $item)
                            @if (isset($item['nama']) && ($item['nilai'] ?? 0) != 0)
                                <tr>
                                    <td>{{ $item['nama'] }}</td>
                                    <td
                                        style="color: {{ ($item['nilai'] ?? 0) >= 0 ? 'var(--positive)' : 'var(--negative)' }};">
                                        {{ ($item['nilai'] ?? 0) >= 0 ? '+' : '' }} Rp
                                        {{ number_format($item['nilai'] ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </table>
            </div>

            {{-- Total Insentif --}}
            <table class="data-table" style="margin-top: 10px;">
                <tr>
                    <td class="label"><strong>Total Insentif</strong></td>
                    <td class="value {{ $penggajian->total_insentif >= 0 ? 'positive' : 'negative' }}">
                        <strong>{{ $penggajian->total_insentif >= 0 ? '+' : '' }} Rp
                            {{ number_format($penggajian->total_insentif, 0, ',', '.') }}</strong>
                    </td>
                </tr>
            </table>
        </div>

        {{-- Lembur --}}
        @if ($hasLembur)
            <div class="subsection">
                <div class="subsection-title">
                    <span class="dot dot-blue"></span>
                    Lembur
                </div>
                <table class="data-table">
                    <tr>
                        <td class="label">Durasi Lembur</td>
                        <td class="value muted-value">
                            {{ floor(($penggajian->total_menit_lembur ?? 0) / 60) }} jam
                            {{ ($penggajian->total_menit_lembur ?? 0) % 60 }} menit
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Upah per Menit</td>
                        <td class="value muted-value">Rp
                            {{ number_format($penggajian->upah_lembur_per_menit ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="label"><strong>Total Upah Lembur</strong></td>
                        <td class="value positive"><strong>+ Rp
                                {{ number_format($penggajian->total_upah_lembur ?? 0, 0, ',', '.') }}</strong></td>
                    </tr>
                </table>
            </div>
        @endif
    </div>

    {{-- Subtotal --}}
    <div class="subtotal-row">
        <span class="subtotal-label">Subtotal Insentif & Lembur</span>
        <span class="subtotal-value {{ $subtotalInsentif >= 0 ? 'subtotal-positive' : 'subtotal-negative' }}">
            {{ $subtotalInsentif >= 0 ? '' : '-' }} Rp {{ number_format(abs($subtotalInsentif), 0, ',', '.') }}
        </span>
    </div>
</div>
