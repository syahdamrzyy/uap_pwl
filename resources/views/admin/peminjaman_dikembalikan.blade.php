@extends('admin.layout')

@section('title', 'Barang Dikembalikan')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-4">Daftar Barang Dikembalikan</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">User</th>
                <th class="p-3 text-left">Barang</th>
                <th class="p-3 text-left">Tanggal Pinjam</th>
                <th class="p-3 text-left">Tanggal Kembali</th>
                <th class="p-3 text-left">Status</th>
            </tr>
        </thead>
        <tbody>

            @forelse($peminjamans as $p)
            <tr class="border-t">
                <td class="p-3">{{ $p->user->name }}</td>
                <td class="p-3">{{ $p->barang->nama_barang }}</td>
                <td class="p-3">{{ $p->tanggal_pinjam }}</td>
                <td class="p-3">{{ $p->tanggal_kembali }}</td>
                <td class="p-3">
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-sm">
                        Dikembalikan
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-5 text-center text-gray-500">
                    Belum ada barang yang dikembalikan.
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>

</div>

@endsection
