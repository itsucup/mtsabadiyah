<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'konten',
        'header_url',
        'user_id',
        'kategori_id', // <--- TAMBAHKAN INI
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Berita dimiliki oleh KategoriBerita
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }
}