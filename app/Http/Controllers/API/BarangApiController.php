<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class BarangApiController extends Controller
{
    // ✅ GET /api/barang
    public function index()
    {
        $barang = Barang::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil diambil',
            'total'   => $barang->count(),
            'data'    => $barang
        ]);
    }

    // ✅ GET /api/barang/{id}
    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail barang berhasil diambil',
            'data'    => $barang
        ]);
    }
}
