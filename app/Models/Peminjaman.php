<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'barang_id','user_id','tanggal_pinjam','tanggal_kembali','status','keperluan'
    ];

    public function barang()
    {
        return $this->belongsTo(\App\Models\Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
