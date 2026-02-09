@props(['penggajian'])

@php
    $lainLainItems = $penggajian->lain_lain_items ?? [];
    $totalPotongan =
        ($penggajian->total_potongan_telat ?? 0) +
        ($penggajian->potongan_lupa_pulang ?? 0) +
        ($penggajian->total_potongan_tidak_hadir ?? 0);
    $subtotalGaji = $penggajian->gaji_pokok - $totalPotongan + ($penggajian->lain_lain ?? 0);
    $hasPotongan = $totalPotongan > 0;
    $hasLainLain = count($lainLainItems) > 0;
@endphp

<div class="section-card">
    {{-- Card Header --}}
    <div class="section-card-header">
        <div class="card-icon gaji">💰</div>
        <h3>Gaji Pokok & Potongan</h3>
    </div>

    <div class="section-card-body">
        {{-- Gaji Pokok --}}
        <div class="subsection">
            <div class="subsection-title">
                <span class="dot dot-green"></span>
                Gaji Pokok
            </div>
            <table class="data-table">
                <tr>
                    <td class="label">Gaji Pokok Bulanan</td>
                    <td class="value positive">Rp {{ number_format($penggajian->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        {{-- Potongan --}}
        @if ($hasPotongan)
            <div class="subsection">
                <div class="subsection-title">
                    <span class="dot dot-red"></span>
                    Potongan
                </div>
                <table class="data-table">
                    @if (($penggajian->total_potongan_telat ?? 0) > 0)
                        <tr>
                            <td class="label">Potongan Keterlambatan</td>
                            <td class="value negative">- Rp
                                {{ number_format($penggajian->total_potongan_telat, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="sub-label" colspan="2">{{ $penggajian->total_menit_telat }} menit &times; Rp
                                {{ number_format($penggajian->potongan_per_menit, 0, ',', '.') }}/menit</td>
                        </tr>
                    @endif
                    @if (($penggajian->total_lupa_pulang ?? 0) > 0)
                        <tr>
                            <td class="label">Potongan Lupa Absen Pulang</td>
                            <td class="value negative">- Rp
                                {{ number_format($penggajian->potongan_lupa_pulang ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="sub-label" colspan="2">{{ $penggajian->total_lupa_pulang }} kali (potong 1 jam
                                jika &gt; 3&times;)</td>
                        </tr>
                    @endif
                    @if (($penggajian->total_tidak_hadir ?? 0) > 0)
                        <tr>
                            <td class="label">Potongan Tidak Hadir</td>
                            <td class="value negative">- Rp
                                {{ number_format($penggajian->total_potongan_tidak_hadir ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="sub-label" colspan="2">{{ $penggajian->total_tidak_hadir }} hari &times; Rp
                                {{ number_format($penggajian->potongan_per_tidak_hadir ?? 0, 0, ',', '.') }}/hari</td>
                        </tr>
                    @endif
                </table>
            </div>
        @endif

        {{-- Lain-lain --}}
        @if ($hasLainLain)
            <div class="subsection">
                <div class="subsection-title">
                    <span class="dot dot-orange"></span>
                    Lain-lain
                </div>
                <table class="data-table">
                    @foreach ($lainLainItems as $item)
                        @if (isset($item['nama']) && ($item['nilai'] ?? 0) != 0)
                            <tr>
                                <td class="label">{{ $item['nama'] }}</td>
                                <td class="value {{ $item['nilai'] >= 0 ? 'positive' : 'negative' }}">
                                    {{ $item['nilai'] >= 0 ? '+' : '' }} Rp
                                    {{ number_format($item['nilai'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        @endif
    </div>

    {{-- Subtotal --}}
    <div class="subtotal-row">
        <span class="subtotal-label">Subtotal Gaji Pokok</span>
        <span class="subtotal-value {{ $subtotalGaji >= 0 ? 'subtotal-positive' : 'subtotal-negative' }}">
            Rp {{ number_format($subtotalGaji, 0, ',', '.') }}
        </span>
    </div>
</div>
