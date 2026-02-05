@props([
    'items' => [],
    'catatan' => '',
    'animationDelay' => 2,
])

<x-ui.section-card title="Lain-lain" subtitle="Komponen tambahan penggajian (+/-)" :animation="'animate-slide-up-delay-' . $animationDelay">
    <x-slot:iconSlot>
        <x-icons.clipboard-check class="h-6 w-6 text-white" />
    </x-slot:iconSlot>

    <x-slot:headerAction>
        <x-ui.action-button type="button" variant="warning" size="sm" iconName="plus"
            x-on:click="lainLainItems.push({ nama: '', nilai: 0 })">
            Tambah Item
        </x-ui.action-button>
    </x-slot:headerAction>

    <!-- Dynamic Lain-lain Items -->
    <template x-if="lainLainItems.length > 0">
        <div class="space-y-3">
            <template x-for="(item, index) in lainLainItems" :key="index">
                <div class="flex flex-col md:flex-row gap-3 p-4 bg-orange-50 rounded-xl border border-orange-200">
                    <div class="flex-1">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Nama/Keterangan</label>
                        <input type="text" x-model="item.nama" :name="'lain_lain_items[' + index + '][nama]'"
                            placeholder="Contoh: Reimburse Transport, Bonus, Potongan Kasbon..."
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-sm">
                    </div>
                    <div class="w-full md:w-48">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Nilai (+/-)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                            <input type="number" x-model="item.nilai" :name="'lain_lain_items[' + index + '][nilai]'"
                                class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-sm">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Negatif untuk potongan</p>
                    </div>
                    <div class="flex items-end">
                        <x-ui.action-button type="button" variant="icon-danger"
                            x-on:click="lainLainItems.splice(index, 1)">
                            <x-icons.trash class="w-5 h-5" />
                        </x-ui.action-button>
                    </div>
                </div>
            </template>

            <!-- Total Lain-lain -->
            <div class="mt-4 p-4 rounded-xl"
                :class="calculateLainLainTotal() >= 0 ? 'bg-green-50 border border-green-200' :
                    'bg-red-50 border border-red-200'">
                <p :class="calculateLainLainTotal() >= 0 ? 'text-green-700' : 'text-red-700'" class="font-bold text-lg">
                    Total Lain-lain: <span
                        x-text="(calculateLainLainTotal() >= 0 ? '+ ' : '') + 'Rp ' + formatNumber(calculateLainLainTotal())"></span>
                </p>
            </div>
        </div>
    </template>

    <template x-if="lainLainItems.length === 0">
        <x-ui.empty-state icon="clipboard-check" title="Belum ada item lain-lain"
            subtitle="Klik tombol 'Tambah Item' untuk menambahkan" />
    </template>

    <div class="mt-6">
        <x-ui.form-input type="textarea" name="catatan" label="Catatan" :value="$catatan"
            placeholder="Catatan tambahan..." rows="3" variant="rounded" />
    </div>
</x-ui.section-card>
