@props([
    'formula' => null,
    'totalText' => null, // Alpine.js expression for total
])

<div class="bg-green-50 rounded-xl p-4 border border-green-200">
    @if($formula)
        <p class="text-sm text-gray-600">{{ $formula }}</p>
    @endif
    <p class="text-green-700 font-bold text-lg {{ $formula ? 'mt-2' : '' }}">
        Total Insentif: Rp <span x-text="formatNumber({{ $totalText }})"></span>
    </p>
</div>
