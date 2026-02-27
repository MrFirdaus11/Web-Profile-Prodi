<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\KurikulumInfo;
use App\Models\Faq;
use App\Models\Pesan;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        // Kontak data
        $alamat = Profil::getValue('alamat', 'Jl. Jend. Ahmad Yani, Lubuklinggau');
        $telepon = Profil::getValue('telepon', '(0733) 123456');
        $email = Profil::getValue('email', 'si@unpari.ac.id');
        
        // Link Penting
        $links = KurikulumInfo::orderBy('urutan')->orderBy('created_at')->get();
        
        // FAQ
        $faqs = Faq::ordered()->get();
        
        // Pesan Masuk
        $pesans = Pesan::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.kontak.index', compact(
            'alamat', 'telepon', 'email',
            'links', 'faqs', 'pesans'
        ));
    }

    public function updateKontak(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:50',
            'email' => 'required|email|max:100',
        ]);

        Profil::setValue('alamat', $request->alamat);
        Profil::setValue('telepon', $request->telepon);
        Profil::setValue('email', $request->email);

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Data kontak berhasil diupdate!');
    }

    // =====================
    // LINK PENTING
    // =====================
    public function storeLink(Request $request)
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

        return back()->with('success', 'Link berhasil ditambahkan!');
    }

    public function updateLink(Request $request, KurikulumInfo $link)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $link->update([
            'judul' => $request->judul,
            'url' => $request->url,
        ]);

        return back()->with('success', 'Link berhasil diupdate!');
    }

    public function destroyLink(KurikulumInfo $link)
    {
        $link->delete();
        return back()->with('success', 'Link berhasil dihapus!');
    }

    // =====================
    // PESAN
    // =====================
    public function showPesan($id)
    {
        $pesan = Pesan::findOrFail($id);
        
        if (!$pesan->dibaca) {
            $pesan->update(['dibaca' => true]);
        }
        
        return view('admin.pesan.show', compact('pesan'));
    }

    public function destroyPesan($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
    // =====================
    // FAQ
    // =====================
    public function storeFaq(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:500',
            'jawaban' => 'required|string',
        ]);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'urutan' => Faq::max('urutan') + 1,
            'aktif' => true,
        ]);

        return back()->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function updateFaq(Request $request, Faq $faq)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:500',
            'jawaban' => 'required|string',
        ]);

        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);

        return back()->with('success', 'FAQ berhasil diupdate!');
    }

    public function destroyFaq(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ berhasil dihapus!');
    }
}
