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
//  PIE CHART → BERDASARKAN STOK REAL ✅
// =============================

// ✅ Total stok barang di gudang
$totalStok = Barang::sum('stok');

// ✅ Total unit yang sedang dipinjam
$dipinjam = Peminjaman::where('status', 'dipinjam')->count();

// ✅ Stok tersedia = total stok + yang sedang dipinjam
$tersedia = $totalStok;

// ✅ Jika suatu saat kamu pakai status rusak:
// $tidakTersedia = Barang::where('status', 'tidak tersedia')->sum('stok');
$tidakTersedia = Barang::where('stok', 0)->count();

$statusLabels = ['tersedia', 'dipinjam', 'tidak tersedia'];

$statusCount = [
    $tersedia,
    $dipinjam,
    $tidakTersedia
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
