@props([
    'label',
    'qtyName',
    'hargaName',
    'qtyModel' => null,
    'hargaModel' => null,
    'qtyValue' => 0,
    'hargaValue' => 0,
])

<div class="bg-gray-50 rounded-xl p-4">
    <label class="block text-sm font-medium text-gray-700 mb-3">{{ $label }}</label>
    <div class="grid grid-cols-2 gap-2">
        <input 
            type="number" 
            name="{{ $qtyName }}" 
            @if($qtyModel) x-model="{{ $qtyModel }}" @endif
            value="{{ $qtyValue }}"
            placeholder="Qty" 
            min="0"
            class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
        <div class="relative">
            <span class="absolute left-2 top-1/2 -translate-y-1/2 text-gray-500 text-xs">Rp</span>
            <input 
                type="number" 
                name="{{ $hargaName }}" 
                @if($hargaModel) x-model="{{ $hargaModel }}" @endif
                value="{{ $hargaValue }}"
                placeholder="Harga" 
                min="0"
                class="w-full pl-8 pr-2 py-2 rounded-lg border border-gray-300 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
        </div>
    </div>
    @if($qtyModel && $hargaModel)
        <p class="text-xs text-gray-500 mt-1">= Rp <span x-text="formatNumber({{ $qtyModel }} * {{ $hargaModel }})"></span></p>
    @endif
</div>
