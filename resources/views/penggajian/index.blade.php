<x-app-layout>
    <x-slot name="header">Penggajian</x-slot>
    <x-slot name="subtle">Kelola penggajian pegawai klinik</x-slot>

    <div class="space-y-6">
        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-xl p-6 animate-slide-up">
            <div class="flex flex-col lg:flex-row gap-4 justify-between items-center">
                <!-- Period Filter -->
                <form method="GET" action="{{ route('penggajian.index') }}" class="flex gap-3 items-center">
                    <label class="text-sm font-medium text-gray-700 hidden md:block">Periode:</label>
                    <input type="month" name="periode" value="{{ $periode }}"
                        class="px-4 py-2 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                    <button type="submit"
                        class="px-4 py-2 bg-primary hover:bg-primaryDark text-white font-semibold rounded-xl transition-all">
                        Filter
                    </button>
                </form>

                <!-- Add New Payroll -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" type="button"
                        class="px-6 py-3 bg-gradient-to-r from-primary to-primaryDark text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Penggajian
                    </button>

                    <!-- Dropdown Employee Selection -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-2xl border border-gray-100 z-50 overflow-hidden">
                        <div class="p-4 border-b border-gray-100">
                            <p class="font-semibold text-gray-800">Pilih Pegawai</p>
                            <p class="text-sm text-gray-500">Periode:
                                {{ \Carbon\Carbon::parse($periode)->format('F Y') }}</p>
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            @forelse($employees as $employee)
                                @php
                                    $exists = \App\Models\Penggajian::where('user_id', $employee->id)->where('periode', $periode)->exists();
                                @endphp
                                <a href="{{ route('penggajian.create', ['user_id' => $employee->id, 'periode' => $periode]) }}"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors {{ $exists ? 'opacity-50 pointer-events-none' : '' }}">
                                    <img src="{{ $employee->avatar ? asset('storage/' . $employee->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($employee->name) . '&color=7F9CF5&background=EBF4FF&size=40' }}"
                                        alt="{{ $employee->name }}" class="w-10 h-10 rounded-full">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">{{ $employee->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $employee->jabatan }}</p>
                                    </div>
                                    @if($exists)
                                        <span class="px-2 py-1 bg-green-100 text-green-600 text-xs font-medium rounded">Sudah
                                            ada</span>
                                    @endif
                                </a>
                            @empty
                                <div class="p-4 text-center text-gray-500">
                                    Tidak ada pegawai
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payroll List -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slide-up-delay-1">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-primary to-primaryDark text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Pegawai</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Jabatan</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold">Gaji Pokok</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold">Potongan</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold">Insentif</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold">Total Gaji</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($penggajian as $gaji)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $gaji->user->avatar ? asset('storage/' . $gaji->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($gaji->user->name) . '&color=7F9CF5&background=EBF4FF&size=40' }}"
                                            alt="{{ $gaji->user->name }}" class="w-10 h-10 rounded-full">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $gaji->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $gaji->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                            {{ $gaji->user->jabatan === 'Dokter' ? 'bg-purple-100 text-purple-700' : '' }}
                                            {{ $gaji->user->jabatan === 'Paramedis' ? 'bg-blue-100 text-blue-700' : '' }}
                                            {{ $gaji->user->jabatan === 'Tech' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $gaji->user->jabatan === 'FO' ? 'bg-orange-100 text-orange-700' : '' }}">
                                        {{ $gaji->user->jabatan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-medium text-gray-900">Rp
                                        {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-medium text-red-600">- Rp
                                        {{ number_format($gaji->total_potongan_telat, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-medium text-green-600">+ Rp
                                        {{ number_format($gaji->total_insentif, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-bold text-gray-900 text-lg">Rp
                                        {{ number_format($gaji->total_gaji, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($gaji->status === 'final')
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">Final</span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-full">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('penggajian.print', $gaji) }}" target="_blank"
                                            class="p-2 bg-green-100 hover:bg-green-200 text-green-600 rounded-lg transition-colors"
                                            title="Cetak">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('penggajian.edit', $gaji) }}"
                                            class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-colors"
                                            title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('penggajian.destroy', $gaji) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus penggajian ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors"
                                                title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-500 text-lg font-medium">Belum ada data penggajian</p>
                                        <p class="text-gray-400 text-sm mt-1">Klik tombol "Buat Penggajian" untuk
                                            menambahkan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($penggajian->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $penggajian->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
