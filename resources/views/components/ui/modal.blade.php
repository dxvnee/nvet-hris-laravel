{{-- Universal Confirmation/Form Modal Component --}}
@props([
    'id',
    'title',
    'maxWidth' => 'md', // sm, md, lg, xl
    'variant' => 'default', // default, danger, success
    'showClose' => true,
])

@php
    $widthClasses = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
    ];

    $headerColors = [
        'default' => 'border-b border-gray-200',
        'danger' => 'bg-red-50 border-b border-red-100',
        'success' => 'bg-green-50 border-b border-green-100',
        'primary' => 'bg-gradient-to-r from-primary to-primaryDark text-white',
    ];
@endphp

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm"
    onclick="if(event.target === this) close{{ Str::studly($id) }}Modal()">
    <div
        class="bg-white rounded-2xl shadow-2xl {{ $widthClasses[$maxWidth] ?? $widthClasses['md'] }} w-full mx-4 overflow-hidden transform transition-all">
        {{-- Header --}}
        <div class="flex items-center justify-between p-4 {{ $headerColors[$variant] ?? $headerColors['default'] }}">
            <h3 class="text-lg font-semibold {{ $variant === 'primary' ? 'text-white' : 'text-gray-900' }}">
                {{ $title }}</h3>
            @if ($showClose)
                <button type="button" onclick="close{{ Str::studly($id) }}Modal()"
                    class="p-2 rounded-lg transition-colors {{ $variant === 'primary' ? 'hover:bg-white/20 text-white' : 'hover:bg-gray-100 text-gray-500' }}">
                    <x-icons.x-mark class="w-5 h-5" />
                </button>
            @endif
        </div>

        {{-- Content --}}
        <div class="p-4">
            {{ $slot }}
        </div>

        {{-- Footer/Actions --}}
        @if (isset($footer))
            <div class="p-4 border-t border-gray-100 flex justify-end gap-3">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>

@once
    @push('scripts')
        <script>
            // Generic modal functions
            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = '';
                }
            }
        </script>
    @endpush
@endonce

<script>
    function open{{ Str::studly($id) }}Modal(data = {}) {
        openModal('{{ $id }}');
        // Dispatch custom event with data
        document.getElementById('{{ $id }}').dispatchEvent(
            new CustomEvent('modal-opened', {
                detail: data
            })
        );
    }

    function close{{ Str::studly($id) }}Modal() {
        closeModal('{{ $id }}');
    }
</script>
