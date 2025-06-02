<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;
    protected $table = 'prestasi';
    protected $fillable = [
        'nama_lengkap_anggota',
        'nama_prestasi',
        'tingkat_prestasi',
        'instansi_penyelenggara',
        'tahun',
    ];
    protected $casts = [
        'tahun' => 'integer',
    ];
}