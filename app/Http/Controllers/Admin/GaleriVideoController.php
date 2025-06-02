<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleriVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $galeriVideos = GaleriVideo::with('user')->latest()->paginate(10);
        } else {
            $galeriVideos = GaleriVideo::where('user_id', Auth::id())->with('user')->latest()->paginate(10);
        }
        return view('cms.admin.galeri.video.index', compact('galeriVideos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.admin.galeri.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'youtube_link' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'status_aktif' => 'boolean',
        ]);

        $processedLink = $this->getEmbedUrl($request->youtube_link); // Panggil helper
        if (!$processedLink) {
            return back()->withErrors(['youtube_link' => 'Format Link YouTube tidak valid. Gunakan link tonton standar atau link share.'])->withInput();
        }

        GaleriVideo::create([
            'youtube_link' => $processedLink, // Simpan yang sudah di-embed
            'judul' => $request->judul,
            'status_aktif' => $request->boolean('status_aktif'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('cms.admin.galeri.video.index')
                         ->with('success', 'Video berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GaleriVideo $galeriVideo)
    {
        if (Auth::user()->role !== 'admin' && $galeriVideo->user_id !== Auth::id()) {
            return redirect()->route('cms.admin.galeri.video.index')->with('error', 'Anda tidak memiliki izin untuk mengedit video ini.');
        }
        return view('cms.admin.galeri.video.edit', compact('galeriVideo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GaleriVideo $galeriVideo)
    {
        if (Auth::user()->role !== 'admin' && $galeriVideo->user_id !== Auth::id()) {
            return redirect()->route('cms.admin.galeri.video.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui video ini.');
        }

        $request->validate([
            'youtube_link' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'status_aktif' => 'boolean',
        ]);

        $processedLink = $this->getEmbedUrl($request->youtube_link); // Panggil helper
        if (!$processedLink) {
            return back()->withErrors(['youtube_link' => 'Format Link YouTube tidak valid. Gunakan link tonton standar atau link share.'])->withInput();
        }

        $galeriVideo->update([
            'youtube_link' => $processedLink, // Simpan yang sudah di-embed
            'judul' => $request->judul,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('cms.admin.galeri.video.index')
                         ->with('success', 'Video berhasil diperbarui!');
    }

    // Tambahkan helper function ini di dalam class GaleriVideoController
    private function getEmbedUrl(string $youtubeLink): ?string
    {
        // Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ
        // Contoh: https://www.youtube.com
        // Contoh: youtu.be/
        // Contoh: youtu.be/3

        // Pola untuk link 'watch?v='
        if (preg_match('/(?:youtube\\.com\\/(?:watch\\?v=|embed\\/|v\\/|shorts\\/)|youtu\\.be\\/)([a-zA-Z0-9_-]{11})/', $youtubeLink, $matches)) {
            $videoId = $matches[1];
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        // Jika link sudah dalam format embed (misal: sudah dari embed code YouTube), biarkan saja
        if (str_contains($youtubeLink, 'youtube.com/embed/')) {
            return $youtubeLink;
        }

        return null; // Format tidak valid atau tidak dikenali
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GaleriVideo $galeriVideo)
    {
        if (Auth::user()->role !== 'admin' && $galeriVideo->user_id !== Auth::id()) {
            return redirect()->route('cms.admin.galeri.video.index')->with('error', 'Anda tidak memiliki izin untuk menghapus video ini.');
        }

        $galeriVideo->delete();

        return redirect()->route('cms.admin.galeri.video.index')
                         ->with('success', 'Video berhasil dihapus!');
    }
}