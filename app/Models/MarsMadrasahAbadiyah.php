<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarsMadrasahAbadiyah extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi Laravel
    protected $table = 'mars_madrasah_abadiyah';

    // Tentukan kolom mana yang bisa diisi secara massal
    protected $fillable = [
        'video_url',
        'lirik',
    ];

}