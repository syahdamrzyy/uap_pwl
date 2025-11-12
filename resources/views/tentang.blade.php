<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang | PERKEDEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, #a78bfa, #6366f1);
            opacity: 0.5;
            animation: float 18s infinite ease-in-out;
            z-index: 0;
        }
        .bubble-1 { width: 360px; height: 360px; top: -80px; right: 5%; }
        .bubble-2 { width: 420px; height: 420px; bottom: 100px; left: -10%; }
        .bubble-3 { width: 260px; height: 260px; top: 40%; right: 10%; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-25px); }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-indigo-500 via-purple-500 to-indigo-700 relative text-white">

    <!-- Bubble Background -->
    <div class="bubble bubble-1"></div>
    <div class="bubble bubble-2"></div>
    <div class="bubble bubble-3"></div>

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-3 px-8 flex justify-between items-center relative z-10">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded bg-gradient-to-br from-indigo-400 to-purple-500"></div>
            <h1 class="text-xl font-bold text-indigo-700">PERKEDEL</h1>
        </div>

        <div class="flex items-center gap-6 font-medium text-gray-700">
            <a href="{{ route('welcome') }}">Beranda</a>
            <a href="{{ route('fitur') }}">Fitur</a>
            <a href="{{ route('tentang') }}" class="text-indigo-600 font-semibold">Tentang</a>
            <a href="{{ route('login') }}" 
                class="px-4 py-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-medium hover:opacity-90 transition">
                Masuk
            </a>
        </div>
    </nav>

    <!-- Section Tentang -->
    <section class="flex flex-col items-center justify-center flex-grow px-6 md:px-20 py-16 relative z-10">
        <div class="max-w-4xl text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-6">Tentang PERKEDEL</h1>
            <p class="text-white/90 leading-relaxed text-lg mb-10">
                <strong>PERKEDEL (Pengelolaan Efektif Ruang & Kebutuhan Data Elektronik Logistik)</strong> 
                merupakan sistem digital yang dirancang untuk mempermudah pengelolaan dan peminjaman inventaris kampus secara efisien,
                transparan, dan akuntabel. Sistem ini hadir sebagai solusi modern untuk menggantikan proses manual yang rentan
                terhadap kesalahan dan keterlambatan data.
            </p>

            <div class="grid md:grid-cols-3 gap-8 mt-10">
                <div class="bg-white/10 rounded-2xl p-6 shadow-lg backdrop-blur-sm hover:bg-white/20 transition">
                    <h3 class="text-2xl font-bold mb-3">🎯 Visi</h3>
                    <p class="text-sm text-white/80 leading-relaxed">
                        Mewujudkan sistem manajemen inventaris kampus yang cerdas, efisien, dan terintegrasi dengan kebutuhan civitas akademika.
                    </p>
                </div>

                <div class="bg-white/10 rounded-2xl p-6 shadow-lg backdrop-blur-sm hover:bg-white/20 transition">
                    <h3 class="text-2xl font-bold mb-3">💡 Misi</h3>
                    <ul class="text-sm text-white/80 leading-relaxed list-disc list-inside space-y-2">
                        <li>Digitalisasi proses administrasi inventaris kampus.</li>
                        <li>Meningkatkan transparansi dan akuntabilitas peminjaman.</li>
                        <li>Menyediakan data inventaris secara real-time.</li>
                    </ul>
                </div>

                <div class="bg-white/10 rounded-2xl p-6 shadow-lg backdrop-blur-sm hover:bg-white/20 transition">
                    <h3 class="text-2xl font-bold mb-3">👥 Tim Kami</h3>
                    <p class="text-sm text-white/80 leading-relaxed">
                        Dikembangkan oleh mahasiswa yang berfokus pada inovasi teknologi kampus, 
                        dengan kolaborasi antara tim pengembang, UI/UX designer, dan peneliti sistem informasi.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-16">
            <a href="{{ route('fitur') }}" 
               class="bg-white text-indigo-600 font-semibold px-8 py-3 rounded-xl shadow hover:shadow-lg hover:bg-gray-100 transition">
               Lihat Fitur PERKEDEL
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 text-center text-sm py-4 relative z-10">
        <p>PERKEDEL – Pengelolaan Efektif Ruang & Kebutuhan Data Elektronik Logistik</p>
        <p>© 2025 PERKEDEL. Sistem Peminjaman Inventaris Kampus.</p>
    </footer>

</body>
</html>
