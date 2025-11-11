<!DOCTYPE html>
<html lang="id" x-data="{ mode: 'login' }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERKEDEL | Login & Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-700 min-h-screen flex flex-col">

<div class="bg-white rounded-2xl shadow-2xl p-10 w-full max-w-md transition-all">

    <!-- Navbar -->
    <nav class="bg-white/10 backdrop-blur-md text-white flex justify-between items-center px-10 py-4 shadow-md">
        <div class="flex items-center space-x-2">
            <div class="bg-blue-500 w-8 h-8 rounded"></div>
            <h1 class="text-xl font-bold">PERKEDEL</h1>
        </div>
        <ul class="flex space-x-8">
            <li><a href="/" class="hover:text-blue-300">Beranda</a></li>
            <li><a href="#" class="hover:text-blue-300">Fitur</a></li>
            <li><a href="#" class="hover:text-blue-300">Tentang</a></li>
        </ul>
        <a href="#" @click="mode='login'" class="bg-white text-indigo-600 font-semibold px-5 py-2 rounded-xl hover:bg-gray-100 transition">Masuk</a>
    </nav>

    <!-- Konten Utama -->
    <div class="flex flex-1 items-center justify-center px-6 py-12">
        <div class="bg-white rounded-2xl shadow-2xl p-10 w-full max-w-md transition-all">

            <!-- LOGIN -->
            <div x-show="mode === 'login'" x-transition>
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Masuk ke Akun</h2>

                @if (session('error'))
    <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-700 font-medium">
        {{ session('error') }}
    </div>
@endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-2 rounded-xl font-semibold hover:opacity-90 transition">
                        Masuk
                    </button>
                </form>

                <p class="text-center text-gray-600 text-sm mt-6">
                    Belum punya akun?
                    <a href="#" @click="mode='register'" class="text-indigo-600 font-medium hover:underline">Daftar di sini</a>
                </p>
            </div>

            <!-- REGISTER -->
            <div x-show="mode === 'register'" x-transition>
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Buat Akun Baru</h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                        <input type="text" name="name" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-600 text-sm p-2 rounded">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-2 rounded-xl font-semibold hover:opacity-90 transition">
                        Daftar Sekarang
                    </button>

                    <p class="text-center text-gray-600 text-sm mt-4">
                        Sudah punya akun?
                        <a href="#" @click="mode='login'" class="text-indigo-600 font-medium hover:underline">Masuk di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white text-center py-4 text-sm">
        PERKEDEL – Pengelolaan Efektif Ruang & Kebutuhan Data Elektronik Logistik <br>
        © 2025 PERKEDEL. Sistem Peminjaman Barang Kampus.
    </footer>

</body>
</html>
