<x-app-layout>
    <x-slot name="header">Lembur</x-slot>
    <x-slot name="subtle">Kelola jam lembur Anda</x-slot>

    <div class="space-y-6">

        <!-- Active Lembur / Start Button -->
        <div class="bg-gradient-to-br bg-white rounded-2xl shadow-xl p-5 animate-slide-up">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 bg-gradient-to-br from-primary to-primaryDark text-white rounded-xl shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Lembur</h2>
            </div>

            @if($activeLembur)
                <div class="text-center space-y-6">
                    <!-- Timer Display -->
                    <div class="relative">
                        <div
                            class="inline-flex p-5 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white mb-4 shadow-2xl animate-pulse">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold text-gray-800">Sedang Lembur</h2>
                        <p class="text-gray-600">Dimulai pukul <span
                                class="font-semibold text-blue-600">{{ \Carbon\Carbon::parse($activeLembur->jam_mulai)->format('H:i') }}</span>
                        </p>

                        <!-- Real-time Timer -->
                        <div class="text-sm text-gray-500 mb-1">Lama Lembur Saat Ini</div>
                        <div id="current-timer" class="text-2xl font-bold text-blue-600 font-mono"
                            data-start="{{ $activeLembur->jam_mulai }}">
                            00:00:00
                        </div>
                    </div>

                    <div class="max-w-lg mx-auto bg-white/60 backdrop-blur-sm rounded-2xl p-5 shadow-xl border border-blue-200">
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-3 text-left flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Keterangan Lembur
                            </label>
                            <textarea id="keterangan-lembur" name="keterangan" rows="4" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all resize-none"
                                placeholder="Jelaskan detail pekerjaan yang dilakukan selama lembur..."></textarea>
                        </div>
                        <button type="button" onclick="openCameraModal('selesai')"
                            class="w-full mt-4 px-6 py-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-xl shadow-lg transition-all transform hover:scale-105 hover:shadow-xl flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path
                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                            </svg>
                            Selesai Lembur
                        </button>
                    </div>
                </div>
            @else
                <div class="text-center space-y-6 mb-2">
                    @if($canLembur)
                        <div class="relative">
                            <div
                                class="inline-flex p-5 rounded-full bg-gradient-to-r from-green-400 to-emerald-500 text-white mb-4 shadow-2xl">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <h2 class="text-3xl font-bold text-gray-800">Siap Mulai Lembur</h2>
                            <p class="text-gray-600">Anda dapat memulai lembur karena sudah melewati jam pulang</p>
                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Jam pulang: {{ $jamPulangToday->format('H:i') }}
                            </div>
                        </div>

                        <button type="button" onclick="openCameraModal('mulai')"
                            class="px-10 py-4 bg-gradient-to-r from-primary to-primaryDark hover:from-primaryDark hover:to-primaryExtraDark text-white font-bold rounded-2xl shadow-2xl transition-all transform hover:scale-105 hover:shadow-3xl flex items-center mx-auto text-lg">
                            <svg class="w-7 h-7 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Mulai Lembur
                        </button>
                    @else
                        <div
                            class="inline-flex p-5 rounded-full bg-gradient-to-r from-gray-300 to-gray-400 text-gray-500 mb-4 shadow-xl">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>

                        <div class="space-y-2">
                            <h2 class="text-2xl font-bold text-gray-600">Belum Waktunya Lembur</h2>
                            <p class="text-gray-500">Tombol lembur akan aktif setelah jam pulang</p>
                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Jam pulang: {{ $jamPulangToday->format('H:i') }}
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 animate-slide-up-delay-1">
            <!-- Total Lembur Bulan Ini -->
            <div
                class="bg-gradient-to-br from-emerald-50 to-green-100 rounded-xl p-5 shadow-xl border border-emerald-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-emerald-600">Total Lembur Bulan Ini</p>
                        <p class="text-2xl font-bold text-emerald-800">
                            {{ floor(collect($riwayatLembur)->where('status', 'approved')->where('tanggal', '>=', now()->startOfMonth())->sum('durasi_menit') / 60) }}j
                            {{ collect($riwayatLembur)->where('status', 'approved')->where('tanggal', '>=', now()->startOfMonth())->sum('durasi_menit') % 60 }}m
                        </p>
                    </div>
                    <div class="p-3 bg-emerald-500 rounded-full text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Lembur Menunggu Approval -->
            <div
                class="bg-gradient-to-br from-yellow-50 to-amber-100 rounded-xl p-5 shadow-xl border border-yellow-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-yellow-600">Menunggu Approval</p>
                        <p class="text-2xl font-bold text-yellow-800">
                            {{ collect($riwayatLembur)->where('status', 'pending')->count() }}
                        </p>
                    </div>
                    <div class="p-3 bg-yellow-500 rounded-full text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Lembur Disetujui -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl p-5 shadow-xl border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600">Lembur Disetujui</p>
                        <p class="text-2xl font-bold text-blue-800">
                            {{ collect($riwayatLembur)->where('status', 'approved')->count() }}
                        </p>
                    </div>
                    <div class="p-3 bg-blue-500 rounded-full text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- History -->
        <div class="bg-white rounded-2xl shadow-xl p-6 animate-slide-up-delay-2">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 bg-gradient-to-br from-primary to-primaryDark rounded-xl shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Riwayat Lembur</h2>
            </div>

            @if($riwayatLembur->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Tanggal</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Waktu</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Durasi</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayatLembur as $lembur)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4">
                                        <div class="font-semibold text-gray-900">
                                            {{ $lembur->tanggal->format('d/m/Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $lembur->tanggal->format('l') }}
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-gray-700">
                                        {{ $lembur->jam_mulai->format('H:i') }} -
                                        {{ $lembur->jam_selesai ? $lembur->jam_selesai->format('H:i') : 'Berlangsung' }}
                                    </td>
                                    <td class="py-3 px-4 text-gray-700">
                                        @if($lembur->durasi_menit > 0)
                                            {{ floor($lembur->durasi_menit / 60) }}j {{ $lembur->durasi_menit % 60 }}m
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        @if($lembur->status === 'approved')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                Disetujui
                                            </span>
                                        @elseif($lembur->status === 'rejected')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700"
                                                title="{{ $lembur->alasan_penolakan ?? 'Tidak ada alasan' }}">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>
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
                    <p>Belum ada riwayat lembur</p>
                </div>
            @endif

            @if($riwayatLembur->hasPages())
                <div class="mt-6">
                    <div class="flex justify-center">
                        <div class="flex space-x-1">
                            {{-- Previous Page Link --}}
                            @if ($riwayatLembur->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-l-xl">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $riwayatLembur->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-l-xl hover:bg-primaryUltraLight hover:border-primary transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($riwayatLembur->getUrlRange(1, $riwayatLembur->lastPage()) as $page => $url)
                                @if ($page == $riwayatLembur->currentPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-gradient-to-r from-primary to-primaryDark border border-primary leading-5 rounded-xl shadow-lg">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:bg-primaryUltraLight hover:border-primary hover:text-primary transition-all duration-200 rounded-xl">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($riwayatLembur->hasMorePages())
                                <a href="{{ $riwayatLembur->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-r-xl hover:bg-primaryUltraLight hover:border-primary transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            @else
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-r-xl">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Camera Modal for Lembur -->
    <div id="camera-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 overflow-hidden">
            <div class="p-4 bg-gradient-to-r from-primary to-primaryDark text-white flex justify-between items-center">
                <h3 id="camera-title" class="text-lg font-bold">Foto Lembur</h3>
                <button onclick="closeCameraModal()" class="p-1 hover:bg-white/20 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-4 space-y-4">
                <!-- Camera Preview -->
                <div class="relative bg-black rounded-xl overflow-hidden aspect-[4/3]">
                    <video id="camera-preview" autoplay playsinline class="w-full h-full object-cover"></video>
                    <div id="photo-result" class="hidden absolute inset-0">
                        <img id="captured-photo" class="w-full h-full object-cover" />
                    </div>
                </div>
                <canvas id="camera-canvas" class="hidden"></canvas>

                <!-- Camera Controls -->
                <div class="flex gap-3 justify-center">
                    <button id="btn-capture" onclick="capturePhoto()" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-xl shadow-lg transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Ambil Foto
                    </button>
                    <button id="btn-retake" onclick="retakePhoto()" class="hidden px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-xl shadow-lg transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Ulangi
                    </button>
                    <button id="btn-submit" onclick="submitWithPhoto()" class="hidden px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl shadow-lg transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span id="btn-submit-text">Kirim</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Form for Camera Submit -->
    <form id="camera-form" action="" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="_method" id="camera-method" value="POST">
        <input type="hidden" name="foto" id="camera-foto">
        <input type="hidden" name="keterangan" id="camera-keterangan">
    </form>

    <!-- JavaScript for Real-time Timer -->
    <script>
        let cameraStream = null;
        let capturedPhotoData = null;
        let currentTipe = null;

        @if($activeLembur)
            function updateTimer() {
                const timerElement = document.getElementById('current-timer');
                const startTime = new Date(timerElement.dataset.start);
                const now = new Date();
                const diff = now - startTime;

                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                timerElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            // Update timer every second
            setInterval(updateTimer, 1000);
            // Initial update
            updateTimer();
        @endif

        // Camera functions
        async function openCameraModal(tipe) {
            currentTipe = tipe;
            capturedPhotoData = null;

            // Set modal title based on type
            const titleEl = document.getElementById('camera-title');
            const submitTextEl = document.getElementById('btn-submit-text');

            if (tipe === 'mulai') {
                titleEl.textContent = 'Foto Mulai Lembur';
                submitTextEl.textContent = 'Mulai Lembur';
            } else if (tipe === 'selesai') {
                // Validate keterangan
                const keterangan = document.getElementById('keterangan-lembur').value;
                if (!keterangan.trim()) {
                    alert('Silakan masukkan keterangan lembur terlebih dahulu.');
                    return;
                }
                titleEl.textContent = 'Foto Selesai Lembur';
                submitTextEl.textContent = 'Selesai Lembur';
            }

            // Reset UI
            document.getElementById('camera-preview').classList.remove('hidden');
            document.getElementById('photo-result').classList.add('hidden');
            document.getElementById('btn-capture').classList.remove('hidden');
            document.getElementById('btn-retake').classList.add('hidden');
            document.getElementById('btn-submit').classList.add('hidden');

            // Show modal
            document.getElementById('camera-modal').classList.remove('hidden');

            // Start camera
            try {
                cameraStream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: 'user', width: { ideal: 640 }, height: { ideal: 480 } },
                    audio: false
                });
                document.getElementById('camera-preview').srcObject = cameraStream;
            } catch (error) {
                alert('Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.');
                closeCameraModal();
            }
        }

        function closeCameraModal() {
            // Stop camera stream
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
                cameraStream = null;
            }

            document.getElementById('camera-modal').classList.add('hidden');
            currentTipe = null;
            capturedPhotoData = null;
        }

        function capturePhoto() {
            const video = document.getElementById('camera-preview');
            const canvas = document.getElementById('camera-canvas');
            const ctx = canvas.getContext('2d');

            // Set canvas size to video size
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw video frame to canvas
            ctx.drawImage(video, 0, 0);

            // Add timestamp watermark
            const now = new Date();
            const timestamp = now.toLocaleString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            }) + ' WIB';

            ctx.font = 'bold 16px Arial';
            ctx.fillStyle = 'rgba(0, 0, 0, 0.7)';
            ctx.fillRect(canvas.width - 200, canvas.height - 30, 195, 25);
            ctx.fillStyle = '#ffffff';
            ctx.textAlign = 'right';
            ctx.fillText(timestamp, canvas.width - 10, canvas.height - 12);

            // Get image data
            capturedPhotoData = canvas.toDataURL('image/jpeg', 0.7);

            // Show captured photo
            document.getElementById('captured-photo').src = capturedPhotoData;
            document.getElementById('photo-result').classList.remove('hidden');

            // Hide video, show controls
            document.getElementById('camera-preview').classList.add('hidden');
            document.getElementById('btn-capture').classList.add('hidden');
            document.getElementById('btn-retake').classList.remove('hidden');
            document.getElementById('btn-submit').classList.remove('hidden');
        }

        function retakePhoto() {
            capturedPhotoData = null;

            // Show video again
            document.getElementById('camera-preview').classList.remove('hidden');
            document.getElementById('photo-result').classList.add('hidden');
            document.getElementById('btn-capture').classList.remove('hidden');
            document.getElementById('btn-retake').classList.add('hidden');
            document.getElementById('btn-submit').classList.add('hidden');
        }

        function submitWithPhoto() {
            if (!capturedPhotoData) {
                alert('Silakan ambil foto terlebih dahulu.');
                return;
            }

            const form = document.getElementById('camera-form');
            document.getElementById('camera-foto').value = capturedPhotoData;

            if (currentTipe === 'mulai') {
                form.action = '{{ route("lembur.store") }}';
                document.getElementById('camera-method').value = 'POST';
            } else if (currentTipe === 'selesai') {
                const keterangan = document.getElementById('keterangan-lembur').value;
                document.getElementById('camera-keterangan').value = keterangan;
                form.action = '{{ $activeLembur ? route("lembur.update", $activeLembur) : "" }}';
                document.getElementById('camera-method').value = 'PATCH';
            }

            // Stop camera before submit
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
            }

            // Submit form
            form.submit();
        }
    </script>

    <style>
        /* Pulse animation for active lembur indicator */
        @keyframes pulse-ring {
            0% {
                transform: scale(0.33);
            }

            40%,
            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: scale(1.5);
            }
        }

        .animate-pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }
    </style>
</x-app-layout>
