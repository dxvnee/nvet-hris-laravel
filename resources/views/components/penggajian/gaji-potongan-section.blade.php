@props([
    'user',
    'totalMenitTelat' => 0,
    'potonganPerMenit' => 0,
    'totalLupaPulang' => 0,
    'totalTidakHadir' => 0,
    'potonganPerTidakHadir' => 0,
    'gajiPokok' => null,
    'catatan' => '',
    'animationDelay' => 1,
])

<x-ui.section-card title="Gaji Pokok & Potongan" subtitle="Gaji dasar, potongan, dan komponen lain-lain"
    :animation="'animate-slide-up-delay-' . $animationDelay">
    <x-slot:iconSlot>
        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
            </path>
        </svg>
    </x-slot:iconSlot>

    <div class="space-y-8">
        {{-- Gaji Pokok --}}
        <div>
            <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-primary"></span>
                Gaji Pokok
            </h4>
            <div class="grid grid-cols-1 gap-6">
                <x-ui.form-input type="number" label="Gaji Pokok" name="gaji_pokok" x-model="gajiPokok"
                    :value="$gajiPokok ?? $user->gaji_pokok" prefix="Rp" variant="rounded" required />
            </div>
        </div>

        {{-- Potongan Keterlambatan --}}
        <div>
            <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-red-400"></span>
                Potongan
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.form-input type="number" label="Total Menit Terlambat" name="total_menit_telat"
                    x-model="totalMenitTelat" :value="$totalMenitTelat" suffix="menit" :hint="'Diambil dari data absensi: ' . $totalMenitTelat . ' menit'" min="0"
                    variant="rounded" required />
                <x-ui.form-input type="number" label="Potongan Per Menit" name="potongan_per_menit"
                    x-model="potonganPerMenit" :value="$potonganPerMenit" prefix="Rp" :hint="'Otomatis: Rp ' .
                        number_format($potonganPerMenit, 0, ',', '.') .
                        '/menit (' .
                        $user->gaji_pokok .
                        ' ÷ ' .
                        $user->jam_kerja .
                        ' jam × 26 hari ÷ 60 menit, dibulatkan)'" min="0"
                    step="1" variant="rounded" required />

                <!-- Lupa Pulang -->
                <x-ui.display-field label="Lupa Absen Pulang" :value="$totalLupaPulang . ' kali'" :status="$totalLupaPulang > 3 ? 'danger' : 'success'" :statusText="$totalLupaPulang > 3 ? 'Potong 1 Jam Kerja' : 'Aman'"
                    hint="Jika > 3x dalam sebulan, dipotong 1 jam kerja">
                    @if ($totalLupaPulang > 3)
                        <p class="text-red-600 text-sm mt-2 font-medium">
                            - Rp <span x-text="formatNumber(potonganPerMenit * 60)"></span> (1 jam kerja)
                        </p>
                    @endif
                </x-ui.display-field>

                <!-- Tidak Hadir -->
                <x-ui.display-field label="Tidak Hadir" :value="$totalTidakHadir . ' hari'" :status="$totalTidakHadir > 0 ? 'danger' : 'success'" :statusText="$totalTidakHadir > 0 ? 'Potong ' . $totalTidakHadir . ' Hari' : 'Tidak Ada'"
                    :hint="'Potongan per hari tidak hadir: Rp ' .
                        number_format($potonganPerTidakHadir, 0, ',', '.')">
                    @if ($totalTidakHadir > 0)
                        <p class="text-red-600 text-sm mt-2 font-medium">
                            - Rp <span x-text="formatNumber(totalTidakHadir * potonganPerTidakHadir)"></span>
                            ({{ $totalTidakHadir }} × Rp
                            {{ number_format($potonganPerTidakHadir, 0, ',', '.') }})
                        </p>
                    @endif
                </x-ui.display-field>
            </div>
        </div>

        {{-- Lain-lain --}}
        <div>
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                    Lain-lain
                </h4>
                <x-ui.action-button type="button" variant="warning" size="sm" iconName="plus"
                    x-on:click="lainLainItems.push({ nama: '', nilai: 0 })">
                    Tambah Item
                </x-ui.action-button>
            </div>

            <template x-if="lainLainItems.length > 0">
                <div class="space-y-3">
                    <template x-for="(item, index) in lainLainItems" :key="index">
                        <div
                            class="flex flex-col md:flex-row gap-3 p-4 bg-orange-50 rounded-xl border border-orange-200">
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Nama/Keterangan</label>
                                <input type="text" x-model="item.nama" :name="'lain_lain_items[' + index + '][nama]'"
                                    placeholder="Contoh: Potongan Kasbon, Reimburse, dll..."
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 text-sm">
                            </div>
                            <div class="w-full md:w-48">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Nilai (+/-)</label>
                                <div class="relative">
                                    <span
                                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                    <input type="number" x-model="item.nilai"
                                        :name="'lain_lain_items[' + index + '][nilai]'"
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
                </div>
            </template>


        </div>

        {{-- Catatan --}}
        <div>
            <x-ui.form-input type="textarea" name="catatan" label="Catatan" :value="$catatan"
                placeholder="Catatan tambahan..." rows="3" variant="rounded" />
        </div>

        {{-- Ringkasan Kalkulasi --}}
        <div class="mt-2 p-5 bg-gray-50 rounded-2xl border border-gray-200 space-y-3">
            <h4 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-3">Ringkasan</h4>

            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">Gaji Pokok</span>
                <span class="font-semibold text-gray-800">Rp <span x-text="formatNumber(gajiPokok)"></span></span>
            </div>

            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">Potongan Keterlambatan
                    <span class="text-xs text-gray-400"
                        x-text="'(' + totalMenitTelat + ' mnt × Rp ' + formatNumber(potonganPerMenit) + ')'"></span>
                </span>
                <span class="font-semibold text-red-600">- Rp <span
                        x-text="formatNumber(totalMenitTelat * potonganPerMenit)"></span></span>
            </div>

            @if ($totalLupaPulang > 3)
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-600">Potongan Lupa Pulang <span class="text-xs text-gray-400">(1 jam
                            kerja)</span></span>
                    <span class="font-semibold text-red-600">- Rp <span
                            x-text="formatNumber(potonganPerMenit * 60)"></span></span>
                </div>
            @endif

            @if ($totalTidakHadir > 0)
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-600">Potongan Tidak Hadir
                        <span class="text-xs text-gray-400">({{ $totalTidakHadir }} × Rp
                            {{ number_format($potonganPerTidakHadir, 0, ',', '.') }})</span>
                    </span>
                    <span class="font-semibold text-red-600">- Rp <span
                            x-text="formatNumber(totalTidakHadir * potonganPerTidakHadir)"></span></span>
                </div>
            @endif

            <template x-if="lainLainItems.length > 0">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-600">Lain-lain <span class="text-xs text-gray-400"
                            x-text="'(' + lainLainItems.length + ' item)'"></span></span>
                    <span class="font-semibold"
                        :class="calculateLainLainTotal() >= 0 ? 'text-green-600' : 'text-red-600'"
                        x-text="(calculateLainLainTotal() >= 0 ? '+ ' : '- ') + 'Rp ' + formatNumber(Math.abs(calculateLainLainTotal()))"></span>
                </div>
            </template>

            <div class="border-t border-gray-300 pt-3 mt-3">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-gray-800">Subtotal Gaji Pokok</span>
                    <span class="font-bold text-lg"
                        :class="calculateGajiSubtotal() >= 0 ? 'text-gray-800' : 'text-red-600'"
                        x-text="'Rp ' + formatNumber(calculateGajiSubtotal())"></span>
                </div>
            </div>
        </div>
    </div>
</x-ui.section-card>
