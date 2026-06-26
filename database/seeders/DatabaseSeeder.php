<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama'     => 'Admin',
            'email'    => 'admin@sambungpangan.id',
            'telepon'  => '081234567890',
            'password' => Hash::make('admin123'),
            'role'     => 'administrator',
        ]);
    }
}