<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakulikuler';

    protected $fillable = [
        'nama',
        'foto_icon',
        'deskripsi_singkat',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean', // Penting untuk checkbox
    ];
}