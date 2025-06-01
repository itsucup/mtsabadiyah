<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    use HasFactory;

    protected $table = 'sejarah'; // Nama tabel di database

    protected $fillable = [
        'judul',
        'header_image',
        'isi_konten',
    ];

    // Jika Anda tidak menggunakan timestamps (created_at, updated_at)
    // public $timestamps = false;
}