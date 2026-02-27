<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peraturan;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    public function index()
    {
        $peraturans = Peraturan::latest()->paginate(15);
        return view('admin.peraturan.index', compact('peraturans'));
    }

    public function create()
    {
        return view('admin.peraturan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:200',
            'kategori' => 'required|max:50',
            'file' => 'required|mimes:pdf|max:10240',
            'deskripsi' => 'nullable',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/files/peraturan'), $filename);

        Peraturan::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'file' => $filename,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.peraturan.index')
            ->with('success', 'Peraturan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $peraturan = Peraturan::findOrFail($id);
        
        // Delete file
        $filePath = public_path('assets/files/peraturan/' . $peraturan->file);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        
        $peraturan->delete();

        return redirect()->route('admin.peraturan.index')
            ->with('success', 'Peraturan berhasil dihapus!');
    }
}
