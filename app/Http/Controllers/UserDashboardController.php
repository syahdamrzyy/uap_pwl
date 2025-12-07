<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;

class UserDashboardController extends Controller
{
    public function index()
{
    $userId = auth()->id();

    // Statistik
    $total_barang_tersedia = Barang::where('stok', '>', 0)->count();

    $sedang_dipinjam = Peminjaman::where('user_id', $userId)
        ->where('status', 'dipinjam') // ✅ HARUS SAMA PERSIS
        ->count();

    $total_dipinjam = Peminjaman::where('user_id', $userId)->count();

    // Barang tersedia (stok > 0)
    $barangs = Barang::where('stok', '>', 0)->get();

    // Aktivitas user
    $aktivitas = Peminjaman::with('barang')
        ->where('user_id', $userId)
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
