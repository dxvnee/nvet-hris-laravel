@props([
    'totalMenitLembur' => 0,
    'upahLemburPerMenit' => 0,
    'animationDelay' => 2,
])

<x-ui.section-card title="Lembur" subtitle="Perhitungan upah lembur" :animation="'animate-slide-up-delay-' . $animationDelay">
    <x-slot:iconSlot>
        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </x-slot:iconSlot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-ui.form-input type="number" label="Total Durasi Lembur" name="total_menit_lembur" x-model="totalMenitLembur"
            :value="$totalMenitLembur" suffix="menit" min="0" variant="rounded" :hint="'= ' . floor($totalMenitLembur / 60) . ' jam ' . $totalMenitLembur % 60 . ' menit'" />
        <x-ui.form-input type="number" label="Upah Lembur Per Menit" name="upah_lembur_per_menit"
            x-model="upahLemburPerMenit" :value="$upahLemburPerMenit" prefix="Rp" min="0" step="1"
            variant="rounded" />
        <x-ui.value-display label="Total Upah Lembur" variant="yellow"
            xText="formatNumber(totalMenitLembur * upahLemburPerMenit)" showSign />
        <input type="hidden" name="total_upah_lembur" :value="totalMenitLembur * upahLemburPerMenit">
    </div>
</x-ui.section-card>
