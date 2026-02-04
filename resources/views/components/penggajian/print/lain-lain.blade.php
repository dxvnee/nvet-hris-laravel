@props([
    'penggajian',
])

@php
    $lainLainItems = $penggajian->lain_lain_items ?? [];
@endphp

@if(count($lainLainItems) > 0)
<div class="salary-section">
    <h4>
        <span style="color: #f59e0b;">●</span> Lain-lain
    </h4>
    <table class="salary-table">
        @foreach($lainLainItems as $item)
            @if(isset($item['nama']) && $item['nilai'] != 0)
            <tr>
                <td class="label">{{ $item['nama'] }}</td>
                <td class="value {{ $item['nilai'] >= 0 ? 'positive' : 'negative' }}">
                    {{ $item['nilai'] >= 0 ? '+ ' : '' }}Rp {{ number_format($item['nilai'], 0, ',', '.') }}
                </td>
            </tr>
            @endif
        @endforeach
        <tr>
            <td class="label"><strong>Total Lain-lain</strong></td>
            <td class="value {{ $penggajian->lain_lain >= 0 ? 'positive' : 'negative' }}">
                <strong>{{ $penggajian->lain_lain >= 0 ? '+ ' : '' }}Rp {{ number_format($penggajian->lain_lain, 0, ',', '.') }}</strong>
            </td>
        </tr>
    </table>
</div>
@endif
