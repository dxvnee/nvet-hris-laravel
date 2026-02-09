@props(['penggajian'])

@php
    $totalPotongan =
        ($penggajian->total_potongan_telat ?? 0) +
        ($penggajian->potongan_lupa_pulang ?? 0) +
        ($penggajian->total_potongan_tidak_hadir ?? 0);
    $subtotalGaji = $penggajian->gaji_pokok - $totalPotongan + ($penggajian->lain_lain ?? 0);
    $subtotalInsentif = ($penggajian->total_insentif ?? 0) + ($penggajian->total_upah_lembur ?? 0);
@endphp

<div class="total-section">
    {{-- Breakdown --}}
    <div class="total-breakdown">
        <div class="total-breakdown-item">
            <div class="bd-label">Subtotal Gaji Pokok</div>
            <div class="bd-value">Rp {{ number_format($subtotalGaji, 0, ',', '.') }}</div>
        </div>
        <div class="total-breakdown-item">
            <div class="bd-label">Subtotal Insentif & Lembur</div>
            <div class="bd-value">Rp {{ number_format($subtotalInsentif, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- Total --}}
    <div class="total-main">
        <div class="total-label">Total Gaji Diterima</div>
        <div class="total-value">Rp {{ number_format($penggajian->total_gaji, 0, ',', '.') }}</div>
    </div>
</div>
