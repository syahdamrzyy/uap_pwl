@extends('admin.layout')

@section('content')

<div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-indigo-700 tracking-wide">
            Manajemen Barang
        </h2>

        <a href="{{ route('admin.barang.create') }}" 
           class="px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl shadow 
                  hover:bg-indigo-700 transition-all duration-200">
           + Tambah Barang
        </a>
    </div>

    {{-- Pencarian --}}
    <div class="mb-4">
        <input type="text" placeholder="Cari barang..."
               class="w-64 px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                      focus:ring-2 focus:ring-indigo-400 focus:outline-none">
    </div>

    {{-- Tabel --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 shadow">
        <table class="w-full text-left">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="p-3">Foto</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Stok</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($barang as $b)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-3 text-center">
                        @if($b->foto)
                            <img src="{{ asset('storage/'.$b->foto) }}" 
                                 class="h-16 w-16 object-cover mx-auto rounded-lg shadow">
                        @else
                            <span class="text-gray-400 italic">Tidak ada foto</span>
                        @endif
                    </td>

                    <td class="p-3 font-medium text-gray-700">{{ $b->nama_barang }}</td>

                    <td class="p-3 font-semibold text-gray-700">{{ $b->stok }}</td>

                    <td class="p-3 flex justify-center gap-3">

                        {{-- Edit --}}
                        <a href="{{ route('admin.barang.edit', $b->id) }}"
                            class="px-4 py-1.5 bg-yellow-400 text-white rounded-lg shadow 
                                   hover:bg-yellow-500 transition">
                            Edit
                        </a>

                        {{-- Hapus --}}
                        <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')"
                                class="px-4 py-1.5 bg-red-500 text-white rounded-lg shadow 
                                       hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
