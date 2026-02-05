{{-- Hari Libur Checkbox Option Component - Wraps ui/form-checkbox --}}
@props(['name', 'label', 'description' => null, 'checked' => false, 'xModel' => null])

<x-ui.form-checkbox :name="$name" :label="$label" :description="$description" :checked="$checked" :xModel="$xModel"
    size="lg" variant="stacked" />
