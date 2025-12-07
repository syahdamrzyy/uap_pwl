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
        /* =============================
         *  STATISTIK UTAMA
         * ============================= */
        $totalBarang = Barang::count();
        $penggunaAktif = User::whereNotNull('email_verified_at')->count();
        $pending = Peminjaman::where('status', 'menunggu')->count();
        $dikembalikan = Peminjaman::where('status', 'dikembalikan')->count();
        $totalPeminjaman = Peminjaman::count();

        $tingkatPengembalian = $totalPeminjaman > 0
            ? round(($dikembalikan / $totalPeminjaman) * 100)
            : 0;


        /* =============================
         *  LINE CHART → Tren Peminjaman
         * ============================= */
        $months = [];
        $peminjaman = [];

        for ($i = 5; $i >= 0; $i--) { 
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('M');

            $peminjaman[] = Peminjaman::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
        }


        /* =============================
         *  PIE CHART → kategori dinamis
         * ============================= */
        $kategoriList = Barang::select('kategori')
            ->groupBy('kategori')
            ->pluck('kategori');

        $kategoriCount = [];

        foreach ($kategoriList as $kategori) {
            $kategoriCount[$kategori] = Barang::where('kategori', $kategori)->count();
        }


        /* =============================
         *  RETURN
         * ============================= */
        return view('admin.dashboard-admin', compact(
            'totalBarang',
            'penggunaAktif',
            'pending',
            'tingkatPengembalian',
            'months',
            'peminjaman',
            'kategoriList',
            'kategoriCount'
        ));
    }
}
