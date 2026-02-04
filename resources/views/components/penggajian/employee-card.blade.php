@props([
    'user',
    'showGajiPokok' => false,
    'showStatus' => false,
    'status' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-xl p-6']) }}>
    <div class="flex items-center gap-4">
        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7F9CF5&background=EBF4FF&size=80' }}"
            alt="{{ $user->name }}" class="w-20 h-20 rounded-full border-4 border-primary shadow-lg">
        <div>
            <h3 class="text-xl font-bold text-gray-800">{{ $user->name }}</h3>
            <p class="text-gray-500">{{ $user->email }}</p>
            <x-penggajian.jabatan-badge :jabatan="$user->jabatan" class="mt-2" />
        </div>
        @if($showGajiPokok || $showStatus)
            <div class="ml-auto text-right">
                @if($showGajiPokok)
                    <p class="text-sm text-gray-500">Gaji Pokok</p>
                    <p class="text-lg font-bold text-gray-800">Rp {{ number_format($user->gaji_pokok, 0, ',', '.') }}</p>
                @endif
                @if($showStatus && $status)
                    <p class="text-sm text-gray-500 {{ $showGajiPokok ? 'mt-2' : '' }}">Status</p>
                    @if($status === 'final')
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">Final</span>
                    @else
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-full">Draft</span>
                    @endif
                @endif
            </div>
        @endif
    </div>
</div>
