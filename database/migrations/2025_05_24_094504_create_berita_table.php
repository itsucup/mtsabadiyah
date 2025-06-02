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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255); // Judul berita
            $table->string('foto_header')->nullable(); // URL foto header berita
            $table->longText('konten'); // Isi berita, menggunakan longText untuk Markdown
            $table->boolean('status_aktif')->default(true); // Status aktif (tampil) atau draft (tidak tampil)

            // Kolom untuk pengupload
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};