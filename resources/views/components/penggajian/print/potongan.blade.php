@props([
    'penggajian',
])

<div class="salary-section">
    <h4>
        <span style="color: #dc2626;">●</span> Potongan
    </h4>
    <table class="salary-table">
        <tr>
            <td class="label">Potongan Keterlambatan</td>
            <td class="value negative">- Rp {{ number_format($penggajian->total_potongan_telat, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="sub-label">{{ $penggajian->total_menit_telat }} menit × Rp {{ number_format($penggajian->potongan_per_menit, 0, ',', '.') }}/menit</td>
            <td></td>
        </tr>
        @if(($penggajian->total_lupa_pulang ?? 0) > 0)
        <tr>
            <td class="label">Potongan Lupa Absen Pulang</td>
            <td class="value negative">- Rp {{ number_format($penggajian->potongan_lupa_pulang ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="sub-label">{{ $penggajian->total_lupa_pulang }} kali (potong 1 jam jika > 3x)</td>
            <td></td>
        </tr>
        @endif
        @if(($penggajian->total_tidak_hadir ?? 0) > 0)
        <tr>
            <td class="label">Potongan Tidak Hadir</td>
            <td class="value negative">- Rp {{ number_format($penggajian->total_potongan_tidak_hadir ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="sub-label">{{ $penggajian->total_tidak_hadir }} hari × Rp {{ number_format($penggajian->potongan_per_tidak_hadir ?? 0, 0, ',', '.') }}/hari</td>
            <td></td>
        </tr>
        @endif
    </table>
</div>
