{{-- Hari Libur Create Page - Modular Version --}}
<x-app-layout>
    <x-slot name="header">Tambah Hari Libur / Hari Khusus</x-slot>
    <x-slot name="subtle">Buat jadwal hari libur atau hari kerja khusus baru</x-slot>

    <div class="space-y-6" x-data="{
        tipe: '{{ old('tipe', 'libur') }}',
        isMasuk: {{ old('is_masuk') ? 'true' : 'false' }},
        isLembur: {{ old('is_lembur') ? 'true' : 'false' }},
        isShiftEnabled: {{ old('is_shift_enabled') ? 'true' : 'false' }},
        pegawaiMode: '{{ old('pegawai_mode', 'semua') }}'
    }">
        {{-- Back Button --}}
        <x-ui.back-button :href="route('hari-libur.index')" />

        {{-- Form Card --}}
        <x-ui.section-card title="Form Hari Libur / Hari Khusus">
            <x-slot name="iconSlot">
                <x-icons.calendar class="h-6 w-6 text-white" />
            </x-slot>

            <form action="{{ route('hari-libur.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Tipe Selection --}}
                <x-ui.section-card variant="simple" title="Tipe">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        {{-- Libur --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="tipe" value="libur" x-model="tipe" class="peer hidden">
                            <div
                                class="p-4 rounded-xl border-2 border-gray-200 transition-all
                                peer-checked:border-red-500 peer-checked:bg-red-50 hover:border-gray-300">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-red-500 rounded-lg">
                                        <x-icons.no-symbol class="w-5 h-5 text-white" />
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Libur</p>
                                        <p class="text-sm text-gray-500">Kantor tutup</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                        {{-- Hari Khusus --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="tipe" value="hari_khusus" x-model="tipe" class="peer hidden">
                            <div
                                class="p-4 rounded-xl border-2 border-gray-200 transition-all
                                peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-blue-500 rounded-lg">
                                        <x-icons.calendar class="w-5 h-5 text-white" />
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Hari Khusus</p>
                                        <p class="text-sm text-gray-500">Jam kerja berbeda</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('tipe')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </x-ui.section-card variant="simple">

                {{-- Basic Info --}}
                <x-ui.section-card variant="simple" title="Informasi Dasar">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-ui.form-input type="date" name="tanggal" label="Tanggal" :value="old('tanggal')" required />

                        <x-ui.form-input type="text" name="nama" label="Nama" :value="old('nama')"
                            placeholder="Contoh: Hari Kemerdekaan RI" required />
                    </div>

                    <div class="mt-4">
                        <x-ui.form-input type="textarea" name="deskripsi" label="Deskripsi" :value="old('deskripsi')"
                            placeholder="Deskripsi tambahan (opsional)" rows="2" />
                    </div>

                    <div class="mt-4">
                        <x-ui.form-checkbox name="is_recurring" label="Berulang Setiap Tahun"
                            description="Tanggal ini akan otomatis menjadi libur/hari khusus setiap tahunnya"
                            :checked="old('is_recurring')" size="lg" variant="stacked" />
                    </div>
                </x-ui.section-card variant="simple">

                {{-- Hari Khusus Options --}}
                <div x-show="tipe === 'hari_khusus'" x-transition class="space-y-6">
                    {{-- Kehadiran --}}
                    <x-ui.section-card variant="simple" title="Pengaturan Kehadiran">
                        <div class="space-y-4">
                            <x-ui.form-checkbox name="is_masuk" label="Pegawai Tetap Masuk"
                                description="Pegawai tetap harus masuk kerja di hari ini" xModel="isMasuk"
                                :checked="old('is_masuk')" size="lg" variant="stacked" />

                            <div x-show="isMasuk" x-transition class="ml-8">
                                <x-ui.form-checkbox name="is_lembur" label="Dihitung Sebagai Lembur"
                                    description="Kehadiran di hari ini dihitung sebagai lembur" xModel="isLembur"
                                    :checked="old('is_lembur')" size="lg" variant="stacked" />
                            </div>
                        </div>
                    </x-ui.section-card variant="simple">

                    {{-- Jam Kerja --}}
                    <div x-show="isMasuk" x-transition>
                        <x-ui.section-card variant="simple" title="Jam Kerja">
                            <div class="grid grid-cols-2 gap-4">
                                <x-ui.form-input type="time" name="jam_masuk" label="Jam Masuk" :value="old('jam_masuk')" />
                                <x-ui.form-input type="time" name="jam_keluar" label="Jam Keluar"
                                    :value="old('jam_keluar')" />
                            </div>
                        </x-ui.section-card variant="simple">
                    </div>

                    {{-- Shift Settings --}}
                    <x-ui.section-card variant="simple">
                        <x-ui.form-checkbox name="is_shift_enabled" label="Aktifkan Pengaturan Shift"
                            description="Atur jam kerja berbeda untuk pegawai shift" xModel="isShiftEnabled"
                            :checked="old('is_shift_enabled')" size="lg" variant="stacked" />

                        <div x-show="isShiftEnabled" x-transition
                            class="space-y-4 pt-4 border-t border-gray-200 mt-4">
                            <x-ui.time-range-input badge="Shift 1" badgeType="success" startName="shift1_jam_masuk"
                                endName="shift1_jam_keluar" :startValue="old('shift1_jam_masuk')" :endValue="old('shift1_jam_keluar')" />

                            <x-ui.time-range-input badge="Shift 2" badgeType="orange" startName="shift2_jam_masuk"
                                endName="shift2_jam_keluar" :startValue="old('shift2_jam_masuk')" :endValue="old('shift2_jam_keluar')" />
                        </div>
                    </x-ui.section-card variant="simple">

                    {{-- Pegawai Selection --}}
                    <x-ui.section-card variant="simple" title="Pegawai yang Hadir">
                        <div class="flex gap-4 mb-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="pegawai_mode" value="semua" x-model="pegawaiMode"
                                    class="w-4 h-4 text-primary focus:ring-primary">
                                <span class="text-sm text-gray-700">Semua Pegawai</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="pegawai_mode" value="pilih" x-model="pegawaiMode"
                                    class="w-4 h-4 text-primary focus:ring-primary">
                                <span class="text-sm text-gray-700">Pilih Pegawai</span>
                            </label>
                        </div>

                        <input type="hidden" name="pegawai_semua" :value="pegawaiMode === 'semua' ? '1' : ''">

                        <div x-show="pegawaiMode === 'pilih'" x-transition class="space-y-3 max-h-60 overflow-y-auto">
                            @foreach ($pegawai as $p)
                                <x-ui.selectable-item name="pegawai_hadir[]" :value="$p->id" :user="$p"
                                    :selected="in_array($p->id, old('pegawai_hadir', []))" />
                            @endforeach
                        </div>
                    </x-ui.section-card variant="simple">

                    {{-- Additional Options --}}
                    <x-ui.section-card variant="simple" title="Opsi Tambahan">
                        <div class="space-y-4">
                            <x-ui.form-checkbox name="libur_tetap_masuk" label="Yang Libur Hari Itu Tetap Masuk"
                                description="Pegawai yang jadwalnya libur di hari ini tetap harus masuk"
                                :checked="old('libur_tetap_masuk')" size="lg" variant="stacked" />

                            <x-ui.form-checkbox name="is_wajib" label="Wajib Hadir"
                                description="Jika tidak hadir akan dihitung sebagai alpha/absen" :checked="old('is_wajib')"
                                size="lg" variant="stacked" />

                            <div x-show="isLembur" x-transition>
                                <x-ui.form-input type="number" name="upah_multiplier" label="Pengali Upah"
                                    :value="old('upah_multiplier', '1.0')" min="0.5" max="5" step="0.5" class="w-32"
                                    suffix="× upah normal" hint="Contoh: 2.0 = upah 2x lipat" />
                            </div>
                        </div>
                    </x-ui.section-card variant="simple">
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3 pt-4">
                    <x-ui.action-button tag="a" :href="route('hari-libur.index')" variant="secondary"
                        class="flex-1 text-center">
                        Batal
                    </x-ui.action-button>
                    <x-ui.action-button type="submit" variant="primary" class="flex-1">
                        Simpan
                    </x-ui.action-button>
                </div>
            </form>
        </x-ui.section-card>
    </div>
</x-app-layout>
