<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\BaganKurikulum;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class AkademikController extends Controller
{
    public function index()
    {
        $kurikulum = Profil::getValue('kurikulum', 'Kurikulum disesuaikan dengan kebutuhan industri dan perkembangan teknologi terkini.');
        $gelar = Profil::getValue('gelar', 'Sarjana Komputer (S.Kom)');
        $durasi = Profil::getValue('durasi_studi', '4 Tahun (8 Semester)');
        $sks = Profil::getValue('total_sks', '144 SKS');
        $fasilitas = Profil::getValue('fasilitas', "Lab Komputer\nPerpustakaan\nWifi Kampus\nRuang Kelas AC");
        
        // Kurikulum data
        $bagans = BaganKurikulum::orderBy('angkatan', 'desc')->get();
        $mataKuliahs = MataKuliah::orderBy('kode')->get()->groupBy('semester');
        
        return view('admin.akademik.index', compact(
            'kurikulum', 'gelar', 'durasi', 'sks', 'fasilitas',
            'bagans', 'mataKuliahs'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'kurikulum' => 'required',
            'gelar' => 'required|max:100',
            'durasi_studi' => 'required|max:50',
            'total_sks' => 'required|max:20',
            'fasilitas' => 'required',
        ]);

        Profil::setValue('kurikulum', $request->kurikulum);
        Profil::setValue('gelar', $request->gelar);
        Profil::setValue('durasi_studi', $request->durasi_studi);
        Profil::setValue('total_sks', $request->total_sks);
        Profil::setValue('fasilitas', $request->fasilitas);

        return redirect()->route('admin.akademik.index')
            ->with('success', 'Data akademik berhasil diupdate!');
    }
}

