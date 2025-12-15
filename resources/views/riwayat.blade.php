<x-app-layout>
    <x-slot name="header">Absen</x-slot>
    <x-slot name="subtle">Halaman absensi karyawan</x-slot>

    <!-- Riwayat Absen -->
        <div class="bg-white rounded-2xl shadow-xl p-6 animate-slide-up-delay-1">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 bg-gradient-to-br from-primary to-primaryDark rounded-xl shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Riwayat Absensi</h2>
            </div>

            @if($riwayat->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Tanggal</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Tipe</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Jam</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $absen)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4 text-gray-700">{{ $absen->tanggal->format('d M Y') }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $absen->tipe === 'hadir' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $absen->tipe === 'izin' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $absen->tipe === 'pulang' ? 'bg-blue-100 text-blue-700' : '' }}">
                                            {{ ucfirst($absen->tipe) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-gray-700">{{ substr($absen->jam, 0, 5) }}</td>
                                    <td class="py-3 px-4">
                                        @if($absen->telat)
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Telat</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Tepat Waktu</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-gray-500 text-sm">{{ $absen->keterangan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <svg class="h-12 w-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <p>Belum ada riwayat absensi</p>
                </div>
            @endif

            @if($riwayat->hasPages())
                <div class="mt-6">
                    {{ $riwayat->links() }}
                </div>
            @endif
        </div>

</x-app-layout>
