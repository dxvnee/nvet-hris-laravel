<x-app-layout>
    <x-slot name="header">Tambah Pegawai</x-slot>
    <x-slot name="subtle">Daftarkan pegawai baru ke sistem</x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Back Button -->
        <a href="{{ route('users.index') }}"
            class="inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors animate-slide-up">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Pegawai
        </a>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 animate-slide-up-delay-1">
            <div class="flex items-center gap-3 mb-8">
                <div class="p-3 bg-gradient-to-br from-primary to-primaryDark rounded-xl shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
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
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('name') border-red-500 @enderror"
                            placeholder="Masukkan nama lengkap"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('email') border-red-500 @enderror"
                            placeholder="contoh@email.com"
                            required>
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
                        <input id="password" name="password" type="password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('password') border-red-500 @enderror"
                            placeholder="Minimal 8 karakter"
                            required>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                            placeholder="Ulangi password"
                            required>
                    </div>
                </div>

                <!-- Jabatan & Gaji Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Jabatan <span class="text-red-500">*</span>
                        </label>
                        <select id="jabatan" name="jabatan"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('jabatan') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Jabatan</option>
                            <option value="Dokter" {{ old('jabatan') == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="Paramedis" {{ old('jabatan') == 'Paramedis' ? 'selected' : '' }}>Paramedis</option>
                            <option value="Tech" {{ old('jabatan') == 'Tech' ? 'selected' : '' }}>Tech</option>
                            <option value="FO" {{ old('jabatan') == 'FO' ? 'selected' : '' }}>FO (Front Office)</option>
                        </select>
                        @error('jabatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gaji_pokok" class="block text-sm font-medium text-gray-700 mb-2">
                            Gaji Pokok <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                            <input id="gaji_pokok" name="gaji_pokok" type="number" value="{{ old('gaji_pokok') }}"
                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('gaji_pokok') border-red-500 @enderror"
                                placeholder="0"
                                min="0"
                                step="1000"
                                required>
                        </div>
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
                        <input id="jam_kerja" name="jam_kerja" type="number" value="{{ old('jam_kerja', 8) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('jam_kerja') border-red-500 @enderror"
                            min="1"
                            max="24"
                            required>
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">jam</span>
                    </div>
                    @error('jam_kerja')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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
                        @foreach($hariNama as $index => $hari)
                            <label class="relative cursor-pointer">
                                <input type="checkbox" name="hari_libur[]" value="{{ $index }}"
                                    class="peer sr-only"
                                    {{ in_array($index, $oldHariLibur) ? 'checked' : '' }}>
                                <div class="p-3 rounded-xl border-2 border-gray-200 bg-gray-50 text-center transition-all
                                    peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:text-red-700
                                    hover:border-gray-300">
                                    <span class="block font-semibold text-sm">{{ $hariShort[$index] }}</span>
                                    <span class="block text-xs text-gray-500 peer-checked:text-red-500">{{ $hari }}</span>
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
                    <button type="submit"
                        class="flex-1 px-8 py-3 bg-gradient-to-r from-primary to-primaryDark text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Pegawai
                    </button>
                    <a href="{{ route('users.index') }}"
                        class="flex-1 px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
