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
        Schema::create('mars_madrasah_abadiyah', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis (primary key)
            $table->string('video_url', 255)->nullable(); // URL video (misalnya dari YouTube), bisa kosong
            $table->longText('lirik')->nullable(); // Lirik lagu, menggunakan longText untuk teks panjang, bisa kosong
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mars_madrasah_abadiyah');
    }
};