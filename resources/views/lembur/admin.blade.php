{{-- Lembur Admin Page - Modular Version --}}
<x-app-layout>
    <x-slot name="header">Kelola Lembur</x-slot>
    <x-slot name="subtle">Setujui atau tolak pengajuan lembur pegawai</x-slot>

    <div class="space-y-6">
        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 animate-slide-up-delay-1">
            <x-lembur.stat-card :value="$stats['total'] ?? 0" label="Total Lembur" gradient="from-emerald-50 to-green-100"
                iconBg="bg-emerald-500" textColor="text-emerald-800">
                <x-slot name="iconSlot">
                    <x-icons.chart-bar class="w-6 h-6 text-white" />
                </x-slot>
            </x-lembur.stat-card>

            <x-lembur.stat-card :value="$stats['pending'] ?? 0" label="Menunggu Approval" gradient="from-yellow-50 to-amber-100"
                iconBg="bg-yellow-500" textColor="text-yellow-800">
                <x-slot name="iconSlot">
                    <x-icons.clock class="w-6 h-6 text-white" />
                </x-slot>
            </x-lembur.stat-card>

            <x-lembur.stat-card :value="$stats['approved'] ?? 0" label="Disetujui" gradient="from-blue-50 to-indigo-100"
                iconBg="bg-blue-500" textColor="text-blue-800">
                <x-slot name="iconSlot">
                    <x-icons.check-circle class="w-6 h-6 text-white" />
                </x-slot>
            </x-lembur.stat-card>
        </div>

        {{-- Lembur List --}}
        <x-ui.section-card title="Daftar Pengajuan Lembur" animation="animate-slide-up-delay-2">
            <x-slot name="iconSlot">
                <x-icons.list class="h-6 w-6 text-white" />
            </x-slot>

            @if ($lemburs->count())
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Pegawai</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Tanggal</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Waktu</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Durasi</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lemburs as $item)
                                <x-lembur.admin-table-row :item="$item" />
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($lemburs->hasPages())
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        {{ $lemburs->links() }}
                    </div>
                @endif
            @else
                <x-lembur.empty-state message="Belum ada pengajuan lembur" />
            @endif
        </x-ui.section-card>
    </div>

    {{-- Photo Modal --}}
    <x-lembur.photo-modal />

    {{-- Reject Modal --}}
    <x-lembur.reject-modal />
</x-app-layout>
