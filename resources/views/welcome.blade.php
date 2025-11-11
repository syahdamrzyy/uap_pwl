<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERKEDEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* === BUBBLE BACKGROUND (warna seragam & elegan) === */
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, #a78bfa, #6366f1);
            opacity: 0.6;
            animation: float 20s infinite ease-in-out;
            z-index: 0;
        }

        .bubble-1 {
            width: 380px;
            height: 380px;
            top: -60px;
            right: 0;
            animation-delay: 0s;
        }

        .bubble-2 {
            width: 440px;
            height: 440px;
            bottom: 100px;
            left: 0;
            animation-delay: 3s;
        }

        .bubble-3 {
            width: 240px;
            height: 240px;
            top: 45%;
            right: 8%;
            animation-delay: 6s;
        }

        .bubble-4 {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
            animation-delay: 9s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(10deg); }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #a78bfa, #6366f1);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-indigo-500 via-purple-500 to-indigo-700 relative">

    <!-- Bubble background -->
    <div class="bubble bubble-1"></div>
    <div class="bubble bubble-2"></div>
    <div class="bubble bubble-3"></div>
    <div class="bubble bubble-4"></div>

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-3 px-8 flex justify-between items-center relative z-10">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded bg-gradient-to-br from-indigo-400 to-purple-500"></div>
            <h1 class="text-xl font-bold text-indigo-700">PERKEDEL</h1>
        </div>

        <div class="flex items-center gap-6 font-medium text-gray-700">
  <a href="{{ route('welcome') }}">Beranda</a>
  <a href="{{ route('fitur') }}">Fitur</a>
  <a href="{{ route('tentang') }}">Tentang</a>
            <a href="{{ route('login') }}" 
                class="px-4 py-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-medium hover:opacity-90 transition">
                Masuk
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="flex flex-col md:flex-row items-center justify-between flex-grow px-10 md:px-20 py-16 relative z-10 text-white">
        <div class="max-w-xl">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                Kelola Inventaris<br>Kampus dengan Mudah
            </h1>
            <p class="text-sm md:text-base mb-8 text-white/90">
                PERKEDEL memudahkan proses peminjaman barang inventaris kampus secara digital,
                transparan, dan efisien untuk seluruh civitas akademika.
            </p>
            <div class="flex space-x-4">
                <a href="#" class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-xl shadow hover:shadow-lg transition">
                    Mulai Sekarang
                </a>
                <a href="#" class="border border-white px-6 py-3 rounded-xl hover:bg-white/10 transition">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>

        <div class="relative mt-10 md:mt-0">
            <div class="bg-white rounded-2xl shadow-2xl p-6 w-80 md:w-96">
                <div class="flex space-x-2 mb-4">
                    <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                    <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                    <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                </div>
                <div class="space-y-3">
                    <div class="p-4 rounded-xl shadow">
                        <p class="font-medium text-gray-800">Nama Barang</p>
                        <p class="text-sm text-gray-500">Status</p>
                    </div>
                    <div class="p-4 rounded-xl shadow">
                        <p class="font-medium text-gray-800">Nama Barang</p>
                        <p class="text-sm text-gray-500">Status</p>
                    </div>
                    <div class="p-4 rounded-xl shadow">
                        <p class="font-medium text-gray-800">Nama Barang</p>
                        <p class="text-sm text-gray-500">Status</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 text-center text-sm py-4 relative z-10">
        <p>PERKEDEL – Pengelolaan Efektif Ruang & Kebutuhan Data Elektronik Logistik</p>
        <p>© 2025 PERKEDEL. Sistem Peminjaman Inventaris Kampus.</p>
    </footer>

</body>
</html>
