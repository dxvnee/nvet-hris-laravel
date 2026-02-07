<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>
    <x-slot name="subtle">Selamat datang kembali, {{ $user->name }}!</x-slot>

    <div class="space-y-6">
        {{-- Welcome Section Pegawai --}}
        <x-ui.page-hero title="Halo, {{ $user->name }}! 👋" variant="pegawai" :user="$user" :showAvatar="true"
            :showClock="true">
            <x-slot name="badges">
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                    <x-icons.briefcase class="w-4 h-4" />
                    {{ $user->jabatan }}
                </span>
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                    <x-icons.calendar class="w-4 h-4" />
                    {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </span>
            </x-slot>
        </x-ui.page-hero>

        {{-- Status Absensi Hari Ini --}}
        <x-ui.section-card class="animate-slide-up-delay-1">
            <x-ui.section-header title="Status Absensi Hari Ini" :subtitle="now()->locale('id')->isoFormat('dddd, D MMMM Y')">
                <x-slot name="iconSlot">
                    <x-icons.clock class="h-6 w-6 text-white" />
                </x-slot>
            </x-ui.section-header>

            {{-- Status Absensi Component --}}
            <x-dashboard.absensi-status :absensi="$absensiToday ?? null" />
        </x-ui.section-card>

        {{-- Stats Ringkasan Bulan Ini --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 px-1">Ringkasan Bulan Ini</h3>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5">
                {{-- Total Hadir --}}
                <x-ui.stat-card title="Total Hadir" :value="$totalHadir" gradient="from-emerald-500 to-green-600"
                    hoverBorder="hover:border-green-200"
                    valueColor="bg-gradient-to-r from-emerald-500 to-green-600 bg-clip-text text-transparent"
                    delay="2">
                    <x-slot name="iconSlot">
                        <x-icons.check-circle class="h-5 w-5 lg:h-6 lg:w-6 text-white" />
                    </x-slot>
                    <x-slot name="footer">
                        <p class="text-xs text-gray-500">Bulan ini</p>
                    </x-slot>
                </x-ui.stat-card>

                {{-- Total Tidak Hadir --}}
                <x-ui.stat-card title="Tidak Hadir" :value="$totalTidakHadir" gradient="from-rose-500 to-red-600"
                    hoverBorder="hover:border-rose-200"
                    valueColor="bg-gradient-to-r from-rose-500 to-red-600 bg-clip-text text-transparent" delay="3">
                    <x-slot name="iconSlot">
                        <x-icons.x-circle class="h-5 w-5 lg:h-6 lg:w-6 text-white" />
                    </x-slot>
                    <x-slot name="footer">
                        <p class="text-xs text-gray-500">Bulan ini</p>
                    </x-slot>
                </x-ui.stat-card>

                {{-- Total Menit Telat --}}
                <x-ui.stat-card title="Menit Telat" :value="$totalMenitTelat" gradient="from-amber-500 to-orange-500"
                    hoverBorder="hover:border-amber-200"
                    valueColor="bg-gradient-to-r from-amber-500 to-orange-500 bg-clip-text text-transparent"
                    delay="4">
                    <x-slot name="iconSlot">
                        <x-icons.clock class="h-5 w-5 lg:h-6 lg:w-6 text-white" />
                    </x-slot>
                    <x-slot name="footer">
                        @if ($totalMenitTelat > 60)
                            <x-ui.status-badge type="danger">⚠️ Cukup tinggi</x-ui.status-badge>
                        @elseif($totalMenitTelat > 30)
                            <x-ui.status-badge type="warning">⚡ Perhatian</x-ui.status-badge>
                        @else
                            <x-ui.status-badge type="success">✓ Baik</x-ui.status-badge>
                        @endif
                    </x-slot>
                </x-ui.stat-card>

                {{-- Lupa Pulang --}}
                <x-ui.stat-card title="Lupa Pulang" :value="$totalLupaPulang" gradient="from-rose-500 to-pink-600"
                    hoverBorder="hover:border-rose-200" :valueColor="$totalLupaPulang > 3 ? 'text-rose-500' : 'text-gray-800'" delay="4">
                    <x-slot name="iconSlot">
                        <x-icons.arrow-right-on-rectangle class="h-5 w-5 lg:h-6 lg:w-6 text-white" />
                    </x-slot>
                    <x-slot name="footer">
                        @if ($totalLupaPulang > 3)
                            <x-ui.status-badge type="danger">⚠️ Potong Gaji</x-ui.status-badge>
                        @elseif($totalLupaPulang > 0)
                            <x-ui.status-badge type="warning">⚡ Perhatian</x-ui.status-badge>
                        @else
                            <x-ui.status-badge type="success">✓ Baik</x-ui.status-badge>
                        @endif
                    </x-slot>
                </x-ui.stat-card>
            </div>
        </div>

        {{-- Riwayat Absensi 7 Hari --}}
        <x-ui.section-card class="animate-slide-up-delay-1">
            <x-ui.section-header title="Riwayat Absensi" subtitle="7 hari terakhir" :linkHref="route('absen.riwayat')">
                <x-slot name="iconSlot">
                    <x-icons.calendar class="h-5 w-5 text-white" />
                </x-slot>
            </x-ui.section-header>

            <div class="space-y-3">
                @forelse($riwayatAbsensi as $absen)
                    @php
                        $historyStatus = $absen->izin
                            ? 'izin'
                            : ($absen->libur
                                ? 'libur'
                                : ($absen->telat
                                    ? 'telat'
                                    : 'hadir'));
                    @endphp
                    <x-ui.history-card :date="\Carbon\Carbon::parse($absen->tanggal)->locale('id')->isoFormat('dddd, D MMM Y')" :status="$historyStatus" :primaryTime="$absen->izin
                        ? null
                        : ($absen->libur
                            ? null
                            : ($absen->jam_masuk
                                ? $absen->jam_masuk->format('H:i')
                                : '-'))" :secondaryTime="$absen->jam_pulang ? $absen->jam_pulang->format('H:i') : null"
                        :description="$absen->izin
                            ? ($absen->izin_keterangan ?:
                                'Tanpa keterangan')
                            : ($absen->libur
                                ? 'Libur'
                                : null)" />
                @empty
                    <x-ui.empty-state message="Belum ada data absensi" description="Belum ada riwayat absensi"
                        icon="calendar" />
                @endforelse
            </div>
        </x-ui.section-card>

        {{-- Quick Actions Pegawai --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 px-1">Aksi Cepat</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <x-ui.quick-action
                    href="{{ route('absen.create', ['tanggal' => now()->toDateString(), 'user' => $user->id]) }}"
                    title="Absen Sekarang" subtitle="Catat kehadiran">
                    <x-slot name="iconSlot">
                        <x-icons.check-circle class="h-6 w-6 text-white" />
                    </x-slot>
                </x-ui.quick-action>

                <x-ui.quick-action href="{{ route('absen.riwayat') }}" title="Riwayat Absensi"
                    subtitle="Lihat semua absensi" gradient="from-blue-500 to-indigo-600"
                    hoverBorder="hover:border-blue-300" hoverText="group-hover:text-blue-600">
                    <x-slot name="iconSlot">
                        <x-icons.calendar class="h-6 w-6 text-white" />
                    </x-slot>
                </x-ui.quick-action>

                <x-ui.quick-action href="{{ route('lembur.index') }}" title="Lembur" subtitle="Lihat data lembur"
                    gradient="from-amber-500 to-orange-500" hoverBorder="hover:border-amber-300"
                    hoverText="group-hover:text-amber-600">
                    <x-slot name="iconSlot">
                        <x-icons.clock class="h-6 w-6 text-white" />
                    </x-slot>
                </x-ui.quick-action>

                <x-ui.quick-action href="{{ route('profile.show') }}" title="Profil Saya" subtitle="Edit profil"
                    gradient="from-purple-500 to-violet-600" hoverBorder="hover:border-purple-300"
                    hoverText="group-hover:text-purple-600">
                    <x-slot name="iconSlot">
                        <x-icons.user class="h-6 w-6 text-white" />
                    </x-slot>
                </x-ui.quick-action>
            </div>
        </div>
    </div>
</x-app-layout>
