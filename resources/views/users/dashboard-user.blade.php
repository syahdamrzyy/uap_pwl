@extends('layouts.user')

@section('title', 'Dashboard User | PERKEDEL')

@section('content')

  <!-- Header Section -->
  <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white p-6 rounded-2xl shadow-md mb-8">
    <h2 class="text-2xl font-bold">Selamat Datang, User! 👋</h2>
    <p class="text-sm mt-1">Kelola peminjaman barang inventaris kampus dengan mudah dan cepat</p>
  </div>

  <!-- Statistik Section -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
      <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-400 to-purple-500"></div>
      <div>
        <h3 class="text-3xl font-bold text-gray-800">45</h3>
        <p class="text-gray-500 text-sm">Barang Tersedia</p>
      </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
      <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-400 to-purple-500"></div>
      <div>
        <h3 class="text-3xl font-bold text-gray-800">2</h3>
        <p class="text-gray-500 text-sm">Sedang Dipinjam</p>
      </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4">
      <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-400 to-purple-500"></div>
      <div>
        <h3 class="text-3xl font-bold text-gray-800">12</h3>
        <p class="text-gray-500 text-sm">Total Dipinjam</p>
      </div>
    </div>
  </div>

  <!-- Daftar Barang Section -->
  <div class="bg-white rounded-2xl shadow p-6 mb-8">
    <div class="flex justify-between items-center mb-4">
      <h3 class="font-semibold text-gray-800 text-lg">Daftar Barang Tersedia</h3>
      <a href="#" class="text-sm text-indigo-600 font-medium hover:underline">Lihat Semua →</a>
    </div>

    <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 16.65z" />
      </svg>
      <input type="text" placeholder="Cari barang di inventaris" class="bg-transparent ml-2 flex-1 focus:outline-none text-sm text-gray-700">
    </div>

    <!-- Card Barang -->
    <div class="space-y-3">
      <div class="flex justify-between items-center bg-gray-50 rounded-xl p-4">
        <div>
          <h4 class="font-semibold text-gray-800">Laptop</h4>
          <p class="text-sm text-gray-500">Status</p>
        </div>
        <div class="flex gap-2">
          <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs font-medium">Tersedia</span>
          <span class="px-3 py-1 rounded-full bg-purple-100 text-purple-600 text-xs font-medium">Pinjam</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Aktivitas Terbaru Section -->
  <div class="bg-white rounded-2xl shadow p-6">
    <h3 class="font-semibold text-gray-800 text-lg mb-4">Aktivitas Terbaru</h3>

    <div class="space-y-4">
      <!-- Item 1 -->
      <div class="flex items-start gap-4 bg-gray-50 rounded-xl p-4 border-l-4 border-green-500">
        <div class="text-green-500 text-xl">✔</div>
        <div>
          <p class="font-semibold text-gray-800">Peminjaman Disetujui</p>
          <p class="text-sm text-gray-600">Laptop</p>
          <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">Disetujui</span>
          <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
        </div>
      </div>

      <!-- Item 2 -->
      <div class="flex items-start gap-4 bg-gray-50 rounded-xl p-4 border-l-4 border-yellow-400">
        <div class="text-yellow-400 text-xl">⏳</div>
        <div>
          <p class="font-semibold text-gray-800">Pengajuan Peminjaman</p>
          <p class="text-sm text-gray-600">Laptop</p>
          <span class="text-xs text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">Menunggu</span>
          <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
        </div>
      </div>

      <!-- Item 3 -->
      <div class="flex items-start gap-4 bg-gray-50 rounded-xl p-4 border-l-4 border-green-500">
        <div class="text-green-500 text-xl">✔</div>
        <div>
          <p class="font-semibold text-gray-800">Pengembalian Selesai</p>
          <p class="text-sm text-gray-600">Laptop</p>
          <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">Selesai</span>
          <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
        </div>
      </div>

      <!-- Item 4 -->
      <div class="flex items-start gap-4 bg-gray-50 rounded-xl p-4 border-l-4 border-red-500">
        <div class="text-red-500 text-xl">✖</div>
        <div>
          <p class="font-semibold text-gray-800">Peminjaman Ditolak</p>
          <p class="text-sm text-gray-600">Laptop</p>
          <span class="text-xs text-red-600 bg-red-100 px-2 py-1 rounded-full">Ditolak</span>
          <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
        </div>
      </div>
    </div>
  </div>

@endsection
