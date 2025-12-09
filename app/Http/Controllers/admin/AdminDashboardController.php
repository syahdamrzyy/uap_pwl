<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\User;
use App\Models\Peminjaman;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ✅ CACHE 60 DETIK
        $totalBarang = Cache::remember('total_barang', 60, fn () => Barang::count());

        $penggunaAktif = Cache::remember('pengguna_aktif', 60, function () {
            return User::whereNotNull('email_verified_at')->count();
        });

        $pending = Cache::remember('pending_peminjaman', 30, function () {
            return Peminjaman::where('status', 'menunggu')->count();
        });

        $dikembalikan = Cache::remember('dikembalikan', 30, function () {
            return Peminjaman::where('status', 'dikembalikan')->count();
        });

        $totalPeminjaman = Cache::remember('total_peminjaman', 60, fn () => Peminjaman::count());

        $tingkatPengembalian = $totalPeminjaman > 0
            ? round(($dikembalikan / $totalPeminjaman) * 100)
            : 0;

        // =============================
        // ✅ LINE CHART → CACHE
        // =============================
        $chart = Cache::remember('chart_peminjaman_6bulan', 60, function () {
            $months = [];
            $peminjaman = [];

            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $months[] = $month->format('M');

                $peminjaman[] = Peminjaman::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count();
            }

            return compact('months', 'peminjaman');
        });

        // =============================
        // ✅ PIE CHART → CACHE
        // =============================
        $pie = Cache::remember('pie_stok', 60, function () {

            $totalStok = Barang::sum('stok');
            $dipinjam = Peminjaman::where('status', 'dipinjam')->count();
            $tidakTersedia = Barang::where('stok', 0)->count();

            return [
                'statusLabels' => ['tersedia', 'dipinjam', 'tidak tersedia'],
                'statusCount'  => [$totalStok, $dipinjam, $tidakTersedia]
            ];
        });

        return view('admin.dashboard-admin', [
            'totalBarang' => $totalBarang,
            'penggunaAktif' => $penggunaAktif,
            'pending' => $pending,
            'months' => $chart['months'],
            'peminjaman' => $chart['peminjaman'],
            'statusLabels' => $pie['statusLabels'],
            'statusCount' => $pie['statusCount']
        ]);
    }
}
