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
            'keperluan' => 'nullable|string|max:255',
        ]);

        Peminjaman::create([
            'user_id'        => Auth::id(),
            'barang_id'      => $request->barang_id,
            'tanggal_pinjam' => now()->toDateString(),
            'status'         => 'menunggu', 
        ]);

        return redirect()->route('dashboard.user')
            ->with('success', 'Peminjaman berhasil diajukan!');
    }

    // ============================
    // ADMIN - LIHAT SEMUA PERMINTAAN
    // ============================
    public function index()
    {
        $peminjamans = Peminjaman::with('user', 'barang')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.peminjaman_admin', compact('peminjamans'));
    }

    // ============================
    // ✅ ADMIN - APPROVE
    // ============================
    public function approve($id)
    {
        DB::transaction(function () use ($id) {
            $pinjam = Peminjaman::with('barang')->findOrFail($id);

            if ($pinjam->status !== 'menunggu') return;

            $barang = $pinjam->barang;
            if (!$barang || $barang->stok <= 0) return;

            // Kurangi stok
            $barang->stok -= 1;
            $barang->status = $barang->stok > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $barang->save();

            // Update peminjaman
            $pinjam->status = 'dipinjam';
            $pinjam->tanggal_pinjam = now()->toDateString();
            $pinjam->save();
        });

        return back()->with('success', 'Permintaan berhasil disetujui.');
    }

    // ============================
    // ❌ ADMIN - REJECT
    // ============================
    public function reject($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status !== 'menunggu') {
            return back()->with('error', 'Tidak dapat menolak permintaan ini.');
        }

        $pinjam->status = 'ditolak';
        $pinjam->save();

        return back()->with('success', 'Permintaan berhasil ditolak.');
    }

    // ============================
    // 🔄 USER - KEMBALIKAN BARANG
    // ============================
    public function kembalikan($id)
{
    DB::transaction(function () use ($id) {

        $pinjam = Peminjaman::with('barang')->findOrFail($id);

        // Hanya bisa dikembalikan jika status Dipinjam
        if ($pinjam->status !== 'dipinjam') {
            return;
        }

        $barang = $pinjam->barang;

        if ($barang) {
            // Tambah stok kembali
            $barang->stok += 1;
            $barang->status = 'Tersedia';
            $barang->save();
        }

        // Update status peminjaman
        $pinjam->status = 'dikembalikan';
        $pinjam->tanggal_kembali = now()->toDateString();
        $pinjam->save();
    });

    return redirect()->route('dashboard.user')
        ->with('success', 'Barang berhasil dikembalikan. Terima kasih!');
}

// ============================
// ✅ ADMIN - LIST BARANG DIKEMBALIKAN
// ============================
public function dikembalikanAdmin()
{
    $peminjamans = Peminjaman::with('user', 'barang')
        ->where('status', 'Dikembalikan')
        ->latest()
        ->get();

    return view('admin.peminjaman_dikembalikan', compact('peminjamans'));
}

}
