@props([
    'modelName', // e.g., 'dokter.lainLainItems', 'paramedis.lainLainItems'
    'inputPrefix' => 'insentif_detail[lain_lain_items]',
])

<div class="space-y-3">
    <div class="flex items-center justify-between">
        <label class="block text-sm font-medium text-gray-700">Lain-lain</label>
        <x-ui.action-button type="button" variant="warning" size="sm" iconName="plus"
            x-on:click="{{ $modelName }}.push({nama: '', nilai: 0})">
            Tambah Item
        </x-ui.action-button>
    </div>
    <div class="space-y-3" x-show="{{ $modelName }}.length > 0">
        <template x-for="(item, index) in {{ $modelName }}" :key="index">
            <div class="flex flex-col md:flex-row gap-3 p-4 bg-orange-50 rounded-xl border border-orange-200">
                <div class="flex-1">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Nama/Keterangan</label>
                    <input type="text" :name="'{{ $inputPrefix }}[' + index + '][nama]'" x-model="item.nama"
                        placeholder="Contoh: Bonus, Potongan, dll..."
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-sm">
                </div>
                <div class="w-full md:w-48">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Nilai (+/-)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                        <input type="number" :name="'{{ $inputPrefix }}[' + index + '][nilai]'"
                            x-model.number="item.nilai" placeholder="Nilai"
                            class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-sm">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Negatif untuk potongan</p>
                </div>
                <div class="flex items-end">
                    <x-ui.action-button type="button" variant="icon-danger"
                        x-on:click="{{ $modelName }}.splice(index, 1)">
                        <x-icons.trash class="w-5 h-5" />
                    </x-ui.action-button>
                </div>
            </div>
        </template>

        <div class="mt-3 p-3 rounded-xl"
            :class="calculateInsentifLainLainTotal({{ $modelName }}) >= 0 ? 'bg-green-50 border border-green-200' :
                'bg-red-50 border border-red-200'">
            <p class="font-bold text-sm"
                :class="calculateInsentifLainLainTotal({{ $modelName }}) >= 0 ? 'text-green-700' : 'text-red-700'"
                x-text="'Total Lain-lain: ' + (calculateInsentifLainLainTotal({{ $modelName }}) >= 0 ? '+ ' : '- ') + 'Rp ' + formatNumber(Math.abs(calculateInsentifLainLainTotal({{ $modelName }})))">
            </p>
        </div>
    </div>
</div>
