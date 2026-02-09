@props(['jabatan', 'detail' => [], 'totalMenitLembur' => 0, 'upahLemburPerMenit' => 0, 'animationDelay' => 2])

<x-ui.section-card title="Insentif & Lembur" subtitle="Semua komponen penambahan gaji" :animation="'animate-slide-up-delay-' . $animationDelay">
    <x-slot:iconSlot>
        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
            </path>
        </svg>
    </x-slot:iconSlot>

    <div class="space-y-8">
        {{-- Insentif Jabatan --}}
        <div>
            <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-green-400"></span>
                Insentif {{ $jabatan }}
            </h4>

            @if ($jabatan === 'Dokter')
                <x-penggajian.insentif-dokter :detail="$detail" />
            @elseif(in_array($jabatan, ['Paramedis', 'FO', 'Tech']))
                <x-penggajian.insentif-universal :role="strtolower($jabatan)" :detail="$detail" />
            @endif
        </div>

        {{-- Lembur --}}
        <div>
            <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                Lembur
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-ui.form-input type="number" label="Total Durasi Lembur" name="total_menit_lembur"
                    x-model="totalMenitLembur" :value="$totalMenitLembur" suffix="menit" min="0" variant="rounded"
                    :hint="'= ' . floor($totalMenitLembur / 60) . ' jam ' . $totalMenitLembur % 60 . ' menit'" />
                <x-ui.form-input type="number" label="Upah Lembur Per Menit" name="upah_lembur_per_menit"
                    x-model="upahLemburPerMenit" :value="$upahLemburPerMenit" prefix="Rp" min="0" step="1"
                    variant="rounded" />
                <x-ui.value-display label="Total Upah Lembur" variant="yellow"
                    xText="formatNumber(totalMenitLembur * upahLemburPerMenit)" showSign />
                <input type="hidden" name="total_upah_lembur" :value="totalMenitLembur * upahLemburPerMenit">
            </div>
        </div>

        {{-- Ringkasan Kalkulasi --}}
        <div class="mt-2 p-5 bg-gray-50 rounded-2xl border border-gray-200 space-y-3">
            <h4 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-3">Ringkasan</h4>

            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">Insentif {{ $jabatan }}</span>
                <span class="font-semibold" :class="getInsentif() >= 0 ? 'text-green-600' : 'text-red-600'"
                    x-text="(getInsentif() >= 0 ? '+ ' : '- ') + 'Rp ' + formatNumber(Math.abs(getInsentif()))">
                </span>
            </div>

            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">Upah Lembur
                    <span class="text-xs text-gray-400"
                        x-text="'(' + totalMenitLembur + ' mnt × Rp ' + formatNumber(upahLemburPerMenit) + ')'"></span>
                </span>
                <span class="font-semibold text-yellow-600">+ Rp <span
                        x-text="formatNumber(totalMenitLembur * upahLemburPerMenit)"></span></span>
            </div>

            <div class="border-t border-gray-300 pt-3 mt-3">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-gray-800">Subtotal Insentif & Lembur</span>
                    <span class="font-bold text-lg"
                        :class="calculateInsentifSubtotal() >= 0 ? 'text-green-700' : 'text-red-700'"
                        x-text="(calculateInsentifSubtotal() >= 0 ? '+ ' : '- ') + 'Rp ' + formatNumber(Math.abs(calculateInsentifSubtotal()))">
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-ui.section-card>
