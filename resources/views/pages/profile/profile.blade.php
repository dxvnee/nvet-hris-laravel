{{-- Profile Page - Modular Version --}}
<x-app-layout>
    <x-slot name="header">Profil</x-slot>
    <x-slot name="subtle">Kelola informasi profil Anda</x-slot>

    <div class="space-y-6">
        {{-- Profile Card --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 animate-slide-up">
            <div class="flex flex-col lg:flex-row gap-8">
                {{-- Profile Photo Section --}}
                <x-ui.avatar-upload :user="auth()->user()" formId="profile-form" previewId="avatar-preview"
                    onchange="handleFileSelection(event)" size="lg" />

                {{-- Profile Info Section --}}
                <div class="flex-1">
                    @php
                        $user = auth()->user();
                        $jabatanTypeMap = [
                            'Dokter' => 'purple',
                            'Paramedis' => 'info',
                            'Tech' => 'green',
                            'FO' => 'orange',
                        ];
                        $jabatanBadgeType = $jabatanTypeMap[$user->jabatan] ?? 'default';
                    @endphp
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-ui.display-field label="Nama Lengkap" :value="$user->name" />
                        <x-ui.display-field label="Email" :value="$user->email" />
                        <x-ui.display-field label="Jabatan">
                            <x-ui.status-badge :type="$jabatanBadgeType">{{ $user->jabatan }}</x-ui.status-badge>
                        </x-ui.display-field>
                        <x-ui.display-field label="Bergabung Sejak" :value="$user->created_at?->format('d M Y') ?? '-'" />
                    </div>

                    {{-- Stats Cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                        <x-ui.stat-card :value="$stats['bulan_ini'] ?? 0" label="Absen Bulan Ini" color="blue" variant="compact"
                            iconName="calendar" />

                        <x-ui.stat-card :value="($stats['total_jam'] ?? 0) . ' jam'" label="Total Jam Kerja" color="green" variant="compact"
                            iconName="clock" />

                        <x-ui.stat-card :value="$stats['lembur'] ?? 0" label="Lembur Bulan Ini" color="orange" variant="compact"
                            iconName="briefcase" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Profile Form --}}
        <x-ui.section-card title="Edit Profil" animation="animate-slide-up-delay-1">
            <x-slot name="iconSlot">
                <x-icons.pencil class="h-6 w-6 text-white" />
            </x-slot>

            <x-profile.edit-form :user="auth()->user()" :action="route('profile.update')" formId="profile-form" />
        </x-ui.section-card>

        {{-- Change Password --}}
        <x-ui.section-card title="Ganti Password" animation="animate-slide-up-delay-2">
            <x-slot name="iconSlot">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </x-slot>

            <x-profile.password-form :action="route('profile.password.update')" />
        </x-ui.section-card>
    </div>

    {{-- Profile Script --}}
    <x-profile.script />
</x-app-layout>
