@props([
    'user',
    'totalMenitTelat' => 0,
    'potonganPerMenit' => 0,
    'totalLupaPulang' => 0,
    'totalTidakHadir' => 0,
    'potonganPerTidakHadir' => 0,
    'gajiPokok' => null,
    'animationDelay' => 1,
])

<x-penggajian.form-section title="Gaji Pokok & Potongan" subtitle="Informasi gaji dasar dan potongan keterlambatan"
    icon-color="blue" :animation-delay="$animationDelay">
    <x-slot:icon>
        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
            </path>
        </svg>
    </x-slot:icon>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-penggajian.currency-input label="Gaji Pokok" name="gaji_pokok" x-model="gajiPokok" :value="$gajiPokok ?? $user->gaji_pokok"
            required />
        <x-penggajian.currency-input label="Total Menit Terlambat" name="total_menit_telat" x-model="totalMenitTelat"
            :value="$totalMenitTelat" prefix="" suffix="menit" :hint="'Diambil dari data absensi: ' . $totalMenitTelat . ' menit'" min="0" required />
        <x-penggajian.currency-input label="Potongan Per Menit" name="potongan_per_menit" x-model="potonganPerMenit"
            :value="$potonganPerMenit" :hint="'Otomatis: Rp ' .
                number_format($potonganPerMenit, 0, ',', '.') .
                '/menit (' .
                $user->gaji_pokok .
                ' ÷ ' .
                $user->jam_kerja .
                ' jam × 26 hari ÷ 60 menit, dibulatkan)'" min="0" step="1" required />
        <x-penggajian.deduction-display label="Total Potongan Keterlambatan" variant="red"
            x-text="formatNumber(totalMenitTelat * potonganPerMenit)" />

        <!-- Lupa Pulang -->
        <x-penggajian.form-display-field label="Lupa Absen Pulang" :value="$totalLupaPulang . ' kali'" :status="$totalLupaPulang > 3 ? 'danger' : 'success'" :status-text="$totalLupaPulang > 3 ? 'Potong 1 Jam Kerja' : 'Aman'"
            hint="Jika > 3x dalam sebulan, dipotong 1 jam kerja">
            @if ($totalLupaPulang > 3)
                <p class="text-red-600 text-sm mt-2 font-medium">
                    - Rp <span x-text="formatNumber(potonganPerMenit * 60)"></span> (1 jam kerja)
                </p>
            @endif
        </x-penggajian.form-display-field>

        <!-- Tidak Hadir -->
        <x-penggajian.form-display-field label="Tidak Hadir" :value="$totalTidakHadir . ' hari'" :status="$totalTidakHadir > 0 ? 'danger' : 'success'" :status-text="$totalTidakHadir > 0 ? 'Potong ' . $totalTidakHadir . ' Hari' : 'Tidak Ada'"
            :hint="'Potongan per hari tidak hadir: Rp ' . number_format($potonganPerTidakHadir, 0, ',', '.')">
            @if ($totalTidakHadir > 0)
                <p class="text-red-600 text-sm mt-2 font-medium">
                    - Rp <span x-text="formatNumber(totalTidakHadir * potonganPerTidakHadir)"></span>
                    ({{ $totalTidakHadir }} × Rp {{ number_format($potonganPerTidakHadir, 0, ',', '.') }})
                </p>
            @endif
        </x-penggajian.form-display-field>
    </div>
</x-penggajian.form-section>
