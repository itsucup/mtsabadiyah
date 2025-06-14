<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail // implements MustVerifyEmail opsional, tergantung konfigurasi Anda
{
    use HasFactory, Notifiable; //HasApiTokens

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',          // Tambahkan ini
        'alamat',        // Tambahkan ini
        'nomor_telepon', // Tambahkan ini
        'status',        // Tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'boolean', // Penting: cast status ke boolean
    ];

    /**
     * Get the news articles for the user.
     */
    public function beritas()
    {
        return $this->hasMany(Berita::class, 'user_id'); // User memiliki banyak Berita
    }
}