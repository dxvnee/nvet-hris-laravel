@props(['jabatan', 'detail' => [], 'animationDelay' => 2])

<x-ui.section-card title="Insentif - {{ $jabatan }}" subtitle="Komponen insentif berdasarkan jabatan"
    :animation="'animate-slide-up-delay-' . $animationDelay">
    <x-slot:iconSlot>
        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
            </path>
        </svg>
    </x-slot:iconSlot>

    @if ($jabatan === 'Dokter')
        <x-penggajian.insentif-dokter :detail="$detail" />
    @elseif(in_array($jabatan, ['Paramedis', 'FO', 'Tech']))
        <x-penggajian.insentif-universal :role="strtolower($jabatan)" :detail="$detail" />
    @endif
</x-ui.section-card>
