{{-- Hari Libur Edit Page - Modular Version --}}
<x-app-layout>
    <x-slot name="header">Edit Hari Libur / Hari Khusus</x-slot>
    <x-slot name="subtle">Perbarui jadwal hari libur atau hari kerja khusus</x-slot>

    <div class="space-y-6" x-data="{
        tipe: '{{ old('tipe', $hariLibur->tipe ?? 'libur') }}',
        isMasuk: {{ old('is_masuk', $hariLibur->is_masuk ?? false) ? 'true' : 'false' }},
        isLembur: {{ old('is_lembur', $hariLibur->is_lembur ?? false) ? 'true' : 'false' }},
        isShiftEnabled: {{ old('is_shift_enabled', $hariLibur->is_shift_enabled ?? false) ? 'true' : 'false' }},
        pegawaiMode: '{{ $hariLibur->pegawai_semua ?? true ? 'semua' : 'pilih' }}'
    }">
        {{-- Back Button --}}
        <x-ui.back-button :href="route('hari-libur.index')" />

        {{-- Form Card --}}
        <x-ui.section-card title="Form Hari Libur / Hari Khusus">
            <x-slot name="iconSlot">
                <x-icons.calendar class="h-6 w-6 text-white" />
            </x-slot>

            <form action="{{ route('hari-libur.update', $hariLibur) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

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
                        <x-ui.form-input type="date" name="tanggal" label="Tanggal" :value="old('tanggal', $hariLibur->tanggal?->format('Y-m-d'))" required />

                        <x-ui.form-input type="text" name="nama" label="Nama" :value="old('nama', $hariLibur->nama)"
                            placeholder="Contoh: Hari Kemerdekaan RI" required />
                    </div>

                    <div class="mt-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="2" placeholder="Deskripsi tambahan (opsional)"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all resize-none">{{ old('deskripsi', $hariLibur->deskripsi) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <x-hari-libur.checkbox-option name="is_recurring" label="Berulang Setiap Tahun"
                            description="Tanggal ini akan otomatis menjadi libur/hari khusus setiap tahunnya"
                            :checked="old('is_recurring', $hariLibur->is_recurring)" />
                    </div>
                </x-ui.section-card variant="simple">

                {{-- Hari Khusus Options --}}
                <div x-show="tipe === 'hari_khusus'" x-transition class="space-y-6">
                    {{-- Kehadiran --}}
                    <x-ui.section-card variant="simple" title="Pengaturan Kehadiran">
                        <div class="space-y-4">
                            <x-hari-libur.checkbox-option name="is_masuk" label="Pegawai Tetap Masuk"
                                description="Pegawai tetap harus masuk kerja di hari ini" xModel="isMasuk"
                                :checked="old('is_masuk', $hariLibur->is_masuk)" />

                            <div x-show="isMasuk" x-transition class="ml-8">
                                <x-hari-libur.checkbox-option name="is_lembur" label="Dihitung Sebagai Lembur"
                                    description="Kehadiran di hari ini dihitung sebagai lembur" xModel="isLembur"
                                    :checked="old('is_lembur', $hariLibur->is_lembur)" />
                            </div>
                        </div>
                    </x-ui.section-card variant="simple">

                    {{-- Jam Kerja --}}
                    <div x-show="isMasuk" x-transition>
                        <x-ui.section-card variant="simple" title="Jam Kerja">
                            <div class="grid grid-cols-2 gap-4">
                                <x-ui.form-input type="time" name="jam_masuk" label="Jam Masuk" :value="old(
                                    'jam_masuk',
                                    $hariLibur->jam_masuk
                                        ? \Carbon\Carbon::parse($hariLibur->jam_masuk)->format('H:i')
                                        : '',
                                )" />
                                <x-ui.form-input type="time" name="jam_keluar" label="Jam Keluar"
                                    :value="old(
                                        'jam_keluar',
                                        $hariLibur->jam_keluar
                                            ? \Carbon\Carbon::parse($hariLibur->jam_keluar)->format('H:i')
                                            : '',
                                    )" />
                            </div>
                        </x-ui.section-card variant="simple">
                    </div>

                    {{-- Shift Settings --}}
                    <x-ui.section-card variant="simple">
                        <x-hari-libur.checkbox-option name="is_shift_enabled" label="Aktifkan Pengaturan Shift"
                            description="Atur jam kerja berbeda untuk pegawai shift" xModel="isShiftEnabled"
                            :checked="old('is_shift_enabled', $hariLibur->is_shift_enabled)" />

                        <div x-show="isShiftEnabled" x-transition class="space-y-4 pt-4 border-t border-gray-200 mt-4">
                            <x-hari-libur.shift-section :shiftNumber="1" jamMasukName="shift1_jam_masuk"
                                jamKeluarName="shift1_jam_keluar" :jamMasukValue="old(
                                    'shift1_jam_masuk',
                                    $hariLibur->shift1_jam_masuk
                                        ? \Carbon\Carbon::parse($hariLibur->shift1_jam_masuk)->format('H:i')
                                        : '',
                                )" :jamKeluarValue="old(
                                    'shift1_jam_keluar',
                                    $hariLibur->shift1_jam_keluar
                                        ? \Carbon\Carbon::parse($hariLibur->shift1_jam_keluar)->format('H:i')
                                        : '',
                                )" />

                            <x-hari-libur.shift-section :shiftNumber="2" jamMasukName="shift2_jam_masuk"
                                jamKeluarName="shift2_jam_keluar" :jamMasukValue="old(
                                    'shift2_jam_masuk',
                                    $hariLibur->shift2_jam_masuk
                                        ? \Carbon\Carbon::parse($hariLibur->shift2_jam_masuk)->format('H:i')
                                        : '',
                                )" :jamKeluarValue="old(
                                    'shift2_jam_keluar',
                                    $hariLibur->shift2_jam_keluar
                                        ? \Carbon\Carbon::parse($hariLibur->shift2_jam_keluar)->format('H:i')
                                        : '',
                                )" />
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

                        @php
                            $selectedPegawai = old('pegawai_hadir', $hariLibur->pegawai_hadir ?? []);
                        @endphp

                        <div x-show="pegawaiMode === 'pilih'" x-transition class="space-y-3 max-h-60 overflow-y-auto">
                            @foreach ($pegawai as $p)
                                <x-hari-libur.pegawai-item :pegawai="$p" :selected="in_array($p->id, $selectedPegawai)" />
                            @endforeach
                        </div>
                    </x-ui.section-card variant="simple">

                    {{-- Additional Options --}}
                    <x-ui.section-card variant="simple" title="Opsi Tambahan">
                        <div class="space-y-4">
                            <x-hari-libur.checkbox-option name="libur_tetap_masuk"
                                label="Yang Libur Hari Itu Tetap Masuk"
                                description="Pegawai yang jadwalnya libur di hari ini tetap harus masuk"
                                :checked="old('libur_tetap_masuk', $hariLibur->libur_tetap_masuk)" />

                            <x-hari-libur.checkbox-option name="is_wajib" label="Wajib Hadir"
                                description="Jika tidak hadir akan dihitung sebagai alpha/absen" :checked="old('is_wajib', $hariLibur->is_wajib)" />

                            <div x-show="isLembur" x-transition>
                                <label for="upah_multiplier" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pengali Upah
                                </label>
                                <div class="flex items-center gap-3">
                                    <input type="number" name="upah_multiplier" id="upah_multiplier"
                                        value="{{ old('upah_multiplier', $hariLibur->upah_multiplier ?? '1.0') }}"
                                        min="0.5" max="5" step="0.5"
                                        class="w-32 px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                    <span class="text-gray-500">× upah normal</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Contoh: 2.0 = upah 2x lipat</p>
                            </div>
                        </div>
                    </x-ui.section-card variant="simple">
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3 pt-4">
                    <a href="{{ route('hari-libur.index') }}"
                        class="flex-1 py-3 px-6 rounded-xl font-bold text-gray-700 bg-gray-200 hover:bg-gray-300 transition-all text-center">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 py-3 px-6 rounded-xl font-bold text-white bg-gradient-to-r from-primary to-primaryDark hover:from-primaryDark hover:to-primary transition-all shadow-lg">
                        Perbarui
                    </button>
                </div>
            </form>
        </x-ui.section-card>
    </div>
</x-app-layout>
