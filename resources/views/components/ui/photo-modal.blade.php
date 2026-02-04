{{-- Universal Photo Modal Component --}}
@props([
    'id' => 'photo-modal',
    'title' => 'Foto',
    'showDownload' => true,
    'variant' => 'default', // default, simple
])

<div id="{{ $id }}"
    class="fixed inset-0 flex items-center justify-center z-50 hidden opacity-0 transition-all duration-300 ease-out">
    {{-- Modal Content --}}
    <div
        class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 overflow-hidden transform scale-95 transition-all duration-300 ease-out relative z-10">
        @if ($variant === 'simple')
            {{-- Simple header --}}
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 id="{{ $id }}-title" class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                <button type="button" onclick="closePhotoModal('{{ $id }}')"
                    class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <x-icons.x-mark class="w-5 h-5 text-gray-500" />
                </button>
            </div>
        @else
            {{-- Gradient header --}}
            <div class="p-4 bg-gradient-to-r from-primary to-primaryDark text-white flex justify-between items-center">
                <div>
                    <h3 id="{{ $id }}-title" class="text-lg font-bold">{{ $title }}</h3>
                    <p id="{{ $id }}-subtitle" class="text-sm opacity-90"></p>
                </div>
                <button onclick="closePhotoModal('{{ $id }}')"
                    class="p-1 hover:bg-white/20 rounded-lg transition-colors">
                    <x-icons.x-mark class="w-6 h-6" />
                </button>
            </div>
        @endif

        {{-- Image Container --}}
        <div class="p-4">
            <div class="bg-gray-100 rounded-xl overflow-hidden">
                <img id="{{ $id }}-image" src="" alt="{{ $title }}"
                    class="w-full h-auto max-h-96 object-contain opacity-0 transform scale-95 transition-all duration-500 ease-out delay-150">
            </div>

            @if ($showDownload)
                <div class="mt-4 flex justify-end gap-3">
                    <button onclick="closePhotoModal('{{ $id }}')"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-lg transition-colors">
                        Tutup
                    </button>
                    <a id="{{ $id }}-download" href="" download
                        class="px-4 py-2 bg-primary hover:bg-primaryDark text-white font-bold rounded-lg transition-colors">
                        Download
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            function openPhotoModal(imageSrc, title = null, subtitle = null, modalId = 'photo-modal') {
                const modal = document.getElementById(modalId);
                const modalImage = document.getElementById(`${modalId}-image`);
                const modalTitle = document.getElementById(`${modalId}-title`);
                const modalSubtitle = document.getElementById(`${modalId}-subtitle`);
                const downloadLink = document.getElementById(`${modalId}-download`);

                modalImage.src = imageSrc;

                if (title && modalTitle) modalTitle.textContent = title;
                if (subtitle && modalSubtitle) modalSubtitle.textContent = subtitle;
                if (downloadLink) downloadLink.href = imageSrc;

                modal.classList.remove('hidden');
                modal.offsetHeight; // Force reflow
                modal.classList.add('opacity-100');
                modal.querySelector('.bg-white')?.classList.add('scale-100');

                modalImage.onload = function() {
                    setTimeout(() => {
                        modalImage.classList.add('opacity-100', 'scale-100');
                    }, 100);
                };

                if (modalImage.complete) {
                    setTimeout(() => {
                        modalImage.classList.add('opacity-100', 'scale-100');
                    }, 100);
                }

                document.body.style.overflow = 'hidden';
            }

            function closePhotoModal(modalId = 'photo-modal') {
                const modal = document.getElementById(modalId);
                const modalImage = document.getElementById(`${modalId}-image`);

                modal.classList.remove('opacity-100');
                modal.querySelector('.bg-white')?.classList.remove('scale-100');
                modalImage.classList.remove('opacity-100', 'scale-100');

                setTimeout(() => {
                    modal.classList.add('hidden');
                    modalImage.src = '';
                    document.body.style.overflow = '';
                }, 300);
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Click outside to close
                document.querySelectorAll('[id$="-modal"]').forEach(modal => {
                    modal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            closePhotoModal(this.id);
                        }
                    });
                });

                // Escape key to close
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        document.querySelectorAll('[id$="-modal"]:not(.hidden)').forEach(modal => {
                            closePhotoModal(modal.id);
                        });
                    }
                });
            });
        </script>
    @endpush
@endonce
