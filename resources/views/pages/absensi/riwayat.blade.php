<x-app-layout>
    <x-slot name="header">Riwayat Absensi</x-slot>
    <x-slot name="subtle">Pantau dan kelola riwayat absensi karyawan</x-slot>

    <div class="space-y-6">
        {{-- Header Section --}}
        <x-ui.page-hero title="Riwayat Absensi">
            <x-slot:icon>
                <x-icons.clipboard-check class="w-10 h-10 text-white" />
            </x-slot:icon>
            <x-slot:subtitle>
                <x-icons.calendar class="w-4 h-4" />
                {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </x-slot:subtitle>
            <x-slot:actions>
                <div class="hidden md:flex flex-col items-center bg-white/10 backdrop-blur-sm rounded-2xl px-4 py-3">
                    <span class="text-xs text-white/70 uppercase tracking-wider">Total Data</span>
                    <span class="text-lg font-semibold">{{ $riwayat->total() }}</span>
                </div>
                <a href="{{ route('absen.riwayatKalender') }}"
                    class="group flex items-center gap-2 px-4 py-2.5 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-xl transition-all duration-300">
                    <x-icons.calendar class="w-5 h-5 group-hover:scale-110 transition-transform" />
                    <span class="font-medium">Tampilan Kalender</span>
                </a>
            </x-slot:actions>
        </x-ui.page-hero>

        {{-- Riwayat Absen --}}
        <x-ui.section-card class="border border-gray-100 animate-slide-up-delay-1">
            @if ($riwayat->count() > 0)
                {{-- Filter & Sort Controls --}}
                <div class="flex flex-col sm:flex-row gap-4 mb-6 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex items-center gap-2">
                        <x-icons.filter class="w-4 h-4 text-gray-500" />
                        <span class="text-sm font-medium text-gray-700">Urutkan:</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $sortOptions = [
                                'tanggal' => ['label' => 'Tanggal', 'icon' => 'calendar'],
                                'jam_masuk' => ['label' => 'Jam Masuk', 'icon' => 'clock'],
                                'menit_kerja' => ['label' => 'Total', 'icon' => 'clock'],
                            ];
                        @endphp
                        @foreach ($sortOptions as $sortKey => $sortInfo)
                            @php
                                $isActive = request('sort_by') === $sortKey;
                                $newDirection = $isActive && request('sort_direction') === 'asc' ? 'desc' : 'asc';
                            @endphp
                            <a href="{{ request()->fullUrlWithQuery(['sort_by' => $sortKey, 'sort_direction' => $newDirection]) }}"
                                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg transition-all
                                      {{ $isActive ? 'bg-primary text-white shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                                @if ($sortInfo['icon'] === 'calendar')
                                    <x-icons.calendar class="w-3 h-3" />
                                @else
                                    <x-icons.clock class="w-3 h-3" />
                                @endif
                                {{ $sortInfo['label'] }}
                                @if ($isActive)
                                    @if (request('sort_direction') === 'asc')
                                        <x-icons.chevron-up class="w-3 h-3" />
                                    @else
                                        <x-icons.chevron-down class="w-3 h-3" />
                                    @endif
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Riwayat Cards --}}
                <div class="space-y-4">
                    @foreach ($riwayat as $absen)
                        @php
                            $status = match (true) {
                                $absen->libur => 'libur',
                                $absen->tidak_hadir => 'tidak_hadir',
                                $absen->izin => 'izin',
                                $absen->telat => 'telat',
                                $absen->jam_masuk != null => 'hadir',
                                default => 'default',
                            };
                            $totalKerja = $absen->menit_kerja
                                ? floor($absen->menit_kerja / 60) . 'j ' . $absen->menit_kerja % 60 . 'm'
                                : null;
                        @endphp
                        <x-ui.history-card :date="$absen->tanggal->format('d M Y')" :dayName="$absen->tanggal->locale('id')->isoFormat('dddd')" :status="$status" :primaryTime="$absen->jam_masuk ? $absen->jam_masuk->format('H:i') : null"
                            :secondaryTime="$absen->jam_pulang ? $absen->jam_pulang->format('H:i') : null" :tertiaryValue="$totalKerja" tertiaryLabel="Total" :description="$absen->izin_keterangan">
                            <x-slot:badge>
                                @if ($absen->libur)
                                    <x-ui.status-badge type="libur">Libur</x-ui.status-badge>
                                @elseif($absen->tidak_hadir)
                                    <x-ui.status-badge type="tidak_hadir">Tidak Hadir</x-ui.status-badge>
                                @elseif($absen->izin)
                                    <x-ui.status-badge type="izin">Izin</x-ui.status-badge>
                                @elseif($absen->telat)
                                    <x-ui.status-badge type="telat">Telat
                                        {{ $absen->menit_telat }}m</x-ui.status-badge>
                                @elseif($absen->jam_masuk)
                                    <x-ui.status-badge type="hadir">Tepat Waktu</x-ui.status-badge>
                                @else
                                    <x-ui.status-badge type="default">-</x-ui.status-badge>
                                @endif
                            </x-slot:badge>
                        </x-ui.history-card>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($riwayat->hasPages())
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <x-ui.pagination :paginator="$riwayat" />
                    </div>
                @endif
            @else
                {{-- Enhanced Empty State --}}
                <div class="text-center py-16">
                    <div class="relative mb-8">
                        <div
                            class="w-24 h-24 mx-auto bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center shadow-lg">
                            <x-icons.clipboard-check class="w-12 h-12 text-gray-400" />
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-8 h-8 bg-primary rounded-full flex items-center justify-center shadow-lg">
                            <x-icons.plus class="w-4 h-4 text-white" />
                        </div>
                    </div>
                    <div class="max-w-md mx-auto">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Riwayat Absensi</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Riwayat absensi Anda akan muncul di sini setelah Anda mulai melakukan absensi masuk dan
                            pulang kerja.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <x-ui.action-button type="link" :href="route('dashboard')" variant="primary">
                                <x-icons.briefcase class="w-5 h-5" />
                                Lihat Dashboard
                            </x-ui.action-button>
                            <x-ui.action-button type="link" :href="route('absen.create')" variant="secondary">
                                <x-icons.arrow-left-on-rectangle class="w-5 h-5" />
                                Absen Sekarang
                            </x-ui.action-button>
                        </div>
                    </div>
                </div>
            @endif
        </x-ui.section-card>
    </div>
</x-app-layout>
