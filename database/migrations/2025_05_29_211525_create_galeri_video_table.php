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
        Schema::create('galeri_video', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul video
            $table->text('deskripsi')->nullable(); // Deskripsi video, opsional
            $table->string('video_url'); // URL link YouTube (misal: https://www.youtube.com/watch?v=dQw4w9WgXcQ)
            $table->string('thumbnail_url')->nullable(); // URL thumbnail video (opsional, bisa diambil dari YouTube API)
            $table->boolean('status')->default(true); // Status: true (aktif/tayang), false (tidak aktif/draft)

            // Foreign key untuk user yang mengunggah/menambahkan link video
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_video');
    }
};