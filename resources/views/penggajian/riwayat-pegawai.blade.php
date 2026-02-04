<x-app-layout>
    <x-slot name="header">Riwayat Penggajian</x-slot>
    <x-slot name="subtle">Riwayat penggajian Anda per bulan</x-slot>

    <div class="space-y-6">
        <!-- Payroll History -->
        <div class="bg-white rounded-2xl shadow-xl p-6 animate-slide-up-delay-1">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 bg-gradient-to-br from-primary to-primaryDark rounded-xl shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Riwayat Penggajian</h2>
            </div>

            @if ($penggajian->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <x-ui.sortable-header column="periode" label="Periode" />
                                <x-ui.sortable-header column="gaji_pokok" label="Gaji Pokok" />
                                <x-ui.sortable-header column="total_potongan_telat" label="Potongan Telat" />
                                <x-ui.sortable-header column="total_insentif" label="Insentif" />
                                <x-ui.sortable-header column="total_gaji" label="Total Gaji" />
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penggajian as $gaji)
                                <x-penggajian.riwayat-row :gaji="$gaji" />
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-ui.empty-state message="Belum ada riwayat penggajian" icon="clipboard" />
            @endif

            @if ($penggajian->hasPages())
                <div class="mt-6">
                    <x-ui.pagination :paginator="$penggajian" />
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
