@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')

<!-- HEADER -->
<div class="bg-gradient-to-r from-purple-500 to-blue-500 p-6 rounded-xl text-white mb-8">
    <h1 class="text-3xl font-bold">Dashboard Admin</h1>
    <p class="text-sm mt-1">Selamat datang kembali, {{ Auth::user()->name }} 👋</p>
</div>

<!-- STAT CARDS -->
<div class="grid grid-cols-4 gap-6 mb-10">

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

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-600">Tingkat Pengembalian</p>
        <h2 class="text-3xl font-bold text-purple-600">{{ $tingkatPengembalian }}%</h2>
        <p class="text-purple-600 text-sm">Tingkat pengembalian barang</p>
    </div>

</div>

<!-- GRAPHICS -->
<div class="grid grid-cols-2 gap-6">

    <!-- LINE CHART -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-medium mb-2">Tren Peminjaman & Pengembalian</h3>
        <p class="text-sm text-gray-500 mb-4">Data 6 bulan terakhir (dummy)</p>
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
    const lineChart = new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [
                {
                    label: 'Peminjaman',
                    data: [45, 52, 47, 55, 50, 68],
                    borderColor: '#4F46E5',
                    backgroundColor: '#4F46E533',
                    tension: 0.4
                },
                {
                    label: 'Pengembalian',
                    data: [40, 48, 43, 50, 47, 62],
                    borderColor: '#3B82F6',
                    backgroundColor: '#3B82F633',
                    tension: 0.4
                }
            ]
        }
    });

    const pieChart = new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: ['Elektronik', 'Proyektor', 'Aksesoris', 'Lainnya'],
            datasets: [{
                data: [35, 25, 23, 15],
                backgroundColor: ['#6366F1', '#93C5FD', '#A5B4FC', '#C7D2FE']
            }]
        }
    });
</script>

@endsection
