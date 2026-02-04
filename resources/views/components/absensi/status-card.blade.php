{{-- Absensi Status Card Component - wrapper for ui/alert-card --}}
@props([
    'type' => 'inactive', // inactive, libur, izin, hadir, pulang
    'title' => null,
    'subtitle' => null,
    'extraInfo' => null,
    'namaHariLibur' => null,
])

@php
    $typeMap = [
        'inactive' => ['alertType' => 'danger', 'icon' => 'x-circle', 'defaultTitle' => 'Status: Inactive'],
        'libur' => ['alertType' => 'info', 'icon' => 'sun', 'defaultTitle' => 'Hari Libur'],
        'izin' => ['alertType' => 'warning', 'icon' => 'exclamation', 'defaultTitle' => 'Sedang Izin'],
        'hadir' => ['alertType' => 'success', 'icon' => 'check', 'defaultTitle' => 'Hadir'],
        'pulang' => ['alertType' => 'info', 'icon' => 'logout', 'defaultTitle' => 'Pulang'],
    ];

    $config = $typeMap[$type] ?? $typeMap['inactive'];
    $displayTitle = $title ?? $config['defaultTitle'];

    if ($type === 'libur' && $namaHariLibur) {
        $displayTitle = $displayTitle . ' - ' . $namaHariLibur;
    }
@endphp

<x-ui.alert-card :type="$config['alertType']" :title="$displayTitle" :subtitle="$subtitle" :iconName="$config['icon']" class="mb-6"
    {{ $attributes }}>
    {{ $slot }}
    @if ($extraInfo)
        <div class="mt-3 p-3 bg-white/70 rounded-lg border border-current/10">
            {{ $extraInfo }}
        </div>
    @endif
</x-ui.alert-card>
