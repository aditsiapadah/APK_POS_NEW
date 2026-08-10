<?php

namespace Database\Seeders;

use App\Models\JenisProduk;
use Illuminate\Database\Seeder;

class JenisProdukSeeder extends Seeder
{
    public function run(): void
    {
        $jenisProduks = [
            ['nama' => 'Makanan', 'deskripsi' => 'Produk makanan dan snack'],
            ['nama' => 'Minuman', 'deskripsi' => 'Produk minuman'],
            ['nama' => 'Elektronik', 'deskripsi' => 'Produk elektronik dan aksesoris'],
        ];

        foreach ($jenisProduks as $jenis) {
            JenisProduk::firstOrCreate(
                ['nama' => $jenis['nama']],
                ['deskripsi' => $jenis['deskripsi']]
            );
        }
    }
}
