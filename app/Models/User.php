<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- DITAMBAHKAN
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Berita;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * =========================================================================
     * PERUBAHAN UTAMA: Definisi Role Terpusat
     * =========================================================================
     *
     * Ini akan digunakan di UserController (untuk validasi)
     * dan di view (untuk membuat dropdown dinamis).
     */
    public const ROLES = [
        'admin' => 'Admin',
        'kontributor' => 'Kontributor',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'alamat',
        'nomor_telepon',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'boolean',
    ];

    /**
     * =========================================================================
     * RELASI
     * =========================================================================
     */

    /**
     * Get the news articles for the user.
     */
    public function beritas(): HasMany // <-- DITAMBAHKAN return type
    {
        return $this->hasMany(Berita::class, 'user_id');
    }

    /**
     * =========================================================================
     * HELPER METHOD UNTUK ROLE (Disederhanakan)
     * =========================================================================
     */

    /**
     * Cek apakah user adalah Super Super Admin.
     * Email mereka didefinisikan di file config (yang membaca .env).
     */
    public function isSuperAdmin(): bool
    {
        // env() tidak boleh dipakai di luar config, tapi untuk .env
        // kita bisa pakai config() untuk membacanya.
        // Kita akan asumsikan Anda menambahkannya di config/auth.php
        
        // Untuk amannya, kita baca .env langsung di sini.
        // ATAU cara lebih baik: tambahkan di config/auth.php
        // 'super_admin' => env('SUPER_ADMIN_EMAIL'),
        // lalu panggil: config('auth.super_admin')
        
        return $this->email === env('SUPER_ADMIN_EMAIL');
    }

    /**
     * Cek apakah user adalah admin.
     * MODIFIKASI: Admin BUKANLAH Super Admin.
     */
    public function isAdmin(): bool
    {
        // Admin adalah yang rolenya 'admin' TAPI BUKAN super admin
        return $this->role === 'admin' && !$this->isSuperAdmin();
    }

    /**
     * Cek apakah user adalah Kontributor.
     */
    public function isKontributor(): bool
    {
        return $this->role === 'kontributor';
    }

}