{{-- Lembur Admin Page - Modular Version --}}
<x-app-layout>
    <x-slot name="header">Kelola Lembur</x-slot>
    <x-slot name="subtle">Setujui atau tolak pengajuan lembur pegawai</x-slot>

    <div class="space-y-6">
        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 animate-slide-up-delay-1">
            <x-ui.stat-card :value="$stats['total'] ?? 0" label="Total Lembur" color="green" variant="gradient" iconName="chart" />

            <x-ui.stat-card :value="$stats['pending'] ?? 0" label="Menunggu Approval" color="yellow" variant="gradient"
                iconName="clock" />

            <x-ui.stat-card :value="$stats['approved'] ?? 0" label="Disetujui" color="blue" variant="gradient" iconName="check" />
        </div>

        {{-- Lembur List --}}
        <x-ui.section-card title="Daftar Pengajuan Lembur" animation="animate-slide-up-delay-2">
            <x-slot name="iconSlot">
                <x-icons.list class="h-6 w-6 text-white" />
            </x-slot>

            @if ($lemburs->count())
                <div class="overflow-x-auto">
                    <x-ui.table>
                        <x-ui.table-head>
                            <x-ui.table-row class="border-b border-gray-200">
                                <x-ui.table-header-cell>Pegawai</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Tanggal</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Waktu</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Durasi</x-ui.table-header-cell>
                                <x-ui.table-header-cell>Status</x-ui.table-header-cell>
                                <x-ui.table-header-cell align="center">Aksi</x-ui.table-header-cell>
                            </x-ui.table-row>
                        </x-ui.table-head>
                        <x-ui.table-body>
                            @foreach ($lemburs as $item)
                                <x-lembur.admin-table-row :item="$item" />
                            @endforeach
                        </x-ui.table-body>
                    </x-ui.table>
                </div>

                {{-- Pagination --}}
                @if ($lemburs->hasPages())
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        {{ $lemburs->links() }}
                    </div>
                @endif
            @else
                <x-ui.empty-state message="Belum ada pengajuan lembur" icon="clock" size="lg" />
            @endif
        </x-ui.section-card>
    </div>

    {{-- Photo Modal --}}
    <x-ui.photo-modal title="Foto Lembur" variant="simple" :showDownload="false" />

    {{-- Reject Modal --}}
    <x-ui.modal name="reject-modal" title="Tolak Lembur" maxWidth="md">
        <form id="reject-form" method="POST" class="p-4 space-y-4">
            @csrf
            @method('PATCH')
            <div>
                <x-ui.form-input type="textarea" name="alasan_penolakan" label="Alasan Penolakan"
                    placeholder="Masukkan alasan penolakan..." :rows="4" required />
            </div>
            <div class="flex justify-end gap-3">
                <x-ui.action-button variant="secondary" onclick="closeRejectModal()">
                    Batal
                </x-ui.action-button>
                <x-ui.action-button type="submit" variant="danger">
                    Tolak
                </x-ui.action-button>
            </div>
        </form>
    </x-ui.modal>

    <script>
        function openModal(name) {
            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: name
            }));
        }

        function closeModal(name) {
            window.dispatchEvent(new CustomEvent('close-modal', {
                detail: name
            }));
        }

        function openRejectModal(lemburId) {
            document.getElementById('reject-form').action = `/lembur/${lemburId}/reject`;
            openModal('reject-modal');
        }

        function closeRejectModal() {
            closeModal('reject-modal');
        }
    </script>
</x-app-layout>
