<?php

namespace Database\Seeders;

use App\Models\Berita; // Import model Berita
use App\Models\KategoriBerita; // Import model KategoriBerita
use App\Models\User; // Import model User (untuk user_id)
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // Untuk menggunakan Str::slug()

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = KategoriBerita::all(); // Ambil semua kategori berita yang sudah di-seed
        if ($kategoris->isEmpty()) {
            $this->call(KategoriSeeder::class); // Panggil KategoriBeritaSeeder jika kosong
            $kategoris = KategoriBerita::all(); // Ambil lagi setelah di-seed
        }

        // Data berita contoh
        $beritas = [
            [
                'judul' => 'Pengumuman Libur Hari Raya Idul Adha 1446 H',
                'deskripsi' => 'Diberitahukan kepada seluruh siswa dan staf MTs Abadiyah Gabus Pati bahwa kegiatan belajar mengajar akan diliburkan mulai tanggal 16 hingga 18 Juni 2025 dalam rangka menyambut Hari Raya Idul Adha 1446 H. Kegiatan akan dimulai kembali pada hari Kamis, 19 Juni 2025. Selamat Hari Raya Idul Adha!',
                'kategori' => 'Pengumuman',
                'header_image' => 'https://placehold.co/1200x600/007bff/ffffff?text=Pengumuman_Libur'
            ],
            [
                'judul' => 'Kegiatan Class Meeting Semester Genap 2024/2025',
                'deskripsi' => 'MTs Abadiyah Gabus Pati sukses menyelenggarakan kegiatan Class Meeting antar kelas pada tanggal 10-14 Juni 2025. Berbagai lomba menarik seperti futsal, bola voli, dan cerdas cermat memeriahkan acara ini. Kegiatan ini bertujuan untuk mempererat tali silaturahmi dan menumbuhkan sportivitas di kalangan siswa.',
                'kategori' => 'Kegiatan Sekolah',
                'header_image' => 'https://placehold.co/1200x600/28a745/ffffff?text=Class_Meeting'
            ],
            [
                'judul' => 'Siswa MTs Abadiyah Meraih Juara 1 Lomba Pidato Bahasa Arab Tingkat Kabupaten',
                'deskripsi' => 'Selamat kepada Ananda Siti Aminah dari kelas IX C yang berhasil meraih Juara 1 dalam Lomba Pidato Bahasa Arab tingkat Kabupaten Pati. Prestasi ini menjadi bukti komitmen sekolah dalam mengembangkan potensi akademik dan non-akademik siswa.',
                'kategori' => 'Prestasi Siswa',
                'header_image' => 'https://placehold.co/1200x600/ffc107/333333?text=Juara_Pidato'
            ],
            [
                'judul' => 'Workshop Kurikulum Merdeka Belajar untuk Guru',
                'deskripsi' => 'Para guru MTs Abadiyah Gabus Pati mengikuti workshop intensif mengenai implementasi Kurikulum Merdeka Belajar. Workshop ini diharapkan dapat meningkatkan kualitas pembelajaran dan inovasi di kelas.',
                'kategori' => 'Pendidikan',
                'header_image' => 'https://placehold.co/1200x600/17a2b8/ffffff?text=Workshop_Kurikulum'
            ],
            [
                'judul' => 'Pentingnya Literasi Digital di Era Modern',
                'deskripsi' => 'Literasi digital menjadi keterampilan esensial bagi siswa di era informasi ini. Artikel ini membahas mengapa penting bagi siswa untuk mengembangkan kemampuan literasi digital mereka.',
                'kategori' => 'Umum',
                'header_image' => 'https://placehold.co/1200x600/6f42c1/ffffff?text=Literasi_Digital'
            ],
            [
                'judul' => 'Sosialisasi PPDB Tahun Ajaran 2025/2026',
                'deskripsi' => 'MTs Abadiyah Gabus Pati membuka pendaftaran peserta didik baru untuk tahun ajaran 2025/2026. Informasi lengkap mengenai persyaratan dan jadwal pendaftaran dapat diakses di website resmi sekolah.',
                'kategori' => 'Pengumuman',
                'header_image' => 'https://placehold.co/1200x600/fd7e14/ffffff?text=PPDB_2025'
            ],
        ];

        foreach ($beritas as $beritaData) {
            $kategori = $kategoris->where('nama', $beritaData['kategori'])->first();

            // Pastikan kategori ditemukan sebelum membuat berita
            if ($kategori) {
                Berita::create([
                    'judul' => $beritaData['judul'],
                    'foto_header' => $beritaData['header_image'],
                    'kategori_id' => $kategori->id, // Ambil ID kategori yang sesuai
                    'konten' => $beritaData['deskripsi'],
                    'status' => true, // Default status aktif
                    'user_id' => '1', // Menggunakan user_id dari user pertama
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $this->command->warn("Kategori '{$beritaData['kategori']}' tidak ditemukan. Berita '{$beritaData['judul']}' tidak dibuat.");
            }
        }
    }
}
