<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumenAkademik = Dokumen::where('kategori', 'Akademik')->orderBy('tgl_upload', 'desc')->get();
        $dokumenSkripsi = Dokumen::where('kategori', 'Skripsi')->orderBy('tgl_upload', 'desc')->get();
        $dokumenJadwal = Dokumen::where('kategori', 'Jadwal')->orderBy('tgl_upload', 'desc')->get();
        
        return view('public.dokumen', compact('dokumenAkademik', 'dokumenSkripsi', 'dokumenJadwal'));
    }
}
