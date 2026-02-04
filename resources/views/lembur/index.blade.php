{{-- Lembur Index Page - Modular Version --}}
<x-app-layout>
    <x-slot name="header">Lembur</x-slot>
    <x-slot name="subtle">Kelola jam lembur Anda</x-slot>

    <div class="space-y-6">
        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 animate-slide-up-delay-1">
            <x-lembur.stat-card :value="floor($totalLemburBulanIni / 60) . 'j ' . $totalLemburBulanIni % 60 . 'm'" label="Total Lembur Bulan Ini" gradient="from-emerald-50 to-green-100"
                iconBg="bg-emerald-500" textColor="text-emerald-800">
                <x-slot name="iconSlot">
                    <x-icons.chart-bar class="w-6 h-6 text-white" />
                </x-slot>
            </x-lembur.stat-card>

            <x-lembur.stat-card :value="$menungguApproval" label="Menunggu Approval" gradient="from-yellow-50 to-amber-100"
                iconBg="bg-yellow-500" textColor="text-yellow-800">
                <x-slot name="iconSlot">
                    <x-icons.clock class="w-6 h-6 text-white" />
                </x-slot>
            </x-lembur.stat-card>

            <x-lembur.stat-card :value="$lemburDisetujui" label="Lembur Disetujui" gradient="from-blue-50 to-indigo-100"
                iconBg="bg-blue-500" textColor="text-blue-800">
                <x-slot name="iconSlot">
                    <x-icons.check-circle class="w-6 h-6 text-white" />
                </x-slot>
            </x-lembur.stat-card>
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
