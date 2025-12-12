<div id="sidebar"
    class="sidebar mr-5 overflow-hidden shadow-2xl-lr rounded-xl flex w-96 min-h-screen p-5 bg-white transform transition-all duration-300 hover:shadow-3xl">
    <div class="flex min-h-full w-full flex-col">

        <!-- Logo -->
        <div class="flex items-center gap-3 mb-8 animate-fade-in">
            <img src="{{ asset('images/logo3.png') }}" alt="logo"
                class="h-12 transition-transform duration-300 hover:scale-105">
            <p class="text-xl font-extrabold text-primaryDark transition-colors duration-300 hover:text-primary">Nvet
                Clinic & Lab</p>
        </div>

        <!-- Menu -->
        <nav class="flex flex-col gap-3 animate-slide-in-left">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 text-primaryDark font-medium {{ request()->routeIs('dashboard') ? 'btn-primary text-white shadow-md transform scale-105' : 'hover:bg-primaryUltraLight hover:shadow-md' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 transition-colors duration-300 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-primaryDark' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 12l9-9 9 9M4.5 10.5v10.5h15V10.5" />
                </svg>
                Dashboard
            </a>

            <!-- Users -->
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primaryDark transition-colors duration-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M5.5 17a4.5 4.5 0 018.9 0M12 7.5a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Users
            </a>

            <!-- Projects -->
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primaryDark transition-colors duration-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                Projects
            </a>

            <!-- Settings -->
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primaryDark transition-colors duration-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.75 3a1.5 1.5 0 013 0v1.051a7.5 7.5 0 014.95 4.95H21a1.5 1.5 0 010 3h-1.301a7.5 7.5 0 01-4.95 4.95V21a1.5 1.5 0 01-3 0v-1.301a7.5 7.5 0 01-4.95-4.95H3a1.5 1.5 0 010-3h1.051a7.5 7.5 0 014.95-4.95V3z" />
                </svg>
                Settings
            </a>

        </nav>

    </div>
</div>

<style>
    .sidebar-hidden {
        transform: translateX(-110%);
    }

    .content-shift {
        margin-left: -25.2rem;
        transition: margin-left 0.3s ease;
    }
</style>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        sidebar.classList.toggle('sidebar-hidden');
        mainContent.classList.toggle('content-shift');
    }
</script>
