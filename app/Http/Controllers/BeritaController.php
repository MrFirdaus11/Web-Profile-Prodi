<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::published()->latest()->paginate(9);
        return view('public.berita', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->published()->firstOrFail();
        $beritaLainnya = Berita::published()
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(3)
            ->get();
            
        return view('public.berita-detail', compact('berita', 'beritaLainnya'));
    }
}
