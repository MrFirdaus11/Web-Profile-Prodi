<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Pesan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalDokumen = Dokumen::count();
        $totalPesan = Pesan::count();
        $pesanBelumDibaca = Pesan::unread()->count();
        
        $beritaTerbaru = Berita::latest()->take(5)->get();
        $pesanTerbaru = Pesan::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalDokumen',
            'totalPesan',
            'pesanBelumDibaca',
            'beritaTerbaru',
            'pesanTerbaru'
        ));
    }
}
