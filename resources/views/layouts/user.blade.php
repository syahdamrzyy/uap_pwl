<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard User | PERKEDEL')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9fafb;
    }
  </style>
</head>
<body class="flex flex-col min-h-screen">

  <!-- Navbar -->
  <nav class="bg-white shadow-md py-3 px-8 flex justify-between items-center">
    <div class="flex items-center gap-2">
      <div class="w-8 h-8 rounded bg-gradient-to-br from-indigo-400 to-purple-500"></div>
      <h1 class="text-xl font-bold text-indigo-700">PERKEDEL</h1>
    </div>

    <div class="flex items-center gap-4">
      <div class="flex items-center gap-2 bg-gray-100 px-4 py-1 rounded-full">
        <div class="w-4 h-4 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500"></div>
        <span class="font-medium text-gray-700 text-sm">User</span>
        <span class="text-gray-500 text-sm">Mahasiswa</span>
      </div>
      <a href="{{ route('logout') }}" 
         class="bg-red-500 text-white px-4 py-1 rounded-full text-sm font-medium hover:bg-red-600 transition">
         Keluar
      </a>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="flex-grow p-8">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 text-center text-sm py-4 mt-8">
    <p>PERKEDEL - Pengelolaan Efektif Ruang & Kebutuhan Data Elektronik Logistik</p>
    <p>© 2025 PERKEDEL. Sistem Peminjaman Inventaris Kampus.</p>
  </footer>

</body>
</html>
