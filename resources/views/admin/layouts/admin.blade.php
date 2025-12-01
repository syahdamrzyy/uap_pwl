<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin PERKEDEL</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f8fc;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <nav class="bg-white shadow px-8 py-3 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded bg-gradient-to-br from-indigo-400 to-purple-500"></div>
            <h1 class="text-xl font-bold text-indigo-700">PERKEDEL — Admin</h1>
        </div>

        <div class="flex items-center gap-4">
            <span class="px-4 py-1 rounded-full bg-indigo-100 text-indigo-700 font-medium text-sm">
                Admin
            </span>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="bg-red-500 text-white px-4 py-1 rounded-full text-sm font-medium hover:bg-red-600 transition">
                Keluar
            </a>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
            </form>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow p-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 text-center text-sm py-4">
        <p>PERKEDEL – Pengelolaan Efektif Ruang & Kebutuhan Data Elektronik Logistik</p>
        <p>© 2025 PERKEDEL. Sistem Peminjaman Inventaris Kampus.</p>
    </footer>

</body>
</html>
