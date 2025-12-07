@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')

<!-- HEADER -->
<div class="bg-gradient-to-r from-purple-500 to-blue-500 p-6 rounded-xl text-white mb-8">
    <h1 class="text-3xl font-bold">Dashboard Admin</h1>
    <p class="text-sm mt-1">Selamat datang kembali, {{ Auth::user()->name }} 👋</p>
</div>

<!-- STAT CARDS -->
<div class="grid grid-cols-3 gap-6 mb-10">

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-600">Total Barang</p>
        <h2 class="text-3xl font-bold text-indigo-600">{{ $totalBarang }}</h2>
        <p class="text-green-600 text-sm">Inventaris kampus</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-600">Pengguna Aktif</p>
        <h2 class="text-3xl font-bold text-blue-600">{{ $penggunaAktif }}</h2>
        <p class="text-green-600 text-sm">Sudah verifikasi email</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-600">Permintaan Pending</p>
        <h2 class="text-3xl font-bold text-yellow-500">{{ $pending }}</h2>
        <p class="text-yellow-600 text-sm">Menunggu persetujuan admin</p>
    </div>

</div>

<!-- GRAPHICS -->
<div class="grid grid-cols-2 gap-6">

    <!-- LINE CHART -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-medium mb-2">Tren Peminjaman</h3>
        <p class="text-sm text-gray-500 mb-4">6 bulan terakhir</p>
        <canvas id="lineChart" height="150"></canvas>
    </div>

    <!-- PIE CHART -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-medium mb-4">Distribusi Kategori Barang</h3>
        <canvas id="pieChart" height="150"></canvas>
    </div>

</div>

<!-- FOOTER -->
<div class="text-center text-sm text-gray-500 mt-16">
    PERKEDEL – Pengelolaan Efektif Ruang & Kebutuhan Data Elektronik Logistik<br>
    © 2025 PERKEDEL. Sistem Peminjaman Inventaris Kampus.
</div>


<!-- CHART.JS -->
<script>
    /* =============================
     *  LINE CHART (Dinamis)
     * ============================= */
    const lineChart = new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Peminjaman',
                data: {!! json_encode($peminjaman) !!},
                borderColor: '#4F46E5',
                backgroundColor: '#4F46E533',
                tension: 0.4
            }]
        }
    });


  /* =============================
 *  PIE CHART — Elektronik vs Alat Tulis (Real-time)
 * ============================= */

const pieChart = new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: @json($statusLabels),
        datasets: [{
            data: @json($statusCount),
            backgroundColor: [
                '#22c55e', // Tersedia (Hijau)
                '#facc15', // Dipinjam (Kuning)
                '#ef4444'  // Tidak Tersedia (Merah)
            ]
        }]
    }
});

</script>


@endsection
