<x-app-layout>
    <x-slot name="header">Profil</x-slot>
    <x-slot name="subtle">Kelola informasi profil Anda</x-slot>

    <div class="space-y-6">
        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 animate-slide-up">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Profile Photo Section -->
                <div class="flex flex-col items-center lg:items-start">
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-primary shadow-lg">
                            @if(auth()->user()->avatar && Storage::disk('public')->exists(auth()->user()->avatar))
                                <img id="profile-preview" src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                    alt="Profile Photo" class="w-full h-full object-cover">
                            @else
                                <img id="profile-preview"
                                    src="{{ 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7F9CF5&background=EBF4FF&size=128' }}"
                                    alt="Profile Photo" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <button type="button" onclick="openAvatarCameraModal()"
                            class="absolute bottom-0 right-0 bg-primary hover:bg-primaryDark text-white p-3 rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 mt-3 text-center lg:text-left">Klik ikon kamera untuk mengambil foto
                    </p>
                </div>

                <!-- Profile Info Section -->
                <div class="flex-1">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                                <p class="text-gray-900 font-medium">{{ auth()->user()->name }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                                <p class="text-gray-900">{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                            <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        {{ auth()->user()->jabatan === 'Dokter' ? 'bg-purple-100 text-purple-700' : '' }}
                                        {{ auth()->user()->jabatan === 'Paramedis' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ auth()->user()->jabatan === 'Tech' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ auth()->user()->jabatan === 'FO' ? 'bg-orange-100 text-orange-700' : '' }}">
                                        {{ auth()->user()->jabatan }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Member Since -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bergabung Sejak</label>
                            <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                                <p class="text-gray-900">{{ auth()->user()->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                        <!-- Total Absen Bulan Ini -->
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-blue-500 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-blue-700">Absen Bulan Ini</p>
                                    <p class="text-2xl font-bold text-blue-800">{{ $stats['bulan_ini'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Jam Kerja -->
                        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-xl p-4 border border-green-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-green-500 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-green-700">Total Jam Kerja</p>
                                    <p class="text-2xl font-bold text-green-800">{{ $stats['total_jam'] ?? 0 }}j</p>
                                </div>
                            </div>
                        </div>

                        <!-- Status Terakhir -->
                        <div
                            class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl p-4 border border-purple-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-purple-500 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-purple-700">Status Terakhir</p>
                                    <p class="text-lg font-bold text-purple-800">
                                        {{ $stats['status_terakhir'] ?? 'Belum ada' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 animate-slide-up-delay-1">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 bg-gradient-to-br from-primary to-primaryDark rounded-xl shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Edit Profil</h2>
                    <p class="text-gray-500 text-sm">Perbarui informasi profil Anda</p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <!-- Avatar Photo (Hidden Input for base64) -->
                <input type="hidden" id="avatar-base64" name="avatar_base64">

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all @error('email') border-red-500 @enderror"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jabatan (Read Only) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                    <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ auth()->user()->jabatan === 'Dokter' ? 'bg-purple-100 text-purple-700' : '' }}
                            {{ auth()->user()->jabatan === 'Paramedis' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ auth()->user()->jabatan === 'Tech' ? 'bg-green-100 text-green-700' : '' }}
                            {{ auth()->user()->jabatan === 'FO' ? 'bg-orange-100 text-orange-700' : '' }}">
                            {{ auth()->user()->jabatan }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">Jabatan hanya dapat diubah oleh administrator</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-primary to-primaryDark text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Camera Modal for Avatar -->
    <div id="avatar-camera-modal"
        class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform transition-all">
            <div class="p-6">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Ambil Foto Profil
                    </h3>
                    <button type="button" onclick="closeAvatarCameraModal()"
                        class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Camera Preview -->
                <div class="relative bg-black rounded-xl overflow-hidden mb-4">
                    <video id="avatar-camera-preview" autoplay playsinline class="w-full h-64 object-cover"></video>
                    <canvas id="avatar-camera-canvas" class="hidden"></canvas>
                </div>

                <!-- Captured Photo Preview -->
                <div id="avatar-photo-result" class="hidden mb-4">
                    <p class="text-sm text-gray-600 mb-2">Foto yang diambil:</p>
                    <div class="relative">
                        <img id="avatar-captured-photo"
                            class="w-full h-48 object-cover rounded-xl border-2 border-green-500">
                        <div class="absolute top-2 right-2 bg-green-500 text-white p-1 rounded-full">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Camera Controls -->
                <div class="flex gap-3">
                    <button type="button" id="avatar-btn-capture" onclick="captureAvatarPhoto()"
                        class="flex-1 py-3 px-6 rounded-xl font-bold text-white bg-gradient-to-r from-primary to-primaryDark hover:from-primaryDark hover:to-primaryExtraDark transition-all shadow-lg flex items-center justify-center gap-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Ambil Foto
                    </button>
                    <button type="button" id="avatar-btn-retake" onclick="retakeAvatarPhoto()"
                        class="hidden py-3 px-6 rounded-xl font-bold text-gray-700 bg-gray-200 hover:bg-gray-300 transition-all flex items-center justify-center gap-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Ulangi
                    </button>
                </div>

                <!-- Use Photo Button -->
                <button type="button" id="avatar-btn-use" onclick="useAvatarPhoto()"
                    class="hidden w-full mt-3 py-3 px-6 rounded-xl font-bold text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 transition-all shadow-lg flex items-center justify-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Gunakan Foto Ini
                </button>
            </div>
        </div>
    </div>

    <script>
        let avatarCameraStream = null;
        let avatarCapturedPhotoData = null;

        // Open camera modal for avatar
        async function openAvatarCameraModal() {
            avatarCapturedPhotoData = null;

            // Reset UI
            document.getElementById('avatar-camera-preview').classList.remove('hidden');
            document.getElementById('avatar-photo-result').classList.add('hidden');
            document.getElementById('avatar-btn-capture').classList.remove('hidden');
            document.getElementById('avatar-btn-retake').classList.add('hidden');
            document.getElementById('avatar-btn-use').classList.add('hidden');

            // Show modal
            document.getElementById('avatar-camera-modal').classList.remove('hidden');

            // Start camera
            try {
                avatarCameraStream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: 'user', width: { ideal: 640 }, height: { ideal: 480 } },
                    audio: false
                });
                document.getElementById('avatar-camera-preview').srcObject = avatarCameraStream;
            } catch (error) {
                alert('Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.');
                closeAvatarCameraModal();
            }
        }

        // Close camera modal
        function closeAvatarCameraModal() {
            // Stop camera stream
            if (avatarCameraStream) {
                avatarCameraStream.getTracks().forEach(track => track.stop());
                avatarCameraStream = null;
            }

            document.getElementById('avatar-camera-modal').classList.add('hidden');
            avatarCapturedPhotoData = null;
        }

        // Capture photo from camera
        function captureAvatarPhoto() {
            const video = document.getElementById('avatar-camera-preview');
            const canvas = document.getElementById('avatar-camera-canvas');
            const ctx = canvas.getContext('2d');

            // Set canvas size to video size
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw video frame to canvas
            ctx.drawImage(video, 0, 0);

            // Get image data
            avatarCapturedPhotoData = canvas.toDataURL('image/jpeg', 0.8);

            // Show captured photo
            document.getElementById('avatar-captured-photo').src = avatarCapturedPhotoData;
            document.getElementById('avatar-photo-result').classList.remove('hidden');

            // Hide video, show controls
            document.getElementById('avatar-camera-preview').classList.add('hidden');
            document.getElementById('avatar-btn-capture').classList.add('hidden');
            document.getElementById('avatar-btn-retake').classList.remove('hidden');
            document.getElementById('avatar-btn-use').classList.remove('hidden');
        }

        // Retake photo
        function retakeAvatarPhoto() {
            avatarCapturedPhotoData = null;

            // Show video again
            document.getElementById('avatar-camera-preview').classList.remove('hidden');
            document.getElementById('avatar-photo-result').classList.add('hidden');
            document.getElementById('avatar-btn-capture').classList.remove('hidden');
            document.getElementById('avatar-btn-retake').classList.add('hidden');
            document.getElementById('avatar-btn-use').classList.add('hidden');
        }

        // Use captured photo
        function useAvatarPhoto() {
            if (!avatarCapturedPhotoData) {
                alert('Silakan ambil foto terlebih dahulu.');
                return;
            }

            // Set hidden input value
            document.getElementById('avatar-base64').value = avatarCapturedPhotoData;

            // Update preview in profile card
            document.getElementById('profile-preview').src = avatarCapturedPhotoData;

            // Close modal
            closeAvatarCameraModal();

            // Show notification
            showNotification('Foto berhasil diambil! Klik "Simpan Perubahan" untuk menyimpan.', 'success');
        }

        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-4 rounded-xl shadow-lg z-50 transform translate-x-full transition-transform duration-300 ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
                }`;
            notification.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${type === 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'
                }"></path>
                    </svg>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    </script>
</x-app-layout>