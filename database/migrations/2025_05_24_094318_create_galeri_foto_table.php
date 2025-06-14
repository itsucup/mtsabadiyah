<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galeri_foto', function (Blueprint $table) {
            $table->id();

            $table->string('gambar_url');
            $table->string('judul');
            $table->text('deskripsi')->nullable(); // Deskripsi foto, bisa kosong

            // Kolom Kategori (Foreign Key ke tabel kategori_foto)
            // Memungkinkan foto memiliki kategori, dan jika kategori dihapus, kategori_foto_id menjadi NULL
            $table->foreignId('kategori_foto_id')->nullable()->constrained('kategori_foto')->onDelete('set null');

            $table->boolean('status')->default(true); // Status: true (aktif/tayang), false (tidak aktif/draft)

            // Foreign Key untuk user yang mengunggah/menambahkan foto
            // Jika user dihapus, user_id di sini menjadi null (foto tidak ikut terhapus)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_foto');
    }
};