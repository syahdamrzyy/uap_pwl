<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // ===============================
    // USER - Tampilkan Form Peminjaman
    // ===============================
    public function create($id)
    {
        $barangDipilih = Barang::findOrFail($id);   
        $barangs = Barang::where('status', 'Tersedia')->get(); 
        return view('users.peminjaman.create', compact('barangDipilih', 'barangs'));
    }

    // ===============================
    // USER - Simpan Permintaan
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
        ]);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => now()->toDateString(),
            'status' => 'menunggu',
        ]);

        return redirect()->route('dashboard.user')->with('success', 'Peminjaman berhasil diajukan!');
    }

    // ===============================
    // ADMIN - Dashboard Permintaan
    // ===============================
    public function index()
    {
        // Statistik
        $total = Peminjaman::count();
        $pending = Peminjaman::where('status', 'menunggu')->count();
        $disetujui = Peminjaman::where('status', 'disetujui')->count();
        $ditolak = Peminjaman::where('status', 'ditolak')->count();

        // Daftar permintaan terbaru (limit 10)
        $permintaanBaru = Peminjaman::with('user', 'barang')
                            ->latest()
                            ->take(10)
                            ->get();

        return view('admin.peminjaman_admin', compact(
            'total',
            'pending',
            'disetujui',
            'ditolak',
            'permintaanBaru'
        ));
    }
}
