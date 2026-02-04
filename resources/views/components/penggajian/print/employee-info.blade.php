@props([
    'penggajian',
])

@php
    $jabatan = $penggajian->user->jabatan;
@endphp

<div class="employee-section">
    <img src="{{ $penggajian->user->avatar ? asset('storage/' . $penggajian->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($penggajian->user->name) . '&color=7F9CF5&background=EBF4FF&size=80' }}"
        alt="{{ $penggajian->user->name }}"
        class="employee-photo">
    <div class="employee-details">
        <h3>{{ $penggajian->user->name }}</h3>
        <table>
            <tr>
                <td>Jabatan</td>
                <td>
                    <span class="badge badge-{{ strtolower($jabatan) }}">{{ $jabatan }}</span>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $penggajian->user->email }}</td>
            </tr>
            <tr>
                <td>Jam Kerja</td>
                <td>{{ $penggajian->user->jam_kerja ?? '-' }} jam/minggu</td>
            </tr>
        </table>
    </div>
</div>
