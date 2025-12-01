@extends('layouts.user')

@section('title', 'Form Peminjaman | PERKEDEL')

@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Form Peminjaman
    </h2>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-1">Pilih Barang</label>

            <select name="barang_id" 
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id }}" 
                        {{ $barang->id == $barangDipilih->id ? 'selected' : '' }}>
                        {{ $barang->nama_barang }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-1">Keperluan</label>
            <input 
                type="text" 
                name="keperluan"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-purple-500 focus:outline-none"
                placeholder="Tuliskan keperluan peminjaman">
        </div>

        <button class="px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow">
            Ajukan Peminjaman
        </button>
    </form>

</div>

@endsection
