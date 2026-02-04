{{-- Lembur Photo Modal Component --}}
<div id="photo-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 overflow-hidden">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Foto Lembur</h3>
            <button type="button" onclick="closePhotoModal()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <img id="modal-photo" src="" alt="Foto Lembur" class="w-full h-auto rounded-xl">
        </div>
    </div>
</div>

<script>
    function openPhotoModal(src) {
        document.getElementById('modal-photo').src = src;
        document.getElementById('photo-modal').classList.remove('hidden');
        document.getElementById('photo-modal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closePhotoModal() {
        document.getElementById('photo-modal').classList.add('hidden');
        document.getElementById('photo-modal').classList.remove('flex');
        document.body.style.overflow = '';
    }
</script>
