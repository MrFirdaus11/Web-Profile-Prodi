<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::orderBy('tgl_upload', 'desc')->paginate(10);
        return view('admin.dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        return view('admin.dokumen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dokumen' => 'required|string|max:100',
            'kategori' => 'required|in:Akademik,Skripsi,Jadwal',
            'url' => 'required|url',
        ]);

        Dokumen::create([
            'nama_dokumen' => $validated['nama_dokumen'],
            'url' => $validated['url'],
            'kategori' => $validated['kategori'],
            'tgl_upload' => now()->toDateString(),
        ]);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('admin.dokumen.edit', compact('dokumen'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $validated = $request->validate([
            'nama_dokumen' => 'required|string|max:100',
            'kategori' => 'required|in:Akademik,Skripsi,Jadwal',
            'url' => 'required|url',
        ]);

        $dokumen->update([
            'nama_dokumen' => $validated['nama_dokumen'],
            'url' => $validated['url'],
            'kategori' => $validated['kategori'],
        ]);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil diupdate!');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->delete();

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus!');
    }
}
