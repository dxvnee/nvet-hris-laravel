@props([
    'penggajian',
])

<div class="total-section">
    <table>
        <tr>
            <td class="total-label">TOTAL GAJI DITERIMA</td>
            <td class="total-value">Rp {{ number_format($penggajian->total_gaji, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2" class="breakdown">
                Gaji Pokok (Rp {{ number_format($penggajian->gaji_pokok, 0, ',', '.') }})
                - Potongan Telat (Rp {{ number_format($penggajian->total_potongan_telat, 0, ',', '.') }})
                @if(($penggajian->potongan_lupa_pulang ?? 0) > 0)
                - Lupa Pulang (Rp {{ number_format($penggajian->potongan_lupa_pulang, 0, ',', '.') }})
                @endif
                @if(($penggajian->total_potongan_tidak_hadir ?? 0) > 0)
                - Tidak Hadir (Rp {{ number_format($penggajian->total_potongan_tidak_hadir, 0, ',', '.') }})
                @endif
                + Insentif (Rp {{ number_format($penggajian->total_insentif, 0, ',', '.') }})
                @if(($penggajian->total_upah_lembur ?? 0) > 0)
                + Lembur (Rp {{ number_format($penggajian->total_upah_lembur ?? 0, 0, ',', '.') }})
                @endif
                @if($penggajian->lain_lain != 0)
                {{ $penggajian->lain_lain >= 0 ? '+' : '' }} Lain-lain (Rp {{ number_format($penggajian->lain_lain, 0, ',', '.') }})
                @endif
            </td>
        </tr>
    </table>
</div>
