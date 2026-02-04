@props([
    'detail' => [],
])

<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-penggajian.qty-price-input 
            label="Review"
            qty-name="insentif_detail[review_qty]"
            harga-name="insentif_detail[review_harga]"
            qty-model="fo.reviewQty"
            harga-model="fo.reviewHarga"
            :qty-value="$detail['review_qty'] ?? 0"
            :harga-value="$detail['review_harga'] ?? 0"
        />
        <x-penggajian.qty-price-input 
            label="Appointment"
            qty-name="insentif_detail[appointment_qty]"
            harga-name="insentif_detail[appointment_harga]"
            qty-model="fo.appointmentQty"
            harga-model="fo.appointmentHarga"
            :qty-value="$detail['appointment_qty'] ?? 0"
            :harga-value="$detail['appointment_harga'] ?? 0"
        />
    </div>
    
    <x-penggajian.dynamic-insentif-items model-name="fo.lainLainItems" />
    
    <x-penggajian.insentif-total total-text="calculateFOInsentif()" />
</div>
