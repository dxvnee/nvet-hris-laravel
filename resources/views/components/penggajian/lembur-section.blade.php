@props([
    'totalMenitLembur' => 0,
    'upahLemburPerMenit' => 0,
    'animationDelay' => 2,
])

<x-penggajian.form-section 
    title="Lembur"
    subtitle="Perhitungan upah lembur"
    icon-color="yellow"
    :animation-delay="$animationDelay"
>
    <x-slot:icon>
        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </x-slot:icon>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Total Durasi Lembur</label>
            <div class="relative">
                <input type="number" name="total_menit_lembur" x-model="totalMenitLembur"
                    value="{{ $totalMenitLembur }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                    min="0">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">menit</span>
            </div>
            <p class="mt-1 text-xs text-gray-500">
                <span x-text="Math.floor(totalMenitLembur / 60)"></span> jam <span x-text="totalMenitLembur % 60"></span> menit
            </p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Upah Lembur Per Menit</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                <input type="number" name="upah_lembur_per_menit" x-model="upahLemburPerMenit"
                    value="{{ $upahLemburPerMenit }}"
                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                    min="0" step="1">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Total Upah Lembur</label>
            <div class="bg-yellow-50 rounded-xl px-4 py-3 border border-yellow-200">
                <p class="text-yellow-700 font-bold text-lg">+ Rp <span x-text="formatNumber(totalMenitLembur * upahLemburPerMenit)"></span></p>
            </div>
            <input type="hidden" name="total_upah_lembur" :value="totalMenitLembur * upahLemburPerMenit">
        </div>
    </div>
</x-penggajian.form-section>
