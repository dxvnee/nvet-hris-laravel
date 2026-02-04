{{-- Penggajian Employee Card - using ui/user-avatar --}}
@props(['user', 'showGajiPokok' => false, 'showStatus' => false, 'status' => null])

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-xl p-6']) }}>
    <div class="flex items-center gap-4">
        <x-ui.user-avatar :user="$user" size="xl" class="border-4 border-primary shadow-lg" />
        <div>
            <h3 class="text-xl font-bold text-gray-800">{{ $user->name }}</h3>
            <p class="text-gray-500">{{ $user->email }}</p>
            <x-penggajian.jabatan-badge :jabatan="$user->jabatan" class="mt-2" />
        </div>
        @if ($showGajiPokok || $showStatus)
            <div class="ml-auto text-right">
                @if ($showGajiPokok)
                    <p class="text-sm text-gray-500">Gaji Pokok</p>
                    <p class="text-lg font-bold text-gray-800">Rp {{ number_format($user->gaji_pokok, 0, ',', '.') }}</p>
                @endif
                @if ($showStatus && $status)
                    <p class="text-sm text-gray-500 {{ $showGajiPokok ? 'mt-2' : '' }}">Status</p>
                    <x-ui.status-badge :type="$status === 'final' ? 'success' : 'warning'">
                        {{ ucfirst($status) }}
                    </x-ui.status-badge>
                @endif
            </div>
        @endif
    </div>
</div>
