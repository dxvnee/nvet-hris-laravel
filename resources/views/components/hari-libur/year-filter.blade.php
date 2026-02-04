{{-- Hari Libur Year Filter Component --}}
@props([
    'currentYear' => date('Y'),
    'routeName' => 'hari-libur.index',
])

@php
    $startYear = 2024;
    $endYear = date('Y') + 1;
@endphp

<form method="GET" action="{{ route($routeName) }}" class="flex items-center gap-3">
    <label for="tahun" class="text-sm font-medium text-gray-700">Tahun:</label>
    <select name="tahun" id="tahun" onchange="this.form.submit()"
        class="px-4 py-2 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all bg-white">
        @for ($year = $startYear; $year <= $endYear; $year++)
            <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>
                {{ $year }}
            </option>
        @endfor
    </select>
</form>
