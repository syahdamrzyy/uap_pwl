<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class PeminjamanApiController extends Controller
{
    // ✅ GET /api/peminjaman
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'barang'])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data peminjaman berhasil diambil',
            'total'   => $peminjaman->count(),
            'data'    => $peminjaman
        ]);
    }

    // ✅ GET /api/peminjaman/user/{id}
    public function byUser($id)
    {
        $data = Peminjaman::with('barang')
                    ->where('user_id', $id)
                    ->latest()
                    ->get();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat peminjaman user',
            'total'   => $data->count(),
            'data'    => $data
        ]);
    }

    // ✅ GET /api/peminjaman-filter?status=menunggu
    public function filter()
    {
        $status = request('status');

        if (!$status) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter status wajib diisi'
            ], 400);
        }

        $data = Peminjaman::with(['user', 'barang'])
                    ->where('status', $status)
                    ->latest()
                    ->get();

        return response()->json([
            'success' => true,
            'message' => "Data peminjaman dengan status '$status'",
            'total'   => $data->count(),
            'data'    => $data
        ]);
    }
}
