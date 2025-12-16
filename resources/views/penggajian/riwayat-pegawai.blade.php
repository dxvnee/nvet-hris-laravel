<x-app-layout>
    <x-slot name="header">Riwayat Penggajian</x-slot>
    <x-slot name="subtle">Riwayat penggajian Anda per bulan</x-slot>

    <div class="space-y-6">
        <!-- Payroll History -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slide-up">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-primary to-primaryDark text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Periode</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Gaji Pokok</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Potongan Telat</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Insentif</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Total Gaji</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($penggajian as $gaji)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($gaji->periode)->format('F Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Dibuat: {{ $gaji->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900">Rp
                                        {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-red-600">- Rp
                                        {{ number_format($gaji->total_potongan_telat, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-green-600">+ Rp
                                        {{ number_format($gaji->total_insentif, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
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
                                            title="Cetak Slip Gaji">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-500 text-lg font-medium">Belum ada data penggajian</p>
                                        <p class="text-gray-400 text-sm mt-1">Data penggajian Anda akan muncul di sini</p>
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