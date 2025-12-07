<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <!-- TAILWIND CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
<aside class="w-64 min-h-screen bg-white shadow-md flex flex-col justify-between">
    <div>
        <div class="p-6 font-bold text-xl text-indigo-600">
            PERKEDEL
        </div>

        <nav class="mt-4">

            {{-- DASHBOARD --}}
            <a href="/admin"
               class="block py-3 px-6 rounded-r-full font-medium
               {{ Request::is('admin') || Request::is('admin/dashboard') 
                    ? 'bg-blue-600 text-white' 
                    : 'text-gray-700 hover:bg-gray-100' }}">
                Dashboard
            </a>

            {{-- MANAJEMEN BARANG --}}
            <a href="{{ route('admin.barang.index') }}"
   class="block py-3 px-6 rounded-r-full font-medium
   {{ Request::is('admin/barang*') 
        ? 'bg-blue-600 text-white' 
        : 'text-gray-700 hover:bg-gray-100' }}">
    Manajemen Inventaris
</a>

            {{-- PERMINTAAN PEMINJAMAN --}}
            <a href="{{ route('admin.peminjaman.index') }}"
               class="block py-3 px-6 rounded-r-full font-medium
               {{ Request::is('admin/peminjaman*') 
                    ? 'bg-blue-600 text-white' 
                    : 'text-gray-700 hover:bg-gray-100' }}">
                Permintaan Peminjaman
            </a>

                <a href="{{ route('admin.peminjaman.dikembalikan') }}"
   class="block px-4 py-2 rounded hover:bg-purple-100">
    Barang Dikembalikan
</a>


        </nav>
    </div>



    <div class="p-6">
    <div class="text-sm text-gray-600 mb-2">
        Admin Kampus<br>
        <span class="text-xs text-gray-400">Administrator</span>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="block w-full bg-red-600 text-white py-2 px-4 rounded text-center">
            Keluar
        </button>
    </form>
</div>

</aside>


    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
