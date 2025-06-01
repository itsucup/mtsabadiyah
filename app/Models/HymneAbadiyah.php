<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HymneAbadiyah extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'hymne_abadiyah';

    // Kolom yang bisa diisi secara massal (mass assignable)
    protected $fillable = [
        'video_url',
        'lirik',
    ];

}