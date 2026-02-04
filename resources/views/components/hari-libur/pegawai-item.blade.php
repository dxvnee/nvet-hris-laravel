{{-- Hari Libur Pegawai Item Component --}}
@props(['pegawai', 'selected' => false])

<label
    class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:border-primary/30 hover:bg-primary/5 cursor-pointer transition-all">
    <input type="checkbox" name="pegawai_hadir[]" value="{{ $pegawai->id }}"
        class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary/20" {{ $selected ? 'checked' : '' }}>
    <div class="flex items-center gap-3">
        <x-ui.user-avatar :user="$pegawai" size="sm" />
        <div>
            <p class="text-sm font-medium text-gray-900">{{ $pegawai->name }}</p>
            <p class="text-xs text-gray-500">{{ $pegawai->jabatan ?? 'Pegawai' }}</p>
        </div>
    </div>
</label>
