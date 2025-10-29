<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Import facade Hash untuk mengenkripsi password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan pengguna dengan email ini belum ada untuk mencegah duplikasi
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('1234'), // Ganti 'password' dengan password yang lebih kuat
                'role' => 'admin', // Set role sebagai 'admin'
                'alamat' => 'Jl. Admin Raya No. 123, Surabaya',
                'nomor_telepon' => '081234567890',
                'status' => true, // Akun aktif
                'email_verified_at' => now(), // Opsional: Tandai email sudah diverifikasi
            ]);

            $this->command->info('User Admin berhasil ditambahkan!');
        } else {
            $this->command->info('User Admin dengan email admin@example.com sudah ada.');
        }

        // Contoh untuk menambahkan kontributor berita
        if (!User::where('email', 'kontributorberita@example.com')->exists()) {
            User::create([
                'name' => 'Kontributor Pertama',
                'email' => 'kontributorberita@example.com',
                'password' => Hash::make('password'), // Ganti 'password' dengan password yang lebih kuat
                'role' => 'kontributor', // Set role sebagai 'kontributor'
                'alamat' => 'Jl. Kontributor No. 45, Surabaya',
                'nomor_telepon' => '085678901234',
                'status' => true,
                'email_verified_at' => now(),
            ]);

            $this->command->info('User Kontributor Berita berhasil ditambahkan!');
        }

        // Contoh untuk menambahkan kontributor prestasi
        if (!User::where('email', 'kontributorprestasi@example.com')->exists()) {
            User::create([
                'name' => 'Kontributor Pertama',
                'email' => 'kontributorprestasi@example.com',
                'password' => Hash::make('password'), // Ganti 'password' dengan password yang lebih kuat
                'role' => 'kontributor_prestasi', // Set role sebagai 'kontributor'
                'alamat' => 'Jl. Kontributor No. 45, Surabaya',
                'nomor_telepon' => '085678901234',
                'status' => true,
                'email_verified_at' => now(),
            ]);

            $this->command->info('User Kontributor Prestasi berhasil ditambahkan!');
        }
    }
}