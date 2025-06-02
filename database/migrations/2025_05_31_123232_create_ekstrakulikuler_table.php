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
        Schema::create('ekstrakulikuler', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100); // Nama Ekstrakulikuler
            $table->string('foto_icon')->nullable(); // Path/URL foto atau ikon
            $table->text('deskripsi_singkat')->nullable(); // Deskripsi singkat
            $table->boolean('status_aktif')->default(true); // Status aktif atau tidak aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakulikuler');
    }
};