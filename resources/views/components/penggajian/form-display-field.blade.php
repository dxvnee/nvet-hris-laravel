@props([
    'label',
    'value',
    'status' => null, // 'danger', 'success', null
    'statusText' => null,
    'deductionText' => null,
    'hint' => null,
])

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
    <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
        <div class="flex items-center justify-between">
            <span class="text-gray-700">{{ $value }}</span>
            @if($status && $statusText)
                <span class="px-2 py-1 text-xs rounded-full font-medium
                    {{ $status === 'danger' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                    {{ $statusText }}
                </span>
            @endif
        </div>
        @if($deductionText)
            <p class="text-red-600 text-sm mt-2 font-medium">{{ $deductionText }}</p>
        @endif
        {{ $slot }}
    </div>
    @if($hint)
        <p class="mt-1 text-xs text-gray-500">{{ $hint }}</p>
    @endif
</div>
