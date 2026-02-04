{{-- Lembur Reject Modal Component --}}
<div id="reject-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Tolak Lembur</h3>
            <button type="button" onclick="closeRejectModal()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <form id="reject-form" method="POST" class="p-4 space-y-4">
            @csrf
            @method('PATCH')
            <div>
                <label for="alasan_penolakan" class="block text-sm font-medium text-gray-700 mb-2">Alasan
                    Penolakan</label>
                <textarea name="alasan_penolakan" id="alasan_penolakan" rows="4" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all resize-none"
                    placeholder="Masukkan alasan penolakan..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeRejectModal()"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-xl transition-colors">
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRejectModal(lemburId) {
        document.getElementById('reject-form').action = `/lembur/${lemburId}/reject`;
        document.getElementById('reject-modal').classList.remove('hidden');
        document.getElementById('reject-modal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeRejectModal() {
        document.getElementById('reject-modal').classList.add('hidden');
        document.getElementById('reject-modal').classList.remove('flex');
        document.body.style.overflow = '';
    }
</script>
