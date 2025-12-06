<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\User;
use App\Models\Peminjaman;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $penggunaAktif = User::whereNotNull('email_verified_at')->count();
        $pending = Peminjaman::where('status', 'menunggu')->count();
        $dikembalikan = Peminjaman::where('status', 'dikembalikan')->count();
        $totalPeminjaman = Peminjaman::count();

        $tingkatPengembalian = $totalPeminjaman > 0
            ? round(($dikembalikan / $totalPeminjaman) * 100)
            : 0;

        return view('admin.dashboard-admin', compact(
            'totalBarang',
            'penggunaAktif',
            'pending',
            'tingkatPengembalian'
        ));
    }
}
