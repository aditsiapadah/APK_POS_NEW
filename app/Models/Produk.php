<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 49def9d (update projek)
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
<<<<<<< HEAD

    protected $table = 'produk';


=======
    use HasFactory;

    protected $table = 'produk';

>>>>>>> 49def9d (update projek)
    protected $fillable = [
        'user_id',
        'nama',
        'jenis_produk',
        'foto',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

<<<<<<< HEAD


=======
>>>>>>> 49def9d (update projek)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD

}
=======
}
>>>>>>> 49def9d (update projek)
