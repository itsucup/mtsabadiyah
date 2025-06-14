<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Untuk membuat slug

class KategoriJabatan extends Model
{
    use HasFactory;

    protected $table = 'kategori_jabatan';

    protected $fillable = [
        'nama',
        'slug',
    ];

    // Event untuk membuat slug otomatis saat kategori dibuat atau diperbarui
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategoriJabatan) {
            $kategoriJabatan->slug = Str::slug($kategoriJabatan->nama);
        });

        static::updating(function ($kategoriJabatan) {
             $kategoriJabatan->slug = Str::slug($kategoriJabatan->nama);
        });
    }

    // Relasi: KategoriJabatan memiliki banyak StaffDanGuru
    public function staffDanGurus()
    {
        return $this->hasMany(StaffDanGuru::class, 'kategori_jabatan_id');
    }
}