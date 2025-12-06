<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Normalisasi: jadikan semuanya lowercase
        DB::table('barangs')->where('status', 'Tersedia')->update(['status' => 'tersedia']);
        DB::table('barangs')->where('status', 'Tidak Tersedia')->update(['status' => 'tidak tersedia']);
        DB::table('barangs')->where('status', 'Dipinjam')->update(['status' => 'dipinjam']);

        // Jika ada yang uppercase semua
        DB::table('barangs')->where('status', 'TERSEDIA')->update(['status' => 'tersedia']);
        DB::table('barangs')->where('status', 'TIDAK TERSEDIA')->update(['status' => 'tidak tersedia']);
        DB::table('barangs')->where('status', 'DIPINJAM')->update(['status' => 'dipinjam']);

        // Jika ada status null → isi default
        DB::table('barangs')->whereNull('status')->update(['status' => 'tersedia']);
    }

    public function down(): void
    {
        // Tidak perlu rollback karena ini hanya data cleanup
    }
};
