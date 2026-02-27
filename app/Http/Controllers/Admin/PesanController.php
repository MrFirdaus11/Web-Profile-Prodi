<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function index()
    {
        $pesans = Pesan::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pesan.index', compact('pesans'));
    }

    public function show($id)
    {
        $pesan = Pesan::findOrFail($id);
        
        if (!$pesan->dibaca) {
            $pesan->update(['dibaca' => true]);
        }
        
        return view('admin.pesan.show', compact('pesan'));
    }

    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}
