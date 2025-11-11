@if (session('success'))
    <div class="fixed top-5 right-5 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg animate-fade-in-down">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="fixed top-5 right-5 z-50 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg animate-fade-in-down">
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div class="fixed top-5 right-5 z-50 bg-yellow-500 text-black px-6 py-3 rounded-lg shadow-lg animate-fade-in-down">
        {{ session('warning') }}
    </div>
@endif

<style>
@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-down {
    animation: fade-in-down 0.3s ease-out;
}
</style>

<script>
    // Auto close setelah 4 detik
    setTimeout(() => {
        document.querySelectorAll('.fixed.top-5.right-5').forEach(el => el.remove());
    }, 4000);
</script>
