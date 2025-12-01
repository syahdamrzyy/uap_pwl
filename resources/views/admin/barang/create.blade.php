@extends('admin.layouts.admin')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">

    <h2 class="text-xl font-bold text-indigo-600 mb-4">Tambah Barang</h2>

    <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="block mb-2 font-semibold">Nama Barang</label>
        <input type="text" name="nama_barang" class="w-full p-2 border rounded mb-4" required>

        <label class="block mb-2 font-semibold">Deskripsi</label>
        <textarea name="deskripsi" class="w-full p-2 border rounded mb-4" required></textarea>

        <label class="block mb-2 font-semibold">Stok</label>
        <input type="number" name="stok" class="w-full p-2 border rounded mb-4" required>

        <label class="block mb-2 font-semibold">Foto Barang (opsional)</label>
        <input type="file" name="foto" class="w-full p-2 border rounded mb-4" accept="image/*">

        <button class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">
            Simpan
        </button>
    </form>
</div>
@endsection
