<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji - {{ $penggajian->user->name }} - {{ \Carbon\Carbon::parse($penggajian->periode)->format('F Y') }}</title>
    @include('components.penggajian.print.styles')
</head>
<body>
    @php
        $detail = $penggajian->insentif_detail ?? [];
        $jabatan = $penggajian->user->jabatan;
    @endphp

    <div class="container">
        <!-- Header -->
        <x-penggajian.print.header :penggajian="$penggajian" />

        <!-- Employee Info -->
        <x-penggajian.print.employee-info :penggajian="$penggajian" />

        <!-- Gaji Pokok -->
        <x-penggajian.print.gaji-pokok :penggajian="$penggajian" />

        <!-- Potongan -->
        <x-penggajian.print.potongan :penggajian="$penggajian" />

        <!-- Insentif -->
        <x-penggajian.print.insentif :penggajian="$penggajian" :detail="$detail" />

        <!-- Lembur -->
        <x-penggajian.print.lembur :penggajian="$penggajian" />

        <!-- Lain-lain -->
        <x-penggajian.print.lain-lain :penggajian="$penggajian" />

        <!-- Note -->
        @if($penggajian->catatan)
        <div class="note-section">
            <h5>Catatan:</h5>
            <p>{{ $penggajian->catatan }}</p>
        </div>
        @endif

        <!-- Total -->
        <x-penggajian.print.total :penggajian="$penggajian" />

        <!-- Footer Signatures -->
        <x-penggajian.print.footer :penggajian="$penggajian" />
    </div>

    <!-- Print Button -->
    <button class="print-button no-print" onclick="window.print()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="6,9 6,2 18,2 18,9"></polyline>
            <path d="M6,18 L4,18 C2.9,18 2,17.1 2,16 L2,11 C2,9.9 2.9,9 4,9 L20,9 C21.1,9 22,9.9 22,11 L22,16 C22,17.1 21.1,18 20,18 L18,18"></path>
            <rect x="6" y="14" width="12" height="8"></rect>
        </svg>
        Cetak Slip Gaji
    </button>
</body>
</html>
