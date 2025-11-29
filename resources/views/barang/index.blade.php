@extends('layouts.user')

@section('title', 'Data Barang | PERKEDEL')

@section('content')
  <!-- Header Section -->
  <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white p-6 rounded-2xl shadow-md mb-8">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold">Data Barang</h2>
        <p class="text-sm mt-1">Kelola inventaris barang kampus dengan mudah</p>
      </div>
      <a href="{{ route('dashboard.user') }}" class="bg-white text-indigo-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition">← Kembali ke Dashboard</a>
    </div>
  </div>

  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <!-- Daftar Barang Section -->
  <div class="bg-white rounded-2xl shadow p-6 mb-8">
    <div class="flex justify-between items-center mb-4">
      <h3 class="font-semibold text-gray-800 text-lg">Daftar Barang</h3>
      @if($user->role === 'admin')
        <a href="{{ route('barang.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">+ Tambah Barang</a>
      @endif
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white">
        <thead class="bg-indigo-600 text-white">
          <tr>
            <th class="py-3 px-4 text-left">ID</th>
            <th class="py-3 px-4 text-left">Nama Barang</th>
            <th class="py-3 px-4 text-left">Deskripsi</th>
            <th class="py-3 px-4 text-left">Stok</th>
            @if($user->role === 'admin')
              <th class="py-3 px-4 text-left">Aksi</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($barangs as $barang)
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4">{{ $barang->id }}</td>
            <td class="py-3 px-4">{{ $barang->nama_barang }}</td>
            <td class="py-3 px-4">{{ $barang->deskripsi }}</td>
            <td class="py-3 px-4">{{ $barang->stok }}</td>
            @if($user->role === 'admin')
            <td class="py-3 px-4">
              <a href="{{ route('barang.edit', $barang->id) }}" class="text-indigo-600 hover:text-indigo-800 mr-2">Edit</a> |
              <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin hapus?')">Hapus</button>
              </form>
            </td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
