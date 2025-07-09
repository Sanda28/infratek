<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'PT Infratek Global',
            'email' => 'infratek@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // Ganti password sesuai kebutuhan
            'nama_perusahaan' => 'PT Infratek Global',
            'alamat' => 'Jl. Teknologi No. 45, Bogor',
            'telepon' => '0211234567',
            'role' => 'perusahaan',
            'remember_token' => Str::random(10),
        ]);

        // Optional: admin
        User::create([
            'name' => 'Admin Kominfo',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // Ganti password sesuai kebutuhan
            'nama_perusahaan' => 'Dinas Kominfo',
            'alamat' => 'Jl. Pemda No.1, Bogor',
            'telepon' => '02511234567',
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);
    }
}
