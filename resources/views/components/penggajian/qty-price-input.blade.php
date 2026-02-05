{{-- Penggajian Qty Price Input Component --}}
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
        <x-ui.form-input type="number" :name="$qtyName" :xModel="$qtyModel" :value="$qtyValue" placeholder="Qty"
            :min="0" />
        <x-ui.form-input type="number" :name="$hargaName" :xModel="$hargaModel" :value="$hargaValue" placeholder="Harga"
            :min="0" prefix="Rp" />
    </div>
    @if ($qtyModel && $hargaModel)
        <p class="text-xs text-gray-500 mt-1">= Rp <span
                x-text="formatNumber({{ $qtyModel }} * {{ $hargaModel }})"></span></p>
    @endif
</div>
