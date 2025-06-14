<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaSetting extends Model
{
    use HasFactory;

    protected $table = 'lembaga_settings';

    protected $fillable = [
        'nama_lembaga',
        'logo_url',
        'deskripsi_singkat',
        'alamat',
        'google_maps_url',
        'no_telepon',
        'no_fax',
        'email',
        'facebook_url',
        'instagram_url',
        'tiktok_url',
        'youtube_url',
    ];
}