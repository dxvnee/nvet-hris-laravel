<x-app-layout>
    <x-slot name="header">Absensi Per Pegawai</x-slot>
    <x-slot name="subtle">Lihat rincian absensi pegawai tertentu</x-slot>

    <div class="space-y-6">
        {{-- Filter Form --}}
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <form method="GET" action="{{ route('absen.user') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Pegawai</label>
                        <select name="user_id" id="user_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach($users as $pegawai)
                                <option value="{{ $pegawai->id }}" {{ $userId == $pegawai->id ? 'selected' : '' }}>
                                    {{ $pegawai->name }} - {{ $pegawai->jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                        <select name="bulan" id="bulan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                            @for($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create(null, $m)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select name="tahun" id="tahun"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                            @for($y = 2024; $y <= 2026; $y++)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="btn-primary px-6 py-2 rounded-lg hover:bg-primaryDark transition-colors">
                        Tampilkan Absensi
                    </button>
                    @if($userId)
                        <a href="{{ route('absen.user') }}"
                            class="btn-secondary px-6 py-2 rounded-lg hover:bg-primary hover:text-white transition-colors">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if($user)
            {{-- User Info --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <div class="flex items-center gap-4">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7F9CF5&background=EBF4FF&size=64' }}"
                        alt="Avatar" class="w-16 h-16 rounded-full border-2 border-primary">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $user->name }}</h3>
                        <p class="text-gray-600">{{ $user->jabatan }}</p>
                        <p class="text-sm text-gray-500">Email: {{ $user->email }}</p>
                    </div>
                </div>
            </div>

            {{-- Absensi Table --}}
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Riwayat Absensi - {{ \Carbon\Carbon::create($tahun, $bulan)->format('F Y') }}
                    </h3>
                    <p class="text-sm text-gray-600">Total: {{ $absensi->count() }} hari absen</p>
                </div>

                @if($absensi->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Masuk</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Pulang</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($absensi as $absen)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $absen->tanggal->format('d/m/Y') }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $absen->tanggal->format('l') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($absen->jam_masuk)
                                                <div class="text-sm text-gray-900">
                                                    {{ $absen->jam_masuk->format('H:i') }}
                                                </div>
                                                @if($absen->status === 'telat')
                                                    <div class="text-xs text-red-600">
                                                        Terlambat {{ $absen->menit_telat }} menit
                                                    </div>
                                                @endif
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($absen->jam_pulang)
                                                <div class="text-sm text-gray-900">
                                                    {{ $absen->jam_pulang->format('H:i') }}
                                                </div>
                                                @if($absen->menit_kerja)
                                                    <div class="text-xs text-green-600">
                                                        {{ floor($absen->menit_kerja / 60) }}j {{ $absen->menit_kerja % 60 }}m
                                                    </div>
                                                @endif
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($absen->izin)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    Izin
                                                </span>
                                            @elseif($absen->jam_masuk)
                                                @if($absen->status === 'tepat_waktu')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Tepat Waktu
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Terlambat
                                                    </span>
                                                @endif
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Belum Absen
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($absen->lat_masuk && $absen->lng_masuk)
                                                <div class="text-xs">
                                                    Masuk: {{ number_format($absen->lat_masuk, 6) }}, {{ number_format($absen->lng_masuk, 6) }}
                                                </div>
                                            @endif
                                            @if($absen->lat_pulang && $absen->lng_pulang)
                                                <div class="text-xs">
                                                    Pulang: {{ number_format($absen->lat_pulang, 6) }}, {{ number_format($absen->lng_pulang, 6) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($absen->izin && $absen->izin_keterangan)
                                                {{ $absen->izin_keterangan }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('absen.edit', $absen) }}"
                                                class="text-primary hover:text-primaryDark transition-colors">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-12 text-center">
                        <div class="text-gray-400 mb-4">
                            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data absensi</h3>
                        <p class="text-gray-500">Belum ada absensi untuk pegawai ini pada bulan yang dipilih.</p>
                    </div>
                @endif
            </div>
        @else
            {{-- No User Selected --}}
            <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                <div class="text-gray-400 mb-4">
                    <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Pilih Pegawai</h3>
                <p class="text-gray-500">Silakan pilih pegawai dari dropdown di atas untuk melihat riwayat absensinya.</p>
            </div>
        @endif
    </div>
</x-app-layout>
