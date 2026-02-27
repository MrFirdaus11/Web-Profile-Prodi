<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KurikulumInfo;
use App\Models\BaganKurikulum;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index()
    {
        $infos = KurikulumInfo::ordered()->get();
        $bagans = BaganKurikulum::ordered()->get();
        $mataKuliahs = MataKuliah::ordered()->get()->groupBy('semester');
        
        return view('admin.kurikulum.index', compact('infos', 'bagans', 'mataKuliahs'));
    }

    // =====================
    // INFORMASI PENTING
    // =====================
    public function storeInfo(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        KurikulumInfo::create([
            'judul' => $request->judul,
            'url' => $request->url,
            'urutan' => KurikulumInfo::max('urutan') + 1,
            'aktif' => true,
        ]);

        return back()->with('success', 'Informasi berhasil ditambahkan!');
    }

    public function updateInfo(Request $request, KurikulumInfo $info)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $info->update([
            'judul' => $request->judul,
            'url' => $request->url,
        ]);

        return back()->with('success', 'Informasi berhasil diupdate!');
    }

    public function destroyInfo(KurikulumInfo $info)
    {
        $info->delete();
        return back()->with('success', 'Informasi berhasil dihapus!');
    }

    // =====================
    // BAGAN KURIKULUM
    // =====================
    public function storeBagan(Request $request)
    {
        $request->validate([
            'angkatan' => 'required|string|max:50',
            'link_bagan' => 'nullable|url',
            'link_matkul' => 'nullable|url',
        ]);

        BaganKurikulum::create([
            'angkatan' => $request->angkatan,
            'link_bagan' => $request->link_bagan,
            'link_matkul' => $request->link_matkul,
            'urutan' => BaganKurikulum::max('urutan') + 1,
        ]);

        return back()->with('success', 'Bagan kurikulum berhasil ditambahkan!');
    }

    public function updateBagan(Request $request, BaganKurikulum $bagan)
    {
        $request->validate([
            'angkatan' => 'required|string|max:50',
            'link_bagan' => 'nullable|url',
            'link_matkul' => 'nullable|url',
        ]);

        $bagan->update([
            'angkatan' => $request->angkatan,
            'link_bagan' => $request->link_bagan,
            'link_matkul' => $request->link_matkul,
        ]);

        return back()->with('success', 'Bagan kurikulum berhasil diupdate!');
    }

    public function destroyBagan(BaganKurikulum $bagan)
    {
        $bagan->delete();
        return back()->with('success', 'Bagan kurikulum berhasil dihapus!');
    }

    // =====================
    // MATA KULIAH / RPS
    // =====================
    public function storeMatkul(Request $request)
    {
        $request->validate([
            'semester' => 'required|integer|min:1|max:8',
            'kode' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'file_rps' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = [
            'semester' => $request->semester,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'sks' => $request->sks,
            'urutan' => MataKuliah::where('semester', $request->semester)->max('urutan') + 1,
        ];

        if ($request->hasFile('file_rps')) {
            $file = $request->file('file_rps');
            $filename = 'rps_' . $request->kode . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/files/rps'), $filename);
            $data['file_rps'] = $filename;
        }

        MataKuliah::create($data);

        return back()->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function updateMatkul(Request $request, MataKuliah $matkul)
    {
        $request->validate([
            'semester' => 'required|integer|min:1|max:8',
            'kode' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'file_rps' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = [
            'semester' => $request->semester,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'sks' => $request->sks,
        ];

        if ($request->hasFile('file_rps')) {
            // Delete old file
            if ($matkul->file_rps && file_exists(public_path('assets/files/rps/' . $matkul->file_rps))) {
                unlink(public_path('assets/files/rps/' . $matkul->file_rps));
            }
            
            $file = $request->file('file_rps');
            $filename = 'rps_' . $request->kode . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/files/rps'), $filename);
            $data['file_rps'] = $filename;
        }

        $matkul->update($data);

        return back()->with('success', 'Mata kuliah berhasil diupdate!');
    }

    public function destroyMatkul(MataKuliah $matkul)
    {
        // Delete file if exists
        if ($matkul->file_rps && file_exists(public_path('assets/files/rps/' . $matkul->file_rps))) {
            unlink(public_path('assets/files/rps/' . $matkul->file_rps));
        }
        
        $matkul->delete();
        return back()->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
