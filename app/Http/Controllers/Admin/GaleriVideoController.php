<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriVideo; // Import Model GaleriVideo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login

class GaleriVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = GaleriVideo::with('user')->latest()->paginate(10);
        return view('cms.admin.galeri.video.index', compact('videos'));
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
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'video_url' => 'required|url|regex:/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/i', // Validasi URL YouTube
            'status' => 'boolean',
        ]);

        GaleriVideo::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'video_url' => $request->video_url,
            'thumbnail_url' => $request->thumbnail_url, // Jika Anda ingin custom thumbnail, jika tidak, bisa kosongkan di form
            'status' => $request->boolean('status'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('cms.admin.galeri.video.index')->with('success', 'Video berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GaleriVideo $galeriVideo)
    {
        return view('cms.admin.galeri.video.edit', compact('galeriVideo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GaleriVideo $galeriVideo)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'video_url' => 'required|url|regex:/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/i',
            'status' => 'boolean',
        ]);

        $galeriVideo->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'video_url' => $request->video_url,
            'thumbnail_url' => $request->thumbnail_url, // Jika Anda ingin custom thumbnail
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('cms.admin.galeri.video.index')->with('success', 'Video berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GaleriVideo $galeriVideo)
    {
        $galeriVideo->delete();
        return redirect()->route('cms.admin.galeri.video.index')->with('success', 'Video berhasil dihapus!');
    }
}