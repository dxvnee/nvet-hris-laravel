@props([
    'detail' => [],
])

<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-penggajian.currency-input 
            label="Total Transaksi"
            name="insentif_detail[transaksi]"
            x-model="dokter.transaksi"
            :value="$detail['transaksi'] ?? 0"
        />
        <x-penggajian.currency-input 
            label="Persentase Insentif (%)"
            name="insentif_detail[persenan]"
            x-model="dokter.persenan"
            :value="$detail['persenan'] ?? 0"
            prefix=""
            suffix="%"
            step="0.1"
        />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-penggajian.currency-input 
                label="Pengurangan"
                name="insentif_detail[pengurangan]"
                x-model="dokter.pengurangan"
                :value="$detail['pengurangan'] ?? 0"
            />
            <input type="text" name="insentif_detail[keterangan_pengurangan]"
                value="{{ $detail['keterangan_pengurangan'] ?? '' }}"
                placeholder="Keterangan pengurangan..."
                class="w-full mt-2 px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
        </div>
        <div>
            <x-penggajian.currency-input 
                label="Penambahan"
                name="insentif_detail[penambahan]"
                x-model="dokter.penambahan"
                :value="$detail['penambahan'] ?? 0"
            />
            <input type="text" name="insentif_detail[keterangan_penambahan]"
                value="{{ $detail['keterangan_penambahan'] ?? '' }}"
                placeholder="Keterangan penambahan..."
                class="w-full mt-2 px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
        </div>
    </div>
    
    <x-penggajian.dynamic-insentif-items model-name="dokter.lainLainItems" />
    
    <x-penggajian.insentif-total 
        formula="Formula: Transaksi - (Pengurangan + Penambahan) × Persenan + Lain-lain"
        total-text="calculateDokterInsentif()"
    />
</div>
