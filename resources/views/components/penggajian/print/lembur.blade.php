@props([
    'penggajian',
])

@if($penggajian->total_menit_lembur ?? 0 > 0)
<div class="salary-section">
    <h4>
        <span style="color: #8b5cf6;">●</span> Lembur
    </h4>
    <table class="salary-table">
        <tr>
            <td class="label">Total Menit Lembur</td>
            <td class="value">{{ $penggajian->total_menit_lembur ?? 0 }} menit</td>
        </tr>
        <tr>
            <td class="sub-label">{{ floor(($penggajian->total_menit_lembur ?? 0) / 60) }} jam {{ ($penggajian->total_menit_lembur ?? 0) % 60 }} menit</td>
            <td></td>
        </tr>
        <tr>
            <td class="label">Upah Lembur per Menit</td>
            <td class="value">Rp {{ number_format($penggajian->upah_lembur_per_menit ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label"><strong>Total Upah Lembur</strong></td>
            <td class="value positive"><strong>+ Rp {{ number_format($penggajian->total_upah_lembur ?? 0, 0, ',', '.') }}</strong></td>
        </tr>
    </table>
</div>
@endif
