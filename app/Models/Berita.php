<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita'; // Nama tabel di database

    protected $fillable = [
        'judul',
        'foto_header',
        'konten',
        'status_aktif',
        'user_id', // Pastikan user_id bisa diisi
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    /**
     * Relasi ke model User (pengunggah berita)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}