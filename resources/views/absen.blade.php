<x-app-layout>
    <x-slot name="header">Absen</x-slot>
    <x-slot name="subtle">Halaman absensi karyawan</x-slot>

    <div class="space-y-6">
        <!-- Status Absen Hari Ini -->
        <div class="bg-white rounded-2xl shadow-xl p-6 animate-slide-up">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 bg-gradient-to-br from-primary to-primaryDark rounded-xl shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Status Absensi Hari Ini</h2>
                    <p class="text-gray-500 text-sm" id="current-datetime"></p>
                </div>
            </div>

            <!-- Status Cards -->
            @if($sudahIzin)
                <!-- Status Izin - Full Width -->
                <div class="w-full p-6 rounded-xl border-2 bg-yellow-50 border-yellow-300 mb-6">
                    <div class="flex items-center gap-4">
                        <div class="p-3 rounded-lg bg-yellow-500">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xl font-bold text-yellow-700">Sedang Izin</p>
                            <p class="text-sm text-yellow-600 mt-1">
                                Waktu: {{ substr($sudahIzin->jam, 0, 5) }}
                            </p>
                            @if($sudahIzin->keterangan)
                                <p class="text-sm text-yellow-600 mt-2 italic">
                                    "{{ $sudahIzin->keterangan }}"
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <!-- Status Cards Normal -->
                <div class="flex gap-4 mb-6">
                    <!-- Hadir -->
                    <div
                        class="flex-1 p-4 rounded-xl border-2 {{ $sudahHadir ? 'bg-green-50 border-green-300' : 'bg-gray-50 border-gray-200' }}">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg {{ $sudahHadir ? 'bg-green-500' : 'bg-gray-300' }}">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold {{ $sudahHadir ? 'text-green-700' : 'text-gray-500' }}">Hadir</p>
                                @if($sudahHadir)
                                    <p class="text-sm text-green-600">
                                        {{ substr($sudahHadir->jam, 0, 5) }}
                                        @if($sudahHadir->telat)
                                            <span class="text-red-500 font-bold">(TELAT)</span>
                                        @endif
                                    </p>
                                @else
                                    <p class="text-sm text-gray-400">Belum absen</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Pulang -->
                    <div
                        class="flex-1 p-4 rounded-xl border-2 {{ $sudahPulang ? 'bg-blue-50 border-blue-300' : 'bg-gray-50 border-gray-200' }}">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg {{ $sudahPulang ? 'bg-blue-500' : 'bg-gray-300' }}">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold {{ $sudahPulang ? 'text-blue-700' : 'text-gray-500' }}">Pulang</p>
                                @if($sudahPulang)
                                    <p class="text-sm text-blue-600">{{ substr($sudahPulang->jam, 0, 5) }}</p>
                                @else
                                    <p class="text-sm text-gray-400">Belum pulang</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Info Jam Kerja -->
            <div class="bg-primaryUltraLight rounded-xl p-4 mb-6">
                <div class="flex items-center gap-2 text-primary">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">Jam masuk: 09:00 WIB | Jam pulang: 20:00 WIB | Radius: 10
                        meter</span>
                </div>
            </div>

            <!-- Total Jam Kerja Hari Ini -->
            @if($sudahHadir && !$sudahIzin)
                <div
                    class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 mb-6 border border-blue-200 animate-slide-up-delay-1">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-500 rounded-lg">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-blue-700">Total Jam Kerja Hari Ini</p>
                            <p class="text-lg font-bold text-blue-800" id="working-hours">{{ $totalJamKerjaText }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Lokasi Status -->
            <div id="location-status" class="mb-6 p-4 rounded-xl bg-gray-50 border border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="animate-spin h-5 w-5 border-2 border-primary border-t-transparent rounded-full"></div>
                    <span class="text-gray-600">Mengambil lokasi...</span>
                </div>
            </div>

            <!-- Absen Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Tombol Hadir -->
                <form id="form-hadir" action="{{ route('absen.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipe" value="hadir">
                    <input type="hidden" name="latitude" id="lat-hadir">
                    <input type="hidden" name="longitude" id="lng-hadir">
                    <button type="submit" {{ $sudahHadir || $sudahIzin ? 'disabled' : '' }}
                        class="w-full py-4 px-6 rounded-xl font-bold text-white transition-all duration-300 flex items-center justify-center gap-2
                        {{ $sudahHadir || $sudahIzin ? 'bg-gray-300 cursor-not-allowed' : 'bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 shadow-lg hover:shadow-xl transform hover:scale-105' }}">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        {{ $sudahHadir ? 'Sudah Hadir' : ($sudahIzin ? 'Sedang Izin' : 'Absen Hadir') }}
                    </button>
                </form>

                <!-- Tombol Izin -->
                <button type="button" onclick="openIzinModal()" {{ $sudahIzin || $sudahHadir ? 'disabled' : '' }}
                    class="w-full py-4 px-6 rounded-xl font-bold text-white transition-all duration-300 flex items-center justify-center gap-2
                    {{ $sudahIzin || $sudahHadir ? 'bg-gray-300 cursor-not-allowed' : 'bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 shadow-lg hover:shadow-xl transform hover:scale-105' }}">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    {{ $sudahIzin ? 'Sedang Izin' : ($sudahHadir ? 'Sudah Hadir' : 'Absen Izin') }}
                </button>

                <!-- Tombol Pulang -->
                <form id="form-pulang" action="{{ route('absen.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipe" value="pulang">
                    <input type="hidden" name="latitude" id="lat-pulang">
                    <input type="hidden" name="longitude" id="lng-pulang">
                    <button type="submit" {{ $sudahPulang || !$sudahHadir || $sudahIzin ? 'disabled' : '' }}
                        class="w-full py-4 px-6 rounded-xl font-bold text-white transition-all duration-300 flex items-center justify-center gap-2
                        {{ $sudahPulang || !$sudahHadir || $sudahIzin ? 'bg-gray-300 cursor-not-allowed' : 'bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 shadow-lg hover:shadow-xl transform hover:scale-105' }}">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        {{ $sudahPulang ? 'Sudah Pulang' : (!$sudahHadir ? 'Hadir Dulu' : ($sudahIzin ? 'Sedang Izin' : 'Absen Pulang')) }}
                    </button>
                </form>
            </div>
        </div>

    </div>

    <!-- Modal Izin -->
    <div id="izin-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Form Izin</h3>
                    <button onclick="closeIzinModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('absen.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipe" value="izin">
                    <input type="hidden" name="latitude" id="lat-izin">
                    <input type="hidden" name="longitude" id="lng-izin">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Izin</label>
                        <textarea name="keterangan" rows="4" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                            placeholder="Masukkan alasan izin..."></textarea>
                    </div>
                    <button type="submit"
                        class="w-full py-3 px-6 rounded-xl font-bold text-white bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 transition-all shadow-lg hover:shadow-xl">
                        Kirim Izin
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let userLatitude = null;
        let userLongitude = null;

        // Update current datetime
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('current-datetime').textContent = now.toLocaleDateString('id-ID', options);
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Get user location
        function getLocation() {
            const statusEl = document.getElementById('location-status');

            if (!navigator.geolocation) {
                statusEl.innerHTML = `
                    <div class="flex items-center gap-3 text-red-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span>Browser tidak mendukung Geolocation</span>
                    </div>
                `;
                return;
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    userLatitude = position.coords.latitude;
                    userLongitude = position.coords.longitude;

                    // Set coordinates to all forms
                    document.getElementById('lat-hadir').value = userLatitude;
                    document.getElementById('lng-hadir').value = userLongitude;
                    document.getElementById('lat-pulang').value = userLatitude;
                    document.getElementById('lng-pulang').value = userLongitude;
                    document.getElementById('lat-izin').value = userLatitude;
                    document.getElementById('lng-izin').value = userLongitude;

                    statusEl.innerHTML = `
                        <div class="flex items-center gap-3 text-green-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Lokasi berhasil diambil (${userLatitude.toFixed(6)}, ${userLongitude.toFixed(6)})</span>
                        </div>
                    `;
                    statusEl.classList.remove('bg-gray-50', 'border-gray-200');
                    statusEl.classList.add('bg-green-50', 'border-green-200');
                },
                (error) => {
                    let errorMessage = 'Gagal mengambil lokasi';
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = 'Izin lokasi ditolak. Mohon aktifkan GPS.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = 'Informasi lokasi tidak tersedia.';
                            break;
                        case error.TIMEOUT:
                            errorMessage = 'Waktu pengambilan lokasi habis.';
                            break;
                    }
                    statusEl.innerHTML = `
                        <div class="flex items-center gap-3 text-red-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <span>${errorMessage}</span>
                            <button onclick="getLocation()" class="ml-auto text-sm bg-red-100 px-3 py-1 rounded-lg hover:bg-red-200 transition-colors">Coba Lagi</button>
                        </div>
                    `;
                    statusEl.classList.remove('bg-gray-50', 'border-gray-200');
                    statusEl.classList.add('bg-red-50', 'border-red-200');
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        }

        // Get location on page load
        getLocation();

        // Modal functions
        function openIzinModal() {
            document.getElementById('izin-modal').classList.remove('hidden');
        }

        function closeIzinModal() {
            document.getElementById('izin-modal').classList.add('hidden');
        }

        // Update working hours every minute
        @if($sudahHadir && !$sudahIzin && !$sudahPulang)
            let checkInTime = '{{ $sudahHadir->jam }}';
            setInterval(updateWorkingHours, 60000); // Update every minute
            updateWorkingHours(); // Initial update
        @endif

        function updateWorkingHours() {
            if (!checkInTime) return;

            const now = new Date();
            const checkIn = new Date();
            const [hours, minutes, seconds] = checkInTime.split(':');
            checkIn.setHours(parseInt(hours), parseInt(minutes), parseInt(seconds));

            const diffMs = now - checkIn;
            const diffMins = Math.floor(diffMs / 60000);
            const hoursWorked = Math.floor(diffMins / 60);
            const minsWorked = diffMins % 60;

            const workingHoursEl = document.getElementById('working-hours');
            if (workingHoursEl) {
                workingHoursEl.textContent = hoursWorked + ' jam ' + minsWorked + ' menit';
            }
        }
    </script>
</x-app-layout>