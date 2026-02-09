@props(['penggajian'])

<div class="header">
    <div class="company-info">
        <div class="company-logo">N</div>
        <div class="company-text">
            <h1>NVet Clinic</h1>
            <p>Jl. Contoh No. 123, Kota XYZ</p>
            <p>Telp: (021) 123-4567 | info@nvet.id</p>
        </div>
    </div>
    <div class="slip-info">
        <div class="slip-title">Dokumen Resmi</div>
        <div class="slip-heading">SLIP GAJI</div>
        <div class="slip-meta">
            Periode: {{ \Carbon\Carbon::parse($penggajian->periode)->format('F Y') }}<br>
            No: #{{ str_pad($penggajian->id, 6, '0', STR_PAD_LEFT) }}
        </div>
        <span class="status-badge {{ $penggajian->status === 'final' ? 'status-final' : 'status-draft' }}">
            {{ $penggajian->status === 'final' ? '● Final' : '● Draft' }}
        </span>
    </div>
</div>
