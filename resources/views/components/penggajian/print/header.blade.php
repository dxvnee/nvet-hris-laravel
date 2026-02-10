@props(['penggajian'])

<div class="header">
    <div class="company-info">
        <img src="{{ asset('images/logo3.png') }}" alt="logo" class="company-logo-image" />
        <div class="company-text">
            <h1>NVet Clinic & Lab</h1>
            <p>Jn. Untung Suropati, RT.004/RW.007, Cimone Jaya, Karawaci, Kota Tangerang, Banten 15114</p>
            <p>Telp: +62 285-1177-1526 | nvetties@gmail.com</p>
        </div>
    </div>
    <div class="slip-info">
        <div class="slip-title">Dokumen Resmi</div>
        <div class="slip-heading">SLIP GAJI</div>
        <div class="slip-meta">
            Periode: {{ \Carbon\Carbon::parse($penggajian->periode)->format('F Y') }}<br>
            No: #{{ str_pad($penggajian->id, 6, '0', STR_PAD_LEFT) }}
        </div>
    </div>
</div>
