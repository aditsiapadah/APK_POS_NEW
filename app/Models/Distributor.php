<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_distributor',
        'nama_perusahaan',
        'telepon',
        'email',
        'alamat',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}