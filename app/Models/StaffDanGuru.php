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
        // 'jabatan', // <-- Hapus ini jika Anda menghapus kolom 'jabatan' di migrasi
        'kategori_jabatan_id', // <-- Tambahkan ini
        'foto',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    // Relasi: StaffDanGuru dimiliki oleh KategoriJabatan
    public function kategoriJabatan()
    {
        return $this->belongsTo(KategoriJabatan::class, 'kategori_jabatan_id');
    }
}