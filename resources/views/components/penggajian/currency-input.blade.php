{{-- Currency Input - wrapper for ui/form-input --}}
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

<x-ui.form-input type="number" :name="$name" :label="$label" :value="$value" :prefix="$prefix" :suffix="$suffix"
    :hint="$hint" :required="$required" :min="$min" :step="$step" :readonly="$readonly" :xModel="$xModel"
    variant="rounded" {{ $attributes }} />
