@props([
    'modelName', // e.g., 'dokter.lainLainItems', 'paramedis.lainLainItems'
    'inputPrefix' => 'insentif_detail[lain_lain_items]',
])

<div class="space-y-3">
    <div class="flex items-center justify-between">
        <label class="block text-sm font-medium text-gray-700">Insentif Lain-lain</label>
        <button type="button" @click="{{ $modelName }}.push({nama: '', qty: 1, harga: 0})"
            class="px-3 py-1 bg-green-100 hover:bg-green-200 text-green-700 text-sm font-medium rounded-lg transition-colors flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah Item
        </button>
    </div>
    <div class="space-y-2" x-show="{{ $modelName }}.length > 0">
        <template x-for="(item, index) in {{ $modelName }}" :key="index">
            <div class="flex items-center gap-2 p-3 bg-gray-50 rounded-lg">
                <input type="text" :name="'{{ $inputPrefix }}[' + index + '][nama]'"
                    x-model="item.nama" placeholder="Nama item..."
                    class="flex-1 px-3 py-2 rounded border border-gray-300 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
                <input type="number" :name="'{{ $inputPrefix }}[' + index + '][qty]'"
                    x-model.number="item.qty" placeholder="Qty" min="0"
                    class="w-20 px-2 py-2 rounded border border-gray-300 text-sm focus:border-primary text-center">
                <div class="relative">
                    <span class="absolute left-2 top-1/2 -translate-y-1/2 text-gray-500 text-xs">Rp</span>
                    <input type="number" :name="'{{ $inputPrefix }}[' + index + '][harga]'"
                        x-model.number="item.harga" placeholder="Harga" min="0"
                        class="w-32 pl-8 pr-2 py-2 rounded border border-gray-300 text-sm focus:border-primary">
                </div>
                <span class="text-sm text-gray-600 w-24 text-right" x-text="'Rp ' + formatNumber(item.qty * item.harga)"></span>
                <button type="button" @click="{{ $modelName }}.splice(index, 1)"
                    class="p-1 text-red-500 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        </template>
    </div>
    <div class="text-sm text-gray-600" x-show="{{ $modelName }}.length > 0">
        Total Lain-lain: Rp <span x-text="formatNumber(calculateInsentifLainLainTotal({{ $modelName }}))"></span>
    </div>
</div>
