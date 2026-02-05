{{-- Lembur Hari Libur Modal Component --}}
@props([])

<div id="lembur-libur-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] p-4 hidden">
    <div class="flex items-center justify-center min-h-full">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md transform transition-all animate-slide-up">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="p-4 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl shadow-lg">
                        <x-icons.sun class="h-12 w-12 text-blue-500" />
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Konfirmasi Lembur Hari Libur</h3>
                <p class="text-gray-600 text-center mb-4">
                    Hari ini adalah <span class="font-bold text-blue-600">hari libur</span> Anda.
                </p>
                <p class="text-gray-600 text-center mb-6">
                    Apakah Anda yakin ingin masuk untuk <span class="font-bold text-orange-600">lembur</span>?
                </p>

                {{-- Keterangan Lembur Hari Libur --}}
                <div id="lembur-libur-keterangan-wrapper" class="mb-6">
                    <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <x-icons.pencil class="w-4 h-4 text-orange-500" />
                        Keterangan Lembur <span class="text-red-500">*</span>
                    </label>
                    <x-ui.form-input type="textarea" id="lembur-libur-keterangan-input" rows="3"
                        placeholder="Jelaskan alasan dan detail pekerjaan lembur di hari libur..." class="!mb-0" />
                </div>

                <div class="flex gap-3">
                    <x-ui.action-button type="button" onclick="closeLemburLiburModal()" variant="secondary"
                        iconName="x-mark" class="flex-1">
                        Batal
                    </x-ui.action-button>
                    <x-ui.action-button type="button" onclick="confirmLemburLibur()" variant="warning" iconName="check"
                        class="flex-1">
                        Ya, Lembur
                    </x-ui.action-button>
                </div>
            </div>
        </div>
    </div>
</div>
