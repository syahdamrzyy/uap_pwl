@extends('layouts.user')

@section('title', 'Form Peminjaman | PERKEDEL')

@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Form Peminjaman Barang
    </h2>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg">
            <ul class="text-sm">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- INFO BARANG --}}
    <div class="mb-6 p-4 bg-purple-50 border border-purple-200 rounded-xl flex items-center gap-4">

        <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-100 border">
            @if ($barangDipilih->foto)
                <img src="{{ asset('storage/'.$barangDipilih->foto) }}" 
                     class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-gray-400 text-sm">
                    No Image
                </div>
            @endif
        </div>

        <div>
            <p class="font-semibold text-lg text-purple-700">
                {{ $barangDipilih->nama_barang }}
            </p>
            <p class="text-gray-600 text-sm">
                Stok tersedia: {{ $barangDipilih->stok }}
            </p>
        </div>
    </div>

    {{-- FORM --}}
    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        {{-- HIDDEN BARANG ID --}}
        <input type="hidden" name="barang_id" value="{{ $barangDipilih->id }}">

        {{-- KEPERLUAN --}}
        <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-1">
                Keperluan
            </label>

            <input type="text"
                name="keperluan"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-purple-500"
                placeholder="Contoh: Untuk presentasi kelas"
                required>
        </div>

        {{-- BUTTON --}}
        <button type="submit"
            class="w-full px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow">
            Ajukan Peminjaman
        </button>

    </form>
</div>

@endsection
