@props([
    'detail' => [],
])

<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-ui.form-input type="number" label="Total Transaksi" name="insentif_detail[transaksi]" x-model="dokter.transaksi"
            :value="$detail['transaksi'] ?? 0" prefix="Rp" variant="rounded" />
        <x-ui.form-input type="number" label="Persentase Insentif (%)" name="insentif_detail[persenan]"
            x-model="dokter.persenan" :value="$detail['persenan'] ?? 0" suffix="%" step="0.1" variant="rounded" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-2">
            <x-ui.form-input type="number" label="Pengurangan" name="insentif_detail[pengurangan]"
                x-model="dokter.pengurangan" :value="$detail['pengurangan'] ?? 0" prefix="Rp" variant="rounded" />
            <x-ui.form-input type="text" name="insentif_detail[keterangan_pengurangan]" :value="$detail['keterangan_pengurangan'] ?? ''"
                placeholder="Keterangan pengurangan..." />
        </div>
        <div class="space-y-2">
            <x-ui.form-input type="number" label="Penambahan" name="insentif_detail[penambahan]"
                x-model="dokter.penambahan" :value="$detail['penambahan'] ?? 0" prefix="Rp" variant="rounded" />
            <x-ui.form-input type="text" name="insentif_detail[keterangan_penambahan]" :value="$detail['keterangan_penambahan'] ?? ''"
                placeholder="Keterangan penambahan..." />
        </div>
    </div>

    <x-penggajian.dynamic-insentif-items model-name="dokter.lainLainItems" />

    <x-ui.value-display label="Total Insentif" variant="green" xText="formatNumber(calculateDokterInsentif())" showSign>
        <p class="text-sm text-gray-600 mt-1">Formula: (Transaksi - Pengurangan + Penambahan) × Persenan + Lain-lain</p>
    </x-ui.value-display>
</div>
