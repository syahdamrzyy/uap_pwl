<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user ? $user->id : null;

        // Barang (untuk ditampilkan di daftar barang)
        $barangs = Barang::take(5)->get();

        // Statistik
        $total_barang_tersedia = Barang::where('stok', '>', 0)->count();
        $sedang_dipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $total_dipinjam = Peminjaman::count();

        // Aktivitas user (5 terakhir) — jika user belum login, kosongkan
        $aktivitas = collect();
        if ($userId) {
            $aktivitas = Peminjaman::with('barang')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('users.dashboard-user', compact(
            'barangs',
            'total_barang_tersedia',
            'sedang_dipinjam',
            'total_dipinjam',
            'aktivitas'
        ));
    }
}
