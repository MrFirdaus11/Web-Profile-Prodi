<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Profil;
use App\Models\Dosen;
use App\Models\Faq;
use App\Models\KurikulumInfo;
use App\Models\BaganKurikulum;
use App\Models\MataKuliah;

class PublicController extends Controller
{
    public function index()
    {
        $beritas = Berita::published()->latest()->take(3)->get();
        return view('public.index', compact('beritas'));
    }

    public function akademik()
    {
        $gelar = Profil::getValue('gelar', 'Sarjana Komputer (S.Kom)');
        $durasi = Profil::getValue('durasi_studi', '4 Tahun (8 Semester)');
        $sks = Profil::getValue('total_sks', '144 SKS');
        $kurikulum = Profil::getValue('kurikulum', 'Kurikulum disesuaikan dengan kebutuhan industri dan perkembangan teknologi terkini.');
        $fasilitas = Profil::getValue('fasilitas', "Lab Komputer\nPerpustakaan\nWifi Kampus\nRuang Kelas AC");

        $infos = KurikulumInfo::aktif()->ordered()->get();
        $bagans = BaganKurikulum::ordered()->get();
        $mataKuliahs = MataKuliah::ordered()->get()->groupBy('semester');
        
        return view('public.akademik', compact(
            'gelar', 'durasi', 'sks', 'kurikulum', 'fasilitas',
            'infos', 'bagans', 'mataKuliahs'
        ));
    }

    // ===== PROFIL SUB-PAGES =====

    public function sambutan()
    {
        $sambutan = Profil::getValue('sambutan', 'Selamat datang di Program Studi Sistem Informasi UNPARI. Kami berkomitmen untuk mencetak lulusan yang profesional, inovatif, dan berkarakter di bidang teknologi informasi.');
        $kaprodi_nama = Profil::getValue('kaprodi_nama', 'Dr. Ahmad Fauzi, M.Kom');
        $kaprodi_jabatan = Profil::getValue('kaprodi_jabatan', 'Ketua Program Studi');
        $kaprodi_foto = Profil::getValue('kaprodi_foto', '');
        
        return view('public.profil.sambutan', compact('sambutan', 'kaprodi_nama', 'kaprodi_jabatan', 'kaprodi_foto'));
    }

    public function visiMisi()
    {
        $visi = Profil::getValue('visi');
        $misi = Profil::getValue('misi');
        return view('public.profil.visi-misi', compact('visi', 'misi'));
    }

    public function struktur()
    {
        $struktur_image = Profil::getValue('struktur_image', '');
        
        return view('public.profil.struktur', compact('struktur_image'));
    }

    public function programKelas()
    {
        $programs = \App\Models\ProgramKelas::aktif()->ordered()->get();
        return view('public.profil.program-kelas', compact('programs'));
    }

    public function dosen()
    {
        $dosens = Dosen::ordered()->get();
        return view('public.profil.dosen', compact('dosens'));
    }

    public function faq()
    {
        $faqs = Faq::aktif()->ordered()->get();
        return view('public.faq', compact('faqs'));
    }
}
