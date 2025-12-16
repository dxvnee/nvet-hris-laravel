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
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house"
                    viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg>
                Dashboard
            </a>

            @if(auth()->user()->role === 'pegawai')
                <a href="{{  route('absen.index') }}"
                    class="btn-secondary flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 text-primaryDark font-medium {{ request()->routeIs('absen.index') ? 'btn-primary text-white shadow-sm transform scale-105' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock"
                        viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                    </svg>
                    Absen
                </a>

                <a href="{{  route('absen.riwayat') }}"
                    class="btn-secondary flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 text-primaryDark font-medium {{ request()->routeIs('absen.riwayat') ? 'btn-primary text-white shadow-sm transform scale-105' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-clipboard-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                        <path
                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                        <path
                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                    </svg>
                    Riwayat
                </a>
            @endif

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('users.index') }}"
                    class="btn-secondary flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 text-primaryDark font-medium {{ request()->routeIs('users.*') ? 'btn-primary text-white shadow-sm transform scale-105' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people"
                        viewBox="0 0 16 16">
                        <path
                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                    </svg>
                    Pegawai
                </a>

                <a href="{{ route('penggajian.index') }}"
                    class="btn-secondary flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 text-primaryDark font-medium {{ request()->routeIs('penggajian.*') ? 'btn-primary text-white shadow-sm transform scale-105' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2"
                        viewBox="0 0 16 16">
                        <path
                            d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                    </svg>
                    Penggajian
                </a>
            @endif

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