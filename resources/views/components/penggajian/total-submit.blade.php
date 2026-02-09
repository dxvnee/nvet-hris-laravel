@props([
    'showDraftButton' => true,
    'animationDelay' => 2,
])

<div
    class="bg-gradient-to-br from-primary to-primaryDark rounded-2xl shadow-xl p-8 text-white animate-slide-up-delay-{{ $animationDelay }}">
    <div class="flex flex-col gap-6">
        {{-- Breakdown --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-white/90 text-sm">
            <div class="flex justify-between items-center">
                <span>Subtotal Gaji Pokok</span>
                <span class="font-semibold" x-text="'Rp ' + formatNumber(calculateGajiSubtotal())"></span>
            </div>
            <div class="flex justify-between items-center">
                <span>Subtotal Insentif & Lembur</span>
                <span class="font-semibold" x-text="'+ Rp ' + formatNumber(calculateInsentifSubtotal())"></span>
            </div>
        </div>

        <div class="border-t border-white/20"></div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <p class="text-white/80 text-lg">Total Gaji yang Diterima</p>
                <p class="text-4xl font-bold">Rp <span x-text="formatNumber(calculateTotal())"></span></p>
            </div>
            <div class="flex gap-4">
                @if ($showDraftButton)
                    <x-ui.action-button type="submit" variant="secondary" size="lg"
                        class="!bg-white/20 hover:!bg-white/30 !text-white !border-0">
                        <input type="hidden" name="status" value="draft" x-ref="statusDraft">
                        Simpan Draft
                    </x-ui.action-button>
                @endif
                <x-ui.action-button type="submit" variant="secondary" size="lg"
                    class="!bg-white !text-primary hover:!bg-white/90">
                    <input type="hidden" name="status" value="final" x-ref="statusFinal">
                    Finalkan
                </x-ui.action-button>
            </div>
        </div>
    </div>
</div>
