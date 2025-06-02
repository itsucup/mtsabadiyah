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
        Schema::create('sambutan_kepala_sekolah', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis (primary key)
            $table->string('judul', 255); // Kolom judul halaman sambutan
            $table->string('gambar_header')->nullable(); // URL gambar header (bisa PNG, JPG, dll.), bisa kosong
            $table->longText('sambutan_text')->nullable(); // Teks sambutan, menggunakan longText untuk teks panjang, bisa kosong
            $table->string('nama_kepala_sekolah', 100)->nullable(); // Nama Kepala Sekolah
            $table->string('jabatan_kepala_sekolah', 100)->nullable(); // Jabatan Kepala Sekolah (opsional, jika ingin spesifik)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sambutan_kepala_sekolah');
    }
};