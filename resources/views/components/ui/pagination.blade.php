@props(['paginator'])

@php
    $lastPage = $paginator->lastPage();
    $currentPage = $paginator->currentPage();

    // Smart range: show max 5 pages with ellipsis
    $start = max(1, $currentPage - 2);
    $end = min($lastPage, $currentPage + 2);

    if ($currentPage <= 3) {
        $end = min(5, $lastPage);
    }
    if ($currentPage >= $lastPage - 2) {
        $start = max(1, $lastPage - 4);
    }
@endphp

<div class="flex items-center justify-between gap-4 flex-wrap">
    {{-- Info --}}
    <p class="text-sm text-gray-500">
        Hal <span class="font-semibold text-gray-700">{{ $currentPage }}</span> dari <span
            class="font-semibold text-gray-700">{{ $lastPage }}</span>
    </p>

    {{-- Navigation --}}
    <div class="flex items-center gap-1">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span
                class="inline-flex items-center justify-center w-9 h-9 text-gray-300 bg-gray-50 rounded-lg cursor-not-allowed">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="inline-flex items-center justify-center w-9 h-9 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-primaryUltraLight hover:border-primary hover:text-primary transition-all duration-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        @endif

        {{-- First page + ellipsis --}}
        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}"
                class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-primaryUltraLight hover:border-primary hover:text-primary transition-all duration-200">1</a>
            @if ($start > 2)
                <span class="inline-flex items-center justify-center w-9 h-9 text-sm text-gray-400">...</span>
            @endif
        @endif

        {{-- Page numbers --}}
        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $currentPage)
                <span
                    class="inline-flex items-center justify-center w-9 h-9 text-sm font-bold text-white bg-primary rounded-lg shadow-sm">{{ $page }}</span>
            @else
                <a href="{{ $paginator->url($page) }}"
                    class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-primaryUltraLight hover:border-primary hover:text-primary transition-all duration-200">{{ $page }}</a>
            @endif
        @endfor

        {{-- Last page + ellipsis --}}
        @if ($end < $lastPage)
            @if ($end < $lastPage - 1)
                <span class="inline-flex items-center justify-center w-9 h-9 text-sm text-gray-400">...</span>
            @endif
            <a href="{{ $paginator->url($lastPage) }}"
                class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-primaryUltraLight hover:border-primary hover:text-primary transition-all duration-200">{{ $lastPage }}</a>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="inline-flex items-center justify-center w-9 h-9 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-primaryUltraLight hover:border-primary hover:text-primary transition-all duration-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        @else
            <span
                class="inline-flex items-center justify-center w-9 h-9 text-gray-300 bg-gray-50 rounded-lg cursor-not-allowed">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        @endif
    </div>
</div>
