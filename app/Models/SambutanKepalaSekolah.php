<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambutanKepalaSekolah extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi Laravel
    protected $table = 'sambutan_kepala_sekolah';

    // Tentukan kolom mana yang bisa diisi secara massal
    protected $fillable = [
        'judul', // Tambahkan kolom judul
        'gambar_header',
        'sambutan_text',
        'nama_kepala_sekolah',
        'jabatan_kepala_sekolah',
    ];

}