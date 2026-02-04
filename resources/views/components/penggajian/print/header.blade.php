@props([
    'penggajian',
])

<div class="header">
    <div class="company-info">
        <h1>NVet Clinic</h1>
        <p>Jl. Contoh No. 123, Kota XYZ</p>
        <p>Telp: (021) 123-4567 | Email: info@nvet.id</p>
    </div>
    <div class="slip-info">
        <h2>SLIP GAJI</h2>
        <p>Periode: {{ \Carbon\Carbon::parse($penggajian->periode)->format('F Y') }}</p>
        <p>ID: #{{ str_pad($penggajian->id, 6, '0', STR_PAD_LEFT) }}</p>
        <span class="status-badge {{ $penggajian->status === 'final' ? 'status-final' : 'status-draft' }}">
            {{ $penggajian->status }}
        </span>
    </div>
</div>
