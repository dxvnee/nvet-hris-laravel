<div id="loading-screen"
    class="fixed inset-0 bg-primaryExtraLight flex items-center justify-center z-50 transition-opacity duration-1000">
    <div class="text-center">

        <!-- Spinner -->
<div class="animate-spin rounded-full h-12 w-12 border-8 border-primary border-t-transparent mx-auto"></div>
        <p class="mt-4 text-gray-600">Loading...</p>
    </div>
</div>

<script>
    window.addEventListener('load', function () {
        const loadingScreen = document.getElementById('loading-screen');
        loadingScreen.style.opacity = '0';
        setTimeout(() => {
            loadingScreen.style.display = 'none';
        }, 1000); // Match transition duration
    });
</script>
