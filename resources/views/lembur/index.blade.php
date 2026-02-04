{{-- Lembur Index Page - Modular Version --}}
<x-app-layout>
    <x-slot name="header">Lembur</x-slot>
    <x-slot name="subtle">Kelola jam lembur Anda</x-slot>

    <div class="space-y-6">
        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 animate-slide-up-delay-1">
            <x-ui.stat-card :value="floor($totalLemburBulanIni / 60) . 'j ' . $totalLemburBulanIni % 60 . 'm'" label="Total Lembur Bulan Ini" color="green" variant="gradient"
                iconName="chart" />

            <x-ui.stat-card :value="$menungguApproval" label="Menunggu Approval" color="yellow" variant="gradient"
                iconName="clock" />

            <x-ui.stat-card :value="$lemburDisetujui" label="Lembur Disetujui" color="blue" variant="gradient"
                iconName="check" />
        </div>

        {{-- Riwayat Lembur --}}
        <x-ui.section-card title="Riwayat Lembur" animation="animate-slide-up-delay-2">
            <x-slot name="iconSlot">
                <x-icons.clipboard-check class="h-6 w-6 text-white" />
            </x-slot>

            <x-lembur.history-table :riwayat="$riwayatLembur" />
        </x-ui.section-card>
    </div>
</x-app-layout>
