<x-app-layout>
    <x-slot name="header">Persetujuan Lembur</x-slot>
    <x-slot name="subtle">Kelola pengajuan lembur pegawai</x-slot>

    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slide-up">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pegawai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Durasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Keterangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($lemburs as $lembur)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full"
                                                src="{{ $lembur->user->avatar ? asset('storage/' . $lembur->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($lembur->user->name) . '&color=7F9CF5&background=EBF4FF&size=40' }}"
                                                alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $lembur->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $lembur->user->jabatan }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>{{ $lembur->tanggal->format('d M Y') }}</div>
                                    <div class="text-xs">{{ $lembur->jam_mulai->format('H:i') }} -
                                        {{ $lembur->jam_selesai ? $lembur->jam_selesai->format('H:i') : '...' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ $lembur->durasi_menit > 0 ? floor($lembur->durasi_menit / 60) . 'j ' . ($lembur->durasi_menit % 60) . 'm' : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                    {{ $lembur->keterangan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($lembur->status === 'approved')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                                    @elseif($lembur->status === 'rejected')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if($lembur->status === 'pending' && $lembur->jam_selesai)
                                        <div class="flex justify-end gap-2">
                                            <form action="{{ route('lembur.approve', $lembur) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="text-green-600 hover:text-green-900 bg-green-50 px-3 py-1 rounded-lg transition-colors">Setujui</button>
                                            </form>
                                            <button onclick="openRejectModal('{{ route('lembur.reject', $lembur) }}')"
                                                class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded-lg transition-colors">Tolak</button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data lembur</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($lemburs->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $lemburs->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <h3 class="text-lg font-bold mb-4">Tolak Pengajuan Lembur</h3>
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                    <textarea name="alasan" rows="3" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')"
                        class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Tolak</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal(url) {
            document.getElementById('rejectForm').action = url;
            document.getElementById('rejectModal').classList.remove('hidden');
        }
    </script>
</x-app-layout>