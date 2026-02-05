{{-- Selectable Item Component - Universal checkbox/radio item with avatar --}}
@props([
    'name' => '',
    'value' => '',
    'type' => 'checkbox', // checkbox, radio
    'label' => '',
    'sublabel' => '',
    'user' => null,
    'selected' => false,
    'showAvatar' => true,
])

<label
    {{ $attributes->merge(['class' => 'flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:border-primary/30 hover:bg-primary/5 cursor-pointer transition-all']) }}>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"
        class="w-4 h-4 text-primary border-gray-300 {{ $type === 'checkbox' ? 'rounded' : 'rounded-full' }} focus:ring-primary/20"
        {{ $selected ? 'checked' : '' }}>

    <div class="flex items-center gap-3">
        @if ($showAvatar && $user)
            <x-ui.user-avatar :user="$user" size="sm" />
        @endif
        <div>
            <p class="text-sm font-medium text-gray-900">{{ $label ?: $user->name ?? '' }}</p>
            @if ($sublabel || ($user && $user->jabatan))
                <p class="text-xs text-gray-500">{{ $sublabel ?: $user->jabatan }}</p>
            @endif
        </div>
    </div>
</label>
