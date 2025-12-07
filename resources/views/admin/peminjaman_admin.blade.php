@extends('admin.layout')

@section('title', 'Manajemen Peminjaman')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-4">Manajemen Peminjaman Barang</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <table class="w-full border rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">User</th>
                <th class="p-3 text-left">Barang</th>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @foreach($peminjamans as $p)
            <tr class="border-t">
                <td class="p-3">{{ $p->user->name }}</td>
                <td class="p-3">{{ $p->barang->nama_barang }}</td>
                <td class="p-3">{{ $p->tanggal_pinjam }}</td>

                <td class="p-3">
                    <span class="px-3 py-1 rounded text-sm
                        @if($p->status == 'Menunggu') bg-yellow-100 text-yellow-700
                        @elseif($p->status == 'Dipinjam') bg-green-100 text-green-700
                        @elseif($p->status == 'Ditolak') bg-red-100 text-red-700
                        @elseif($p->status == 'Dikembalikan') bg-blue-100 text-blue-700
                        @else bg-gray-100 text-gray-700
                        @endif">
                        {{ $p->status }}
                    </span>
                </td>

                <td class="p-3 text-center space-x-2">

    @if($p->status == 'menunggu')
        <form action="{{ route('admin.peminjaman.approve', $p->id) }}"
              method="POST" class="inline">
            @csrf
            <button class="bg-green-600 text-white px-3 py-1 rounded">
                Approve
            </button>
        </form>

        <form action="{{ route('admin.peminjaman.reject', $p->id) }}"
              method="POST" class="inline">
            @csrf
            <button class="bg-red-600 text-white px-3 py-1 rounded">
                Reject
            </button>
        </form>

    @else
        <span class="text-gray-500 italic">
            Selesai
        </span>
    @endif

</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endsection
