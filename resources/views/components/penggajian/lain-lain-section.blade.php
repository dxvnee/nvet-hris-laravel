@props([
    'items' => [],
    'catatan' => '',
    'animationDelay' => 2,
])

<x-penggajian.form-section 
    title="Lain-lain"
    subtitle="Komponen tambahan penggajian (+/-)"
    icon-color="orange"
    :animation-delay="$animationDelay"
>
    <x-slot:icon>
        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
        </svg>
    </x-slot:icon>

    <x-slot:headerAction>
        <button type="button" @click="lainLainItems.push({ nama: '', nilai: 0 })"
            class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Item
        </button>
    </x-slot:headerAction>

    <!-- Dynamic Lain-lain Items -->
    <template x-if="lainLainItems.length > 0">
        <div class="space-y-3">
            <template x-for="(item, index) in lainLainItems" :key="index">
                <div class="flex flex-col md:flex-row gap-3 p-4 bg-orange-50 rounded-xl border border-orange-200">
                    <div class="flex-1">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Nama/Keterangan</label>
                        <input type="text" x-model="item.nama"
                            :name="'lain_lain_items[' + index + '][nama]'"
                            placeholder="Contoh: Reimburse Transport, Bonus, Potongan Kasbon..."
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-sm">
                    </div>
                    <div class="w-full md:w-48">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Nilai (+/-)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                            <input type="number" x-model="item.nilai"
                                :name="'lain_lain_items[' + index + '][nilai]'"
                                class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-sm">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Negatif untuk potongan</p>
                    </div>
                    <div class="flex items-end">
                        <button type="button" @click="lainLainItems.splice(index, 1)"
                            class="px-3 py-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </template>

            <!-- Total Lain-lain -->
            <div class="mt-4 p-4 rounded-xl"
                :class="calculateLainLainTotal() >= 0 ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'">
                <p :class="calculateLainLainTotal() >= 0 ? 'text-green-700' : 'text-red-700'"
                    class="font-bold text-lg">
                    Total Lain-lain: <span x-text="(calculateLainLainTotal() >= 0 ? '+ ' : '') + 'Rp ' + formatNumber(calculateLainLainTotal())"></span>
                </p>
            </div>
        </div>
    </template>

    <template x-if="lainLainItems.length === 0">
        <div class="text-center py-8 text-gray-500">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <p>Belum ada item lain-lain</p>
            <p class="text-sm">Klik tombol "Tambah Item" untuk menambahkan</p>
        </div>
    </template>

    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
        <textarea name="catatan" rows="3" placeholder="Catatan tambahan..."
            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">{{ $catatan }}</textarea>
    </div>
</x-penggajian.form-section>
