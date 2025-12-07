<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // ============================
    // USER - AJUKAN PEMINJAMAN
    // ============================
    public function create($id)
    {
        $barangDipilih = Barang::findOrFail($id);
        return view('users.peminjaman.create', compact('barangDipilih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'keperluan' => 'required|string|max:255',
        ]);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => now()->toDateString(),
            'status' => 'menunggu',
        ]);

        return redirect()->route('dashboard.user')
            ->with('success', 'Peminjaman berhasil diajukan!');
    }

    // ============================
    // ADMIN - LIHAT PERMINTAAN
    // ============================
    public function index()
    {
        $peminjamans = Peminjaman::with('user', 'barang')
            ->latest()
            ->get();

        return view('admin.peminjaman_admin', compact('peminjamans'));
    }

    // ============================
    // ✅ ADMIN - APPROVE
    // ============================
    public function approve($id)
    {
        DB::transaction(function () use ($id) {

            $pinjam = Peminjaman::findOrFail($id);

            if ($pinjam->status !== 'menunggu') return;

            $barang = Barang::findOrFail($pinjam->barang_id);

            if ($barang->stok <= 0) return;

            // Kurangi stok
            $barang->stok -= 1;
            if ($barang->stok == 0) {
                $barang->status = 'Tidak Tersedia';
            }
            $barang->save();

            // Update status pinjam
            $pinjam->status = 'disetujui';
            $pinjam->save();
        });

        return back()->with('success', 'Peminjaman disetujui!');
    }

    // ============================
    // ❌ ADMIN - REJECT
    // ============================
    public function reject($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status !== 'menunggu') {
            return back()->with('error', 'Data tidak valid.');
        }

        $pinjam->status = 'ditolak';
        $pinjam->save();

        return back()->with('success', 'Peminjaman ditolak!');
    }
}
