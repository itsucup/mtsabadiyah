<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    use HasFactory;

    protected $table = 'galeri_video';

    protected $fillable = [
        'judul',
        'deskripsi',
        'video_url',
        'thumbnail_url',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper function untuk mendapatkan YouTube video ID dari URL
    public function getYouTubeIdAttribute()
    {
        $url = $this->video_url;
        // Mengubah delimiter dari '/' menjadi '#'
        preg_match('#(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})#i', $url, $match);
        return $match[1] ?? null;
    }

    // Helper function untuk mendapatkan URL embed YouTube
    public function getYouTubeEmbedUrlAttribute()
    {
        $videoId = $this->youTubeId;
        // Perbaiki juga URL embed YouTube. Gunakan 'http://www.youtube.com/embed/'
        return $videoId ? "https://www.youtube.com/embed/{$videoId}" : null;
    }

    // Helper function untuk mendapatkan URL thumbnail YouTube default
    public function getYouTubeThumbnailUrlAttribute()
    {
        if ($this->thumbnail_url) {
            return $this->thumbnail_url;
        }
        $videoId = $this->youTubeId;
        // Perbaiki juga URL thumbnail YouTube.
        return $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : null;
    }
}