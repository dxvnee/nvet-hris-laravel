@props([
    'showDraftButton' => true,
    'animationDelay' => 2,
])

<div class="bg-gradient-to-br from-primary to-primaryDark rounded-2xl shadow-xl p-8 text-white animate-slide-up-delay-{{ $animationDelay }}">
    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
            <p class="text-white/80 text-lg">Total Gaji yang Diterima</p>
            <p class="text-4xl font-bold">Rp <span x-text="formatNumber(calculateTotal())"></span></p>
        </div>
        <div class="flex gap-4">
            @if($showDraftButton)
                <button type="submit" name="status" value="draft"
                    class="px-8 py-3 bg-white/20 hover:bg-white/30 text-white font-bold rounded-xl transition-all duration-300 flex items-center gap-2">
                    Simpan Draft
                </button>
            @endif
            <button type="submit" name="status" value="final"
                class="px-8 py-3 bg-white text-primary font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center gap-2">
                Finalkan
            </button>
        </div>
    </div>
</div>
