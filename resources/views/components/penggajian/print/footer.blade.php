@props([
    'penggajian',
])

<div class="footer">
    <div class="signature-box">
        <p>Penerima,</p>
        <div class="signature-line">
            {{ $penggajian->user->name }}
        </div>
    </div>
    <div class="signature-box">
        <p>Dikeluarkan oleh,</p>
        <div class="signature-line">
            Admin NVet Clinic
        </div>
    </div>
</div>

<p style="text-align: center; color: #888; font-size: 10px; margin-top: 30px;">
    Dokumen ini dicetak pada {{ now()->format('d F Y H:i') }}
</p>
