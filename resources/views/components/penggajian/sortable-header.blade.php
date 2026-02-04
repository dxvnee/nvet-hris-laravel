@props([
    'column',
    'label',
    'currentSort' => null,
    'currentDirection' => null,
])

@php
    $isActive = request('sort_by') === $column;
    $nextDirection = ($isActive && request('sort_direction') === 'asc') ? 'desc' : 'asc';
@endphp

<th class="text-left py-3 px-4 font-semibold text-gray-600">
    <a href="{{ request()->fullUrlWithQuery(['sort_by' => $column, 'sort_direction' => $nextDirection]) }}"
       class="flex items-center space-x-1 hover:text-primary transition-colors">
        <span>{{ $label }}</span>
        @if($isActive)
            @if(request('sort_direction') === 'asc')
                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                </svg>
            @else
                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            @endif
        @else
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        @endif
    </a>
</th>
