@props([
    'gaji',
])

<tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
    <td class="py-3 px-4">
        <div class="font-semibold text-gray-900">
            {{ \Carbon\Carbon::parse($gaji->periode)->format('F Y') }}
        </div>
        <div class="text-sm text-gray-500">
            Dibuat: {{ $gaji->created_at->format('d/m/Y') }}
        </div>
    </td>
    <td class="py-3 px-4 text-gray-700">
        Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}
    </td>
    <td class="py-3 px-4 text-gray-700">
        <span class="text-red-600">- Rp {{ number_format($gaji->total_potongan_telat, 0, ',', '.') }}</span>
    </td>
    <td class="py-3 px-4 text-gray-700">
        <span class="text-green-600">+ Rp {{ number_format($gaji->total_insentif, 0, ',', '.') }}</span>
    </td>
    <td class="py-3 px-4 text-gray-700">
        <span class="font-bold text-lg">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</span>
    </td>
    <td class="py-3 px-4">
        @if($gaji->status === 'final')
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Final</span>
        @else
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Draft</span>
        @endif
    </td>
    <td class="py-3 px-4">
        <div class="flex items-center gap-2">
            <a href="{{ route('penggajian.print', $gaji) }}" target="_blank"
                class="p-2 bg-green-100 hover:bg-green-200 text-green-600 rounded-lg transition-colors"
                title="Cetak Slip Gaji">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
            </a>
        </div>
    </td>
</tr>
