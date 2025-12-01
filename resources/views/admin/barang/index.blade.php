@extends('admin.layouts.admin')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-indigo-600">Manajemen Barang</h2>
        <a href="{{ route('admin.barang.create') }}" 
           class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">
           + Tambah Barang
        </a>
    </div>

    <table class="w-full bg-white border rounded shadow">
        <thead>
            <tr class="bg-indigo-100 text-indigo-700">
                <th class="p-3">Foto</th>
                <th class="p-3">Nama</th>
                <th class="p-3">Stok</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $b)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3 text-center">
                    @if($b->foto)
                        <img src="{{ asset('storage/'.$b->foto) }}" class="h-16 mx-auto rounded">
                    @else
                        <span class="text-gray-400 italic">Tidak ada foto</span>
                    @endif
                </td>
                <td class="p-3">{{ $b->nama_barang }}</td>
                <td class="p-3">{{ $b->stok }}</td>
                <td class="p-3 flex gap-2">
                    <a href="{{ route('admin.barang.edit', $b->id) }}"
                       class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                       Edit
                    </a>

                    <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')"
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
