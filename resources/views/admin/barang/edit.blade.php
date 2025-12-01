@extends('admin.layouts.admin')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">

    <h2 class="text-xl font-bold text-indigo-600 mb-4">Edit Barang</h2>

    <form action="{{ route('admin.barang.update', $barang->id) }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama Barang --}}
        <label class="block mb-2 font-semibold">Nama Barang</label>
        <input
            type="text"
            name="nama_barang"
            value="{{ $barang->nama_barang }}"
            class="w-full p-2 border rounded mb-4"
            required
        >

        {{-- Deskripsi --}}
        <label class="block mb-2 font-semibold">Deskripsi</label>
        <textarea
            name="deskripsi"
            class="w-full p-2 border rounded mb-4"
            required>{{ $barang->deskripsi }}</textarea>

        {{-- Stok --}}
        <label class="block mb-2 font-semibold">Stok</label>
        <input
            type="number"
            name="stok"
            value="{{ $barang->stok }}"
            class="w-full p-2 border rounded mb-4"
            required
        >

        {{-- Foto Barang --}}
        <label class="block mb-2 font-semibold">Foto Barang (opsional)</label>

        @if($barang->foto)
            <img src="{{ asset('storage/'.$barang->foto) }}"
                 class="h-24 rounded mb-3 border">
        @else
            <p class="text-gray-500 italic mb-3">Belum ada foto.</p>
        @endif

        <input
            type="file"
            name="foto"
            class="w-full p-2 border rounded mb-4"
            accept="image/*"
        >

        {{-- Tombol --}}
        <div class="flex justify-between mt-4">
            <a href="{{ route('admin.barang.index') }}"
               class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
               Kembali
            </a>

            <button class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">
                Update
            </button>
        </div>

    </form>
</div>
@endsection
