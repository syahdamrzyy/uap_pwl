@extends('layouts.user')

@section('title', 'Tambah Barang | PERKEDEL')

@section('content')
  <!-- Header Section -->
  <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white p-6 rounded-2xl shadow-md mb-8">
    <h2 class="text-2xl font-bold">Tambah Barang Baru</h2>
    <p class="text-sm mt-1">Tambahkan barang baru ke inventaris kampus</p>
  </div>

  <!-- Form Section -->
  <div class="bg-white rounded-2xl shadow p-8 max-w-md mx-auto">
    <form action="{{ route('barang.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label for="nama_barang" class="block text-gray-700 font-semibold mb-2">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" required
               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <div class="mb-4">
        <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" placeholder="Tulis deskripsi barang..."
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none h-20"></textarea>
      </div>

      <div class="mb-6">
        <label for="stok" class="block text-gray-700 font-semibold mb-2">Stok:</label>
        <input type="number" id="stok" name="stok" required
               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <div class="flex gap-4 justify-center">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-semibold">Simpan</button>
        <a href="{{ route('barang.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition font-semibold">Kembali</a>
      </div>
    </form>
  </div>
@endsection
