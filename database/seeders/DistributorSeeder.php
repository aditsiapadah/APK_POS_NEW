<?php

namespace Database\Seeders;

use App\Models\Distributor;
use Illuminate\Database\Seeder;

class DistributorSeeder extends Seeder
{
    public function run(): void
    {
        Distributor::create([
            'nama_distributor' => 'PT Sumber Makmur',
            'nama_perusahaan' => 'Sumber Makmur Abadi',
            'telepon' => '081234567890',
            'email' => 'sumbermakmur@gmail.com',
            'alamat' => 'Jakarta',
        ]);

        Distributor::create([
            'nama_distributor' => 'CV Berkah Jaya',
            'nama_perusahaan' => 'Berkah Jaya Sejahtera',
            'telepon' => '082345678901',
            'email' => 'berkahjaya@gmail.com',
            'alamat' => 'Bandung',
        ]);

        Distributor::create([
            'nama_distributor' => 'PT Indo Supplier',
            'nama_perusahaan' => 'Indo Supplier Nusantara',
            'telepon' => '083456789012',
            'email' => 'indosupplier@gmail.com',
            'alamat' => 'Surabaya',
        ]);

        Distributor::create([
            'nama_distributor' => 'CV Maju Bersama',
            'nama_perusahaan' => 'Maju Bersama Official',
            'telepon' => '084567890123',
            'email' => 'majubersama@gmail.com',
            'alamat' => 'Yogyakarta',
        ]);
    }
}