@props(['gaji'])

<tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
    <td class="py-3 px-4">
        <div class="font-semibold text-gray-900">
            {{ \Carbon\Carbon::parse($gaji->periode)->format('F Y') }}
        </div>
        <div class="text-sm text-gray-500">
            Dibuat: {{ $gaji->created_at->format('d/m/Y') }}
        </div>
    </td>
    <td class="py-3 px-4">
        <x-ui.currency-display :amount="$gaji->gaji_pokok" />
    </td>
    <td class="py-3 px-4">
        <x-ui.currency-display :amount="$gaji->total_potongan_telat" type="negative" show-sign />
    </td>
    <td class="py-3 px-4">
        <x-ui.currency-display :amount="$gaji->total_insentif" type="positive" show-sign />
    </td>
    <td class="py-3 px-4">
        <x-ui.currency-display :amount="$gaji->total_gaji" size="lg" />
    </td>
    <td class="py-3 px-4">
        <x-ui.status-badge :status="$gaji->status" />
    </td>
    <td class="py-3 px-4">
        <x-ui.action-button type="link" :href="route('penggajian.print', $gaji)" variant="icon-success" target="_blank"
            title="Cetak Slip Gaji">
            <x-icons.printer class="w-5 h-5" />
        </x-ui.action-button>
    </td>
</tr>
