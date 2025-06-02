<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDanGuru extends Model
{
    use HasFactory;

    protected $table = 'staff_dan_guru';

    protected $fillable = [
        'nama',
        'foto',
        'jabatan',
        'jenis_kelamin',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean', // Penting untuk checkbox
    ];
}