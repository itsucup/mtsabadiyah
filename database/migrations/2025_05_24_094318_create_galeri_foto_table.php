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
            $table->string('gambar_url'); // URL gambar
            $table->string('judul', 255); // Judul foto
            $table->text('deskripsi_singkat')->nullable(); // Deskripsi singkat
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
        Schema::dropIfExists('galeri_foto');
    }
};