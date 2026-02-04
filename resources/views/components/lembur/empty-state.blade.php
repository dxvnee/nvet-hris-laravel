{{-- Lembur Empty State Component --}}
@props([
    'message' => 'Tidak ada data',
])

<div class="text-center py-16">
    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </div>
    <p class="text-gray-500 font-medium">{{ $message }}</p>
</div>
