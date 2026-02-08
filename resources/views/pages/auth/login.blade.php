<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyNVet</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo3.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo3.png') }}">

    @vite('resources/css/app.css')
</head>

<body
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-50 via-orange-50 to-stone-100 font-sans">

    <x-ui.error-message />

    @php
        $emailIcon = view('components.icons.mail', ['class' => 'w-5 h-5'])->render();
        $lockIcon = view('components.icons.lock-closed', ['class' => 'w-5 h-5'])->render();
    @endphp

    <main class="w-full min-h-screen flex items-center justify-center p-4">
        <div
            class="flex flex-col md:flex-row w-full max-w-[900px] m-4 bg-white rounded-2xl shadow-[0_20px_60px_rgba(133,94,65,0.15)] overflow-hidden animate-slide-up">
            <!-- LEFT -->
            <div
                class="md:flex-1 bg-gradient-to-br from-primary via-primaryDark to-primary md:p-12 p-8 flex flex-col justify-center items-center text-white relative overflow-hidden">

                <div class="relative z-10 flex flex-col items-center">
                    <x-ui.logo :animated="true" size="lg" :src="asset('images/logo3.png')" alt="logo" />
                    <h1 class="mt-6 text-3xl font-bold tracking-wide">MyNNvet</h1>
                    <p class="mt-2 text-white/80 text-xs text-center">Copyright © {{ date('Y') }} MyNNvet. All rights reserved.</p>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="flex-1 p-8 md:p-12 flex flex-col justify-center animate-slide-in-left">

                <div class="mb-8 text-center md:text-left">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Selamat Datang Kembali!</h2>
                    <p class="text-gray-500 text-sm">Silakan masuk untuk melanjutkan: </p>
                </div>

                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf

                    <div class="mb-6">
                        <x-ui.form-input type="email" name="email" label="Email Address"
                            placeholder="nama@email.com" required variant="rounded" :prefix-html="$emailIcon"
                            class="bg-gray-50 placeholder:text-gray-400 focus:bg-white" />
                    </div>

                    <div class="mb-6">
                        <x-ui.form-input type="password" name="password" label="Password"
                            placeholder="Masukkan password" required variant="rounded" :prefix-html="$lockIcon"
                            class="bg-gray-50 placeholder:text-gray-400 focus:bg-white" />
                    </div>

                    <div class="flex justify-between items-center mb-6 text-sm">
                        <x-ui.form-checkbox name="remember" label="Ingat saya" size="sm" />
                        <a href="#" class="text-primary font-medium hover:text-primaryDark transition-colors">Lupa
                            password?</a>
                    </div>

                    <x-ui.action-button type="submit" variant="primary"
                        class="w-full !rounded-xl !py-3.5 !text-base shadow-lg shadow-primary/30 hover:shadow-xl hover:shadow-primary/40 transition-all duration-300"
                        size="lg">
                        Masuk Sekarang
                    </x-ui.action-button>

                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 text-center text-xs text-gray-400">
                    <p>&copy; {{ date('Y') }} MyNVet. All rights reserved.</p>
                </div>

            </div>
        </div>


    </main>


</body>

</html>
