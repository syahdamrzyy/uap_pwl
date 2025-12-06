@extends('admin.layout')

@section('title', 'Permintaan Peminjaman')

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
            <p class="text-3xl font-semibold mt-2 text-yellow-500">{{ $pending }}</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <h3 class="text-sm">Disetujui</h3>
            <p class="text-3xl font-semibold mt-2 text-green-600">{{ $disetujui }}</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <h3 class="text-sm">Ditolak</h3>
            <p class="text-3xl font-semibold mt-2 text-red-600">{{ $ditolak }}</p>
        </div>
    </div>

    <!-- DAFTAR PERMINTAAN -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold mb-3">Permintaan Terbaru</h3>
        <p class="text-sm text-gray-500 mb-4">Daftar pengajuan peminjaman pengguna</p>

        <div class="space-y-4">

            @forelse ($permintaanBaru as $pinjam)
                @php
                    $color = match($pinjam->status) {
                        'menunggu' => 'yellow',
                        'disetujui' => 'green',
                        'ditolak' => 'red',
                        default => 'gray',
                    };
                    $icon = match($pinjam->status) {
                        'menunggu' => '⏳',
                        'disetujui' => '✔️',
                        'ditolak' => '❌',
                        default => '📦',
                    };
                @endphp

                <div class="border rounded-xl p-4 flex items-center justify-between hover:bg-gray-50 transition">

                    <!-- LEFT: Info -->
                    <div class="flex items-start gap-4">

                        <!-- Icon -->
                        <div class="text-4xl text-{{ $color }}-600">
                            {{ $icon }}
                        </div>

                        <div>
                            <p class="font-semibold text-gray-800 text-lg">{{ $pinjam->user->name }}</p>
                            <p class="text-gray-600">{{ $pinjam->barang->nama_barang }}</p>

                            <p class="text-xs text-gray-500 mt-1">
                                Tanggal Pinjam: {{ $pinjam->tanggal_pinjam ?? '-' }}
                            </p>
                        </div>

                    </div>

                    <!-- RIGHT: Status + Button -->
                    <div class="flex flex-col items-end gap-2">

                        <!-- STATUS BADGE -->
                        <span class="px-3 py-1 rounded-full bg-{{ $color }}-100 text-{{ $color }}-700 text-sm">
                            {{ ucfirst($pinjam->status) }}
                        </span>

                        <!-- ACTION BUTTONS (ONLY WHEN MENUNGGU) -->
                        @if($pinjam->status == 'menunggu')
                            <div class="flex gap-2">

                                <!-- APPROVE -->
                                <form action="{{ route('admin.peminjaman.approve', $pinjam->id) }}" method="POST">
                                    @csrf
                                    <button class="px-4 py-1.5 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                                        Setujui
                                    </button>
                                </form>

                                <!-- REJECT -->
                                <form action="{{ route('admin.peminjaman.reject', $pinjam->id) }}" method="POST">
                                    @csrf
                                    <button class="px-4 py-1.5 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
                                        Tolak
                                    </button>
                                </form>

                            </div>
                        @endif

                    </div>

                </div>

            @empty
                <p class="text-gray-500 text-sm">Belum ada permintaan peminjaman.</p>
            @endforelse

        </div>
    </div>

</div>

@endsection
