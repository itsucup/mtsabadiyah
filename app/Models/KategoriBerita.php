<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;

    protected $table = 'kategori_berita';

    protected $fillable = ['nama', 'slug', 'deskripsi'];

    // Relasi: Satu KategoriBerita memiliki banyak Berita
    public function beritas()
    {
        return $this->hasMany(Berita::class, 'kategori_id');
    }
}