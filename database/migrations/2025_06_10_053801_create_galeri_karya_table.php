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
        Schema::create('galeri_karya', function (Blueprint $table) {
            $table->id();
            $table->string('gambar_url'); // URL atau path gambar karya
            $table->string('judul');      // Judul karya
            $table->text('deskripsi')->nullable(); // Deskripsi karya, bisa kosong
            $table->boolean('status')->default(true); // Aktif/Tidak Aktif

            // Foreign key untuk user yang mengunggah
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_karya');
    }
};