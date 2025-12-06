<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Perbaiki semua status menjadi lowercase
        DB::table('peminjaman')->where('status', 'Menunggu')->update(['status' => 'menunggu']);
        DB::table('peminjaman')->where('status', 'Menunggu')->update(['status' => 'menunggu']);
        DB::table('peminjaman')->where('status', 'Disetujui')->update(['status' => 'disetujui']);
        DB::table('peminjaman')->where('status', 'Ditolak')->update(['status' => 'ditolak']);
        DB::table('peminjaman')->where('status', 'Dipinjam')->update(['status' => 'dipinjam']);
        DB::table('peminjaman')->where('status', 'Dikembalikan')->update(['status' => 'dikembalikan']);
    }

    public function down(): void
    {
        // Tidak perlu rollback karena ini hanya normalisasi text
    }
};
