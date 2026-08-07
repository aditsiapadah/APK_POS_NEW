<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'aditya@gmail.com'],
            [
                'name' => 'ADITYA DWI SAPUTRA',
                'password' => Hash::make('password'),
                'role_id' => Role::where('name', 'Admin')->value('id'),
            ]
        );

        // Kasir Dummy
        User::factory()->count(5)->create([
            'role_id' => Role::where('name', 'Kasir')->value('id'),
        ]);
    }
}