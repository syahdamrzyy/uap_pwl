<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('barangs')->where('status', 'Tersedia')->update(['status' => 'tersedia']);
        DB::table('barangs')->where('status', 'Tidak Tersedia')->update(['status' => 'tidak tersedia']);
        DB::table('barangs')->where('status', 'Dipinjam')->update(['status' => 'dipinjam']);
 
        DB::table('barangs')->where('status', 'TERSEDIA')->update(['status' => 'tersedia']);
        DB::table('barangs')->where('status', 'TIDAK TERSEDIA')->update(['status' => 'tidak tersedia']);
        DB::table('barangs')->where('status', 'DIPINJAM')->update(['status' => 'dipinjam']);

        DB::table('barangs')->whereNull('status')->update(['status' => 'tersedia']);
    }

    public function down(): void
    {
    }
};
