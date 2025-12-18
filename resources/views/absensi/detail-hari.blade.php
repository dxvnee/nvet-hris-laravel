<x-app-layout>
    <x-slot name="header">Detail Absensi - {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</x-slot>
    <x-slot name="subtle">Rincian absensi pegawai pada tanggal tersebut</x-slot>

    <div class="space-y-6">
        {{-- Back Button --}}
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors animate-slide-up">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali
        </a>
        {{-- Absensi List --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 animate-slide-up-delay-1">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 bg-gradient-to-br from-primary to-primaryDark rounded-xl shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Detail Absensi</h2>
            </div>

            @if($absensiHari->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-center py-3 px-4 font-semibold text-gray-600">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name', 'sort_direction' => (request('sort_by') === 'name' && request('sort_direction') === 'asc') ? 'desc' : 'asc']) }}"
                                       class="flex items-center space-x-1 hover:text-primary transition-colors">
                                        <span>Pegawai</span>
                                        @if(request('sort_by') === 'name')
                                            @if(request('sort_direction') === 'asc')
                                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 010-1.414l-4-4a1 1 0 01-1.414 0l-4 4a1 1 0 111.414 1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        @else
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 01.707-1.707z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-600">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'jam_masuk', 'sort_direction' => (request('sort_by') === 'jam_masuk' && request('sort_direction') === 'asc') ? 'desc' : 'asc']) }}"
                                       class="flex items-center justify-center space-x-1 hover:text-primary transition-colors">
                                        <span>Jam Masuk</span>
                                        @if(request('sort_by') === 'jam_masuk')
                                            @if(request('sort_direction') === 'asc')
                                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 010-1.414l-4-4a1 1 0 01-1.414 0l-4 4a1 1 0 111.414 1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        @else
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 01.707-1.707z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-600">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'jam_pulang', 'sort_direction' => (request('sort_by') === 'jam_pulang' && request('sort_direction') === 'asc') ? 'desc' : 'asc']) }}"
                                       class="flex items-center justify-center space-x-1 hover:text-primary transition-colors">
                                        <span>Jam Pulang</span>
                                        @if(request('sort_by') === 'jam_pulang')
                                            @if(request('sort_direction') === 'asc')
                                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 010-1.414l-4-4a1 1 0 01-1.414 0l-4 4a1 1 0 111.414 1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        @else
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 01.707-1.707z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-600">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'status', 'sort_direction' => (request('sort_by') === 'status' && request('sort_direction') === 'asc') ? 'desc' : 'asc']) }}"
                                       class="flex items-center justify-center space-x-1 hover:text-primary transition-colors">
                                        <span>Status</span>
                                        @if(request('sort_by') === 'status')
                                            @if(request('sort_direction') === 'asc')
                                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 010-1.414l-4-4a1 1 0 01-1.414 0l-4 4a1 1 0 111.414 1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        @else
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 01.707-1.707z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-600">Lokasi</th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-600">Keterangan</th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absensiHari as $absen)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $absen->user->avatar ? asset('storage/' . $absen->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($absen->user->name) . '&color=7F9CF5&background=EBF4FF&size=40' }}"
                                                alt="{{ $absen->user->name }}" class="w-10 h-10 rounded-full">
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $absen->user->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $absen->user->jabatan }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center py-3 px-4">
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
                                    <td class="text-center py-3 px-4">
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
                                    <td class="text-center py-3 px-4">
                                        @if($absen->izin)
                                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-700">Izin</span>
                                        @elseif($absen->jam_masuk)
                                            @if($absen->status === 'tepat_waktu')
                                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">Tepat Waktu</span>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-700">Terlambat</span>
                                            @endif
                                        @else
                                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700">Belum Absen</span>
                                        @endif
                                    </td>
                                    <td class="text-center py-3 px-4 text-gray-700">
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
                                    <td class="text-center py-3 px-4 text-gray-700">
                                        @if($absen->izin && $absen->izin_keterangan)
                                            {{ $absen->izin_keterangan }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="flex items-center justify-center py-3 px-4">
                                        <div class="flex items-center gap-2">
                                            @if($absen->exists)
                                                <a href="{{ route('absen.edit', $absen) }}"
                                                    class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-colors"
                                                    title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <svg class="h-12 w-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p>Belum ada data absensi</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
