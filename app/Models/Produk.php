<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{

    protected $table = 'produk';


    protected $fillable = [
        'user_id',
        'nama',
        'jenis_produk',
        'foto',
        'harga_beli',
        'harga_jual',
        'stok',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

}