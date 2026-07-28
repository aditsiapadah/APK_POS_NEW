<?php

namespace App\Models;

<<<<<<< HEAD
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 49def9d (update projek)
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> e5fa7ac (Update fitur baru)
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
<<<<<<< HEAD
<<<<<<< HEAD

    protected $table = 'produk';


=======
    use HasFactory;

    protected $table = 'produk';

>>>>>>> 49def9d (update projek)
=======
    use HasFactory;

    protected $table = 'produk';

>>>>>>> e5fa7ac (Update fitur baru)
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
<<<<<<< HEAD


=======
>>>>>>> 49def9d (update projek)
=======
>>>>>>> e5fa7ac (Update fitur baru)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD
<<<<<<< HEAD

}
=======
}
>>>>>>> 49def9d (update projek)
=======
}
>>>>>>> e5fa7ac (Update fitur baru)
