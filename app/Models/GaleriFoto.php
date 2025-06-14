<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    use HasFactory;

    protected $table = 'galeri_foto';

    protected $fillable = [
        'gambar_url',
        'judul',
        'deskripsi',
        'kategori',
        'status',
        'user_id',
        'kategori_foto_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Relasi: GaleriFoto dimiliki oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategoriFoto()
    {
        return $this->belongsTo(KategoriFoto::class, 'kategori_foto_id');
    }
}