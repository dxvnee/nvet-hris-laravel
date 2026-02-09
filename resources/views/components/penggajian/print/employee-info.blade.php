@props(['penggajian'])

@php
    $jabatan = $penggajian->user->jabatan;
@endphp

<div class="body-content">
    <div class="employee-section">
        <img src="{{ $penggajian->user->avatar ? asset('storage/' . $penggajian->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($penggajian->user->name) . '&color=855E41&background=f5f0eb&size=64&bold=true' }}"
            alt="{{ $penggajian->user->name }}" class="employee-photo">
        <div class="employee-main">
            <div class="employee-name">{{ $penggajian->user->name }}</div>
            <div class="employee-meta">
                <div class="employee-meta-item">
                    <span class="badge badge-{{ strtolower($jabatan) }}">{{ $jabatan }}</span>
                </div>
                <div class="employee-meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                    {{ $penggajian->user->email }}
                </div>
                @if ($penggajian->user->jam_kerja)
                    <div class="employee-meta-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        {{ $penggajian->user->jam_kerja }} jam/minggu
                    </div>
                @endif
            </div>
        </div>
    </div>
