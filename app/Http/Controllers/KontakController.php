<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\Profil;
use App\Models\KurikulumInfo;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $alamat = Profil::getValue('alamat');
        $telepon = Profil::getValue('telepon');
        $email = Profil::getValue('email');
        $links = KurikulumInfo::aktif()->ordered()->get();
        
        return view('public.kontak', compact('alamat', 'telepon', 'email', 'links'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'pesan' => 'required|string',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'pesan.required' => 'Pesan wajib diisi',
        ]);

        Pesan::create($validated);

        return redirect()->route('kontak')
            ->with('success', 'Pesan Anda berhasil dikirim. Terima kasih!');
    }
}
