<x-app-layout>
    <x-slot name="header">Absen</x-slot>
    <x-slot name="subtle">Halaman absensi karyawan</x-slot>

    <div class="space-y-6">
        {{-- Welcome Section --}}
        <x-ui.page-hero title="Absensi Kehadiran" :showClock="true" :showDate="true">
            <x-slot:icon>
                <x-icons.clock class="w-8 h-8 md:w-10 md:h-10 text-white" />
            </x-slot:icon>
        </x-ui.page-hero>

        {{-- Status Absen Hari Ini --}}
        <x-ui.section-card class="border border-gray-100 animate-slide-up-delay-1">
            <x-slot:icon>
                <x-icons.check-circle class="h-6 w-6 text-white" />
            </x-slot:icon>
            <x-slot:title>Status Absensi Hari Ini</x-slot:title>
            <x-slot:subtitle>Pantau kehadiran Anda</x-slot:subtitle>

            {{-- Status Cards Based on Condition --}}
            @if (isset($isInactive) && $isInactive)
                {{-- Inactive Status --}}
                <x-ui.alert-card type="danger" title="Status: Inactive" iconName="x-circle" class="mb-6">
                    @if ($inactiveEndDate)
                        Anda sedang inactive hingga {{ $inactiveEndDate->format('d M Y') }}.
                    @else
                        Anda sedang inactive secara permanen.
                    @endif
                    @if ($inactiveReason)
                        <p class="text-sm text-gray-700 mt-2 p-3 bg-white/70 rounded-lg border border-red-200">
                            <strong>Alasan:</strong> {{ $inactiveReason }}
                        </p>
                    @endif
                </x-ui.alert-card>

                <x-ui.info-box color="warning" class="mb-5">
                    <x-slot:title>Informasi</x-slot:title>
                    Anda tidak dapat melakukan absen saat status Anda inactive. Silakan hubungi admin untuk informasi
                    lebih lanjut.
                </x-ui.info-box>
            @elseif($liburOrNot)
                {{-- Holiday Status --}}
                <x-ui.alert-card type="info" :title="'Hari Libur' . (isset($namaHariLibur) && $namaHariLibur ? ' - ' . $namaHariLibur : '')" iconName="sun" class="mb-6">
                    @if ($sudahHadir)
                        <span class="inline-flex items-center gap-1">
                            <x-icons.clock class="w-4 h-4" />
                            Anda sedang lembur hari libur. Masuk: {{ $sudahHadir->jam_masuk->format('H:i') }}
                        </span>
                    @else
                        Hari ini adalah hari
                        libur{{ isset($namaHariLibur) && $namaHariLibur ? ' (' . $namaHariLibur . ')' : '' }}. Klik
                        tombol di bawah jika ingin lembur.
                    @endif
                </x-ui.alert-card>

                {{-- Location Status --}}
                <div id="location-status"
                    class="p-4 rounded-2xl bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="animate-spin h-5 w-5 border-2 border-primary border-t-transparent rounded-full">
                        </div>
                        <span class="text-gray-600 font-medium">Mengambil lokasi...</span>
                    </div>
                </div>

                {{-- Lembur Holiday Buttons --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-2">
                    <x-ui.action-button variant="lembur" size="xl" iconName="clock"
                        onclick="openLemburLiburModal('hadir')" :disabled="$sudahHadir ? true : false" class="group">
                        {{ $sudahHadir ? 'Sudah Masuk Lembur' : 'Masuk Lembur Hari Libur' }}
                    </x-ui.action-button>

                    <x-ui.action-button variant="pulang" size="xl" iconName="logout"
                        onclick="openCameraModal('pulang')" :disabled="!$sudahHadir || $sudahPulang" class="group">
                        {{ $sudahPulang ? 'Sudah Pulang' : (!$sudahHadir ? 'Masuk Lembur Dulu' : 'Pulang Lembur') }}
                    </x-ui.action-button>
                </div>
            @elseif($sudahIzin)
                {{-- Izin Status --}}
                <x-ui.alert-card type="warning" title="Sedang Izin" iconName="exclamation" class="mb-6">
                    <p class="text-sm text-amber-600 mt-1 flex items-center gap-2">
                        <x-icons.calendar class="w-4 h-4" />
                        Tanggal: {{ $sudahIzin->tanggal->format('d M Y') }}
                    </p>
                    @if ($sudahIzin->izin_keterangan)
                        <div class="mt-3 p-3 bg-amber-100 rounded-xl">
                            <p class="text-sm text-amber-800 italic flex items-start gap-2">
                                <x-icons.chat-bubble class="w-4 h-4 mt-0.5 flex-shrink-0" />
                                "{{ $sudahIzin->izin_keterangan }}"
                            </p>
                        </div>
                    @endif
                </x-ui.alert-card>
            @else
                {{-- Normal Status Cards --}}
                @php
                    $masukTime = $sudahHadir && $sudahHadir->jam_masuk ? $sudahHadir->jam_masuk->format('H:i') : null;
                    $pulangTime =
                        $sudahPulang && $sudahHadir && $sudahHadir->jam_pulang
                            ? $sudahHadir->jam_pulang->format('H:i')
                            : null;
                    $telatMinutes = $sudahHadir && $sudahHadir->telat ? $sudahHadir->menit_telat : null;
                    $shiftNum = $sudahHadir ? $sudahHadir->shift_number : null;
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <x-ui.time-card type="masuk" :time="$masukTime" :isActive="(bool) $sudahHadir" :badge="$shiftNum ? 'Shift ' . $shiftNum : null"
                        :badgeColor="$shiftNum == 2 ? 'orange' : 'blue'" :statusText="$telatMinutes ? 'TELAT ' . $telatMinutes . 'm' : null" statusColor="rose" />

                    <x-ui.time-card type="pulang" :time="$pulangTime" :isActive="(bool) $sudahPulang" />
                </div>
            @endif

            {{-- Special Day Info --}}
            @if (isset($hariKhususInfo) && $hariKhususInfo)
                @php
                    $specialDayDesc = 'Hari khusus - tetap masuk kerja seperti biasa';
                    if ($hariKhususInfo->jam_masuk && $hariKhususInfo->jam_keluar) {
                        $specialDayDesc .=
                            ' (' .
                            \Carbon\Carbon::parse($hariKhususInfo->jam_masuk)->format('H:i') .
                            ' - ' .
                            \Carbon\Carbon::parse($hariKhususInfo->jam_keluar)->format('H:i') .
                            ')';
                    }
                @endphp
                <x-ui.alert-card type="info" iconName="calendar" :title="$hariKhususInfo->nama" :description="$specialDayDesc"
                    class="mb-6" />
            @endif

            <div class="flex flex-col gap-4">

                {{-- Working Hours Info --}}
                @if (!$liburOrNot)
                    @php
                        $authUser = auth()->user();
                        $isShift = $authUser->is_shift && $authUser->shift_partner_id;
                        if ($isShift) {
                            $jamMasuk1 = $authUser->shift1_jam_masuk
                                ? \Carbon\Carbon::parse($authUser->shift1_jam_masuk)->format('H:i')
                                : '08:00';
                            $jamKeluar1 = $authUser->shift1_jam_keluar
                                ? \Carbon\Carbon::parse($authUser->shift1_jam_keluar)->format('H:i')
                                : '14:00';
                            $jamMasuk2 = $authUser->shift2_jam_masuk
                                ? \Carbon\Carbon::parse($authUser->shift2_jam_masuk)->format('H:i')
                                : '14:00';
                            $jamKeluar2 = $authUser->shift2_jam_keluar
                                ? \Carbon\Carbon::parse($authUser->shift2_jam_keluar)->format('H:i')
                                : '20:00';
                            $partnerName = $authUser->shiftPartner ? $authUser->shiftPartner->name : 'Tidak ada';
                        } else {
                            $jamMasukUser = $authUser->jam_masuk
                                ? \Carbon\Carbon::parse($authUser->jam_masuk)->format('H:i')
                                : '09:00';
                            $jamKeluarUser = $authUser->jam_keluar
                                ? \Carbon\Carbon::parse($authUser->jam_keluar)->format('H:i')
                                : '20:00';
                        }
                        $currentShift = $sudahHadir ? $sudahHadir->shift_number : null;
                    @endphp
                    <x-ui.info-box type="info">
                        <x-slot:icon>
                            <x-icons.information-circle class="h-5 w-5" />
                        </x-slot:icon>
                        @if ($isShift)
                            <div class="flex items-center gap-2 flex-wrap mb-1">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-100 text-blue-800 shadow-sm">
                                    <x-icons.calendar class="w-3 h-3 mr-1" /> SHIFT
                                </span>
                            </div>
                            <p class="text-sm font-medium">
                                Shift 1: {{ $jamMasuk1 }} - {{ $jamKeluar1 }} |
                                Shift 2: {{ $jamMasuk2 }} - {{ $jamKeluar2 }} |
                                Partner: {{ $partnerName }}
                            </p>
                            @if ($currentShift)
                                <div class="mt-3 pt-3 border-t border-primary/20 flex items-center gap-2">
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold shadow-sm {{ (int) $currentShift === 1 ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white' : 'bg-gradient-to-r from-orange-500 to-orange-600 text-white' }}">
                                        <x-icons.user class="w-4 h-4 mr-1" /> Anda Shift {{ $currentShift }}
                                    </span>
                                    @php
                                        $shiftJamKeluar =
                                            (int) $currentShift === 1
                                                ? \Carbon\Carbon::parse($authUser->shift1_jam_keluar)->format('H:i')
                                                : \Carbon\Carbon::parse($authUser->shift2_jam_keluar)->format('H:i');
                                    @endphp
                                    <span class="text-sm text-gray-600">Bisa pulang setelah
                                        <strong>{{ $shiftJamKeluar }} WIB</strong></span>
                                </div>
                            @endif
                        @else
                            <p class="text-sm font-medium flex flex-wrap items-center gap-x-2">
                                <span class="inline-flex items-center gap-1">
                                    <x-icons.clock class="w-4 h-4" /> Jam masuk: <strong>{{ $jamMasukUser }}
                                        WIB</strong>
                                </span>
                                <span class="mx-1">|</span>
                                <span>Jam pulang: <strong>{{ $jamKeluarUser }} WIB</strong></span>
                                <span class="mx-1">|</span>
                                <span class="inline-flex items-center gap-1">
                                    <x-icons.map-pin class="w-4 h-4" /> Radius: <strong>20 meter</strong>
                                </span>
                            </p>
                        @endif
                    </x-ui.info-box>
                @endif

                {{-- Total Working Hours Today --}}
                @if ($sudahHadir && !$sudahIzin && !$liburOrNot)
                    <x-ui.stat-card :value="$totalJamKerjaText" label="Total Jam Kerja Hari Ini" color="blue" iconName="clock"
                        variant="gradient" :delay="1" valueId="working-hours" />
                @endif

                {{-- Location Status & Absen Buttons (not shown on holiday) --}}
                @if (!$liburOrNot && !$isInactive && !$sudahIzin)
                    {{-- Location Status --}}
                    <div id="location-status"
                        class="p-4 rounded-2xl bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="animate-spin h-5 w-5 border-2 border-primary border-t-transparent rounded-full">
                            </div>
                            <span class="text-gray-600 font-medium">Mengambil lokasi...</span>
                        </div>
                    </div>

                    @php
                        $user = auth()->user();
                        if ($user->is_shift && $sudahHadir && $sudahHadir->shift_number) {
                            $jamPulangText =
                                (int) $sudahHadir->shift_number === 1
                                    ? \Carbon\Carbon::parse($user->shift1_jam_keluar)->format('H:i')
                                    : \Carbon\Carbon::parse($user->shift2_jam_keluar)->format('H:i');
                        } else {
                            $jamPulangText = $user->jam_keluar
                                ? \Carbon\Carbon::parse($user->jam_keluar)->format('H:i')
                                : '20:00';
                        }

                        // Button labels
                        $hadirLabel = $liburOrNot
                            ? 'Hari Libur'
                            : ($sudahHadir
                                ? 'Sudah Hadir'
                                : ($sudahIzin
                                    ? 'Sedang Izin'
                                    : 'Absen Hadir'));
                        $izinLabel = $liburOrNot
                            ? 'Hari Libur'
                            : ($sudahIzin && $sudahHadir
                                ? 'Sudah Izin Pulang'
                                : ($sudahIzin
                                    ? 'Sedang Izin'
                                    : ($sudahPulang
                                        ? 'Sudah Pulang'
                                        : ($sudahHadir
                                            ? 'Izin Pulang Awal'
                                            : 'Izin Tidak Masuk'))));
                        $pulangLabel = $liburOrNot
                            ? 'Hari Libur'
                            : ($sudahPulang
                                ? 'Sudah Pulang'
                                : ($sudahIzin
                                    ? 'Sudah Izin Pulang'
                                    : (!$sudahHadir
                                        ? 'Hadir Dulu'
                                        : "Absen Pulang (≥{$jamPulangText})")));
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-ui.action-button variant="hadir" size="xl" iconName="check"
                            onclick="openCameraModal('hadir')" :disabled="$sudahHadir || $sudahIzin || $liburOrNot || ($isInactive ?? false)" class="group">
                            {{ $hadirLabel }}
                        </x-ui.action-button>

                        <x-ui.action-button :variant="$sudahHadir ? 'lembur' : 'izin'" size="xl" :iconName="$sudahHadir ? 'clock' : 'exclamation'"
                            onclick="openCameraModal('izin')" :disabled="($sudahIzin && !$sudahHadir) ||
                                $sudahPulang ||
                                $liburOrNot ||
                                ($isInactive ?? false)" class="group">
                            {{ $izinLabel }}
                        </x-ui.action-button>

                        <x-ui.action-button variant="pulang" size="xl" iconName="logout"
                            onclick="openCameraModal('pulang')" :disabled="$sudahPulang || !$sudahHadir || $sudahIzin || $liburOrNot" class="group">
                            {{ $pulangLabel }}
                        </x-ui.action-button>
                    </div>
                @endif
            </div>

        </x-ui.section-card>
    </div>

    {{-- Camera Modal --}}
    <x-absensi.camera-modal :storeRoute="route('absen.store')" />

    {{-- Lembur Confirmation Modal --}}
    <div id="lembur-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] p-4 hidden">
        <div class="flex items-center justify-center min-h-full">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md transform transition-all animate-slide-up">
                <div class="p-6">
                    <div class="flex items-center justify-center mb-4">
                        <div class="p-4 bg-gradient-to-br from-orange-100 to-amber-100 rounded-2xl shadow-lg">
                            <x-icons.clock class="h-12 w-12 text-orange-500" />
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Konfirmasi Lembur</h3>
                    <p class="text-gray-600 text-center mb-4">
                        Anda pulang <span id="lembur-menit" class="font-bold text-orange-600">0</span> menit setelah
                        jam
                        kerja berakhir.
                    </p>
                    <p class="text-gray-600 text-center mb-6">
                        Apakah ini termasuk <span class="font-bold text-orange-600">lembur</span>?
                    </p>

                    <div id="lembur-keterangan-wrapper" class="mb-6 hidden">
                        <label class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-1">
                            <x-icons.chat-bubble class="w-4 h-4 text-orange-500" /> Keterangan Lembur
                        </label>
                        <x-ui.form-input type="textarea" name="lembur-keterangan-input" id="lembur-keterangan-input"
                            rows="2" placeholder="Masukkan keterangan lembur (opsional)..." class="!mb-0" />
                    </div>

                    <div class="flex gap-3">
                        <x-ui.action-button type="button" onclick="confirmLembur(false)" variant="secondary"
                            class="flex-1">
                            Bukan Lembur
                        </x-ui.action-button>
                        <x-ui.action-button type="button" onclick="showLemburKeterangan()" variant="warning"
                            class="flex-1">
                            Ya, Lembur
                        </x-ui.action-button>
                    </div>

                    <x-ui.action-button type="button" id="btn-submit-lembur" onclick="confirmLembur(true)"
                        variant="success" class="hidden w-full mt-4">
                        Kirim dengan Lembur
                    </x-ui.action-button>
                </div>
            </div>
        </div>
    </div>

    {{-- Lembur Holiday Modal --}}
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

                    <div id="lembur-libur-keterangan-wrapper" class="mb-6">
                        <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <x-icons.pencil class="w-4 h-4 text-orange-500" /> Keterangan Lembur <span
                                class="text-red-500">*</span>
                        </label>
                        <x-ui.form-input type="textarea" name="lembur-libur-keterangan-input"
                            id="lembur-libur-keterangan-input" rows="3"
                            placeholder="Jelaskan alasan dan detail pekerjaan lembur di hari libur..."
                            class="!mb-0" />
                    </div>

                    <div class="flex gap-3">
                        <x-ui.action-button type="button" onclick="closeLemburLiburModal()" variant="secondary"
                            iconName="x-mark" class="flex-1">
                            Batal
                        </x-ui.action-button>
                        <x-ui.action-button type="button" onclick="confirmLemburLibur()" variant="warning"
                            iconName="check" class="flex-1">
                            Ya, Lembur
                        </x-ui.action-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Absensi Scripts --}}
    @php
        $user = auth()->user();
        if ($user->is_shift && $sudahHadir && $sudahHadir->shift_number) {
            $jamPulangSetting =
                (int) $sudahHadir->shift_number === 1
                    ? \Carbon\Carbon::parse($user->shift1_jam_keluar)
                    : \Carbon\Carbon::parse($user->shift2_jam_keluar);
        } else {
            $jamPulangSetting = $user->jam_keluar
                ? \Carbon\Carbon::parse($user->jam_keluar)
                : \Carbon\Carbon::createFromTime(20, 0);
        }
    @endphp

    <x-absensi.absen-script :officeLatitude="$officeLatitude" :officeLongitude="$officeLongitude" :allowedRadius="$allowedRadius" :sudahHadir="$sudahHadir"
        :sudahIzin="$sudahIzin" :sudahPulang="$sudahPulang" :liburOrNot="$liburOrNot" :jamPulangHour="$jamPulangSetting->hour" :jamPulangMinute="$jamPulangSetting->minute" />
</x-app-layout>
