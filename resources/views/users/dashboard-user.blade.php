@extends('layouts.user')

@section('title', 'Dashboard User | PERKEDEL')

@section('content')

<!-- HEADER -->
<div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white p-6 rounded-2xl shadow mb-8">
    <h2 class="text-2xl font-bold">
        Selamat Datang, {{ auth()->user()->name }}! 👋
    </h2>
    <p class="text-sm mt-1">
        Kelola peminjaman barang inventaris kampus dengan mudah dan cepat.
    </p>
</div>

<!-- STATISTIK -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-600 text-sm">Barang Tersedia</p>
        <h2 class="text-3xl font-bold text-indigo-600">{{ $total_barang_tersedia }}</h2>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-600 text-sm">Sedang Dipinjam</p>
        <h2 class="text-3xl font-bold text-yellow-500">{{ $sedang_dipinjam }}</h2>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-600 text-sm">Total Riwayat Peminjaman</p>
        <h2 class="text-3xl font-bold text-purple-600">{{ $total_dipinjam }}</h2>
    </div>

</div>

<!-- DAFTAR BARANG -->
<div class="bg-white p-6 rounded-xl shadow mb-10">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Daftar Barang Tersedia</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($barangs as $barang)
        <div class="bg-white rounded-xl shadow p-4 flex flex-col">

            <!-- FOTO BARANG -->
            <div class="w-full h-48 bg-gray-100 rounded-lg mb-3 overflow-hidden flex items-center justify-center">
                @if($barang->foto)
                    <img src="{{ asset('storage/' . $barang->foto) }}"
                         class="w-full h-full object-contain p-2" alt="Foto Barang">
                @else
                    <span class="text-gray-400 text-sm italic">Tidak ada foto</span>
                @endif
            </div>

            <!-- NAMA & STOK -->
            <h3 class="font-semibold text-lg">{{ $barang->nama_barang }}</h3>
            <p class="text-sm text-gray-600 mb-2">Stok: {{ $barang->stok }}</p>

            <!-- BUTTON PINJAM -->
            <a href="{{ route('peminjaman.create', $barang->id) }}"
               class="mt-auto inline-block bg-purple-100 text-purple-600 px-3 py-2 rounded-full text-xs font-medium hover:bg-purple-200 text-center">
                Pinjam
            </a>

        </div>
        @endforeach

    </div>
</div>

<!-- AKTIVITAS USER -->
<div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>

    <div class="space-y-4">

        @forelse ($aktivitas as $item)
        <div class="flex items-start justify-between gap-4 bg-gray-50 rounded-xl p-4 border-l-4
            @if($item->status == 'dikembalikan') border-green-500
            @elseif($item->status == 'menunggu') border-yellow-400
            @elseif($item->status == 'ditolak') border-red-500
            @elseif($item->status == 'dipinjam') border-blue-500
            @else border-gray-300
            @endif">

            <!-- KIRI -->
            <div class="flex gap-4">

                <!-- ICON -->
                <div class="text-xl
                    @if($item->status == 'dikembalikan') text-green-500
                    @elseif($item->status == 'menunggu') text-yellow-400
                    @elseif($item->status == 'ditolak') text-red-500
                    @elseif($item->status == 'dipinjam') text-blue-500
                    @else text-gray-400
                    @endif">

                    @if($item->status == 'dikembalikan') ✔
                    @elseif($item->status == 'menunggu') ⏳
                    @elseif($item->status == 'ditolak') ✖
                    @elseif($item->status == 'dipinjam') 🔄
                    @else ℹ
                    @endif
                </div>

                <!-- TEKS -->
                <div>
                    <p class="font-semibold text-gray-800">
                        {{ $item->barang->nama_barang ?? '-' }}
                    </p>

                    <p class="text-sm text-gray-600">
                        Status: {{ $item->status }}
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        {{ $item->created_at->diffForHumans() }}
                    </p>
                </div>

            </div>

            <!-- KANAN -->
            <div class="flex flex-col items-end gap-2">

                <span class="text-xs px-3 py-1 rounded-full
                    @if($item->status == 'dikembalikan') bg-green-100 text-green-700
                    @elseif($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                    @elseif($item->status == 'ditolak') bg-red-100 text-red-700
                    @elseif($item->status == 'dipinjam') bg-blue-100 text-blue-700
                    @else bg-gray-100 text-gray-600
                    @endif">
                    {{ $item->status }}
                </span>

                <!-- ✅ TOMBOL KEMBALIKAN -->
                @if($item->status == 'dipinjam')
                <form action="{{ route('peminjaman.kembalikan', $item->id) }}" 
                      method="POST"
                      onsubmit="return confirm('Yakin ingin mengembalikan barang?')">
                    @csrf
                    <button type="submit"
                        class="px-3 py-1 text-xs bg-purple-600 text-white rounded-full hover:bg-purple-700">
                        Kembalikan
                    </button>
                </form>
                @endif

            </div>

        </div>
        @empty
        <p class="text-gray-500 text-sm">Belum ada aktivitas.</p>
        @endforelse

    </div>
</div>

@endsection
