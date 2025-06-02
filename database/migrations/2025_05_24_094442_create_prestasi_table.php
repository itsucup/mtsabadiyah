<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->text('nama_lengkap_anggota');
            $table->string('nama_prestasi');
            $table->enum('tingkat_prestasi', ['Sekolah', 'Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional']);
            $table->string('instansi_penyelenggara');
            $table->year('tahun');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};