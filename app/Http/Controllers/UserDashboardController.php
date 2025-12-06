<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;

class UserDashboardController extends Controller
{
    public function index()
    {
        $total_barang_tersedia = Barang::where('stok', '>', 0)->count();

        $sedang_dipinjam = Peminjaman::where('user_id', auth()->id())
            ->where('status', 'disetujui')
            ->count();

        $total_dipinjam = Peminjaman::where('user_id', auth()->id())->count();

        $barangs = Barang::where('stok', '>', 0)->get();

        $aktivitas = Peminjaman::where('user_id', auth()->id())
            ->latest()
            ->take(10)
            ->get();

        return view('users.dashboard-user', compact(
            'total_barang_tersedia',
            'sedang_dipinjam',
            'total_dipinjam',
            'barangs',
            'aktivitas'
        ));
    }
}
