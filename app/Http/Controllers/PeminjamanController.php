<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // USER - form peminjaman
    public function create($id)
    {
        $barangDipilih = Barang::findOrFail($id);
        // tampilkan hanya barang yang berstatus "tersedia" dan stok > 0
        $barangs = Barang::where('status', 'Tersedia')->where('stok', '>', 0)->get();
        return view('users.peminjaman.create', compact('barangDipilih', 'barangs'));
    }

    // USER - store peminjaman (ajukan)
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'keperluan' => 'nullable|string|max:255',
        ]);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => now()->toDateString(),
            'status' => 'menunggu', // lowercase
        ]);

        return redirect()->route('dashboard.user')->with('success', 'Peminjaman berhasil diajukan!');
    }

    // ADMIN - list permintaan
    public function index()
    {
        $total = Peminjaman::count();
        $pending = Peminjaman::where('status', 'menunggu')->count();
        $disetujui = Peminjaman::where('status', 'disetujui')->count();
        $ditolak = Peminjaman::where('status', 'ditolak')->count();

        $permintaanBaru = Peminjaman::with('user', 'barang')
                            ->latest()
                            ->take(50)
                            ->get();

        return view('admin.peminjaman_admin', compact('total','pending','disetujui','ditolak','permintaanBaru'));
    }

  public function approve($id)
{
    $pinjam = Peminjaman::findOrFail($id);
    $barang = $pinjam->barang;

    if ($pinjam->status !== 'menunggu') {
        return back()->with('error', 'Permintaan ini sudah diproses.');
    }

    if ($barang->stok <= 0) {
        return back()->with('error', 'Stok barang habis!');
    }

    // Kurangi stok
    $barang->stok -= 1;

    // Jika stok habis setelah dipinjam, ubah status
    $barang->status = $barang->stok > 0 ? 'tersedia' : 'tidak tersedia';
    $barang->save();

    // Update peminjaman
    $pinjam->update([
        'status' => 'disetujui',
        'tanggal_pinjam' => now()->toDateString(),
    ]);

    return back()->with('success', 'Peminjaman berhasil disetujui!');
}



public function reject(Request $request, $id)
{
    $pinjam = Peminjaman::findOrFail($id);

    if ($pinjam->status !== 'menunggu') {
        return back()->with('error', 'Permintaan ini sudah diproses sebelumnya.');
    }

    $pinjam->status = 'ditolak';
    $pinjam->save();

    return back()->with('success', 'Permintaan berhasil ditolak.');
}

public function kembalikan($id)
{
    $pinjam = Peminjaman::findOrFail($id);
    $barang = $pinjam->barang;

    if ($pinjam->status !== 'disetujui') {
        return back()->with('error', 'Hanya peminjaman yang sedang berlangsung yang bisa dikembalikan.');
    }

    // Tambah stok
    $barang->stok += 1;
    $barang->status = 'tersedia';
    $barang->save();

    // Update peminjaman
    $pinjam->update([
        'status' => 'dikembalikan',
        'tanggal_kembali' => now()->toDateString(),
    ]);

    return back()->with('success', 'Barang berhasil dikembalikan!');
}
}
