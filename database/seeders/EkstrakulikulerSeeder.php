<?php

namespace Database\Seeders;

use App\Models\Ekstrakulikuler; // Import model Ekstrakulikuler Anda
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EkstrakulikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekskul_data = [
            [
                'nama' => 'Pramuka',
                'foto_icon' => 'https://placehold.co/100x100/4CAF50/ffffff?text=Pramuka',
                'deskripsi_singkat' => 'Mengembangkan kemandirian, kepemimpinan, dan kecintaan pada alam.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Marching Band',
                'foto_icon' => 'https://placehold.co/100x100/FFC107/000000?text=Band',
                'deskripsi_singkat' => 'Melatih kekompakan, disiplin, dan kemampuan bermusik instrumental.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Arabic Forum',
                'foto_icon' => 'https://placehold.co/100x100/007BFF/ffffff?text=Arabic',
                'deskripsi_singkat' => 'Meningkatkan kemampuan berbahasa Arab, baik lisan maupun tulisan.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'English Forum',
                'foto_icon' => 'https://placehold.co/100x100/DC3545/ffffff?text=English',
                'deskripsi_singkat' => 'Mengembangkan keterampilan berbahasa Inggris melalui diskusi dan praktik.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Pencak Silat (PN)',
                'foto_icon' => 'https://placehold.co/100x100/6C757D/ffffff?text=Silat',
                'deskripsi_singkat' => 'Melatih fisik, mental, dan nilai-nilai luhur bela diri pencak silat.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Football dan Futsal',
                'foto_icon' => 'https://placehold.co/100x100/20C997/ffffff?text=Futsal',
                'deskripsi_singkat' => 'Mengasah bakat dan strategi dalam permainan sepak bola dan futsal.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Paskibra',
                'foto_icon' => 'https://placehold.co/100x100/6F42C1/ffffff?text=Paskibra',
                'deskripsi_singkat' => 'Membentuk karakter disiplin, tanggung jawab, dan nasionalisme.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Sanggar Sastra',
                'foto_icon' => 'https://placehold.co/100x100/FD7E14/ffffff?text=Sastra',
                'deskripsi_singkat' => 'Mengeksplorasi kreativitas melalui tulisan, puisi, dan seni peran.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Musik Religi',
                'foto_icon' => 'https://placehold.co/100x100/17A2B8/ffffff?text=Religi',
                'deskripsi_singkat' => 'Mengembangkan bakat seni musik dengan nuansa Islami.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Rebana Klasik',
                'foto_icon' => 'https://placehold.co/100x100/E83E8C/ffffff?text=Rebana',
                'deskripsi_singkat' => 'Melestarikan seni musik tradisional rebana dengan sentuhan klasik.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'PMR',
                'foto_icon' => 'https://placehold.co/100x100/6610F2/ffffff?text=PMR',
                'deskripsi_singkat' => 'Melatih keterampilan pertolongan pertama dan jiwa kemanusiaan.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Tilawah',
                'foto_icon' => 'https://placehold.co/100x100/28A745/ffffff?text=Tilawah',
                'deskripsi_singkat' => 'Meningkatkan kemampuan membaca Al-Quran dengan tajwid dan irama yang baik.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Biola',
                'foto_icon' => 'https://placehold.co/100x100/FFC107/000000?text=Biola',
                'deskripsi_singkat' => 'Kursus dasar hingga mahir dalam memainkan alat musik biola.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Seni Kaligrafi',
                'foto_icon' => 'https://placehold.co/100x100/007BFF/ffffff?text=Kaligrafi',
                'deskripsi_singkat' => 'Mengeksplorasi keindahan tulisan Arab melalui seni kaligrafi.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Sanggar Tani',
                'foto_icon' => 'https://placehold.co/100x100/28a745/ffffff?text=Tani',
                'deskripsi_singkat' => 'Mengenalkan siswa pada dunia pertanian dan keberlanjutan lingkungan.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Bola Tangan',
                'foto_icon' => 'https://placehold.co/100x100/6C757D/ffffff?text=Bola+Tangan',
                'deskripsi_singkat' => 'Mengembangkan keterampilan fisik dan strategi tim dalam olahraga bola tangan.',
                'status_aktif' => true,
            ],
            [
                'nama' => 'Jurnalistik',
                'foto_icon' => 'https://placehold.co/100x100/DC3545/ffffff?text=Jurnalistik',
                'deskripsi_singkat' => 'Melatih kemampuan menulis berita, wawancara, dan editing untuk media sekolah.',
                'status_aktif' => true,
            ],
        ];

        foreach ($ekskul_data as $ekskul) {
            Ekstrakulikuler::create($ekskul);
        }
    }
}