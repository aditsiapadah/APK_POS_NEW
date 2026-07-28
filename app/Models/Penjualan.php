<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemPenjualan;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; // Sesuaikan jika nama tabel Anda berbeda

    protected $guarded = ['id'];

    // Relasi ke User (Kasir)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Item Penjualan
    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id');
    }
}
