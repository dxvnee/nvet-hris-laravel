{{-- Dashboard Absensi Status - wrapper for ui/alert-card --}}
@props([
    'absensi' => null,
])

@if (isset($absensi) && ($absensi->jam_masuk != null || $absensi->izin != false || $absensi->libur != false))
    @if ($absensi->libur)
        {{-- Status Libur --}}
        <x-ui.alert-card type="info" title="Hari Libur 🎉" iconName="sun">
            <p class="text-gray-600">Hari ini adalah hari libur anda!</p>
            @if ($absensi->libur_keterangan)
                <p class="text-sm text-blue-600 mt-2 bg-blue-100 inline-block px-3 py-1 rounded-full">
                    {{ $absensi->libur_keterangan }}</p>
            @endif
        </x-ui.alert-card>
    @elseif($absensi->izin)
        {{-- Status Izin --}}
        <x-ui.alert-card type="warning" title="Izin Hari Ini 📝" iconName="document">
            @if ($absensi->izin_keterangan)
                <p class="text-gray-600">{{ $absensi->izin_keterangan }}</p>
            @else
                <p class="text-gray-500">Izin tanpa keterangan</p>
            @endif
        </x-ui.alert-card>
    @else
        {{-- Status Absen Normal --}}
        <x-ui.alert-card type="success" iconName="check">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Jam Masuk --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-emerald-100">
                    <div class="flex items-center gap-2 mb-1">
                        <x-icons.arrow-left-on-rectangle class="w-4 h-4 text-emerald-500" />
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Masuk</span>
                    </div>
                    <span
                        class="text-2xl font-bold text-gray-800">{{ $absensi->jam_masuk ? $absensi->jam_masuk->format('H:i') : '-' }}</span>
                    @if (!$absensi->telat)
                        <span
                            class="ml-2 text-xs px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full font-medium">✓
                            Tepat</span>
                    @else
                        <span
                            class="ml-2 text-xs px-2 py-0.5 bg-rose-100 text-rose-700 rounded-full font-medium">{{ $absensi->menit_telat }}m
                            telat</span>
                    @endif
                </div>
                {{-- Jam Pulang --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-emerald-100">
                    <div class="flex items-center gap-2 mb-1">
                        <x-icons.arrow-right-on-rectangle class="w-4 h-4 text-blue-500" />
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Keluar</span>
                    </div>
                    <span
                        class="text-2xl font-bold text-gray-800">{{ $absensi->jam_pulang ? $absensi->jam_pulang->format('H:i') : '—' }}</span>
                    @if ($absensi->jam_pulang)
                        <span class="ml-2 text-xs px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full font-medium">✓
                            Selesai</span>
                    @else
                        <span
                            class="ml-2 text-xs px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full font-medium animate-pulse">Belum
                            pulang</span>
                    @endif
                </div>
            </div>
        </x-ui.alert-card>
    @endif
@else
    {{-- Belum Absen --}}
    <x-ui.alert-card type="warning" variant="centered" title="Belum Absen Hari Ini"
        subtitle="Jangan lupa untuk melakukan absensi!" iconName="exclamation" actionHref="{{ route('absen.index') }}"
        actionText="Absen Sekarang" />
@endif
