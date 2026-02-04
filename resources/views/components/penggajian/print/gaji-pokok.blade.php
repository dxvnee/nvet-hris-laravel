@props([
    'penggajian',
])

<div class="salary-section">
    <h4>
        <span style="color: #0D9488;">●</span> Gaji Pokok
    </h4>
    <table class="salary-table">
        <tr>
            <td class="label">Gaji Pokok</td>
            <td class="value positive">Rp {{ number_format($penggajian->gaji_pokok, 0, ',', '.') }}</td>
        </tr>
    </table>
</div>
