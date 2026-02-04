@props([
    'label' => null,
    'name',
    'xModel' => null,
    'value' => '',
    'prefix' => 'Rp',
    'suffix' => null,
    'hint' => null,
    'required' => false,
    'min' => null,
    'step' => null,
    'readonly' => false,
])

<div>
    @if($label)
        <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
    @endif
    <div class="relative">
        @if($prefix)
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">{{ $prefix }}</span>
        @endif
        <input 
            type="number" 
            name="{{ $name }}" 
            @if($xModel) x-model="{{ $xModel }}" @endif
            value="{{ $value }}"
            {{ $attributes->merge(['class' => 'w-full ' . ($prefix ? 'pl-12 ' : 'px-4 ') . ($suffix ? 'pr-16 ' : 'pr-4 ') . 'py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all']) }}
            @if($required) required @endif
            @if($min !== null) min="{{ $min }}" @endif
            @if($step !== null) step="{{ $step }}" @endif
            @if($readonly) readonly @endif
        >
        @if($suffix)
            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">{{ $suffix }}</span>
        @endif
    </div>
    @if($hint)
        <p class="mt-1 text-xs text-gray-500">{{ $hint }}</p>
    @endif
</div>
