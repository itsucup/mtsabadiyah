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
        Schema::create('staff_dan_guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('foto')->nullable();
            $table->string('jabatan', 50);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_dan_guru');
    }
};