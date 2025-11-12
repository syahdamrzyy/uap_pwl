<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | PERKEDEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .spaced-text {
            letter-spacing: 0.25em;
        }

        /* === BUBBLE BACKGROUND (identik dengan welcome.blade.php) === */
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, #a78bfa, #6366f1);
            opacity: 0.6;
            animation: float 20s infinite ease-in-out;
            z-index: 0;
        }

        /* Posisi bubble */
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

        /* Animasi bubble */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(10deg); }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #a78bfa, #6366f1);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-indigo-500 via-purple-500 to-indigo-700 relative overflow-x-hidden">

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
            <a href="{{ route('welcome') }}" 
               class="{{ request()->routeIs('welcome') ? 'text-indigo-600 font-semibold' : 'hover:text-indigo-500' }}">
               Beranda
            </a>

            <a href="{{ route('fitur') }}" 
               class="{{ request()->routeIs('fitur') ? 'text-indigo-600 font-semibold' : 'hover:text-indigo-500' }}">
               Fitur
            </a>

            <a href="{{ route('tentang') }}" 
               class="{{ request()->routeIs('tentang') ? 'text-indigo-600 font-semibold' : 'hover:text-indigo-500' }}">
               Tentang
            </a>

            <a href="{{ route('login') }}" 
               class="px-4 py-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-medium hover:opacity-90 transition">
               Masuk
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex flex-col md:flex-row items-center justify-center p-10 flex-grow relative z-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 text-center text-sm py-4 relative z-10">
        <p>PERKEDEL – Pengelolaan Efektif Ruang & Kebutuhan Data Elektronik Logistik</p>
        <p>© 2025 PERKEDEL. Sistem Peminjaman Inventaris Kampus.</p>
    </footer>
</body>
</html>
