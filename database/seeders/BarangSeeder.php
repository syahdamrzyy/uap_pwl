<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::create([
            'nama_barang' => 'Laptop',
            'deskripsi' => 'Laptop untuk keperluan akademik dan administrasi.',
            'stok' => 10,
        ]);

        Barang::create([
            'nama_barang' => 'Proyektor',
            'deskripsi' => 'Proyektor untuk presentasi dan kuliah.',
            'stok' => 5,
        ]);

        Barang::create([
            'nama_barang' => 'Kabel HDMI',
            'deskripsi' => 'Kabel HDMI untuk menghubungkan perangkat.',
            'stok' => 20,
        ]);

        Barang::create([
            'nama_barang' => 'Mouse Wireless',
            'deskripsi' => 'Mouse nirkabel untuk komputer.',
            'stok' => 15,
        ]);

        Barang::create([
            'nama_barang' => 'Keyboard',
            'deskripsi' => 'Keyboard mekanik untuk mengetik.',
            'stok' => 12,
        ]);
    }
}
