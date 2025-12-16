<x-app-layout>
    <x-slot name="header">Manajemen Pegawai</x-slot>
    <x-slot name="subtle">Kelola data pegawai klinik</x-slot>

    <div class="space-y-6">
        <!-- Header Section with Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 animate-slide-up">
            <!-- Total Pegawai -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 text-white shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white/80 text-sm">Pegawai</p>
                        <p class="text-3xl font-bold">{{ \App\Models\User::where('role', 'pegawai')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Dokter -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-5 text-white shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white/80 text-sm">Dokter</p>
                        <p class="text-3xl font-bold">
                            {{ \App\Models\User::where('role', 'pegawai')->where('jabatan', 'Dokter')->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Paramedis -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-5 text-white shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white/80 text-sm">Paramedis</p>
                        <p class="text-3xl font-bold">
                            {{ \App\Models\User::where('role', 'pegawai')->where('jabatan', 'Paramedis')->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- FO & Tech -->
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-5 text-white shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white/80 text-sm">FO & Tech</p>
                        <p class="text-3xl font-bold">
                            {{ \App\Models\User::where('role', 'pegawai')->whereIn('jabatan', ['FO', 'Tech'])->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="bg-white rounded-2xl shadow-xl p-6 animate-slide-up-delay-1">
            <div class="flex flex-col lg:flex-row gap-4 justify-between items-center">
                <!-- Search & Filter -->
                <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
                    <form method="GET" action="{{ route('users.index') }}"
                        class="flex flex-col sm:flex-row gap-3 w-full">
                        <div class="relative flex-1">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari pegawai..."
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <select name="jabatan"
                            class="px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                            <option value="">Semua Jabatan</option>
                            <option value="Dokter" {{ request('jabatan') == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="Paramedis" {{ request('jabatan') == 'Paramedis' ? 'selected' : '' }}>Paramedis
                            </option>
                            <option value="Tech" {{ request('jabatan') == 'Tech' ? 'selected' : '' }}>Tech</option>
                            <option value="FO" {{ request('jabatan') == 'FO' ? 'selected' : '' }}>FO</option>
                        </select>
                        <button type="submit"
                            class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all">
                            Filter
                        </button>
                    </form>
                </div>

                <!-- Add Button -->
                <a href="{{ route('users.create') }}"
                    class="w-full lg:w-auto px-6 py-3 bg-gradient-to-r from-primary to-primaryDark text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Pegawai
                </a>
            </div>
        </div>

        <!-- Employees Table -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slide-up-delay-2">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-primary to-primaryDark text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">
                                <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => 'name', 'dir' => request('sort') == 'name' && request('dir') == 'asc' ? 'desc' : 'asc'])) }}"
                                    class="flex items-center gap-2 hover:text-primaryUltraLight transition-colors">
                                    Pegawai
                                    @if(request('sort') == 'name')
                                        <svg class="w-4 h-4 {{ request('dir') == 'desc' ? 'rotate-180' : '' }}" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">
                                <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => 'jabatan', 'dir' => request('sort') == 'jabatan' && request('dir') == 'asc' ? 'desc' : 'asc'])) }}"
                                    class="flex items-center gap-2 hover:text-primaryUltraLight transition-colors">
                                    Jabatan
                                    @if(request('sort') == 'jabatan')
                                        <svg class="w-4 h-4 {{ request('dir') == 'desc' ? 'rotate-180' : '' }}" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">
                                <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => 'gaji_pokok', 'dir' => request('sort') == 'gaji_pokok' && request('dir') == 'asc' ? 'desc' : 'asc'])) }}"
                                    class="flex items-center gap-2 hover:text-primaryUltraLight transition-colors">
                                    Gaji Pokok
                                    @if(request('sort') == 'gaji_pokok')
                                        <svg class="w-4 h-4 {{ request('dir') == 'desc' ? 'rotate-180' : '' }}" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Jam Kerja</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Hari Libur</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7F9CF5&background=EBF4FF&size=40' }}"
                                            alt="{{ $user->name }}" class="w-10 h-10 rounded-full border-2 border-gray-200">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                {{ $user->jabatan === 'Dokter' ? 'bg-purple-100 text-purple-700' : '' }}
                                                {{ $user->jabatan === 'Paramedis' ? 'bg-blue-100 text-blue-700' : '' }}
                                                {{ $user->jabatan === 'Tech' ? 'bg-green-100 text-green-700' : '' }}
                                                {{ $user->jabatan === 'FO' ? 'bg-orange-100 text-orange-700' : '' }}">
                                        {{ $user->jabatan ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-900">Rp
                                        {{ number_format($user->gaji_pokok ?? 0, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-700">{{ $user->jam_kerja ?? '-' }} jam/hari</span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $hariNama = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
                                        $hariLibur = $user->hari_libur ?? [];
                                    @endphp
                                    @if(count($hariLibur) > 0)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($hariLibur as $hari)
                                                <span class="px-2 py-1 bg-red-100 text-red-600 rounded text-xs font-medium">
                                                    {{ $hariNama[$hari] ?? $hari }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('users.edit', $user) }}"
                                            class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-colors"
                                            title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors"
                                                title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-500 text-lg font-medium">Belum ada data pegawai</p>
                                        <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Pegawai" untuk menambahkan
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
