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
        Schema::create('sarana_prasarana', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama sarana/prasarana (misal: Ruang Kelas A, Lapangan Basket)
            $table->string('foto_url')->nullable(); // URL atau path foto sarana/prasarana
            $table->text('deskripsi')->nullable(); // Deskripsi detail, bisa kosong
            $table->boolean('status')->default(true); // Aktif/Tidak Aktif (tampil di front-end)

            // Opsional: Foreign key untuk user yang mengunggah
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarana_prasarana');
    }
};