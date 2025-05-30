<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi Laravel (plural nama model)
    protected $table = 'berita'; // Opsional, jika nama tabel Anda adalah 'berita' bukan 'beritas'

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'judul',
        'konten',
        'header_url',
        'user_id',
        'status', // Tambahkan ini
    ];

    // Cast kolom status ke boolean
    protected $casts = [
        'status' => 'boolean',
    ];

    // Definisi relasi: Berita dimiliki oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}