{{-- Lembur History Table Component --}}
@props([
    'riwayat' => collect(),
])

@if ($riwayat->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Tanggal</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Waktu</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Durasi</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Keterangan</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat as $lembur)
                    <x-lembur.history-row :lembur="$lembur" />
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($riwayat->hasPages())
        <div class="mt-6 pt-4 border-t border-gray-200">
            {{ $riwayat->links() }}
        </div>
    @endif
@else
    <x-ui.empty-state message="Belum ada riwayat lembur" icon="clock" />
@endif
