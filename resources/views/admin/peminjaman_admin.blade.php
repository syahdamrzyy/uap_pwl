@extends('admin.layout')

@section('content')

<style>
    .header-gradient {
        background: linear-gradient(90deg, #6a5af9, #3b82f6, #06b6d4);
    }
</style>

<div class="p-6">

    <!-- HEADER -->
    <div class="header-gradient text-white rounded-xl p-5 shadow mb-6">
        <h2 class="text-2xl font-semibold">Permintaan Peminjaman</h2>
        <p>Kelola semua permintaan peminjaman barang</p>
    </div>

    <!-- STATISTIK -->
    <div class="grid grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-5 rounded-xl shadow">
            <h3 class="text-sm">Total Permintaan</h3>
            <p class="text-3xl font-semibold mt-2">{{ $total }}</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <h3 class="text-sm">Pending</h3>
            <p class="text-3xl font-semibold mt-2 text-yellow-500">
                {{ $pending }}
            </p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <h3 class="text-sm">Disetujui</h3>
            <p class="text-3xl font-semibold mt-2 text-green-600">
                {{ $disetujui }}
            </p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <h3 class="text-sm">Ditolak</h3>
            <p class="text-3xl font-semibold mt-2 text-red-600">
                {{ $ditolak }}
            </p>
        </div>

    </div>

    <!-- DAFTAR PERMINTAAN -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h3 class="text-lg font-semibold">Daftar Permintaan Terbaru</h3>
        <p class="text-sm text-gray-500 mb-4">Permintaan peminjaman barang dari pengguna</p>

        <div class="space-y-4">

            @foreach ($permintaanBaru as $pinjam)

                <div class="border rounded-xl p-4 flex items-start justify-between">

                    <div class="flex gap-4">
                        <!-- Ikon -->
                        @if($pinjam->status == 'disetujui')
                            <div class="text-green-600 text-4xl">✔️</div>
                        @elseif($pinjam->status == 'ditolak')
                            <div class="text-red-600 text-4xl">❌</div>
                        @else
                            <div class="text-gray-600 text-4xl">📦</div>
                        @endif

                        <!-- Info -->
                        <div>
                            <p class="font-semibold text-lg">{{ $pinjam->user->name }}</p>
                            <p class="text-gray-600">{{ $pinjam->barang->nama_barang }}</p>

                            <p class="text-sm text-gray-500 mt-1">
                                Tanggal: {{ $pinjam->tanggal_pinjam }}
                            </p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="flex gap-2">

                        @if($pinjam->status == 'menunggu')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">Pending</span>
                        @elseif($pinjam->status == 'disetujui')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">Disetujui</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">Ditolak</span>
                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

@endsection
