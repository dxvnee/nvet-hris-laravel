{{-- Profile Info Grid Component --}}
@props(['user'])

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Name --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
        <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
            <p class="text-gray-900 font-medium">{{ $user->name }}</p>
        </div>
    </div>

    {{-- Email --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
        <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
            <p class="text-gray-900">{{ $user->email }}</p>
        </div>
    </div>

    {{-- Jabatan --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
        <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
            <x-penggajian.jabatan-badge :jabatan="$user->jabatan" />
        </div>
    </div>

    {{-- Member Since --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Bergabung Sejak</label>
        <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
            <p class="text-gray-900">{{ $user->created_at?->format('d M Y') ?? '-' }}</p>
        </div>
    </div>
</div>
