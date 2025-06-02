<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKelas extends Model
{
    use HasFactory;

    protected $table = 'program_kelas';

    protected $fillable = [
        'nama',
        'foto_icon',
        'deskripsi',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean', // Penting untuk checkbox
    ];
}