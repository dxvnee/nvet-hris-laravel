{{-- Qty Price Input Component - Universal qty × price input pair --}}
@props([
    'label',
    'qtyName',
    'priceName',
    'qtyModel' => null,
    'priceModel' => null,
    'qtyValue' => 0,
    'priceValue' => 0,
    'qtyPlaceholder' => 'Qty',
    'pricePlaceholder' => 'Harga',
    'showTotal' => true,
])

<div {{ $attributes->merge(['class' => 'bg-gray-50 rounded-xl p-4']) }}>
    <label class="block text-sm font-medium text-gray-700 mb-3">{{ $label }}</label>
    <div class="grid grid-cols-2 gap-2">
        <x-ui.form-input type="number" :name="$qtyName" :xModel="$qtyModel" :value="$qtyValue" :placeholder="$qtyPlaceholder"
            :min="0" />
        <x-ui.form-input type="number" :name="$priceName" :xModel="$priceModel" :value="$priceValue" :placeholder="$pricePlaceholder"
            :min="0" prefix="Rp" />
    </div>
    @if ($showTotal && $qtyModel && $priceModel)
        <p class="text-xs text-gray-500 mt-1">= Rp <span
                x-text="formatNumber({{ $qtyModel }} * {{ $priceModel }})"></span></p>
    @endif
</div>
