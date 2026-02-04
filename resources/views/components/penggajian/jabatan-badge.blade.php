@props([
    'jabatan',
])

@php
    $classes = match($jabatan) {
        'Dokter' => 'bg-purple-100 text-purple-700',
        'Paramedis' => 'bg-blue-100 text-blue-700',
        'Tech' => 'bg-green-100 text-green-700',
        'FO' => 'bg-orange-100 text-orange-700',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-3 py-1 rounded-full text-sm font-medium $classes"]) }}>
    {{ $jabatan }}
</span>
