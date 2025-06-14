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
        Schema::create('lembaga_settings', function (Blueprint $table) {
            $table->id();

            $table->string('nama_lembaga')->nullable();
            $table->text('deskripsi_singkat')->nullable();
            $table->string('alamat')->nullable();
            $table->text('google_maps_url')->nullable(); 
            $table->string('no_telepon')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('email')->nullable();

            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('youtube_url')->nullable();

            $table->string('logo_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembaga_settings');
    }
};

