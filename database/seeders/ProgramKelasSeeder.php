<?php

namespace Database\Seeders;

use App\Models\ProgramKelas; // Import model ProgramKelas Anda
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'nama' => 'Tahfidz',
                'foto_icon' => 'https://placehold.co/100x100/3498db/ffffff?text=Tahfidz',
                'deskripsi' => 'Program unggulan Tahfidz untuk mencetak generasi penghafal Al-Quran dengan metode yang efektif dan pendampingan intensif.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Kitab Salaf',
                'foto_icon' => 'https://placehold.co/100x100/2ecc71/ffffff?text=Kitab+Salaf',
                'deskripsi' => 'Fokus pada pengkajian kitab-kitab kuning klasik untuk memahami dasar-dasar ilmu agama Islam secara mendalam.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Sains dan Riset',
                'foto_icon' => 'https://placehold.co/100x100/e74c3c/ffffff?text=Sains',
                'deskripsi' => 'Mengembangkan minat dan bakat siswa di bidang sains melalui eksperimen, penelitian, dan proyek ilmiah inovatif.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Prestasi Seni dan Olahraga',
                'foto_icon' => 'https://placehold.co/100x100/f39c12/ffffff?text=Seni+Olahraga',
                'deskripsi' => 'Mewadahi bakat siswa dalam berbagai cabang seni dan olahraga, dengan pelatihan profesional untuk meraih prestasi.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Reguler',
                'foto_icon' => 'https://placehold.co/100x100/9b59b6/ffffff?text=Reguler',
                'deskripsi' => 'Program pendidikan umum yang mengikuti kurikulum nasional, dipadukan dengan pendidikan karakter dan keagamaan.',
                'status_aktif' => true,
            ],
        ];

        foreach ($programs as $program) {
            ProgramKelas::create($program);
        }
    }
}