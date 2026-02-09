@props(['penggajian'])

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

<p class="print-timestamp">
    Dokumen ini dicetak pada {{ now()->format('d F Y, H:i') }} WIB
</p>
</div> {{-- close .body-content --}}
