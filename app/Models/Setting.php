<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
    'nama_toko',
    'alamat',
    'telepon',
    'email',
    'logo',

    'bahasa',
    'mata_uang',
    'per_page',

    'nama_aplikasi',
    'versi_aplikasi',
    'deskripsi_aplikasi',
    'developer',
];
}