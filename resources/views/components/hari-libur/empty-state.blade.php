{{-- Hari Libur Empty State Component --}}
@props([
    'message' => 'Tidak ada data hari libur',
    'showButton' => true,
])

<div class="text-center py-16">
    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
    </div>
    <p class="text-gray-500 font-medium">{{ $message }}</p>
    @if ($showButton)
        <a href="{{ route('hari-libur.create') }}"
            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-primary text-white font-medium rounded-xl hover:bg-primaryDark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Hari Libur
        </a>
    @endif
</div>
