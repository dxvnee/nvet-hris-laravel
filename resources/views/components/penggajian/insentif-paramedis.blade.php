@props([
    'detail' => [],
])

<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-penggajian.qty-price-input 
            label="Antar Jemput"
            qty-name="insentif_detail[antar_jemput_qty]"
            harga-name="insentif_detail[antar_jemput_harga]"
            qty-model="paramedis.antarJemputQty"
            harga-model="paramedis.antarJemputHarga"
            :qty-value="$detail['antar_jemput_qty'] ?? 0"
            :harga-value="$detail['antar_jemput_harga'] ?? 0"
        />
        <x-penggajian.qty-price-input 
            label="Rawat Inap"
            qty-name="insentif_detail[rawat_inap_qty]"
            harga-name="insentif_detail[rawat_inap_harga]"
            qty-model="paramedis.rawatInapQty"
            harga-model="paramedis.rawatInapHarga"
            :qty-value="$detail['rawat_inap_qty'] ?? 0"
            :harga-value="$detail['rawat_inap_harga'] ?? 0"
        />
        <x-penggajian.qty-price-input 
            label="Visit"
            qty-name="insentif_detail[visit_qty]"
            harga-name="insentif_detail[visit_harga]"
            qty-model="paramedis.visitQty"
            harga-model="paramedis.visitHarga"
            :qty-value="$detail['visit_qty'] ?? 0"
            :harga-value="$detail['visit_harga'] ?? 0"
        />
        <x-penggajian.qty-price-input 
            label="Grooming"
            qty-name="insentif_detail[grooming_qty]"
            harga-name="insentif_detail[grooming_harga]"
            qty-model="paramedis.groomingQty"
            harga-model="paramedis.groomingHarga"
            :qty-value="$detail['grooming_qty'] ?? 0"
            :harga-value="$detail['grooming_harga'] ?? 0"
        />
    </div>
    
    <x-penggajian.dynamic-insentif-items model-name="paramedis.lainLainItems" />
    
    <x-penggajian.insentif-total total-text="calculateParamedisInsentif()" />
</div>
