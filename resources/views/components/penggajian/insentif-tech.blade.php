@props([
    'detail' => [],
])

<div class="space-y-4">
    <x-penggajian.qty-price-input 
        label="Antar Konten"
        qty-name="insentif_detail[antar_konten_qty]"
        harga-name="insentif_detail[antar_konten_harga]"
        qty-model="tech.antarKontenQty"
        harga-model="tech.antarKontenHarga"
        :qty-value="$detail['antar_konten_qty'] ?? 0"
        :harga-value="$detail['antar_konten_harga'] ?? 0"
    />
    
    <x-penggajian.dynamic-insentif-items model-name="tech.lainLainItems" />
    
    <x-penggajian.insentif-total total-text="calculateTechInsentif()" />
</div>
