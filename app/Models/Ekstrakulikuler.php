<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakulikuler';

    protected $fillable = [
        'nama_ekstrakulikuler',
        'foto_ekstrakulikuler',
        'deskripsi_singkat',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

}