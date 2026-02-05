{{-- Avatar Upload Component - Circular avatar with upload button --}}
@props([
    'user' => null,
    'currentImage' => null,
    'name' => 'avatar',
    'formId' => null,
    'previewId' => 'avatar-preview',
    'size' => 'lg', // sm, md, lg, xl
    'onchange' => null,
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'w-16 h-16',
        'md' => 'w-20 h-20',
        'lg' => 'w-32 h-32',
        'xl' => 'w-40 h-40',
        default => 'w-32 h-32',
    };

    $buttonSize = match ($size) {
        'sm' => 'p-1.5',
        'md' => 'p-2',
        'lg' => 'p-3',
        'xl' => 'p-4',
        default => 'p-3',
    };

    $iconSize = match ($size) {
        'sm' => 'w-3 h-3',
        'md' => 'w-4 h-4',
        'lg' => 'w-5 h-5',
        'xl' => 'w-6 h-6',
        default => 'w-5 h-5',
    };

    // Determine image source
    $imageSrc = $currentImage;
    if (!$imageSrc && $user) {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            $imageSrc = asset('storage/' . $user->avatar);
        } else {
            $imageSrc =
                'https://ui-avatars.com/api/?name=' .
                urlencode($user->name) .
                '&color=7F9CF5&background=EBF4FF&size=128';
        }
    }

    $inputId = $name . '-file-input';
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col items-center']) }}>
    <div class="relative">
        <div class="{{ $sizeClasses }} rounded-full overflow-hidden border-4 border-primary shadow-lg">
            <img id="{{ $previewId }}" src="{{ $imageSrc }}" alt="Avatar" class="w-full h-full object-cover">
        </div>
        <input type="file" id="{{ $inputId }}" name="{{ $name }}" accept="image/*" class="hidden"
            @if ($formId) form="{{ $formId }}" @endif
            @if ($onchange) onchange="{{ $onchange }}" @endif>
        <button type="button" onclick="document.getElementById('{{ $inputId }}').click()"
            class="absolute bottom-0 right-0 bg-primary hover:bg-primaryDark text-white {{ $buttonSize }} rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300">
            <svg class="{{ $iconSize }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>
        </button>
    </div>
</div>
