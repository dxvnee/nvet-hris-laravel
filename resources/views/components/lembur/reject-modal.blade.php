{{-- Lembur Reject Modal Component - Uses ui/modal --}}
<x-ui.modal id="reject-modal" title="Tolak Lembur" maxWidth="md">
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
    function openRejectModal(lemburId) {
        document.getElementById('reject-form').action = `/lembur/${lemburId}/reject`;
        openModal('reject-modal');
    }

    function closeRejectModal() {
        closeModal('reject-modal');
    }
</script>
