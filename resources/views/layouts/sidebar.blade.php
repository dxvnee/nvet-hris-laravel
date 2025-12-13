<!-- Backdrop for mobile -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden" onclick="toggleSidebar()">
</div>

<div id="sidebar" class="sidebar mr-5 overflow-y-auto overflow-x-hidden  shadow-2xl-lr rounded-xl flex w-96 p-5 bg-white hover:shadow-3xl
    lg:relative fixed top-0 left-0 h-full z-50 lg:z-auto lg:h-auto lg:m-0 lg:mr-5">
    <div class="flex h-full w-full flex-col">

        <!-- Logo and Close Button -->
        <div class="flex items-center justify-between mb-8 animate-fade-in">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo3.png') }}" alt="logo"
                    class="h-12 transition-transform duration-300 hover:scale-105">
                <p class="text-xl font-extrabold text-primaryDark transition-colors duration-300 hover:text-primary">
                    Nvet
                    Clinic & Lab</p>
            </div>
            <!-- Close button for mobile -->
            <button onclick="toggleSidebar()"
                class="lg:hidden text-primaryDark hover:text-red-500 transition-colors duration-300 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <nav class="flex flex-col gap-3 animate-slide-in-left">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="btn-secondary flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 text-primaryDark font-medium {{ request()->routeIs('dashboard') ? 'btn-primary text-white shadow-sm transform scale-105' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 transition-colors duration-300 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-primaryDark' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 12l9-9 9 9M4.5 10.5v10.5h15V10.5" />
                </svg>
                Dashboard
            </a>

            <a href="{{  route('absen.index') }}"
                class="btn-secondary flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 text-primaryDark font-medium {{ request()->routeIs('absen.index') ? 'btn-primary text-white shadow-sm transform scale-105' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 transition-colors duration-300 {{ request()->routeIs('absen.index') ? 'text-white' : 'text-primaryDark' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M5.5 17a4.5 4.5 0 018.9 0M12 7.5a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Absen
            </a>
            
            <!-- Users -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primaryDark transition-colors duration-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M5.5 17a4.5 4.5 0 018.9 0M12 7.5a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Users
            </a>

            <!-- Projects -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primaryDark transition-colors duration-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                Projects
            </a>

            <!-- Settings -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all btn-secondary">
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

    /* Mobile sidebar styles */
    @media (max-width: 1023px) {
        .sidebar-hidden {
            transform: translateX(-100);
        }
    }
</style>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const backdrop = document.getElementById('sidebar-backdrop');

        if (window.innerWidth < 1024) {
            // Mobile: toggle overlay sidebar and backdrop
            sidebar.classList.toggle('sidebar-hidden');
            backdrop.classList.toggle('hidden');
        } else {
            // Desktop: original behavior
            sidebar.classList.toggle('sidebar-hidden');
            mainContent.classList.toggle('content-shift');
        }
    }

    // Initialize sidebar state on mobile
    document.addEventListener('DOMContentLoaded', function () {
        if (window.innerWidth < 1024) {
            const sidebar = document.getElementById('sidebar');
            // Disable transition for initial load
            sidebar.style.transition = 'none';
            sidebar.classList.add('sidebar-hidden');
            // Re-enable transition after a short delay
            setTimeout(() => {
                sidebar.style.transition = '';
            }, 10);
        }
    });

    window.addEventListener('resize', function () {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const backdrop = document.getElementById('sidebar-backdrop');

        // Matikan animasi saat resize
        sidebar.classList.remove('sidebar-animate');
        mainContent.classList.remove('content-animate');

        if (window.innerWidth >= 1024) {
            // DESKTOP MODE
            backdrop.classList.add('hidden');

            // 🔥 PAKSA SIDEBAR SELALU TERBUKA
            sidebar.classList.remove('sidebar-hidden');
            mainContent.classList.remove('content-shift');

        } else {
            // MOBILE MODE
            mainContent.classList.remove('content-shift');

            // Default mobile: sidebar tertutup
            sidebar.classList.add('sidebar-hidden');
            backdrop.classList.add('hidden');
        }
    });



</script>
