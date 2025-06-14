<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranaPrasarana extends Model
{
    use HasFactory;

    protected $table = 'sarana_prasarana'; // Nama tabel

    protected $fillable = [
        'nama',
        'foto_url',
        'deskripsi',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Relasi: SaranaPrasarana dimiliki oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}