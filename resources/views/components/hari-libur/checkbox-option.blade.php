{{-- Hari Libur Checkbox Option Component --}}
@props(['name', 'label', 'description' => null, 'checked' => false, 'xModel' => null])

<label class="flex items-start gap-3 cursor-pointer">
    <div class="flex-shrink-0 pt-0.5">
        <input type="checkbox" name="{{ $name }}" value="1"
            @if ($xModel) x-model="{{ $xModel }}" @endif {{ $checked ? 'checked' : '' }}
            class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary/20 transition-all">
    </div>
    <div>
        <p class="font-medium text-gray-800">{{ $label }}</p>
        @if ($description)
            <p class="text-sm text-gray-500 mt-0.5">{{ $description }}</p>
        @endif
    </div>
</label>
