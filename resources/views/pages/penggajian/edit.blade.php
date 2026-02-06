<x-app-layout>
    <x-slot name="header">Edit Penggajian</x-slot>
    <x-slot name="subtle">{{ $user->name }} - Periode {{ \Carbon\Carbon::parse($periode)->format('F Y') }}</x-slot>

    <div class="max-w-5xl mx-auto space-y-6">
        <!-- Back Button -->
        <x-ui.back-button :href="route('penggajian.index', ['periode' => $periode])" />

        <!-- Employee Info Card -->
        <x-penggajian.employee-card :user="$user" show-status :status="$penggajian->status" class="animate-slide-up" />

        @php
            $detail = $penggajian->insentif_detail ?? [];
        @endphp

        <!-- Form -->
        <form method="POST" action="{{ route('penggajian.update', $penggajian) }}" class="space-y-6"
            x-data="penggajianForm()">
            @csrf
            @method('PUT')

            <!-- Gaji Pokok & Potongan Section -->
            <x-penggajian.gaji-potongan-section :user="$user" :gaji-pokok="$penggajian->gaji_pokok" :total-menit-telat="$totalMenitTelat" :potongan-per-menit="$potonganPerMenit"
                :total-lupa-pulang="$totalLupaPulang" :total-tidak-hadir="$totalTidakHadir" :potongan-per-tidak-hadir="$potonganPerTidakHadir" />

            <!-- Insentif Section -->
            <x-penggajian.insentif-section :jabatan="$user->jabatan" :detail="$detail" />

            <!-- Lembur Section -->
            <x-penggajian.lembur-section :total-menit-lembur="$penggajian->total_menit_lembur ?? 0" :upah-lembur-per-menit="$penggajian->upah_lembur_per_menit ?? 0" />

            <!-- Lain-lain Section -->
            <x-penggajian.lain-lain-section :catatan="$penggajian->catatan ?? ''" />

            <!-- Total & Submit -->
            <x-penggajian.total-submit />
        </form>
    </div>

    <!-- Form Script -->
    <x-penggajian.form-script :user="$user" :gaji-pokok="$penggajian->gaji_pokok" :total-menit-telat="$totalMenitTelat" :potongan-per-menit="$potonganPerMenit"
        :total-menit-lembur="$penggajian->total_menit_lembur ?? 0" :upah-lembur-per-menit="$penggajian->upah_lembur_per_menit ?? 0" :total-tidak-hadir="$totalTidakHadir" :potongan-per-tidak-hadir="$potonganPerTidakHadir" :total-lupa-pulang="$totalLupaPulang"
        :detail="$detail" :lain-lain-items="$penggajian->lain_lain_items ?? []" />
</x-app-layout>
