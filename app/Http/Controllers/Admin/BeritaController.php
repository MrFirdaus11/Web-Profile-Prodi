<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'isi_berita' => 'required|string',
            'status' => 'required|in:Published,Draft',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
            'gambar.mimes' => 'Format gambar harus jpg, jpeg, atau png',
        ]);

        $data = [
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '-' . time(),
            'isi_berita' => $validated['isi_berita'],
            'status' => $validated['status'],
            'tanggal' => now()->toDateString(),
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/berita'), $filename);
            $data['gambar'] = $filename;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'isi_berita' => 'required|string',
            'status' => 'required|in:Published,Draft',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul' => $validated['judul'],
            'isi_berita' => $validated['isi_berita'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($berita->gambar && file_exists(public_path('assets/img/berita/' . $berita->gambar))) {
                unlink(public_path('assets/img/berita/' . $berita->gambar));
            }
            
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/berita'), $filename);
            $data['gambar'] = $filename;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Hapus file gambar
        if ($berita->gambar && file_exists(public_path('assets/img/berita/' . $berita->gambar))) {
            unlink(public_path('assets/img/berita/' . $berita->gambar));
        }
        
        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
