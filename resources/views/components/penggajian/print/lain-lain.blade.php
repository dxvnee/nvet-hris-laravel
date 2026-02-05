@props(['penggajian'])

@php
    $lainLainItems = $penggajian->lain_lain_items ?? [];
@endphp

@if (count($lainLainItems) > 0)
    <div class="salary-section">
        <h4>
            <span style="color: #f59e0b;">●</span> Lain-lain
        </h4>
        <x-ui.table variant="print" class="salary-table">
            <x-ui.table-body>
                @foreach ($lainLainItems as $item)
                    @if (isset($item['nama']) && $item['nilai'] != 0)
                        <x-ui.table-row>
                            <x-ui.table-cell variant="print" class="label">{{ $item['nama'] }}</x-ui.table-cell>
                            <x-ui.table-cell variant="print"
                                class="value {{ $item['nilai'] >= 0 ? 'positive' : 'negative' }}">
                                {{ $item['nilai'] >= 0 ? '+ ' : '' }}Rp {{ number_format($item['nilai'], 0, ',', '.') }}
                            </x-ui.table-cell>
                        </x-ui.table-row>
                    @endif
                @endforeach
                <x-ui.table-row>
                    <x-ui.table-cell variant="print" class="label"><strong>Total Lain-lain</strong></x-ui.table-cell>
                    <x-ui.table-cell variant="print"
                        class="value {{ $penggajian->lain_lain >= 0 ? 'positive' : 'negative' }}">
                        <strong>{{ $penggajian->lain_lain >= 0 ? '+ ' : '' }}Rp
                            {{ number_format($penggajian->lain_lain, 0, ',', '.') }}</strong>
                    </x-ui.table-cell>
                </x-ui.table-row>
            </x-ui.table-body>
        </x-ui.table>
    </div>
@endif
