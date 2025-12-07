<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\User;
use App\Models\Peminjaman;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
{
    // =============================
    //  STATISTIK UTAMA
    // =============================
    $totalBarang = \App\Models\Barang::count();
    $penggunaAktif = \App\Models\User::whereNotNull('email_verified_at')->count();
    $pending = \App\Models\Peminjaman::where('status', 'menunggu')->count();
    $dikembalikan = \App\Models\Peminjaman::where('status', 'dikembalikan')->count();
    $totalPeminjaman = \App\Models\Peminjaman::count();

    $tingkatPengembalian = $totalPeminjaman > 0
        ? round(($dikembalikan / $totalPeminjaman) * 100)
        : 0;

    // =============================
    //  LINE CHART → Tren Peminjaman
    // =============================
    $months = [];
    $peminjaman = [];

    for ($i = 5; $i >= 0; $i--) {
        $month = \Carbon\Carbon::now()->subMonths($i);
        $months[] = $month->format('M');

        $peminjaman[] = \App\Models\Peminjaman::whereMonth('created_at', $month->month)
            ->whereYear('created_at', $month->year)
            ->count();
    }

    // =============================
    //  PIE CHART → STATUS BARANG ✅
    // =============================
    $statusLabels = ['Tersedia', 'Dipinjam', 'Tidak Tersedia'];

    $statusCount = [
        \App\Models\Barang::where('status', 'Tersedia')->count(),
        \App\Models\Barang::where('status', 'Dipinjam')->count(),
        \App\Models\Barang::where('status', 'Tidak Tersedia')->count(),
    ];

    // =============================
    //  RETURN
    // =============================
    return view('admin.dashboard-admin', compact(
        'totalBarang',
        'penggunaAktif',
        'pending',
        'months',
        'peminjaman',
        'statusLabels',
        'statusCount'
    ));
}
}
