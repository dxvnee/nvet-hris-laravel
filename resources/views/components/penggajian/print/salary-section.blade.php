{{-- Reusable Print Salary Section Wrapper --}}
@props([
    'title',
    'color' => 'green', // green, red, blue, orange, purple
    'items' => [], // Array of ['label' => '', 'amount' => 0]
    'showTotal' => true,
    'totalLabel' => 'Total',
])

@php
    $colors = [
        'green' => ['dot' => 'bg-green-500', 'total' => 'text-green-600'],
        'red' => ['dot' => 'bg-red-500', 'total' => 'text-red-600'],
        'blue' => ['dot' => 'bg-blue-500', 'total' => 'text-blue-600'],
        'orange' => ['dot' => 'bg-orange-500', 'total' => 'text-orange-600'],
        'purple' => ['dot' => 'bg-purple-500', 'total' => 'text-purple-600'],
    ];
    $colorClass = $colors[$color] ?? $colors['green'];

    $total = collect($items)->sum('amount');
@endphp

<div class="mb-4">
    <div class="flex items-center mb-2">
        <span class="w-2 h-2 {{ $colorClass['dot'] }} rounded-full mr-2"></span>
        <h3 class="text-sm font-semibold text-gray-700">{{ $title }}</h3>
    </div>

    <div class="ml-4 space-y-1">
        @forelse($items as $item)
            @if (!empty($item['label']) && $item['amount'] > 0)
                <div class="flex justify-between text-xs">
                    <span class="text-gray-600">{{ $item['label'] }}</span>
                    <span class="text-gray-800">Rp {{ number_format($item['amount'], 0, ',', '.') }}</span>
                </div>
            @endif
        @empty
            <div class="text-xs text-gray-400 italic">Tidak ada data</div>
        @endforelse

        {{-- Custom slot for additional items --}}
        {{ $slot }}

        @if ($showTotal && $total > 0)
            <div class="flex justify-between text-xs font-medium pt-1 border-t border-gray-200">
                <span>{{ $totalLabel }}</span>
                <span class="{{ $colorClass['total'] }}">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        @endif
    </div>
</div>
