@props([
    'message' => 'Belum ada data',
    'description' => null,
    'icon' => 'clipboard',
])

<div class="text-center py-8 text-gray-500">
    @if($icon === 'clipboard')
        <svg class="h-12 w-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
        </svg>
    @endif
    <p>{{ $message }}</p>
    @if($description)
        <p class="text-sm">{{ $description }}</p>
    @endif
</div>
