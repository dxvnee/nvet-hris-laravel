<div class="shadow-2xl rounded-md flex w-1/5 min-h-screen p-5 bg-white">
    <div class="flex min-h-full w-full flex-col">

        <!-- Logo -->
        <div class="flex items-center gap-3 mb-8">
            <img src="{{ asset('images/logo3.png') }}" alt="logo" class="h-12">
            <p class="text-xl font-extrabold text-primaryDark">Nvet Clinic & Lab</p>
        </div>

        <!-- Menu -->
        <nav class="flex flex-col gap-3">

            <!-- Dashboard -->
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primaryUltraLight transition text-primaryDark font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primaryDark" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 12l9-9 9 9M4.5 10.5v10.5h15V10.5" />
                </svg>
                Dashboard
            </a>

            <!-- Users -->
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primaryUltraLight transition text-primaryDark font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primaryDark" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M5.5 17a4.5 4.5 0 018.9 0M12 7.5a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Users
            </a>

            <!-- Projects -->
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primaryUltraLight transition text-primaryDark font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primaryDark" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                Projects
            </a>

            <!-- Settings -->
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primaryUltraLight transition text-primaryDark font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primaryDark" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.75 3a1.5 1.5 0 013 0v1.051a7.5 7.5 0 014.95 4.95H21a1.5 1.5 0 010 3h-1.301a7.5 7.5 0 01-4.95 4.95V21a1.5 1.5 0 01-3 0v-1.301a7.5 7.5 0 01-4.95-4.95H3a1.5 1.5 0 010-3h1.051a7.5 7.5 0 014.95-4.95V3z" />
                </svg>
                Settings
            </a>

        </nav>

        <!-- Footer / Logout -->
        <div class="mt-auto pt-8">
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-100 transition text-red-600 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15.75 9V5.25a2.25 2.25 0 00-2.25-2.25h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>
                Logout
            </a>
        </div>

    </div>
</div>
