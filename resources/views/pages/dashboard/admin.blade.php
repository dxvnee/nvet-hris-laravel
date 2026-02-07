<x-app-layout>
    <x-slot name="header">Dashboard Admin</x-slot>
    <x-slot name="subtle">Selamat datang kembali, {{ $user->name }}!</x-slot>

    <div class="space-y-6">
        {{-- Welcome Section Admin --}}
        <x-ui.page-hero title="NVet Clinic & Lab" variant="admin" :showClock="true" :showDate="true">
            <x-slot name="icon">
                <x-icons.building-office class="w-10 h-10 text-white" />
            </x-slot>
        </x-ui.page-hero>

        {{-- Stats Cards Admin --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 px-1">Ringkasan Hari Ini</h3>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-4">
                {{-- Total Pegawai --}}
                <x-ui.stat-card title="Total Pegawai" :value="$totalPegawai" delay="1">
                    <x-slot name="iconSlot">
                        <x-icons.users-group class="h-5 w-5 lg:h-6 lg:w-6 text-white" />
                    </x-slot>
                    <x-slot name="footer">
                        <div class="flex flex-wrap gap-1">
                            @foreach ($pegawaiByJabatan as $jabatan => $total)
                                @php
                                    $variant = match ($jabatan) {
                                        'Dokter' => 'purple',
                                        'Paramedis' => 'info',
                                        'Tech' => 'green',
                                        'FO' => 'orange',
                                        default => 'default',
                                    };
                                @endphp
                                <x-ui.status-badge :type="$variant">{{ $jabatan }}:
                                    {{ $total }}</x-ui.status-badge>
                            @endforeach
                        </div>
                    </x-slot>
                </x-ui.stat-card>

                {{-- Absensi Hari Ini --}}
                <x-ui.stat-card title="Hadir Hari Ini" :value="$absensiHariIni" gradient="from-emerald-500 to-green-600"
                    hoverBorder="hover:border-green-200"
                    valueColor="bg-gradient-to-r from-emerald-500 to-green-600 bg-clip-text text-transparent"
                    delay="2">
                    <x-slot name="iconSlot">
                        <x-icons.check-circle class="h-5 w-5 lg:h-6 lg:w-6 text-white" />
                    </x-slot>
                    <x-slot name="footer">
                        <div class="flex flex-wrap gap-2">
                            <x-ui.status-badge type="success">
                                <x-slot name="iconSlot">
                                    <x-icons.check-circle-solid class="w-3 h-3" />
                                </x-slot>
                                {{ $tepatWaktuHariIni }}
                            </x-ui.status-badge>
                            <x-ui.status-badge type="danger">
                                <x-slot name="iconSlot">
                                    <x-icons.x-circle-solid class="w-3 h-3" />
                                </x-slot>
                                {{ $telatHariIni }}
                            </x-ui.status-badge>
                        </div>
                    </x-slot>
                </x-ui.stat-card>

                {{-- Total Gaji Bulan Ini --}}
                <x-ui.stat-card title="Gaji Bulan Ini" :value="'Rp ' . number_format($totalGajiBulanIni, 0, ',', '.')" gradient="from-blue-500 to-indigo-600"
                    hoverBorder="hover:border-blue-200" valueColor="text-gray-800" valueClass="text-xl lg:text-3xl leading-tight" delay="3" :formatValue="false">
                    <x-slot name="iconSlot">
                        <x-icons.currency class="h-5 w-5 lg:h-6 lg:w-6 text-white" />
                    </x-slot>
                    <x-slot name="footer">
                        @if ($penggajianDraft > 0)
                            <x-ui.status-badge type="warning">
                                <x-slot name="iconSlot">
                                    <x-icons.exclamation-circle-solid class="w-3 h-3" />
                                </x-slot>
                                {{ $penggajianDraft }} Draft
                            </x-ui.status-badge>
                        @endif
                    </x-slot>
                </x-ui.stat-card>

                {{-- Belum Absen --}}
                <x-ui.stat-card title="Belum Absen" :value="count($belumAbsen)" gradient="from-amber-500 to-orange-500"
                    hoverBorder="hover:border-orange-200" :valueColor="count($belumAbsen) > 0 ? 'text-orange-500' : 'text-green-500'" delay="4" :pulse="count($belumAbsen) > 0">
                    <x-slot name="iconSlot">
                        <x-icons.exclamation-circle class="h-5 w-5 lg:h-6 lg:w-6 text-white" />
                    </x-slot>
                    <x-slot name="footer">
                        @if (count($belumAbsen) > 0)
                            <div class="flex -space-x-2">
                                @foreach ($belumAbsen->take(4) as $pegawai)
                                    <img src="{{ $pegawai->avatar ? asset('storage/' . $pegawai->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($pegawai->name) . '&size=32&background=f97316&color=ffffff' }}"
                                        class="w-8 h-8 rounded-full border-2 border-white shadow-sm hover:scale-110 transition-transform cursor-pointer"
                                        title="{{ $pegawai->name }}">
                                @endforeach
                                @if (count($belumAbsen) > 4)
                                    <span
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-100 to-orange-200 border-2 border-white flex items-center justify-center text-xs font-bold text-orange-600 shadow-sm">+{{ count($belumAbsen) - 4 }}</span>
                                @endif
                            </div>
                        @else
                            <p class="text-xs text-green-500 font-medium">✓ Semua sudah absen</p>
                        @endif
                    </x-slot>
                </x-ui.stat-card>


            </div>
        </div>

        {{-- Grafik & Detail Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            {{-- Grafik Absensi 7 Hari --}}
            <div
                class="lg:col-span-2 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100/80 animate-slide-up-delay-5">
                <x-ui.section-header title="Statistik Absensi" subtitle="7 hari terakhir">
                    <x-slot name="iconSlot">
                        <x-icons.chart-bar class="h-5 w-5 text-white" />
                    </x-slot>
                    <x-slot name="extra">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-gradient-to-r from-primary to-primaryDark rounded-full"></span>
                                <span class="text-xs text-gray-500">Tepat</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-gradient-to-r from-rose-500 to-red-500 rounded-full"></span>
                                <span class="text-xs text-gray-500">Telat</span>
                            </div>
                        </div>
                    </x-slot>
                </x-ui.section-header>

                <div class="grid grid-cols-7 gap-2 lg:gap-3 mt-1">
                    @foreach ($grafikAbsensi as $data)
                        <div class="text-center group">
                            <div
                                class="h-28 lg:h-36 bg-gradient-to-t from-gray-50 to-gray-100/50 rounded-xl relative overflow-hidden flex flex-col justify-end border border-gray-100 group-hover:border-primary/30 transition-all duration-300 group-hover:shadow-sm">
                                @php
                                    $maxHadir = max(array_column($grafikAbsensi, 'hadir')) ?: 1;
                                    $heightHadir = ($data['hadir'] / $maxHadir) * 100;
                                @endphp
                                <div class="bg-gradient-to-t from-primary to-primary/60 transition-all duration-500 relative rounded-t-lg group-hover:from-primaryDark"
                                    style="height: {{ $heightHadir }}%">
                                    @if ($data['telat'] > 0)
                                        <div class="bg-gradient-to-t from-rose-500 to-rose-400 w-full absolute top-0 rounded-t-lg"
                                            style="height: {{ ($data['telat'] / max($data['hadir'], 1)) * 100 }}%">
                                        </div>
                                    @endif
                                    <div
                                        class="absolute -top-7 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs px-2.5 py-1 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-lg">
                                        {{ $data['hadir'] }} hadir
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs font-semibold text-gray-700 mt-2">{{ $data['tanggal'] }}</p>
                            <p class="text-[10px] text-gray-400">{{ $data['hadir'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Top Telat --}}
            <div
                class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100/80 animate-slide-up-delay-5">
                <x-ui.section-header title="Top Keterlambatan" subtitle="Bulan ini" gradient="from-rose-500 to-red-600">
                    <x-slot name="iconSlot">
                        <x-icons.clock class="h-5 w-5 text-white" />
                    </x-slot>
                </x-ui.section-header>

                @if (count($topTelat) > 0)
                    <div class="space-y-3">
                        @foreach ($topTelat as $index => $telat)
                            <x-ui.rank-item :rank="$index + 1" :user="$telat->user" :subtitle="$telat->total_telat . 'x terlambat'" :value="$telat->total_menit . 'm'"
                                valueType="danger" />
                        @endforeach
                    </div>
                @else
                    <x-ui.empty-state message="Tidak ada keterlambatan bulan ini" description="Luar Biasa! 🎉"
                        icon="check" />
                @endif
            </div>
        </div>

        {{-- Aktivitas Terbaru --}}
        <x-ui.section-card class="animate-slide-up-delay-1">
            <x-ui.section-header title="Aktivitas Terbaru" subtitle="Absensi hari ini" :linkHref="route('absen.detailHari', $today)">
                <x-slot name="iconSlot">
                    <x-icons.clock class="h-5 w-5 text-white" />
                </x-slot>
            </x-ui.section-header>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @forelse($aktivitasTerbaru as $aktivitas)
                    @php
                        $activityStatus = $aktivitas->izin ? 'izin' : (!$aktivitas->telat ? 'hadir' : 'telat');
                        $activitySubtitle = $aktivitas->izin
                            ? '<span class="text-blue-600">Izin hari ini</span>'
                            : (!$aktivitas->telat
                                ? '<span class="text-emerald-600">Tepat waktu</span>'
                                : '<span class="text-rose-600">Terlambat ' . $aktivitas->menit_telat . ' menit</span>');
                    @endphp
                    <x-ui.activity-item :user="$aktivitas->user" :status="$activityStatus" :subtitle="$activitySubtitle" :time="$aktivitas->jam_masuk ? $aktivitas->jam_masuk->format('H:i') : '-'"
                        :timeLabel="\Carbon\Carbon::parse($aktivitas->tanggal)->format('d M')" />
                @empty
                    <div class="col-span-2">
                        <x-ui.empty-state message="Belum ada aktivitas absensi hari ini" icon="clock" />
                    </div>
                @endforelse
            </div>
        </x-ui.section-card>

        {{-- Quick Actions Admin --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 px-1">Aksi Cepat</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <x-ui.quick-action href="{{ route('users.index') }}" title="Kelola Pegawai"
                    subtitle="Tambah, edit, hapus">
                    <x-slot name="iconSlot">
                        <x-icons.users class="h-6 w-6 text-white" />
                    </x-slot>
                </x-ui.quick-action>

                <x-ui.quick-action href="{{ route('penggajian.index') }}" title="Penggajian"
                    subtitle="Kelola gaji pegawai" gradient="from-emerald-500 to-green-600"
                    hoverBorder="hover:border-emerald-300" hoverText="group-hover:text-emerald-600">
                    <x-slot name="iconSlot">
                        <x-icons.wallet class="h-6 w-6 text-white" />
                    </x-slot>
                </x-ui.quick-action>

                <x-ui.quick-action href="{{ route('absen.kalender') }}" title="Riwayat Absensi"
                    subtitle="Lihat semua absensi" gradient="from-blue-500 to-indigo-600"
                    hoverBorder="hover:border-blue-300" hoverText="group-hover:text-blue-600">
                    <x-slot name="iconSlot">
                        <x-icons.calendar class="h-6 w-6 text-white" />
                    </x-slot>
                </x-ui.quick-action>

                <x-ui.quick-action href="{{ route('users.create') }}" title="Tambah Pegawai"
                    subtitle="Daftarkan pegawai baru" gradient="from-purple-500 to-violet-600"
                    hoverBorder="hover:border-purple-300" hoverText="group-hover:text-purple-600">
                    <x-slot name="iconSlot">
                        <x-icons.user-plus class="h-6 w-6 text-white" />
                    </x-slot>
                </x-ui.quick-action>
            </div>
        </div>
    </div>
</x-app-layout>
