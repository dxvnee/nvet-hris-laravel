{{-- Page Hero Component --}}
@props([
    'title',
    'subtitle' => null,
    'animation' => 'animate-slide-up',
    'showClock' => false,
    'showDate' => false,
    'user' => null,
    'showAvatar' => false,
    'variant' => 'default', // default, admin, pegawai
])

@php
    $paddingClass = $variant === 'admin' ? 'p-8' : 'p-6 md:p-8';
@endphp

<div
    {{ $attributes->merge(['class' => "relative overflow-hidden bg-gradient-to-br from-primary via-primaryDark to-primary rounded-3xl shadow-2xl {$paddingClass} text-white {$animation}"]) }}>
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white rounded-full"></div>
        @if ($variant === 'admin' || $variant === 'default')
            <div class="absolute top-1/2 left-1/3 w-20 h-20 bg-white rounded-full"></div>
        @endif
    </div>

    <div
        class="relative flex flex-col md:flex-row {{ $variant === 'pegawai' ? 'items-center' : 'items-start md:items-center' }} justify-between gap-{{ $variant === 'admin' ? '4' : '5' }}">
        @if ($showAvatar && $user)
            {{-- Avatar untuk Pegawai --}}
            <div class="relative">
                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=80&background=ffffff&color=0D9488' }}"
                    class="w-20 h-20 md:w-24 md:h-24 rounded-2xl border-4 border-white/30 shadow-xl">
                <span
                    class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-400 rounded-full border-2 border-white flex items-center justify-center">
                    <x-icons.check-circle-solid class="w-3 h-3 text-white" />
                </span>
            </div>
            {{-- Content untuk Pegawai --}}
            <div class="text-center md:text-left flex-1">
                <h2 class="text-2xl md:text-3xl font-bold mb-1">{{ $title }}</h2>
                @if (isset($badges))
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mt-2">
                        {{ $badges }}
                    </div>
                @endif
            </div>
        @else
            {{-- Layout Default/Admin --}}
            <div class="flex items-center gap-4">
                @if (isset($icon))
                    <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl">
                        {{ $icon }}
                    </div>
                @endif
                <div>
                    <h2
                        class="{{ $variant === 'admin' ? 'text-2xl md:text-3xl' : 'text-xl md:text-2xl' }} font-bold mb-1">
                        {{ $title }}</h2>
                    @if ($showDate)
                        <p class="text-white/80 text-sm md:text-base flex items-center gap-2">
                            <x-icons.calendar class="w-4 h-4" />
                            <span id="current-datetime">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                        </p>
                    @elseif($subtitle)
                        <p class="text-white/80 text-sm md:text-base flex items-center gap-2">
                            {{ $subtitle }}
                        </p>
                    @endif
                </div>
            </div>
        @endif

        {{-- Clock & Actions --}}
        @if ($showClock)
            <div class="flex items-center gap-6">
                <div
                    class="{{ $variant === 'pegawai' ? 'hidden lg:block text-center' : 'hidden md:block text-right' }} bg-white/10 backdrop-blur-sm rounded-2xl {{ $variant === 'admin' ? 'px-6' : 'px-4 md:px-6' }} py-3">
                    <p class="text-white/70 text-xs uppercase tracking-wider mb-1">
                        {{ $variant === 'admin' ? 'Waktu Sekarang' : 'Waktu' }}</p>
                    <p class="{{ $variant === 'admin' ? 'text-3xl' : 'text-2xl md:text-3xl' }} font-bold font-mono"
                        x-data="{ time: '' }" x-init="time = new Date().toLocaleTimeString('id-ID'); setInterval(() => time = new Date().toLocaleTimeString('id-ID'), 1000)" x-text="time"></p>
                </div>
            </div>
        @elseif(isset($actions))
            <div class="flex items-center gap-4">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>
