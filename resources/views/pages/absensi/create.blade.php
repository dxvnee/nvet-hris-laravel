<x-app-layout>
    <x-slot name="header">Tambah Absensi Manual - {{ $user->name }}</x-slot>
    <x-slot name="subtle">{{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</x-slot>

    <div class="space-y-6">
        {{-- Back Button --}}
        <div class="animate-slide-up">
            <x-ui.back-button :href="route('absen.detailHari', $tanggal)" label="Kembali ke Detail Hari" />
        </div>

        {{-- User Info --}}
        <x-ui.section-card animation="animate-slide-up-delay-1">
            <div class="flex items-center gap-4">
                <x-ui.user-avatar :user="$user" size="lg" class="border-2 border-primary" />
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-gray-600">{{ $user->jabatan }}</p>
                    <p class="text-sm text-gray-500">Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</p>
                </div>
            </div>
        </x-ui.section-card>

        {{-- Create Form --}}
        <x-ui.section-card animation="animate-slide-up-delay-2">
            <form method="POST" action="{{ route('absen.storeManual') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                {{-- Waktu Absensi --}}
                <x-ui.form-section title="Waktu Absensi">
                    <x-slot:icon>
                        <x-icons.clock class="w-5 h-5 text-primary" />
                    </x-slot:icon>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-ui.form-input type="time" name="jam_masuk" label="Jam Masuk" />
                        <x-ui.form-input type="time" name="jam_pulang" label="Jam Pulang" />
                    </div>
                </x-ui.form-section>

                {{-- Status Kehadiran --}}
                <x-ui.form-section title="Status Kehadiran" :bordered="true">
                    <x-slot:icon>
                        <x-icons.check-circle class="w-5 h-5 text-primary" />
                    </x-slot:icon>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kehadiran</label>
                            <x-ui.form-checkbox name="tidak_hadir" label="Tidak Hadir" color="gray" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Hari Libur</label>
                            <x-ui.form-checkbox name="libur" label="Libur" color="blue" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Terlambat?</label>
                            <x-ui.form-checkbox name="telat" label="Ya, terlambat" color="red" />
                        </div>
                        <x-ui.form-input type="number" name="menit_telat" label="Menit Terlambat" :value="0" />
                    </div>
                </x-ui.form-section>

                {{-- Shift (Only for shift employees) --}}
                @if ($user->is_shift && $user->shift_partner_id)
                    <x-ui.form-section title="Shift" :bordered="true">
                        <x-slot:icon>
                            <x-icons.clock class="w-5 h-5 text-primary" />
                        </x-slot:icon>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-ui.form-select name="shift_number" label="Pilih Shift" :options="['1' => 'Shift 1', '2' => 'Shift 2']"
                                placeholder="-- Pilih Shift --" />
                        </div>
                    </x-ui.form-section>
                @endif

                {{-- Izin --}}
                <x-ui.form-section title="Izin" :bordered="true">
                    <x-slot:icon>
                        <x-icons.document-text class="w-5 h-5 text-primary" />
                    </x-slot:icon>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Izin</label>
                            <x-ui.form-checkbox name="izin" label="Izin" color="primary" />
                        </div>
                        <x-ui.form-input type="textarea" name="izin_keterangan" label="Keterangan Izin"
                            :value="old('izin_keterangan')" rows="3" />
                    </div>
                </x-ui.form-section>

                {{-- Submit --}}
                <div class="flex justify-end gap-3 pt-6 border-t">
                    <x-ui.action-button type="link" :href="route('absen.detailHari', $tanggal)" variant="secondary">
                        Batal
                    </x-ui.action-button>
                    <x-ui.action-button type="submit" variant="primary">
                        Simpan Absensi
                    </x-ui.action-button>
                </div>
            </form>
        </x-ui.section-card>
    </div>
</x-app-layout>
