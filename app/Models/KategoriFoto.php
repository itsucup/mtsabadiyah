<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriFoto extends Model
{
    use HasFactory;

    protected $table = 'kategori_foto';

    protected $fillable = [
        'nama',
        'slug',
    ];

    // Event untuk membuat slug otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategoriFoto) {
            $kategoriFoto->slug = Str::slug($kategoriFoto->nama);
        });

        static::updating(function ($kategoriFoto) {
             $kategoriFoto->slug = Str::slug($kategoriFoto->nama);
        });
    }

    // Relasi: KategoriFoto memiliki banyak GaleriFoto
    public function galeriFotos()
    {
        return $this->hasMany(GaleriFoto::class, 'kategori_foto_id');
    }
}