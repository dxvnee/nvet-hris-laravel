<x-app-layout>
    <x-slot name="header">Buat Penggajian</x-slot>
    <x-slot name="subtle">{{ $user->name }} - Periode {{ \Carbon\Carbon::parse($periode)->format('F Y') }}</x-slot>

    <div class="max-w-5xl mx-auto space-y-6">
        <!-- Back Button -->
        <x-ui.back-button :href="route('penggajian.index', ['periode' => $periode])" />

        <!-- Employee Info Card -->
        <x-penggajian.employee-card :user="$user" show-gaji-pokok class="animate-slide-up" />

        @php
            $detail = [];
        @endphp

        <!-- Form -->
        <form method="POST" action="{{ route('penggajian.store') }}" class="space-y-6" x-data="penggajianForm()">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="periode" value="{{ $periode }}">

            <!-- Gaji Pokok & Potongan Section -->
            <x-penggajian.gaji-potongan-section :user="$user" :total-menit-telat="$totalMenitTelat" :potongan-per-menit="$potonganPerMenit" :total-lupa-pulang="$totalLupaPulang"
                :total-tidak-hadir="$totalTidakHadir" :potongan-per-tidak-hadir="$potonganPerTidakHadir" />

            <!-- Lembur Section -->
            <x-penggajian.lembur-section :total-menit-lembur="$totalMenitLembur ?? 0" :upah-lembur-per-menit="$upahLemburPerMenit ?? 0" />

            <!-- Insentif Section -->
            <x-penggajian.insentif-section :jabatan="$user->jabatan" :detail="$detail" />

            <!-- Lain-lain Section -->
            <x-penggajian.lain-lain-section />

            <!-- Total & Submit -->
            <x-penggajian.total-submit />
        </form>
    </div>

    <!-- Form Script -->
    <x-penggajian.form-script :user="$user" :total-menit-telat="$totalMenitTelat" :potongan-per-menit="$potonganPerMenit" :total-menit-lembur="$totalMenitLembur ?? 0"
        :upah-lembur-per-menit="$upahLemburPerMenit ?? 0" :total-tidak-hadir="$totalTidakHadir" :potongan-per-tidak-hadir="$potonganPerTidakHadir" :total-lupa-pulang="$totalLupaPulang" :detail="$detail"
        :lain-lain-items="[]" />
</x-app-layout>
