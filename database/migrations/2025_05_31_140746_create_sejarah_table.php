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
        Schema::create('sejarah', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255); // Judul halaman sejarah
            $table->string('header_image')->nullable(); // URL gambar header
            $table->longText('isi_konten'); // Isi konten sejarah, menggunakan longText untuk WYSIWYG
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sejarah');
    }
};