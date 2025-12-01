<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // Tampilkan form peminjaman
    public function create($id)
    {
        $barangDipilih = Barang::findOrFail($id);   
        $barangs = Barang::where('status', 'Tersedia')->get(); 
        return view('users.peminjaman.create', compact('barangDipilih', 'barangs'));
    }

    // Simpan peminjaman
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
        ]);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => now()->toDateString(),
            'status' => 'menunggu', // HARUS sesuai enum di DB
        ]);

        return redirect()->route('dashboard.user')->with('success', 'Peminjaman berhasil diajukan!');
    }
}
