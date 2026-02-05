<x-app-layout>
    <x-slot name="header">Tambah Pegawai</x-slot>
    <x-slot name="subtle">Daftarkan pegawai baru ke sistem</x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Back Button -->
        <a href="{{ route('users.index') }}"
            class="inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors animate-slide-up">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Daftar Pegawai
        </a>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 animate-slide-up-delay-1">
            <div class="flex items-center gap-3 mb-8">
                <div class="p-3 bg-gradient-to-br from-primary to-primaryDark rounded-xl shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Form Pendaftaran Pegawai</h2>
                    <p class="text-gray-500 text-sm">Isi data pegawai dengan lengkap</p>
                </div>
            </div>

            <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                @csrf

                <!-- Name & Email Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <x-ui.form-input type="text" id="name" name="name" :value="old('name')"
                            placeholder="Masukkan nama lengkap" variant="rounded" required />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <x-ui.form-input type="email" id="email" name="email" :value="old('email')"
                            placeholder="contoh@email.com" variant="rounded" required />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <x-ui.form-input type="password" id="password" name="password" placeholder="Minimal 8 karakter"
                            variant="rounded" required />
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <x-ui.form-input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Ulangi password" variant="rounded" required />
                    </div>
                </div>

                <!-- Jabatan & Gaji Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Jabatan <span class="text-red-500">*</span>
                        </label>
                        <x-ui.form-select name="jabatan" id="jabatan" variant="rounded" :selected="old('jabatan')"
                            :options="[
                                'Dokter' => 'Dokter',
                                'Paramedis' => 'Paramedis',
                                'Tech' => 'Tech',
                                'FO' => 'FO (Front Office)',
                            ]" placeholder="Pilih Jabatan" required />
                        @error('jabatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gaji_pokok" class="block text-sm font-medium text-gray-700 mb-2">
                            Gaji Pokok <span class="text-red-500">*</span>
                        </label>
                        <x-ui.form-input type="number" id="gaji_pokok" name="gaji_pokok" :value="old('gaji_pokok')"
                            prefix="Rp" placeholder="0" min="0" step="1000" variant="rounded" required />
                        @error('gaji_pokok')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Jam Kerja -->
                <div>
                    <label for="jam_kerja" class="block text-sm font-medium text-gray-700 mb-2">
                        Jam Kerja per Hari <span class="text-red-500">*</span>
                    </label>
                    <div class="relative w-full md:w-1/2">
                        <x-ui.form-input type="number" id="jam_kerja" name="jam_kerja" :value="old('jam_kerja', 8)" suffix="jam"
                            min="1" max="24" variant="rounded" required />
                    </div>
                    @error('jam_kerja')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Shift Toggle -->
                <div x-data="{ isShift: {{ old('is_shift') ? 'true' : 'false' }} }">
                    <div class="flex items-center gap-4 mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Sistem Shift
                        </label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_shift" value="0">
                            <input type="checkbox" name="is_shift" value="1" x-model="isShift"
                                class="sr-only peer" {{ old('is_shift') ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-700"
                                x-text="isShift ? 'Aktif' : 'Tidak Aktif'"></span>
                        </label>
                    </div>

                    <!-- Non-Shift: Jam Masuk & Keluar Normal -->
                    <div x-show="!isShift" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="jam_masuk" class="block text-sm font-medium text-gray-700 mb-2">
                                Jam Masuk <span class="text-red-500">*</span>
                            </label>
                            <input id="jam_masuk" name="jam_masuk" type="time"
                                value="{{ old('jam_masuk', '08:00') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('jam_masuk') border-red-500 @enderror"
                                :required="!isShift">
                            @error('jam_masuk')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="jam_keluar" class="block text-sm font-medium text-gray-700 mb-2">
                                Jam Keluar <span class="text-red-500">*</span>
                            </label>
                            <input id="jam_keluar" name="jam_keluar" type="time"
                                value="{{ old('jam_keluar', '17:00') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('jam_keluar') border-red-500 @enderror"
                                :required="!isShift">
                            @error('jam_keluar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Shift: Partner & Jam Shift -->
                    <div x-show="isShift" x-transition class="space-y-6">
                        <!-- Shift Partner Selection -->
                        <div>
                            <label for="shift_partner_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Partner Shift <span class="text-red-500">*</span>
                            </label>
                            <select id="shift_partner_id" name="shift_partner_id"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('shift_partner_id') border-red-500 @enderror"
                                :required="isShift">
                                <option value="">Pilih Partner Shift</option>
                                @foreach ($pegawaiList as $pegawai)
                                    <option value="{{ $pegawai->id }}"
                                        {{ old('shift_partner_id') == $pegawai->id ? 'selected' : '' }}>
                                        {{ $pegawai->name }} ({{ $pegawai->jabatan }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Pegawai yang akan bergantian shift dengan pegawai
                                ini. Siapa yang absen duluan = Shift 1.</p>
                            @error('shift_partner_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Shift 1 Times -->
                        <div class="p-4 bg-blue-50 rounded-xl border border-blue-200">
                            <h4 class="font-semibold text-blue-800 mb-3 flex items-center gap-2">
                                <span
                                    class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm">1</span>
                                Shift 1 (Pagi)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="shift1_jam_masuk"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Jam Masuk <span class="text-red-500">*</span>
                                    </label>
                                    <input id="shift1_jam_masuk" name="shift1_jam_masuk" type="time"
                                        value="{{ old('shift1_jam_masuk', '08:00') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('shift1_jam_masuk') border-red-500 @enderror"
                                        :required="isShift">
                                    @error('shift1_jam_masuk')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="shift1_jam_keluar"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Jam Keluar <span class="text-red-500">*</span>
                                    </label>
                                    <input id="shift1_jam_keluar" name="shift1_jam_keluar" type="time"
                                        value="{{ old('shift1_jam_keluar', '14:00') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('shift1_jam_keluar') border-red-500 @enderror"
                                        :required="isShift">
                                    @error('shift1_jam_keluar')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Shift 2 Times -->
                        <div class="p-4 bg-orange-50 rounded-xl border border-orange-200">
                            <h4 class="font-semibold text-orange-800 mb-3 flex items-center gap-2">
                                <span
                                    class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center text-sm">2</span>
                                Shift 2 (Sore)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="shift2_jam_masuk"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Jam Masuk <span class="text-red-500">*</span>
                                    </label>
                                    <input id="shift2_jam_masuk" name="shift2_jam_masuk" type="time"
                                        value="{{ old('shift2_jam_masuk', '14:00') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('shift2_jam_masuk') border-red-500 @enderror"
                                        :required="isShift">
                                    @error('shift2_jam_masuk')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="shift2_jam_keluar"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Jam Keluar <span class="text-red-500">*</span>
                                    </label>
                                    <input id="shift2_jam_keluar" name="shift2_jam_keluar" type="time"
                                        value="{{ old('shift2_jam_keluar', '20:00') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('shift2_jam_keluar') border-red-500 @enderror"
                                        :required="isShift">
                                    @error('shift2_jam_keluar')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <p class="text-sm text-gray-500 bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                            <strong>💡 Catatan:</strong> Siapa yang absen masuk duluan pada hari itu akan otomatis
                            menjadi Shift 1, dan partner-nya wajib menjadi Shift 2.
                        </p>
                    </div>
                </div>

                <!-- Hari Libur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Hari Libur Khusus dalam Seminggu
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-3">
                        @php
                            $hariNama = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                            $hariShort = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
                            $oldHariLibur = old('hari_libur', []);
                        @endphp
                        @foreach ($hariNama as $index => $hari)
                            <label class="relative cursor-pointer">
                                <input type="checkbox" name="hari_libur[]" value="{{ $index }}"
                                    class="peer sr-only" {{ in_array($index, $oldHariLibur) ? 'checked' : '' }}>
                                <div
                                    class="p-3 rounded-xl border-2 border-gray-200 bg-gray-50 text-center transition-all
                                    peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:text-red-700
                                    hover:border-gray-300">
                                    <span class="block font-semibold text-sm">{{ $hariShort[$index] }}</span>
                                    <span
                                        class="block text-xs text-gray-500 peer-checked:text-red-500">{{ $hari }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Pilih hari-hari dimana pegawai ini libur secara rutin</p>
                    @error('hari_libur')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <x-ui.action-button type="submit" variant="primary" iconName="check" class="flex-1">
                        Simpan Pegawai
                    </x-ui.action-button>
                    <x-ui.action-button tag="a" :href="route('users.index')" variant="secondary" iconName="x-mark"
                        class="flex-1">
                        Batal
                    </x-ui.action-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
