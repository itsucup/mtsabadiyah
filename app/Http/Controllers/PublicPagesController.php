<?php

namespace App\Http\Controllers;

use App\Models\Sejarah; // Impor model Sejarah
use App\Models\HymneAbadiyah; // Impor model Sejarah
use Illuminate\Http\Request;

class PublicPagesController extends Controller
{
    /**
     * Menampilkan halaman sejarah di sisi publik.
     */
    public function showSejarah()
    {
        // Ambil record sejarah pertama. Jika belum ada, akan null.
        $sejarah = Sejarah::first();
        return view('profil.sejarah', compact('sejarah'));
    }

    public function showHymne()
    {
        // Ambil record hymne pertama. Jika belum ada, akan null.
        $hymne = HymneAbadiyah::first();
        return view('profil.hymne', compact('hymne'));
    }
}