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
    // USER - FORM AJUKAN PEMINJAMAN
    // ============================
    public function create($id)
    {
        $barangDipilih = Barang::findOrFail($id);
        return view('users.peminjaman.create', compact('barangDipilih'));
    }

    // ============================
    // USER - SIMPAN PEMINJAMAN
    // ============================
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
            ->with('menunggu_admin', 'Peminjaman berhasil diajukan! Menunggu persetujuan admin.');
    }

    // ============================
    // ADMIN - LIST PERMINTAAN
    // ============================
    public function index()
    {
        $peminjamans = Peminjaman::with('user', 'barang')->latest()->get();
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

            $barang->stok -= 1;
            $barang->status = $barang->stok > 0 ? 'tersedia' : 'tidak tersedia';
            $barang->save();

            $pinjam->status = 'dipinjam';
            $pinjam->tanggal_pinjam = now()->toDateString();
            $pinjam->save();
        });

        return back()->with('approve_sukses', 'Peminjaman berhasil disetujui.');
    }

    // ============================
    // ❌ ADMIN - REJECT
    // ============================
    public function reject(Request $request, $id)
{
    $pinjam = Peminjaman::findOrFail($id);

    if ($pinjam->status !== 'menunggu') {
        return back()->with('reject_gagal', 'Tidak bisa menolak permintaan ini.');
    }

    $request->validate([
        'alasan_ditolak' => 'required|string'
    ]);

    $pinjam->status = 'ditolak';
    $pinjam->alasan_ditolak = $request->alasan_ditolak;
    $pinjam->save();

    return back()->with('reject_gagal', 'Peminjaman berhasil ditolak.');
}

    // ============================
    // ✅ USER - KEMBALIKAN BARANG
    // ============================
    public function kembalikan($id)
    {
        DB::transaction(function () use ($id) {

            $pinjam = Peminjaman::with('barang')->findOrFail($id);

            if ($pinjam->status !== 'dipinjam') return;

            $barang = $pinjam->barang;
            if ($barang) {
                $barang->stok += 1;
                $barang->status = 'tersedia';
                $barang->save();
            }

            $pinjam->status = 'dikembalikan';
            $pinjam->tanggal_kembali = now()->toDateString();
            $pinjam->save();
        });

        return redirect()->route('dashboard.user')
            ->with('kembali_sukses', 'Barang berhasil dikembalikan. Terima kasih!');
    }

    // ============================
    // ✅ ADMIN - LIST DIKEMBALIKAN
    // ============================
    public function dikembalikanAdmin()
    {
        $peminjamans = Peminjaman::with('user', 'barang')
            ->where('status', 'dikembalikan')
            ->latest()
            ->get();

        return view('admin.peminjaman_dikembalikan', compact('peminjamans'));
    }
}
