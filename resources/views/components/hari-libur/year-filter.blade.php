{{-- Hari Libur Year Filter Component --}}
@props([
    'currentYear' => date('Y'),
    'routeName' => 'hari-libur.index',
])

@php
    $startYear = 2024;
    $endYear = date('Y') + 1;
    $options = [];
    for ($year = $startYear; $year <= $endYear; $year++) {
        $options[$year] = (string) $year;
    }
@endphp

<form method="GET" action="{{ route($routeName) }}" class="flex items-center gap-3">
    <x-ui.form-select name="tahun" label="Tahun:" :options="$options" :selected="$currentYear" variant="inline"
        onchange="this.form.submit()" />
</form>
