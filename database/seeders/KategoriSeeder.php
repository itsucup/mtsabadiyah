<?php

namespace Database\Seeders;

use App\Models\KategoriBerita;   // Import model KategoriBerita
use App\Models\KategoriFoto;     // Import model KategoriFoto
use App\Models\KategoriJabatan;  // Import model KategoriJabatan
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;       // Untuk menggunakan Str::slug()

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- Seeder untuk Kategori Berita ---
        $kategoriBeritaData = [
            ['nama' => 'Pengumuman', 'deskripsi' => 'Berita penting dan informasi resmi dari sekolah.'],
            ['nama' => 'Kegiatan Sekolah', 'deskripsi' => 'Liputan acara dan kegiatan yang diadakan di lingkungan sekolah.'],
            ['nama' => 'Prestasi Siswa', 'deskripsi' => 'Berita mengenai pencapaian dan prestasi siswa.'],
            ['nama' => 'Pendidikan', 'deskripsi' => 'Artikel atau informasi terkait dunia pendidikan dan kurikulum.'],
            ['nama' => 'Umum', 'deskripsi' => 'Kategori umum untuk berita lainnya.'],
        ];

        foreach ($kategoriBeritaData as $kategori) {
            KategoriBerita::create([
                'nama' => $kategori['nama'],
                'slug' => Str::slug($kategori['nama']),
                'deskripsi' => $kategori['deskripsi'],
            ]);
        }

        // --- Seeder untuk Kategori Foto ---
        $kategoriFotoData = [
            ['nama' => 'Karya Siswa'],
            ['nama' => 'Karya Guru'],
        ];

        foreach ($kategoriFotoData as $kategori) {
            KategoriFoto::create([
                'nama' => $kategori['nama'],
                'slug' => Str::slug($kategori['nama']),
            ]);
        }

        // --- Seeder untuk Kategori Jabatan ---
        $kategoriJabatanData = [
            ['nama' => 'Kepala Sekolah'],
            ['nama' => 'Guru'],
            ['nama' => 'Staf Tata Usaha'],
            ['nama' => 'Staf Kebersihan'],
            ['nama' => 'Penjaga Keamanan'],
        ];

        foreach ($kategoriJabatanData as $kategori) {
            KategoriJabatan::create([
                'nama' => $kategori['nama'],
                'slug' => Str::slug($kategori['nama']),
            ]);
        }
    }
}