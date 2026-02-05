{{-- Universal Insentif Section - Configurable for all roles --}}
@props([
    'role', // dokter, paramedis, fo, tech
    'detail' => [],
])

@php
    // Konfigurasi item berdasarkan jabatan
    $configs = [
        'paramedis' => [
            'model' => 'paramedis',
            'calcFunc' => 'calculateParamedisInsentif()',
            'items' => [
                [
                    'key' => 'antar_jemput',
                    'label' => 'Antar Jemput',
                    'qtyModel' => 'antarJemputQty',
                    'hargaModel' => 'antarJemputHarga',
                ],
                [
                    'key' => 'rawat_inap',
                    'label' => 'Rawat Inap',
                    'qtyModel' => 'rawatInapQty',
                    'hargaModel' => 'rawatInapHarga',
                ],
                ['key' => 'visit', 'label' => 'Visit', 'qtyModel' => 'visitQty', 'hargaModel' => 'visitHarga'],
                [
                    'key' => 'grooming',
                    'label' => 'Grooming',
                    'qtyModel' => 'groomingQty',
                    'hargaModel' => 'groomingHarga',
                ],
            ],
        ],
        'fo' => [
            'model' => 'fo',
            'calcFunc' => 'calculateFOInsentif()',
            'items' => [
                ['key' => 'review', 'label' => 'Review', 'qtyModel' => 'reviewQty', 'hargaModel' => 'reviewHarga'],
                [
                    'key' => 'appointment',
                    'label' => 'Appointment',
                    'qtyModel' => 'appointmentQty',
                    'hargaModel' => 'appointmentHarga',
                ],
            ],
        ],
        'tech' => [
            'model' => 'tech',
            'calcFunc' => 'calculateTechInsentif()',
            'items' => [
                [
                    'key' => 'antar_konten',
                    'label' => 'Antar Konten',
                    'qtyModel' => 'antarKontenQty',
                    'hargaModel' => 'antarKontenHarga',
                ],
            ],
        ],
    ];

    $config = $configs[$role] ?? null;
@endphp

@if ($config)
    <div class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($config['items'] as $item)
                <x-ui.qty-price-input :label="$item['label']" :qtyName="'insentif_detail[' . $item['key'] . '_qty]'" :priceName="'insentif_detail[' . $item['key'] . '_harga]'" :qtyModel="$config['model'] . '.' . $item['qtyModel']"
                    :priceModel="$config['model'] . '.' . $item['hargaModel']" :qtyValue="$detail[$item['key'] . '_qty'] ?? 0" :priceValue="$detail[$item['key'] . '_harga'] ?? 0" />
            @endforeach
        </div>

        <x-penggajian.dynamic-insentif-items :model-name="$config['model'] . '.lainLainItems'" />

        <x-ui.value-display label="Total Insentif" variant="green" :xText="'formatNumber(' . $config['calcFunc'] . ')'" showSign />
    </div>
@endif
