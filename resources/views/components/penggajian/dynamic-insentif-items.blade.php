@props([
    'modelName', // e.g., 'dokter.lainLainItems', 'paramedis.lainLainItems'
    'inputPrefix' => 'insentif_detail[lain_lain_items]',
])

<div class="space-y-3">
    <div class="flex items-center justify-between">
        <label class="block text-sm font-medium text-gray-700">Insentif Lain-lain</label>
        <x-ui.action-button type="button" variant="success" size="sm" iconName="plus"
            x-on:click="{{ $modelName }}.push({nama: '', qty: 1, harga: 0})">
            Tambah Item
        </x-ui.action-button>
    </div>
    <div class="space-y-2" x-show="{{ $modelName }}.length > 0">
        <template x-for="(item, index) in {{ $modelName }}" :key="index">
            <div class="flex items-center gap-2 p-3 bg-gray-50 rounded-lg">
                <input type="text" :name="'{{ $inputPrefix }}[' + index + '][nama]'" x-model="item.nama"
                    placeholder="Nama item..."
                    class="flex-1 px-3 py-2 rounded border border-gray-300 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
                <input type="number" :name="'{{ $inputPrefix }}[' + index + '][qty]'" x-model.number="item.qty"
                    placeholder="Qty" min="0"
                    class="w-20 px-2 py-2 rounded border border-gray-300 text-sm focus:border-primary text-center">
                <div class="relative">
                    <span class="absolute left-2 top-1/2 -translate-y-1/2 text-gray-500 text-xs">Rp</span>
                    <input type="number" :name="'{{ $inputPrefix }}[' + index + '][harga]'"
                        x-model.number="item.harga" placeholder="Harga" min="0"
                        class="w-32 pl-8 pr-2 py-2 rounded border border-gray-300 text-sm focus:border-primary">
                </div>
                <span class="text-sm text-gray-600 w-24 text-right"
                    x-text="'Rp ' + formatNumber(item.qty * item.harga)"></span>
                <x-ui.action-button type="button" variant="icon-danger"
                    x-on:click="{{ $modelName }}.splice(index, 1)">
                    <x-icons.trash class="w-4 h-4" />
                </x-ui.action-button>
            </div>
        </template>
    </div>
    <div class="text-sm text-gray-600" x-show="{{ $modelName }}.length > 0">
        Total Lain-lain: Rp <span x-text="formatNumber(calculateInsentifLainLainTotal({{ $modelName }}))"></span>
    </div>
</div>
