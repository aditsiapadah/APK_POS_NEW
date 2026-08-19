<?php

namespace Database\Seeders;

use App\Models\JenisProduk;
use Illuminate\Database\Seeder;

class JenisProdukSeeder extends Seeder
{
    public function run(): void
    {
        $jenisProduks = [
            ['nama' => 'Makanan', '' => 'Produk makanan dan snack'],
            ['nama' => 'Minuman', '' => 'Produk minuman'],
            ['nama' => 'Elektronik', '' => 'Produk elektronik dan aksesoris'],
        ];

        foreach ($jenisProduks as $jenis) {
            JenisProduk::firstOrCreate(
                ['nama' => $jenis['nama']],
                ['' => $jenis['']]
            );
        }
    }
}
